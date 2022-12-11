<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountsConfigSeeder::class);
        $this->call(CoaGeneralLedgerSeeder::class);
        $this->call(CoaSubsidiaryLedgerSeeder::class);
        $this->call(CoaTypesSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UserRoleSeeder::class);  
        $this->call(CurrenciesSeeder::class);  
        $this->call(CurrencySettingSeeder::class);  
        
    }
}
