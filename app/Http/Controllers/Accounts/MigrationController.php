<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AisAccountsConfig;
use App\Model\AisCoaTypes;
use App\Model\AisCoaGeneralLedger;
use App\Model\AisCoaSubsidiaryLedger;
use App\Model\AisSubsidiaryCalculation;
use App\Model\Logs;
use Auth;
use DB;
use DateTime;

class MigrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = DB::table('ais_general_config')->first();
        if(!empty($config)) {
            $opening_date = new DateTime($config->opening_date);
            $data["opening_date"] = $opening_date->format('d/m/Y');
        } else {
            $data['opening_date'] = '';
        }

        $data["subsidiaryLedger"] = AisCoaSubsidiaryLedger::join('ais_coa_general_ledger', 'ais_coa_subsidiary_ledger.general_ledger_id', '=', 'ais_coa_general_ledger.id')
            ->join('ais_coa_types', 'ais_coa_general_ledger.type_id', '=', 'ais_coa_types.id')
            ->select('ais_coa_subsidiary_ledger.*', 'ais_coa_general_ledger.ledger_head as general_ledger_head', 'ais_coa_types.type_name')
            ->orderBy('ledger_code', 'asc')
            ->get();

        $data["openingData"] = AisSubsidiaryCalculation::where('particular_sl', 0)->get()->keyBy('sub_ledger')->all();

        return view('accounts.migration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = DB::table('ais_general_config')->first();
        if(!empty($config)) {
            $opening_date = new DateTime($config->opening_date);
            $data["opening_date"] = $opening_date->format('d/m/Y');
        } else {
            $data['opening_date'] = '';
        }
        return view('accounts.migration.create', $data);
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
            'opening_date' => 'required'
        ]);

        $opening_date = DateTime::createFromFormat('d/m/Y', $request->opening_date);
        $opening_date = $opening_date->format('Y-m-d');

        $config = DB::table('ais_general_config')->first();
        if(!empty($config)) {
            DB::table('ais_general_config')->where('id', $config->id)->update(['opening_date'=>$opening_date]);
        } else {
            DB::table('ais_general_config')->insert(['opening_date'=>$opening_date]);
        }

        echo json_encode([
            "status"=>"success",
            "message"=>"Tanggal Pembukaan telah berhasil diubah"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["subsidiaryLedger"] = AisCoaSubsidiaryLedger::find($id);

        $config = DB::table('ais_general_config')->first();
        if(!empty($config)) {
            $opening_date = new DateTime($config->opening_date);
            $data["opening_date"] = $opening_date->format('d/m/Y');
        } else {
            $data['opening_date'] = '';
        }

        $openingData = AisSubsidiaryCalculation::where('sub_ledger', $id)->where('particular_sl', 0)->first();
        if(!empty($openingData)) {
            $data["openingAmount"] = ($openingData->acc_type<=2) ? $openingData->debit_amount-$openingData->credit_amount : $openingData->credit_amount-$openingData->debit_amount;
        } else {
            $data["openingAmount"] = '';
        }

        return view('accounts.migration.edit', $data);
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
            'opening_amount' => 'required',
            'opening_date' => 'required'
        ]);

        $opening_date = DateTime::createFromFormat('d/m/Y', $request->opening_date);
        $opening_date = $opening_date->format('Y-m-d');
        $subsidiaryLedger = AisCoaSubsidiaryLedger::find($id);
        if($subsidiaryLedger->type_id<=2) {
            $debit = $request->opening_amount;
            $credit = 0;
        } else {
            $debit = 0;
            $credit = $request->opening_amount;
        }

        DB::beginTransaction();
        AisSubsidiaryCalculation::where('sub_ledger', $id)->where('particular_sl', 0)->delete();
        $inputData = [
            'particular_sl' => 0,
            'gl_ledger' => $subsidiaryLedger->general_ledger_id,
            'sub_ledger' => $id,
            'acc_type' => $subsidiaryLedger->type_id,
            'transaction_date' => $opening_date,
            'debit_amount' => $debit,
            'credit_amount' => $credit,
            'voucher_id' => 0,
            'voucher_details_id' => 0
        ];
        AisSubsidiaryCalculation::create($inputData);

        Logs::add("Migration Data", "add", $inputData);
        DB::commit();

        echo json_encode([
            "status"=>"success",
            "message"=>"Migration data has added successfully"
        ]);
    }

    
}
