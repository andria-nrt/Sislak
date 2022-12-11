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

class ReportController extends Controller
{
    //Balance Sheet
    public function balanceSheet()
    {
        return view('accounts.reports.balanceSheet.template');
    }

    public function balanceSheetReport(Request $request)
    {
        $date = DateTime::createFromFormat('d/m/Y', $request->date);
        $data['title_date'] = 'As at '.$date->format("dS F'Y");
        $date = $date->format('Y-m-d');

        $data['company_name'] = DB::table('settings')->first()->company_name;

        $data['surplus_id'] = AisAccountsConfig::where('particular', 'retain_surplus')->first()->sl_id;

        $data['accTypes'] = AisCoaTypes::where('id', 1)->orWhere('id', 3)->orderBy('type_code', 'asc')->get();
        $data['glLedgers'] = AisCoaGeneralLedger::where('type_id', 1)->orWhere('type_id', 3)->orderBy('ledger_code', 'asc')->get()->groupBy('type_id')->all();
        $data['slLedgers'] = AisCoaSubsidiaryLedger::where('type_id', 1)->orWhere('type_id', 3)->orderBy('ledger_code', 'asc')->get()->groupBy('general_ledger_id')->all();

        $data['ledgers'] = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, sub_ledger'))
            ->where('transaction_date', '<=', $date)
            ->where(function($query){
                $query->where('acc_type', 1)->orWhere('acc_type', 3);
            })
            ->groupBy('sub_ledger')->get()->keyBy('sub_ledger')->all();
        $data['surplusBalance'] = AisSubsidiaryCalculation::select(DB::raw('sum(credit_amount)-sum(debit_amount) as balanceAmount'))
            ->where('transaction_date', '<=', $date)
            ->where(function($query){
                $query->where('acc_type', 2)->orWhere('acc_type', 4);
            })->first();

        return view('accounts.reports.balanceSheet.report', $data);
    }

    //Income Statement
    public function incomeStatement()
    {
        return view('accounts.reports.incomeStatement.template');
    }

    public function incomeStatementReport(Request $request)
    {
        $from_date = DateTime::createFromFormat('d/m/Y', $request->from_date);
        $to_date = DateTime::createFromFormat('d/m/Y', $request->to_date);
        $data['title_date'] = 'For date range '.$request->from_date.' to '.$request->to_date;
        $from_date = $from_date->format('Y-m-d');
        $to_date = $to_date->format('Y-m-d');

        $data['company_name'] = DB::table('settings')->first()->company_name;

        $data['accTypes'] = AisCoaTypes::where('id', 2)->orWhere('id', 4)->orderBy('type_code', 'asc')->get();
        $data['glLedgers'] = AisCoaGeneralLedger::where('type_id', 2)->orWhere('type_id', 4)->orderBy('ledger_code', 'asc')->get()->groupBy('type_id')->all();
        $data['slLedgers'] = AisCoaSubsidiaryLedger::where('type_id', 2)->orWhere('type_id', 4)->orderBy('ledger_code', 'asc')->get()->groupBy('general_ledger_id')->all();

        $data['ledgers'] = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, sub_ledger'))
            ->whereBetween('transaction_date', [$from_date, $to_date])
            ->where(function($query){
                $query->where('acc_type', 2)->orWhere('acc_type', 4);
            })
            ->groupBy('sub_ledger')->get()->keyBy('sub_ledger')->all();

        return view('accounts.reports.incomeStatement.report', $data);
    }

    //Receipts Payments
    public function receiptsPayments()
    {
        return view('accounts.reports.receiptsPayments.template');
    }

    public function receiptsPaymentsReport(Request $request)
    {
        $from_date = DateTime::createFromFormat('d/m/Y', $request->from_date);
        $to_date = DateTime::createFromFormat('d/m/Y', $request->to_date);
        $data['title_date'] = 'For date range '.$request->from_date.' to '.$request->to_date;
        $from_date = $from_date->format('Y-m-d');
        $to_date = $to_date->format('Y-m-d');

        $data['cash_glId'] = $cash_glId = AisAccountsConfig::where('particular', 'cash')->first()->gl_id;

        $data['company_name'] = DB::table('settings')->first()->company_name;

        $data['accTypes'] = AisCoaTypes::orderBy('type_code', 'asc')->get();
        $data['glLedgers'] = AisCoaGeneralLedger::orderBy('ledger_code', 'asc')->get()->groupBy('type_id')->all();
        $data['slLedgers'] = AisCoaSubsidiaryLedger::orderBy('ledger_code', 'asc')->get()->groupBy('general_ledger_id')->all();

        $data['cash_opening'] = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount)-sum(credit_amount) as balanceAmount, sub_ledger'))
            ->where('transaction_date', '<', $from_date)
            ->where('gl_ledger', $cash_glId)
            ->groupBy('sub_ledger')->get()->keyBy('sub_ledger')->all();

