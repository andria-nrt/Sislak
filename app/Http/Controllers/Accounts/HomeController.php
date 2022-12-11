<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Http\Request;

use App\Mode\User;
use App\Http\Controllers\Controller;

use App\Model\AisAccountsConfig;
use App\Model\AisCoaTypes;
use App\Model\AisCoaGeneralLedger;
use App\Model\AisCoaSubsidiaryLedger;
use App\Model\AisSubsidiaryCalculation;
use App\Model\AisVouchers;
use App\Model\AisVoucherDetails;

use App\Model\Logs;
use DB;
use DateTime;

class HomeController extends Controller
{
    public function dashboard()
    {
        $dateTime = new DateTime();
        $date = $dateTime->format('Y-m-d');

        $config = AisAccountsConfig::whereIn('particular', ['cash', 'cash_in_hand', 'accounts_payable', 'accounts_receivable'])->get()->keyBy('particular')->all();
        $cash_id = $config['cash']->gl_id;
        $hand_cash_id = $config['cash_in_hand']->sl_id;
        $payable_id = $config['accounts_payable']->gl_id;
        $receivable_id = $config['accounts_receivable']->gl_id;

        $glBalance = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount'), 'gl_ledger')
            ->where('transaction_date', '<=', $date)
            ->whereIn('gl_ledger', [$cash_id, $payable_id, $receivable_id])
            ->groupBy('gl_ledger')
            ->get()->keyBy('gl_ledger')->all();

        $cash_slBalance = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount'), 'sub_ledger')
            ->where('transaction_date', '<=', $date)
            ->where('gl_ledger', $cash_id)
            ->groupBy('sub_ledger')
            ->get()->keyBy('sub_ledger')->all();

        $data['cash_balance'] = array_key_exists($hand_cash_id, $cash_slBalance) ? $cash_slBalance[$hand_cash_id]->debit_amount-$cash_slBalance[$hand_cash_id]->credit_amount : 0;
        $ttlCashBalance = array_key_exists($cash_id, $glBalance) ? $glBalance[$cash_id]->debit_amount-$glBalance[$cash_id]->credit_amount : 0;
        $data['bank_balance'] = $ttlCashBalance-$data['cash_balance'];
        $data['receivable_balance'] = array_key_exists($receivable_id, $glBalance) ? $glBalance[$receivable_id]->debit_amount-$glBalance[$receivable_id]->credit_amount : 0;
        $data['payable_balance'] = array_key_exists($payable_id, $glBalance) ? $glBalance[$payable_id]->credit_amount-$glBalance[$payable_id]->debit_amount : 0;

        //CHART------
        if($dateTime->format('m')==12) {
            $month_from = $dateTime->format('Y-01-01');
        } else {
            $month_from = new DateTime(($dateTime->format('Y')-1).'-'.($dateTime->format('m')+1).'-01');
            $month_from = $month_from->format('Y-m-d');
        }
        $this_month_lastDate = $dateTime->format('Y-m-t');

        $monthArray = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        //Income-Expense
        $monthlyIncome = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, DATE_FORMAT(transaction_date, "%Y-%m") as transMonth'))
            ->whereBetween('transaction_date', [$month_from, $this_month_lastDate])
            ->where('acc_type', 4)
            ->groupBy('transMonth')
            ->get()->keyBy('transMonth')->all();

        $monthlyExpense = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, DATE_FORMAT(transaction_date, "%Y-%m") as transMonth'))
            ->whereBetween('transaction_date', [$month_from, $this_month_lastDate])
            ->where('acc_type', 2)
            ->groupBy('transMonth')
            ->get()->keyBy('transMonth')->all();

        $incExp_dateTime = new DateTime($month_from);
        $month = intval($incExp_dateTime->format('m'));
        $fullYear = intval($incExp_dateTime->format('Y'));
        $year = intval($incExp_dateTime->format('y'));

        $incExp_label = [];
        $incExp_income = [];
        $incExp_expense = [];

        for($i=0; $i<12; $i++) {
            $yearMonth = $fullYear.'-'.(($month<=9)?'0'.$month:$month);

            $incExp_label[] = $monthArray[($month-1)].'-'.$year;
            $incExp_income[] = array_key_exists($yearMonth, $monthlyIncome) ? $monthlyIncome[$yearMonth]->credit_amount-$monthlyIncome[$yearMonth]->debit_amount : 0;
            $incExp_expense[] = array_key_exists($yearMonth, $monthlyExpense) ? $monthlyExpense[$yearMonth]->debit_amount-$monthlyExpense[$yearMonth]->credit_amount : 0;

            if($month==12) {
                $month = 1;
                $fullYear++;
                $year++;
            } else {
                $month++;
            }
        }

        $data['incExp_label'] = $incExp_label;
        $data['incExp_income'] = $incExp_income;
        $data['incExp_expense'] = $incExp_expense;

        //Receivable-Payable
        $recPay_opening = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, gl_ledger'))
            ->where('transaction_date', '<', $month_from)
            ->where('gl_ledger', $receivable_id)
            ->where(function($query)use($receivable_id,$payable_id){
                $query->where('gl_ledger', $receivable_id)->orWhere('gl_ledger', $payable_id);
            })
            ->groupBy('gl_ledger')
            ->get()->keyBy('gl_ledger')->all();

        $monthlyReceivable = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, DATE_FORMAT(transaction_date, "%Y-%m") as transMonth'))
            ->whereBetween('transaction_date', [$month_from, $this_month_lastDate])
            ->where('gl_ledger', $receivable_id)
            ->groupBy('transMonth')
            ->get()->keyBy('transMonth')->all();

        $monthlyPayable = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, DATE_FORMAT(transaction_date, "%Y-%m") as transMonth'))
            ->whereBetween('transaction_date', [$month_from, $this_month_lastDate])
            ->where('gl_ledger', $payable_id)
            ->groupBy('transMonth')
            ->get()->keyBy('transMonth')->all();

        $recPay_dateTime = new DateTime($month_from);
        $month = intval($recPay_dateTime->format('m'));
        $fullYear = intval($recPay_dateTime->format('Y'));
        $year = intval($recPay_dateTime->format('y'));

        $recPay_label = [];
        $recPay_receivable = [];
        $recPay_payable = [];

        $recAmount = array_key_exists($receivable_id, $recPay_opening) ? $recPay_opening[$receivable_id]->debit_amount-$recPay_opening[$receivable_id]->credit_amount : 0;
        $payAmount = array_key_exists($payable_id, $recPay_opening) ? $recPay_opening[$payable_id]->credit_amount-$recPay_opening[$payable_id]->debit_amount : 0;

        for($i=0; $i<12; $i++) {
            $yearMonth = $fullYear.'-'.(($month<=9)?'0'.$month:$month);

            $recPay_label[] = $monthArray[($month-1)].'-'.$year;
            $recAmount += array_key_exists($yearMonth, $monthlyReceivable) ? $monthlyReceivable[$yearMonth]->debit_amount-$monthlyReceivable[$yearMonth]->credit_amount : 0;
            $payAmount += array_key_exists($yearMonth, $monthlyPayable) ? $monthlyPayable[$yearMonth]->credit_amount-$monthlyPayable[$yearMonth]->debit_amount : 0;
            $recPay_receivable[] = $recAmount;
            $recPay_payable[] = $payAmount;

            if($month==12) {
                $month = 1;
                $fullYear++;
                $year++;
            } else {
                $month++;
            }
        }

        $data['recPay_label'] = $recPay_label;
        $data['recPay_receivable'] = $recPay_receivable;
        $data['recPay_payable'] = $recPay_payable;

        //CashIn-CashOut
        $beginngCash = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount)-sum(credit_amount) as cashBalance'))
            ->where('transaction_date', '<', $month_from)
            ->where('gl_ledger', $cash_id)
            ->first();

