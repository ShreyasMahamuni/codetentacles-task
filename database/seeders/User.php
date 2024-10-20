<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@codetentacle.com',
            'password' => Hash::make('123456'), // Ensure to hash the password
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
