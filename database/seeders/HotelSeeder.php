<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            [
                'hid' => "test01",
                'status_pattern' => 0,
                'open_time' => '00:00',
                'close_time' => '23:45',
                'allday_active' => true,
                'explain_text_ja' => '貸出備品オーダー画面に表示されます。',
                'explain_text_en' => 'Displayed on the item order screen.',
                'order_text_ja' => '15分後以降にフロントでお受け取りいただけます。',
                'order_text_en' => 'Pick-up available at the front desk in 15 minutes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
