<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_patterns')->insert([
            [
                'status_pattern' => '0',
                'status'         => '0',
                'status_name'    => '未確認',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'status_pattern' => '0',
                'status'         => '1',
                'status_name'    => '準備完了',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'status_pattern' => '0',
                'status'         => '2',
                'status_name'    => '受け渡し完了',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'status_pattern' => '1',
                'status'         => '0',
                'status_name'    => '注文中',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'status_pattern' => '1',
                'status'         => '1',
                'status_name'    => 'お届け中',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'status_pattern' => '1',
                'status'         => '2',
                'status_name'    => 'お届け済み',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],

        ]);
    }
}
