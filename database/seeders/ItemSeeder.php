<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'name' => 'カット',
                'memo' => '学生料金',
                'price' => 4000,
            ],
            [
                'name' => 'カラー',
                'memo' => '通常料金',
                'price' => 8000,
            ],
            [
                'name' => 'パーマ(カット込み)',
                'memo' => '通常料金',
                'price' => 13000,
            ],
            [
                'name' => 'トリートメント',
                'memo' => '学生料金',
                'price' => 5000,
            ],

        ]);
    }
}
