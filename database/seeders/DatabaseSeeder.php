<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin user',
            'email' => 'admin@test.com',
            'password' => Hash::make('123'),
            'is_admin' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Basic user',
            'email' => 'user@test.com',
            'password' => Hash::make('123'),
            'is_admin' => 0,
        ]);
    }
}
