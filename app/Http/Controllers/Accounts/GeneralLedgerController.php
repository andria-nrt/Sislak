<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AisAccountsConfig;
use App\Model\AisCoaTypes;
use App\Model\AisCoaGeneralLedger;
use App\Model\AisSubsidiaryCalculation;
use App\Model\Logs;
use Auth;

class GeneralLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["generalLedger"] = AisCoaGeneralLedger::join('ais_coa_types', 'ais_coa_general_ledger.type_id', '=', 'ais_coa_types.id')
            ->select('ais_coa_general_ledger.*', 'ais_coa_types.type_name')
            ->orderBy('id', 'desc')
            ->get();
        return view('accounts.generalLedger.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["accTypes"] = AisCoaTypes::orderBy('type_code', 'asc')->get();
        return view('accounts.generalLedger.create', $data);
    }

    public function generalLedgerCode(Request $request)
    {
        $typeId = $request->typeId;
        $gl = AisCoaGeneralLedger::where('type_id', $typeId)->orderBy('ledger_code', 'desc')->first();
        if(!empty($gl)) {
            $code = $gl->ledger_code;
        } else {
            $code = AisCoaTypes::find($typeId)->type_code;
        }
        $data["code"] = $code+1000;
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
            'type_id' => 'required',
            'ledger_head' => 'required'
        ]);

        //Code
        $typeId = $request->type_id;
        $gl = AisCoaGeneralLedger::where('type_id', $typeId)->orderBy('ledger_code', 'desc')->first();
        if(!empty($gl)) {
            $code = $gl->ledger_code;
        } else {
            $code = AisCoaTypes::find($typeId)->type_code;
        }
        $ledger_code = $code+1000;
        ///

        $inputData = [
            'ledger_head' => $request->ledger_head,
            'ledger_code' => $ledger_code,
            'type_id' => $request->type_id
        ];
        AisCoaGeneralLedger::create($inputData);

        Logs::add("General Ledger Manage", "add", $inputData);

        echo json_encode([
            "status"=>"success",
            "message"=>"General Ledger has created successfully"
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
        $data["generalLedger"] = AisCoaGeneralLedger::find($id);
        $data["accTypes"] = AisCoaTypes::orderBy('type_code', 'asc')->get();
        return view('accounts.generalLedger.edit', $data);
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
            'type_id' => 'required',
            'ledger_head' => 'required'
        ]);

        $inputData = [
            'ledger_head' => $request->ledger_head,
            'type_id' => $request->type_id
        ];

        $flag=true;
        $generalLedger = AisCoaGeneralLedger::find($id);
        //Chk
        $configChk = AisAccountsConfig::where('account_code', $generalLedger->ledger_code)->first();
        if(!empty($configChk)) {
            $flag=false;
            $msg = "The General Ledger is configured";
        }
        if($flag && $request->type_id!=$generalLedger->type_id) {
            //Chk
            $tranChk = AisSubsidiaryCalculation::where('gl_ledger', $id)->first();
            if(!empty($tranChk)) {
                $flag=false;
                $msg = "The General Ledger has transaction";
            }
            if($flag) {
                //Code
                $typeId = $request->type_id;
                $gl = AisCoaGeneralLedger::where('type_id', $typeId)->orderBy('ledger_code', 'desc')->first();
                if(!empty($gl)) {
                    $code = $gl->ledger_code;
                } else {
                    $code = AisCoaTypes::find($typeId)->type_code;
                }
                $inputData["ledger_code"] = $code+1000;
                ///
            }
        }

        if($flag) {
            Logs::add("General Ledger Manage", "edit", $inputData);

            AisCoaGeneralLedger::find($id)->update($inputData);

            echo json_encode([
                "status"=>"success",
                "message"=>"General Ledger has updated successfully"
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
        $generalLedger = AisCoaGeneralLedger::find($id);

        $configChk = AisAccountsConfig::where('account_code', $generalLedger->ledger_code)->first();
        if(!empty($configChk)) {
            echo json_encode([
                "status"=>"error",
                "message"=>"The General Ledger is configured"
            ]);
        } else {
            $tranChk = AisSubsidiaryCalculation::where('gl_ledger', $id)->first();
            if(!empty($tranChk)) {
                echo json_encode([
                    "status"=>"error",
                    "message"=>"The General Ledger has transaction"
                ]);
            } else {
                $data = $generalLedger->toArray();
                Logs::add("General Ledger Manage", "delete", $data);

                AisCoaGeneralLedger::find($id)->delete();
                echo json_encode([
                    "status"=>"success",
                    "message"=>"General Ledger has deleted successfully"
                ]);
            }
        }
    }
}
