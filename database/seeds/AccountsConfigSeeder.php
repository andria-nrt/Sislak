<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ais_accounts_config')->insert([
    		[
                'particular' => 'cash',
                'particular_name' => 'Cash',
                'coa_level' => 2,
                'account_code' => 1001000,
                'type_id' => 1,
                'gl_id' => 1,
                'sl_id' => 0
            ],
            [
                'particular' => 'cash_in_hand',
                'particular_name' => 'Cash In Hand',
                'coa_level' => 3,
                'account_code' => 1001001,
                'type_id' => 1,
                'gl_id' => 1,
                'sl_id' => 1
            ],
            [
                'particular' => 'accounts_payable',
                'particular_name' => 'Accounts Payable',
                'coa_level' => 2,
                'account_code' => 2005000,
                'type_id' => 3,
                'gl_id' => 4,
                'sl_id' => 0
            ],
            [
                'particular' => 'accounts_payable_suppliers',
                'particular_name' => 'Accounts Payable (Suppliers)',
                'coa_level' => 3,
                'account_code' => 2005001,
                'type_id' => 3,
                'gl_id' => 4,
                'sl_id' => 2
            ],
            [
                'particular' => 'accounts_receivable',
                'particular_name' => 'Accounts Receivable',
                'coa_level' => 2,
                'account_code' => 1020000,
                'type_id' => 1,
                'gl_id' => 3,
                'sl_id' => 0
            ],
            [
                'particular' => 'accounts_receivable_customers',
                'particular_name' => 'Accounts Receivable (Customers)',
                'coa_level' => 3,
                'account_code' => 1020001,
                'type_id' => 1,
                'gl_id' => 3,
                'sl_id' => 3
            ],
            [
                'particular' => 'others_income',
                'particular_name' => 'Others Income',
                'coa_level' => 0,
                'account_code' => '',
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'bad_debt_income',
                'particular_name' => 'Bad Debt Income',
                'coa_level' => 0,
                'account_code' => 3008001,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'others_expense',
                'particular_name' => 'Others Expense',
                'coa_level' => 0,
                'account_code' => 4017000,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'bad_debt_expense',
                'particular_name' => 'Bad Debt Expense',
                'coa_level' => 0,
                'account_code' => 4017001,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'sales_income',
                'particular_name' => 'Sales Income',
                'coa_level' => 0,
                'account_code' => 3001000,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'sales',
                'particular_name' => 'Sales',
                'coa_level' => 0,
                'account_code' => 3001002,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'inventory_stock',
                'particular_name' => 'Inventory Stock',
                'coa_level' => 0,
                'account_code' => 1009001,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'purchase_expenses',
                'particular_name' => 'Purchase Expenses',
                'coa_level' => 0,
                'account_code' => 4018000,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'cost_of_goods',
                'particular_name' => 'Cost of Goods Sold',
                'coa_level' => 0,
                'account_code' => 4018001,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'net_earnings',
                'particular_name' => 'Net Earnings',
                'coa_level' => 0,
                'account_code' => 2002000,
                'type_id' => 0,
                'gl_id' => 0,
                'sl_id' => 0
            ],
            [
                'particular' => 'retain_surplus',
                'particular_name' => 'Retain Surplus',
                'coa_level' => 3,
                'account_code' => 2002000,
                'type_id' => 3,
                'gl_id' => 2,
                'sl_id' => 4
            ]
        ]);
    }
}
