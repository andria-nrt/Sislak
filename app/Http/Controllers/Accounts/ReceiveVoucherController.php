<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AisAccountsConfig;
use App\Model\AisCoaTypes;
use App\Model\AisCoaGeneralLedger;
use App\Model\AisCoaSubsidiaryLedger;
use App\Model\AisSubsidiaryCalculation;
use App\Model\AisVouchers;
use App\Model\AisVoucherDetails;
use App\Model\Logs;
use Auth;
use DB;
use DateTime;

class ReceiveVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["vouchers"] = AisVouchers::where('transaction_type', 2)->orderBy('id', 'desc')->get();
        return view('accounts.receiveVoucher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tran_date = new DateTime();
        $data["tran_date"] = $tran_date->format('d/m/Y');

        $cash = AisAccountsConfig::where('particular', 'cash')->first();

        $slLedgers = AisCoaSubsidiaryLedger::join('ais_coa_general_ledger', 'ais_coa_subsidiary_ledger.general_ledger_id', '=', 'ais_coa_general_ledger.id')
            ->select('ais_coa_subsidiary_ledger.*', DB::raw('concat(ais_coa_general_ledger.ledger_code, " - ", ais_coa_general_ledger.ledger_head) as glName'))
            ->where('general_ledger_id', '!=', $cash->gl_id)
            ->orderBy('ledger_code', 'asc')->get();
        $data["slLedgers"] = $slLedgers->groupBy('glName')->all();
        $data["slLedgerData"] = $slLedgers->keyBy('id')->toJson();

        $cashLedgers = AisCoaSubsidiaryLedger::where('general_ledger_id', '=', $cash->gl_id)
            ->orderBy('ledger_code', 'asc')->get();
        $data["cashLedgers"] = $cashLedgers;
        $data["cashLedgerData"] = $cashLedgers->keyBy('id')->toJson();

        return view('accounts.receiveVoucher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'trans_date' => 'required'
        ]);

        if(!empty($request->sl_id) && count($request->sl_id)>0) {
            $voucher_no = AisVouchers::where("transaction_type",2)->orderBy("voucher_code_number", "desc")->first();
            if(!empty($voucher_no)) {
                $voucher_code_number = $voucher_no->voucher_code_number+1;
            } else {
                $voucher_code_number = 1;
            }
            $voucher_no = "RV-".$voucher_code_number;

            //Date
            $trans_date = DateTime::createFromFormat('d/m/Y', $request->trans_date);
            $trans_date = $trans_date->format('Y-m-d');

            DB::beginTransaction();
            $inputData = [
                "voucher_code" => $voucher_no,
                "voucher_code_number" => $voucher_code_number,
                "transaction_type" => 2,
                "transaction_amount" => $request->total_amount,
                "transaction_date" => $trans_date,
                "remarks" => $request->remarks
            ];
            AisVouchers::create($inputData);
            $voucher_id = AisVouchers::orderBy("id", "desc")->first()->id;

            //Add
            foreach($request->sl_id as $i=>$sl_id) {
                $trans_by = $request->trans_by[$i];
                $amount = $request->amount[$i];

                $sl_details = AisCoaSubsidiaryLedger::find($sl_id);
                $tranBy_details = AisCoaSubsidiaryLedger::find($trans_by);

                //Tran Detail
                AisVoucherDetails::create([
                    "voucher_id" => $voucher_id,
                    "dr_gl_ledger" => $tranBy_details->general_ledger_id,
                    "dr_sub_ledger" => $trans_by,
                    "cr_gl_ledger" => $sl_details->general_ledger_id,
                    "cr_sub_ledger" => $sl_id,
                    "transaction_amount" => $amount
                ]);
                $voucherDtl_id = AisVoucherDetails::orderBy("id", "desc")->first()->id;

                //Debit
                AisSubsidiaryCalculation::create([
                    "particular_sl" => $sl_id,
                    "gl_ledger" => $tranBy_details->general_ledger_id,
                    "sub_ledger" => $trans_by,
                    "acc_type" => $tranBy_details->type_id,
                    "transaction_date" => $trans_date,
                    "debit_amount" => $amount,
                    "credit_amount" => 0,
                    "voucher_id" => $voucher_id,
                    "voucher_details_id" => $voucherDtl_id
                ]);

                //Credit
                AisSubsidiaryCalculation::create([
                    "particular_sl" => $trans_by,
                    "gl_ledger" => $sl_details->general_ledger_id,
                    "sub_ledger" => $sl_id,
                    "acc_type" => $sl_details->type_id,
                    "transaction_date" => $trans_date,
                    "debit_amount" => 0,
                    "credit_amount" => $amount,
                    "voucher_id" => $voucher_id,
                    "voucher_details_id" => $voucherDtl_id
                ]);
            }

            Logs::add("Receive Voucher Manage", "add", $inputData);
            DB::commit();

            echo json_encode([
                "status"=>"success",
                "message"=>"Receive Voucher has created successfully"
            ]);
        } else {
            echo json_encode([
                "status"=>"error",
                "message"=>"Add atleast one transaction"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['companyDetails'] = DB::table('settings')->first()->company_name;
        $data['voucherName'] = 'Receive Voucher';

        $data['voucher'] = AisVouchers::find($id);

        if(!empty($data['voucher'])) {
            $data['winTitle'] = 'Receive Voucher - ['.$data['voucher']->voucher_code.']';
            
            $cash_account = AisAccountsConfig::where('particular', 'cash')->first()->gl_id;
            $data['cashLedgers'] = AisCoaSubsidiaryLedger::where('general_ledger_id', $cash_account)->get()->keyBy('id')->all();

            $tranDetails = AisVoucherDetails::join('ais_coa_subsidiary_ledger', 'ais_voucher_details.cr_sub_ledger', '=', 'ais_coa_subsidiary_ledger.id')
                ->select('ais_voucher_details.*', 'ais_coa_subsidiary_ledger.ledger_code', 'ais_coa_subsidiary_ledger.ledger_head')
                ->where('ais_voucher_details.voucher_id', $id)
                ->orderBy('ais_voucher_details.id', 'asc')
                ->get();

            $tranDetails1 = $tranDetails->groupBy('dr_sub_ledger')->all();
            $tranDetails2 = $tranDetails->groupBy('cr_sub_ledger')->all();
            $data['byGrp'] = count($tranDetails1)<=count($tranDetails2);
            $data['tranDetails'] = $data['byGrp'] ? $tranDetails1 : $tranDetails2;

            $ntw = new \NTWIndia\NTWIndia();
            $data['amount_in_word'] = $ntw->numToWord(floor(@$data['voucher']->transaction_amount));
            
            return view('accounts.voucher.receiveVoucher', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["voucher"] = $voucher = AisVouchers::find($id);
        $data["voucherDtl"] = AisVoucherDetails::join('ais_coa_subsidiary_ledger as drSl', 'ais_voucher_details.dr_sub_ledger', '=', 'drSl.id')
            ->join('ais_coa_subsidiary_ledger as crSl', 'ais_voucher_details.cr_sub_ledger', '=', 'crSl.id')
            ->select('ais_voucher_details.*', 'drSl.ledger_head as drSlHead', 'crSl.ledger_head as crSlHead')
            ->where('ais_voucher_details.voucher_id', $id)->orderBy('id', 'asc')->get();
        
        $tran_date = new DateTime($voucher->transaction_date);
        $data["tran_date"] = $tran_date->format('d/m/Y');

        $cash = AisAccountsConfig::where('particular', 'cash')->first();

        $slLedgers = AisCoaSubsidiaryLedger::join('ais_coa_general_ledger', 'ais_coa_subsidiary_ledger.general_ledger_id', '=', 'ais_coa_general_ledger.id')
            ->select('ais_coa_subsidiary_ledger.*', DB::raw('concat(ais_coa_general_ledger.ledger_code, " - ", ais_coa_general_ledger.ledger_head) as glName'))
            ->where('general_ledger_id', '!=', $cash->gl_id)
            ->orderBy('ledger_code', 'asc')->get();
        $data["slLedgers"] = $slLedgers->groupBy('glName')->all();
        $data["slLedgerData"] = $slLedgers->keyBy('id')->toJson();

        $cashLedgers = AisCoaSubsidiaryLedger::where('general_ledger_id', '=', $cash->gl_id)
            ->orderBy('ledger_code', 'asc')->get();
        $data["cashLedgers"] = $cashLedgers;
        $data["cashLedgerData"] = $cashLedgers->keyBy('id')->toJson();

        return view('accounts.receiveVoucher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'trans_date' => 'required'
        ]);

        if(!empty($request->sl_id) && count($request->sl_id)>0) {
            //Date
            $trans_date = DateTime::createFromFormat('d/m/Y', $request->trans_date);
            $trans_date = $trans_date->format('Y-m-d');

            DB::beginTransaction();
            $voucher_id = $id;
            $voucherDtl_ids = AisVoucherDetails::where('voucher_id', $voucher_id)->get()->pluck('id')->all();

            $inputData = [
                "transaction_amount" => $request->total_amount,
                "transaction_date" => $trans_date,
                "remarks" => $request->remarks
            ];
            AisVouchers::where('id', $voucher_id)->update($inputData);

            //Remove
            $voucherDtl_ids = collect($voucherDtl_ids);
            $voucherDtl_ids = $voucherDtl_ids->diff($request->tran_dtl_id)->all();
            foreach($voucherDtl_ids as $voucherDtl_id) {
                AisVoucherDetails::where('id', $voucherDtl_id)->delete();
                AisSubsidiaryCalculation::where('voucher_details_id', $voucherDtl_id)->delete();
            }

            //Add
            foreach($request->sl_id as $i=>$sl_id) {
                $tran_dtl_id = $request->tran_dtl_id[$i];
                if(empty($tran_dtl_id)) {
                    $trans_by = $request->trans_by[$i];
                    $amount = $request->amount[$i];

                    $sl_details = AisCoaSubsidiaryLedger::find($sl_id);
                    $tranBy_details = AisCoaSubsidiaryLedger::find($trans_by);

                    //Tran Detail
                    AisVoucherDetails::create([
                        "voucher_id" => $voucher_id,
                        "dr_gl_ledger" => $tranBy_details->general_ledger_id,
                        "dr_sub_ledger" => $trans_by,
                        "cr_gl_ledger" => $sl_details->general_ledger_id,
                        "cr_sub_ledger" => $sl_id,
                        "transaction_amount" => $amount
                    ]);
                    $voucherDtl_id = AisVoucherDetails::orderBy("id", "desc")->first()->id;

                    //Debit
                    AisSubsidiaryCalculation::create([
                        "particular_sl" => $sl_id,
                        "gl_ledger" => $tranBy_details->general_ledger_id,
                        "sub_ledger" => $trans_by,
                        "acc_type" => $tranBy_details->type_id,
                        "transaction_date" => $trans_date,
                        "debit_amount" => $amount,
                        "credit_amount" => 0,
                        "voucher_id" => $voucher_id,
                        "voucher_details_id" => $voucherDtl_id
                    ]);

                    //Credit
                    AisSubsidiaryCalculation::create([
                        "particular_sl" => $trans_by,
                        "gl_ledger" => $sl_details->general_ledger_id,
                        "sub_ledger" => $sl_id,
                        "acc_type" => $sl_details->type_id,
                        "transaction_date" => $trans_date,
                        "debit_amount" => 0,
                        "credit_amount" => $amount,
                        "voucher_id" => $voucher_id,
                        "voucher_details_id" => $voucherDtl_id
                    ]);
                }
            }

            Logs::add("Receive Voucher Update", "edit", $inputData);
            DB::commit();

            echo json_encode([
                "status"=>"success",
                "message"=>"Receive Voucher has updated successfully"
            ]);
        } else {
            echo json_encode([
                "status"=>"error",
                "message"=>"Add atleast one transaction"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AisVouchers::find($id)->toArray();

        DB::beginTransaction();
        AisVouchers::where('id', $id)->delete();
        AisVoucherDetails::where('voucher_id', $id)->delete();
        AisSubsidiaryCalculation::where('voucher_id', $id)->delete();
        Logs::add("Receive Voucher Delete", "delete", $data);
        DB::commit();

        echo json_encode([
            "status"=>"success",
            "message"=>"Receive Voucher has deleted successfully"
        ]);
    }
}
