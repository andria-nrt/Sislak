<?php

use Illuminate\Database\Seeder;

class CurrencySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency_setting')->insert([
            [
                'id' => 1,
                'currency' => '100',
                'symbol' => '$',
                'currency_text' => 'USD',
                'currency_position' => '2'
            ]
        ]);
    }
}
