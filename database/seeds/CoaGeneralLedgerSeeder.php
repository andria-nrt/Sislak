<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoaGeneralLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ais_coa_general_ledger')->insert([
    		[
                'id' => 1,
                'ledger_head' => 'Cash and Bank',
                'ledger_code' => 1001000,
                'type_id' => 1
            ],
            [
                'id' => 2,
                'ledger_head' => 'LOAN FROM FINANCIERS Current Position',
                'ledger_code' => 2002000,
                'type_id' => 3
            ],
            [
                'id' => 3,
                'ledger_head' => 'ACCOUNTS RECEIVABLES',
                'ledger_code' => 1020000,
                'type_id' => 1
            ],
            [
                'id' => 4,
                'ledger_head' => 'Accounts Payable',
                'ledger_code' => 2005000,
                'type_id' => 3
            ],
            [
                'id' => 5,
                'ledger_head' => 'Office Furniture',
                'ledger_code' => 1002000,
                'type_id' => 1
            ],
            [
                'id' => 6,
                'ledger_head' => 'Computers',
                'ledger_code' => 1003000,
                'type_id' => 1
            ],
            [
                'id' => 7,
                'ledger_head' => 'Printers',
                'ledger_code' => 1004000,
                'type_id' => 1
            ],
            [
                'id' => 8,
                'ledger_head' => 'Other Equipment',
                'ledger_code' => 1005000,
                'type_id' => 1
            ],
            [
                'id' => 9,
                'ledger_head' => 'Capital',
                'ledger_code' => 2003000,
                'type_id' => 3
            ],
            [
                'id' => 10,
                'ledger_head' => 'Bank Capital',
                'ledger_code' => 2004000,
                'type_id' => 3
            ],
            [
                'id' => 11,
                'ledger_head' => 'Domain Sell',
                'ledger_code' => 3001000,
                'type_id' => 4
            ],
            [
                'id' => 12,
                'ledger_head' => 'Hosting Sell',
                'ledger_code' => 3002000,
                'type_id' => 4
            ],
            [
                'id' => 13,
                'ledger_head' => 'Salary',
                'ledger_code' => 4001000,
                'type_id' => 2
            ]
        ]);
    }
}