        $data['cash_closing'] = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount)-sum(credit_amount) as balanceAmount, sub_ledger'))
            ->where('transaction_date', '<=', $to_date)
            ->where('gl_ledger', $cash_glId)
            ->groupBy('sub_ledger')->get()->keyBy('sub_ledger')->all();

        $data['ledgers'] = AisSubsidiaryCalculation::join('ais_coa_subsidiary_ledger', 'ais_subsidiary_calculation.particular_sl', '=', 'ais_coa_subsidiary_ledger.id')
            ->select(DB::raw('sum(ais_subsidiary_calculation.debit_amount) as debit_amount, sum(ais_subsidiary_calculation.credit_amount) as credit_amount, ais_subsidiary_calculation.sub_ledger'))
            ->whereBetween('ais_subsidiary_calculation.transaction_date', [$from_date, $to_date])
            ->where('ais_coa_subsidiary_ledger.general_ledger_id', $cash_glId)
            ->where('ais_subsidiary_calculation.gl_ledger', '!=', $cash_glId)
            ->groupBy('sub_ledger')->get()->keyBy('sub_ledger')->all();

        return view('accounts.reports.receiptsPayments.report', $data);
    }

    //Trial Balance 
    public function trialBalance()
    {
        return view('accounts.reports.trialBalance.template');
    }

    public function trialBalanceReport(Request $request)
    {
        $date = DateTime::createFromFormat('d/m/Y', $request->date);
        $data['title_date'] = 'As at '.$date->format("dS F'Y");
        $date = $date->format('Y-m-d');

        $data['company_name'] = DB::table('settings')->first()->company_name;

        $data['accTypes'] = AisCoaTypes::orderBy('type_code', 'asc')->get();
        $data['glLedgers'] = AisCoaGeneralLedger::orderBy('ledger_code', 'asc')->get()->groupBy('type_id')->all();
        $data['slLedgers'] = AisCoaSubsidiaryLedger::orderBy('ledger_code', 'asc')->get()->groupBy('general_ledger_id')->all();

        $data['ledgers'] = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, sub_ledger'))
            ->where('transaction_date', '<=', $date)
            ->groupBy('sub_ledger')->get()->keyBy('sub_ledger')->all();

        return view('accounts.reports.trialBalance.report', $data);
    }

    //Ledger Report 
    public function ledgerReport()
    {
        $data["glLedgers"] = AisCoaGeneralLedger::join('ais_coa_types', 'ais_coa_general_ledger.type_id', '=', 'ais_coa_types.id')
            ->select('ais_coa_general_ledger.*', DB::raw('concat(ais_coa_types.type_code, " - ", ais_coa_types.type_name) as typeName'))
            ->orderBy('ledger_code', 'asc')->get()->groupBy('typeName')->all();

        $data["slLedgers"] = AisCoaSubsidiaryLedger::join('ais_coa_general_ledger', 'ais_coa_subsidiary_ledger.general_ledger_id', '=', 'ais_coa_general_ledger.id')
            ->select('ais_coa_subsidiary_ledger.*', DB::raw('concat(ais_coa_general_ledger.ledger_code, " - ", ais_coa_general_ledger.ledger_head) as glName'))
            ->orderBy('ledger_code', 'asc')->get()->groupBy('glName')->all();

        return view('accounts.reports.ledgerReport.template_ledgerReport', $data);
    }
    public function gl_slLedger(Request $request)
    {
        $gl_id = $request->gl_id;

        $slLedgers = AisCoaSubsidiaryLedger::join('ais_coa_general_ledger', 'ais_coa_subsidiary_ledger.general_ledger_id', '=', 'ais_coa_general_ledger.id')
            ->select('ais_coa_subsidiary_ledger.*', DB::raw('concat(ais_coa_general_ledger.ledger_code, " - ", ais_coa_general_ledger.ledger_head) as glName'));
            if($gl_id>0) {
                $slLedgers = $slLedgers->where('general_ledger_id', $gl_id);
            }
            $slLedgers = $slLedgers->orderBy('ledger_code', 'asc')->get()->groupBy('glName')->all();

        if($gl_id>0) {
            $gl_name = AisCoaGeneralLedger::find($gl_id);
            $data["gl_name"] = @$gl_name->ledger_head;
        }

        $data["gl_id"] = $gl_id;
        $data["slLedgers"] = $slLedgers;

        return view('accounts.reports.ledgerReport.gl_slLedger', $data);
    }
    //Cash Book
    public function cashBook()
    {
        $hand_cash_id = AisAccountsConfig::where('particular', 'cash_in_hand')->first()->sl_id;
        $data["slLedger"] = AisCoaSubsidiaryLedger::find($hand_cash_id);
        return view('accounts.reports.ledgerReport.template_cashBook', $data);
    }
    //Bank Book
    public function bankBook()
    {
        $cash_id = AisAccountsConfig::where('particular', 'cash')->first()->gl_id;
        $hand_cash_id = AisAccountsConfig::where('particular', 'cash_in_hand')->first()->sl_id;
        $data["gl_id"] = $cash_id;
        $data["slLedgers"] = AisCoaSubsidiaryLedger::where('general_ledger_id', $cash_id)->where('id', '!=', $hand_cash_id)->get();
        return view('accounts.reports.ledgerReport.template_bankBook', $data);
    }

    //Ledger Data
    public function ledgerReportView(Request $request)
    {
        $report_type = $request->report_type;
        $gl_id = $request->gl_id;
        $data['sl_id'] = $sl_id = $request->sl_id;

        $data['from_date'] = $request->from_date;
        $from_date = DateTime::createFromFormat('d/m/Y', $request->from_date);
        $to_date = DateTime::createFromFormat('d/m/Y', $request->to_date);
        $data['title_date'] = 'For date range '.$request->from_date.' to '.$request->to_date;
        $from_date = $from_date->format('Y-m-d');
        $to_date = $to_date->format('Y-m-d');

        $data['company_name'] = DB::table('settings')->first()->company_name;

        if($sl_id>0) {
            $accHead = AisCoaSubsidiaryLedger::find($sl_id);
        } else {
            $accHead = AisCoaGeneralLedger::find($gl_id);
        }
        $data['accHead'] = $accHead;
        if($report_type==2) {
            $data['report_title'] = 'Cash Book';
        } else if($report_type==3) {
            $data['report_title'] = 'Bank Book';
        } else {
            $data['report_title'] = 'Ledger Report';
        }
        if($report_type==2 || ($report_type==3 && empty($sl_id))) {
            $data['report_head'] = '';
        } else {
            $data['report_head'] = 'Ledger of '.$accHead->ledger_head.'['.$accHead->ledger_code.']';
        }

        $hand_cash_id = AisAccountsConfig::where('particular', 'cash_in_hand')->first()->sl_id;

        $data['slHead'] = AisCoaSubsidiaryLedger::get()->keyBy('id')->all();

        $data['opening'] = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount'))
            ->where('transaction_date', '<', $from_date)
            ->where(function($query) use ($gl_id, $sl_id, $report_type, $hand_cash_id){
                if($sl_id>0) {
                    $query->where('sub_ledger', $sl_id);
                } else {
                    $query->where('gl_ledger', $gl_id);
                    if($report_type==3) {
                        $query->where('sub_ledger', '!=', $hand_cash_id);
                    }
                }     
            })
            ->first();

        $data['opening_ledgers'] = AisSubsidiaryCalculation::where('voucher_id', 0)
            ->whereBetween('transaction_date', [$from_date, $to_date])
            ->where(function($query) use ($gl_id, $sl_id, $report_type, $hand_cash_id){
                if($sl_id>0) {
                    $query->where('sub_ledger', $sl_id);
                } else {
                    $query->where('gl_ledger', $gl_id);
                    if($report_type==3) {
                        $query->where('sub_ledger', '!=', $hand_cash_id);
                    }
                }                
            })
            ->orderBy('transaction_date', 'asc')->get();

        $data['ledgers'] = AisSubsidiaryCalculation::join('ais_vouchers', 'ais_subsidiary_calculation.voucher_id', '=', 'ais_vouchers.id')
            ->select('ais_subsidiary_calculation.*', 'ais_vouchers.voucher_code', 'ais_vouchers.remarks')
            ->whereBetween('ais_subsidiary_calculation.transaction_date', [$from_date, $to_date])
            ->where(function($query) use ($gl_id, $sl_id, $report_type, $hand_cash_id){
                if($sl_id>0) {
                    $query->where('ais_subsidiary_calculation.sub_ledger', $sl_id);
                } else {
                    $query->where('ais_subsidiary_calculation.gl_ledger', $gl_id);
                    if($report_type==3) {
                        $query->where('ais_subsidiary_calculation.sub_ledger', '!=', $hand_cash_id);
                    }
                }                
            })
            ->orderBy('transaction_date', 'asc')->get();

        return view('accounts.reports.ledgerReport.report', $data);
    }


}
