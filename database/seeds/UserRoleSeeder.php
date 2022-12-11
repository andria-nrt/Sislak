<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
    		[
                'id' => 1,
                'role_name' => 'Admin'
            ],
            [
                'id' => 2,
                'role_name' => 'Accounts Manager'
            ],
            [
                'id' => 3,
                'role_name' => 'Assistant Accountant'
            ]
        ]);
    }
}
