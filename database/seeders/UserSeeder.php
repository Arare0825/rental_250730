<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'hid' => 'test01',
                'password' => Hash::make('password123'),
                'status_pattern' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hid' => 'test02',
                'password' => Hash::make('password123'),
                'status_pattern' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}