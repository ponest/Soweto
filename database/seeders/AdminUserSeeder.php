<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if an admin user already exists to avoid duplication
        if (DB::table('users')->where('email', 'admin@soweto.com')->doesntExist()) {
            DB::table('users')->insert([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@soweto.com',
                'phone_number' => '0763976000',
                'password' => Hash::make('password'), // Change the password as needed
            ]);
        }
    }
}
