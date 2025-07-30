<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'hid'           => "test01",
                'room'          => '101',
                'item_name_ja'  => '歯ブラシ',
                'quantity'      => 1,
                'status'        => 0,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'hid'           => "test02",
                'room'          => '202',
                'item_name_ja'  => 'フェイスタオル',
                'quantity'      => 2,
                'status'        => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'hid'           => "test01",
                'room'          => '303',
                'item_name_ja'  => '加湿器',
                'quantity'      => 1,
                'status'        => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'hid'           => "test01",
                'room'          => '505',
                'item_name_ja'  => 'トランプ',
                'quantity'      => 1,
                'status'        => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],

        ]);
    }
}
