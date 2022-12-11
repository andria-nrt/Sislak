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

class ContraVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["vouchers"] = AisVouchers::where('transaction_type', 4)->orderBy('id', 'desc')->get();
        return view('accounts.contraVoucher.index', $data);
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

        $slLedgers = AisCoaSubsidiaryLedger::where('general_ledger_id', $cash->gl_id)->orderBy('ledger_code', 'asc')->get();
        $data["slLedgers"] = $slLedgers;
        $data["slLedgerData"] = $slLedgers->keyBy('id')->toJson();

        return view('accounts.contraVoucher.create', $data);
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

        if(!empty($request->dr_sl_id) && count($request->dr_sl_id)>0) {
            $voucher_no = AisVouchers::where("transaction_type",4)->orderBy("voucher_code_number", "desc")->first();
            if(!empty($voucher_no)) {
                $voucher_code_number = $voucher_no->voucher_code_number+1;
            } else {
                $voucher_code_number = 1;
            }
            $voucher_no = "CV-".$voucher_code_number;

            //Date
            $trans_date = DateTime::createFromFormat('d/m/Y', $request->trans_date);
            $trans_date = $trans_date->format('Y-m-d');

            DB::beginTransaction();
            $inputData = [
                "voucher_code" => $voucher_no,
                "voucher_code_number" => $voucher_code_number,
                "transaction_type" => 4,
                "transaction_amount" => $request->total_amount,
                "transaction_date" => $trans_date,
                "remarks" => $request->remarks
            ];
            AisVouchers::create($inputData);
            $voucher_id = AisVouchers::orderBy("id", "desc")->first()->id;

            //Add
            foreach($request->dr_sl_id as $i=>$dr_sl_id) {
                $cr_sl_id = $request->cr_sl_id[$i];
                $amount = $request->amount[$i];

                $dr_sl_details = AisCoaSubsidiaryLedger::find($dr_sl_id);
                $cr_sl_details = AisCoaSubsidiaryLedger::find($cr_sl_id);

                //Tran Detail
                AisVoucherDetails::create([
                    "voucher_id" => $voucher_id,
                    "dr_gl_ledger" => $dr_sl_details->general_ledger_id,
                    "dr_sub_ledger" => $dr_sl_id,
                    "cr_gl_ledger" => $cr_sl_details->general_ledger_id,
                    "cr_sub_ledger" => $cr_sl_id,
                    "transaction_amount" => $amount
                ]);
                $voucherDtl_id = AisVoucherDetails::orderBy("id", "desc")->first()->id;

                //Debit
                AisSubsidiaryCalculation::create([
                    "particular_sl" => $cr_sl_id,
                    "gl_ledger" => $dr_sl_details->general_ledger_id,
                    "sub_ledger" => $dr_sl_id,
                    "acc_type" => $dr_sl_details->type_id,
                    "transaction_date" => $trans_date,
                    "debit_amount" => $amount,
                    "credit_amount" => 0,
                    "voucher_id" => $voucher_id,
                    "voucher_details_id" => $voucherDtl_id
                ]);

                //Credit
                AisSubsidiaryCalculation::create([
                    "particular_sl" => $dr_sl_id,
                    "gl_ledger" => $cr_sl_details->general_ledger_id,
                    "sub_ledger" => $cr_sl_id,
                    "acc_type" => $cr_sl_details->type_id,
                    "transaction_date" => $trans_date,
                    "debit_amount" => 0,
                    "credit_amount" => $amount,
                    "voucher_id" => $voucher_id,
                    "voucher_details_id" => $voucherDtl_id
                ]);
            }

            Logs::add("Contra Voucher Manage", "add", $inputData);
            DB::commit();

            echo json_encode([
                "status"=>"success",
                "message"=>"Contra Voucher has created successfully"
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
        $data['voucherName'] = 'Contra Voucher';

        $data['voucher'] = AisVouchers::find($id);

        if(!empty($data['voucher'])) {
            $data['winTitle'] = 'Contra Voucher - ['.$data['voucher']->voucher_code.']';

            $tranDetails = AisVoucherDetails::join('ais_coa_subsidiary_ledger as debitSl', 'ais_voucher_details.dr_sub_ledger', '=', 'debitSl.id')
                ->join('ais_coa_subsidiary_ledger as creditSl', 'ais_voucher_details.cr_sub_ledger', '=', 'creditSl.id')
                ->select('ais_voucher_details.*', 'debitSl.ledger_code as debit_sl_code', 'debitSl.ledger_head as debit_sl_name', 'creditSl.ledger_code as credit_sl_code', 'creditSl.ledger_head as credit_sl_name')
                ->where('ais_voucher_details.voucher_id', $id)
                ->orderBy('ais_voucher_details.id', 'asc')
                ->get();

            $tranDetails1 = $tranDetails->groupBy('dr_sub_ledger')->all();
            $tranDetails2 = $tranDetails->groupBy('cr_sub_ledger')->all();
            $data['byGrp'] = count($tranDetails1)<=count($tranDetails2);
            $data['tranDetails'] = $data['byGrp'] ? $tranDetails1 : $tranDetails2;

            $ntw = new \NTWIndia\NTWIndia();
            $data['amount_in_word'] = $ntw->numToWord(floor(@$data['voucher']->transaction_amount));

            return view('accounts.voucher.contraVoucher', $data);
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

        $slLedgers = AisCoaSubsidiaryLedger::where('general_ledger_id', $cash->gl_id)->orderBy('ledger_code', 'asc')->get();
        $data["slLedgers"] = $slLedgers;
        $data["slLedgerData"] = $slLedgers->keyBy('id')->toJson();

        return view('accounts.contraVoucher.edit', $data);
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

        if(!empty($request->dr_sl_id) && count($request->dr_sl_id)>0) {
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
            foreach($request->dr_sl_id as $i=>$dr_sl_id) {
                $tran_dtl_id = $request->tran_dtl_id[$i];
                if(empty($tran_dtl_id)) {
                    $cr_sl_id = $request->cr_sl_id[$i];
                    $amount = $request->amount[$i];

                    $dr_sl_details = AisCoaSubsidiaryLedger::find($dr_sl_id);
                    $cr_sl_details = AisCoaSubsidiaryLedger::find($cr_sl_id);

                    //Tran Detail
                    AisVoucherDetails::create([
                        "voucher_id" => $voucher_id,
                        "dr_gl_ledger" => $dr_sl_details->general_ledger_id,
                        "dr_sub_ledger" => $dr_sl_id,
                        "cr_gl_ledger" => $cr_sl_details->general_ledger_id,
                        "cr_sub_ledger" => $cr_sl_id,
                        "transaction_amount" => $amount
                    ]);
                    $voucherDtl_id = AisVoucherDetails::orderBy("id", "desc")->first()->id;

                    //Debit
                    AisSubsidiaryCalculation::create([
                        "particular_sl" => $cr_sl_id,
                        "gl_ledger" => $dr_sl_details->general_ledger_id,
                        "sub_ledger" => $dr_sl_id,
                        "acc_type" => $dr_sl_details->type_id,
                        "transaction_date" => $trans_date,
                        "debit_amount" => $amount,
                        "credit_amount" => 0,
                        "voucher_id" => $voucher_id,
                        "voucher_details_id" => $voucherDtl_id
                    ]);

                    //Credit
                    AisSubsidiaryCalculation::create([
                        "particular_sl" => $dr_sl_id,
                        "gl_ledger" => $cr_sl_details->general_ledger_id,
                        "sub_ledger" => $cr_sl_id,
                        "acc_type" => $cr_sl_details->type_id,
                        "transaction_date" => $trans_date,
                        "debit_amount" => 0,
                        "credit_amount" => $amount,
                        "voucher_id" => $voucher_id,
                        "voucher_details_id" => $voucherDtl_id
                    ]);
                }
            }

            Logs::add("Contra Voucher Update", "edit", $inputData);
            DB::commit();

            echo json_encode([
                "status"=>"success",
                "message"=>"Contra Voucher has updated successfully"
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
        Logs::add("Contra Voucher Delete", "delete", $data);
        DB::commit();

        echo json_encode([
            "status"=>"success",
            "message"=>"Contra Voucher has deleted successfully"
        ]);
    }
}
