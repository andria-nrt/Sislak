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

class SubsidiaryLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["subsidiaryLedger"] = AisCoaSubsidiaryLedger::join('ais_coa_general_ledger', 'ais_coa_subsidiary_ledger.general_ledger_id', '=', 'ais_coa_general_ledger.id')
            ->join('ais_coa_types', 'ais_coa_general_ledger.type_id', '=', 'ais_coa_types.id')
            ->select('ais_coa_subsidiary_ledger.*', 'ais_coa_general_ledger.ledger_head as general_ledger_head', 'ais_coa_types.type_name')
            ->orderBy('id', 'desc')
            ->get();
        return view('accounts.subsidiaryLedger.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["generalLedgers"] = AisCoaGeneralLedger::join('ais_coa_types', 'ais_coa_general_ledger.type_id', '=', 'ais_coa_types.id')
            ->select('ais_coa_general_ledger.*', DB::raw('concat(ais_coa_types.type_code, " - ", ais_coa_types.type_name) as accTypeName'))
            ->orderBy('ledger_code', 'asc')->get()->groupBy('accTypeName')->all();
        return view('accounts.subsidiaryLedger.create', $data);
    }

    public function subsidiaryLedgerCode(Request $request)
    {
        $glId = $request->glId;
        $sl = AisCoaSubsidiaryLedger::where('general_ledger_id', $glId)->orderBy('ledger_code', 'desc')->first();
        if(!empty($sl)) {
            $code = $sl->ledger_code;
        } else {
            $code = AisCoaGeneralLedger::find($glId)->ledger_code;
        }
        $data["code"] = $code+1;
        echo json_encode($data);
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
            'general_ledger_id' => 'required',
            'ledger_head' => 'required'
        ]);

        $generalLedger = AisCoaGeneralLedger::find($request->general_ledger_id);
        //Code
        $glId = $request->general_ledger_id;
        $sl = AisCoaSubsidiaryLedger::where('general_ledger_id', $glId)->orderBy('ledger_code', 'desc')->first();
        if(!empty($sl)) {
            $code = $sl->ledger_code;
        } else {
            $code = $generalLedger->ledger_code;
        }
        $ledger_code = $code+1;
        ///

        $inputData = [
            'ledger_head' => $request->ledger_head,
            'ledger_code' => $ledger_code,
            'general_ledger_id' => $request->general_ledger_id,
            'type_id' => $generalLedger->type_id
        ];
        AisCoaSubsidiaryLedger::create($inputData);

        Logs::add("Subsidiary Ledger Manage", "add", $inputData);

        echo json_encode([
            "status"=>"success",
            "message"=>"Subsidiary Ledger has created successfully"
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
        $data["generalLedgers"] = AisCoaGeneralLedger::join('ais_coa_types', 'ais_coa_general_ledger.type_id', '=', 'ais_coa_types.id')
            ->select('ais_coa_general_ledger.*', DB::raw('concat(ais_coa_types.type_code, " - ", ais_coa_types.type_name) as accTypeName'))
            ->orderBy('ledger_code', 'asc')->get()->groupBy('accTypeName')->all();
        return view('accounts.subsidiaryLedger.edit', $data);
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
            'general_ledger_id' => 'required',
            'ledger_head' => 'required'
        ]);

        $generalLedger = AisCoaGeneralLedger::find($request->general_ledger_id);
        $inputData = [
            'ledger_head' => $request->ledger_head,
            'general_ledger_id' => $request->general_ledger_id,
            'type_id' => $generalLedger->type_id
        ];

        $flag=true;
        $subsidiaryLedger = AisCoaSubsidiaryLedger::find($id);
        //Chk
        $configChk = AisAccountsConfig::where('account_code', $subsidiaryLedger->ledger_code)->first();
        if(!empty($configChk)) {
            $flag=false;
            $msg = "The Subsidiary Ledger is configured";
        }
        if($flag && $request->general_ledger_id!=$subsidiaryLedger->general_ledger_id) {
            //Chk
            $tranChk = AisSubsidiaryCalculation::where('sub_ledger', $id)->first();
            if(!empty($tranChk)) {
                $flag=false;
                $msg = "The Subsidiary Ledger has transaction";
            }
            if($flag) {
                //Code
                $glId = $request->general_ledger_id;
                $sl = AisCoaSubsidiaryLedger::where('general_ledger_id', $glId)->orderBy('ledger_code', 'desc')->first();
                if(!empty($sl)) {
                    $code = $sl->ledger_code;
                } else {
                    $code = AisCoaGeneralLedger::find($glId)->ledger_code;
                }
                $inputData["ledger_code"] = $code+1;
                ///
            }
        }

        if($flag) {
            Logs::add("Subsidiary Ledger Manage", "edit", $inputData);

            AisCoaSubsidiaryLedger::find($id)->update($inputData);

            echo json_encode([
                "status"=>"success",
                "message"=>"Subsidiary Ledger has updated successfully"
            ]);
        } else {
            echo json_encode([
                "status"=>"error",
                "message"=>$msg
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
        $subsidiaryLedger = AisCoaSubsidiaryLedger::find($id);

        $configChk = AisAccountsConfig::where('account_code', $subsidiaryLedger->ledger_code)->first();
        if(!empty($configChk)) {
            echo json_encode([
                "status"=>"error",
                "message"=>"The Subsidiary Ledger is configured"
            ]);
        } else {
            $tranChk = AisSubsidiaryCalculation::where('sub_ledger', $id)->first();
            if(!empty($tranChk)) {
                echo json_encode([
                    "status"=>"error",
                    "message"=>"The Subsidiary Ledger has transaction"
                ]);
            } else {
                $data = $subsidiaryLedger->toArray();
                Logs::add("Subsidiary Ledger Manage", "delete", $data);

                AisCoaSubsidiaryLedger::find($id)->delete();
                echo json_encode([
                    "status"=>"success",
                    "message"=>"Subsidiary Ledger has deleted successfully"
                ]);
            }
        }
    }
}
