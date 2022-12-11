<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
    		[
                'id' => 1,
                'company_name' => '',
                'phone' => '',
                'email' => '',
                'address' => '',
                'logo' => '1581165657.png',
                'favicon' => '1576596798.png',
                'soft_name' => 'CA Expert Accounting v1.0'
            ]
        ]);
    }
}
