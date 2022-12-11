<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
    		[
                'id' => 1,
                'name' => '',
                'designation' => '',
                'mobile' => '',
                'address' => '',
                'email' => '',
                'username' => '',
                'password' => '',
                'remember_token' => 'riRi3D0FrTOWGcd2HaJcioH8Yd0DIyKnUxmJXhe05a2pH5C2Q1uE4JSbTsgg',
                'user_role' => 1,
                'admin' => 1,
                'accounts' => 1,
                'status' => 'Active'
            ]
        ]);
    }
}
