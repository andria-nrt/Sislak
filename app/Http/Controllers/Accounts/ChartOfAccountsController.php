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

class ChartOfAccountsController extends Controller
{
    public function index()
    {
        $data["accountTypes"] = AisCoaTypes::orderBy('type_code', 'asc')->get();
        $data["generalLedgers"] = AisCoaGeneralLedger::orderBy('ledger_code', 'asc')->get()->groupBy('type_id')->all();
        $data["subsidiaryLedgers"] = AisCoaSubsidiaryLedger::orderBy('ledger_code', 'asc')->get()->groupBy('general_ledger_id')->all();
        return view('accounts.chartOfAccounts.index', $data);
    }

    public function accountTypes()
    {
        $data["accountTypes"] = AisCoaTypes::orderBy('type_code', 'asc')->get();
        return view('accounts.chartOfAccounts.accountTypes', $data);
    }


}