        $openingCash = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount)-sum(credit_amount) as cashBalance, DATE_FORMAT(transaction_date, "%Y-%m") as transMonth'))
            ->whereBetween('transaction_date', [$month_from, $this_month_lastDate])
            ->where('gl_ledger', $cash_id)
            ->where('particular_sl', 0)
            ->groupBy('transMonth')
            ->get()->keyBy('transMonth')->all();

        $cashTrans = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount) as debit_amount, sum(credit_amount) as credit_amount, DATE_FORMAT(transaction_date, "%Y-%m") as transMonth'))
            ->join('ais_coa_subsidiary_ledger as particularSl', 'ais_subsidiary_calculation.particular_sl', '=', 'particularSl.id')
            ->whereBetween('ais_subsidiary_calculation.transaction_date', [$month_from, $this_month_lastDate])
            ->where('ais_subsidiary_calculation.gl_ledger', $cash_id)
            ->where('particularSl.general_ledger_id', '!=', $cash_id)
            ->groupBy('transMonth')
            ->get()->keyBy('transMonth')->all();

        $cashInOut_dateTime = new DateTime($month_from);
        $month = intval($cashInOut_dateTime->format('m'));
        $fullYear = intval($cashInOut_dateTime->format('Y'));
        $year = intval($cashInOut_dateTime->format('y'));

        $cashInOut_label = [];
        $cashInOut_cashIn = [];
        $cashInOut_cashOut = [];
        $cashInOut_cashBalance = [];
        $cashBalance = !empty($beginngCash) ? $beginngCash->cashBalance : 0;

        for($i=0; $i<12; $i++) {
            $yearMonth = $fullYear.'-'.(($month<=9)?'0'.$month:$month);

            $cashInOut_label[] = $monthArray[($month-1)].'-'.$year;
            if(array_key_exists($yearMonth, $cashTrans)) {
                $cashInAmount = $cashTrans[$yearMonth]->debit_amount;
                $cashOutAmount = $cashTrans[$yearMonth]->credit_amount;
            } else {
                $cashInAmount = 0;
                $cashOutAmount = 0;
            }
            $cashInOut_cashIn[] = $cashInAmount;
            $cashInOut_cashOut[] = $cashOutAmount;

            //Balance
            $cashBalance += array_key_exists($yearMonth, $openingCash) ? $openingCash[$yearMonth]->cashBalance : 0;
            $cashBalance += $cashInAmount-$cashOutAmount;
            $cashInOut_cashBalance[] = $cashBalance;

            if($month==12) {
                $month = 1;
                $fullYear++;
                $year++;
            } else {
                $month++;
            }
        }

        $data['cashInOut_label'] = $cashInOut_label;
        $data['cashInOut_cashIn'] = $cashInOut_cashIn;
        $data['cashInOut_cashOut'] = $cashInOut_cashOut;
        $data['cashInOut_cashBalance'] = $cashInOut_cashBalance;

        //Cash-Balance
        $colors = ["#008cff", "#15ca20", "#fd3550", "#ff9700", "#b81cff", "#0dceec", "#400040", "#0080c0", "#008080", "#ff8000"];

        $cashSl = AisCoaSubsidiaryLedger::where('general_ledger_id', $cash_id)->orderBy('ledger_code', 'asc')->get();

        $cashBalance = AisSubsidiaryCalculation::select(DB::raw('sum(debit_amount)-sum(credit_amount) as cashBalance, sub_ledger'))
            ->where('transaction_date', '<=', $date)
            ->where('gl_ledger', $cash_id)
            ->groupBy('sub_ledger')
            ->get()->keyBy('sub_ledger')->all();

        $cashB_label = [];
        $cashB_balance = [];
        $cashB_color = [];
        $i = 0;
        foreach($cashSl as $cashSl) {
            $cashB_label[] = $cashSl->ledger_head;
            $cashB_balance[] = array_key_exists($cashSl->id, $cashBalance) ? $cashBalance[$cashSl->id]->cashBalance : 0;
            $cashB_color[] = $colors[$i];
            
            if($i==9) { $i = 0; } else { $i++; }
        }

        $data['cashB_label'] = $cashB_label;
        $data['cashB_balance'] = $cashB_balance;
        $data['cashB_color'] = $cashB_color;


        //Sagor---------------
    	$data["gelled"] = DB::table('ais_coa_general_ledger')
        ->orderBy('id', 'desc')
        ->count();

        $data["sublegd"] = DB::table('ais_coa_subsidiary_ledger')
        ->orderBy('id', 'desc')
        ->count();

        $data["cot"] = DB::table('ais_coa_types')
        ->orderBy('id', 'desc')
        ->count();


        $date = date("Y-m-d");

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

        $data["payvou"] = DB::table('ais_vouchers')
        ->where('transaction_type',1)
        ->orderBy('id', 'desc')
        ->count();

        $data["recvou"] = DB::table('ais_vouchers')
        ->where('transaction_type',2)
        ->orderBy('id', 'desc')
        ->count();

        $data["jorvou"] = DB::table('ais_vouchers')
        ->where('transaction_type',3)
        ->orderBy('id', 'desc')
        ->count();

        $data["convou"] = DB::table('ais_vouchers')
        ->where('transaction_type',4)
        ->orderBy('id', 'desc')
        ->count();

        return view('accounts.dashboard',$data);
    }

    
    

    
}