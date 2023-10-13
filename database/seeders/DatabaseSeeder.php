<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
