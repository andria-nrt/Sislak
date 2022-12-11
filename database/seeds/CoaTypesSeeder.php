<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoaTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ais_coa_types')->insert([
    		[
                'id' => 1,
                'type_name' => 'PROPERTY AND ASSETS',
                'type_code' => 1000000
            ],
            [
                'id' => 2,
                'type_name' => 'EXPENSE',
                'type_code' => 4000000
            ],
            [
                'id' => 3,
                'type_name' => 'LIABILITY AND CAPITAL',
                'type_code' => 2000000
            ],
            [
                'id' => 4,
                'type_name' => 'INCOME',
                'type_code' => 3000000
            ]
        ]);
    }
}
