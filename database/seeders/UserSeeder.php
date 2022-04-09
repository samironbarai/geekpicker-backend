<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'User A',
                'email' => 'user.a@gmail.com',
                'password' => Hash::make('password'),
                'currency_id' => 1,
            ],
            [
                'name' => 'User B',
                'email' => 'user.b@gmail.com',
                'password' => Hash::make('password'),
                'currency_id' => 2,
            ],
            [
                'name' => 'User C',
                'email' => 'user.c@gmail.com',
                'password' => Hash::make('password'),
                'currency_id' => 3,
            ],
            [
                'name' => 'User D',
                'email' => 'user.d@gmail.com',
                'password' => Hash::make('password'),
                'currency_id' => 2,
            ]
        ]);
    }
}
