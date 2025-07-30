<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'hid' => 'test01',
                'item_name_ja' => 'ハンガー',
                'item_name_en' => 'Hanger',
                'sort' => 1,
                'stock' => 10,
                'visible' => true,
                'i_name' => 'icon_hanger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hid' => 'test01',
                'item_name_ja' => 'ケーブル',
                'item_name_en' => 'Cable',
                'sort' => 2,
                'stock' => 15,
                'visible' => true,
                'i_name' => 'icon_cable.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hid' => 'test01',
                'item_name_ja' => 'アイロン',
                'item_name_en' => 'Iron',
                'sort' => 3,
                'stock' => 5,
                'visible' => true,
                'i_name' => 'icon_iron.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hid' => 'test01',
                'item_name_ja' => 'ストレートアイロン',
                'item_name_en' => 'Straight Iron',
                'sort' => 4,
                'stock' => 10,
                'visible' => false,
                'i_name' => 'icon_straight_iron.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hid' => 'test01',
                'item_name_ja' => '充電器',
                'item_name_en' => 'Charger',
                'sort' => 5,
                'stock' => 20,
                'visible' => true,
                'i_name' => 'icon_charger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hid' => 'test02',
                'item_name_ja' => '充電器',
                'item_name_en' => 'Charger',
                'sort' => 5,
                'stock' => 20,
                'visible' => true,
                'i_name' => 'icon_charger.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
