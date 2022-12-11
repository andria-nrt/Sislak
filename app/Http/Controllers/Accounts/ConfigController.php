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
use DB;
use Auth;

class ConfigController extends Controller
{
    public function head_configuration()
    {
        $data["configs"] = AisAccountsConfig::orderBy('id', 'asc')->get()->chunk(2)->all();
        return view('accounts.configs.head_configuration', $data);
    }

    public function head_configuration_update(Request $request)
    {
        $configs = AisAccountsConfig::orderBy('id', 'asc')->get();

        DB::beginTransaction();
        foreach($configs as $config) {
        	$particular_code = $request[$config->particular];
        	if($config->account_code!=$particular_code) {
        		$data = [
					'account_code' => $particular_code,
					'type_id' => 0,
					'gl_id' => 0,
					'sl_id' => 0
				];
        		if(!empty($particular_code)) {
        			if($config->coa_level==2) {
        				$ledger = AisCoaGeneralLedger::where('ledger_code', $particular_code)->first();
        				if(!empty($ledger)) {
        					$data['type_id'] = $ledger->type_id;
        					$data['gl_id'] = $ledger->id;
        				}       				
        			} else {
        				$ledger = AisCoaSubsidiaryLedger::where('ledger_code', $particular_code)->first();
        				if(!empty($ledger)) {
        					$data['type_id'] = $ledger->type_id;
        					$data['gl_id'] = $ledger->general_ledger_id;
        					$data['sl_id'] = $ledger->id;
        				}
        			}
        		}
				AisAccountsConfig::find($config->id)->update($data);
        	}
        }
        DB::commit();

        return redirect()->route('Accounts.headConfig')->with("configMsg", "Head configuration updated successfully");
    }


}
