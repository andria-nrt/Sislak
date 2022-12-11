<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoaSubsidiaryLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ais_coa_subsidiary_ledger')->insert([
    		[
                'id' => 1,
                'ledger_head' => 'Cash In Hand',
                'ledger_code' => '1001001',
                'general_ledger_id' => 1,
                'type_id' => 1
            ],
            [
                'id' => 2,
                'ledger_head' => 'Accounts Payable (Suppliers)',
                'ledger_code' => '2005001',
                'general_ledger_id' => 4,
                'type_id' => 1
            ],
            [
                'id' => 3,
                'ledger_head' => 'Accounts Receivable (Customers)',
                'ledger_code' => '1020001',
                'general_ledger_id' => 3,
                'type_id' => 1
            ],
            [
                'id' => 4,
                'ledger_head' => 'Previous Earnings',
                'ledger_code' => '2002001',
                'general_ledger_id' => 2,
                'type_id' => 3
            ]
        ]);
    }
}
