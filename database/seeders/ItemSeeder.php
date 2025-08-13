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
                'memo' => '通常料金',
                'price' => 5500,
            ],
            [
                'name' => 'カラー',
                'memo' => '通常料金',
                'price' => 7500,
            ],
            [
                'name' => 'パーマ(カット込み)',
                'memo' => '通常料金',
                'price' => 12000,
            ],
            [
                'name' => 'トリートメント',
                'memo' => '通常料金',
                'price' => 4000,
            ],
            [
                'name' => 'ヘッドスパ',
                'memo' => 'リラクゼーション',
                'price' => 6000,
            ],
            [
                'name' => '縮毛矯正(カット込み)',
                'memo' => '高技術メニュー',
                'price' => 18000,
            ],
            [
                'name' => 'ハイライト',
                'memo' => 'ブリーチ使用',
                'price' => 11000,
            ],
            [
                'name' => 'シャンプー・ブロー',
                'memo' => '単品メニュー',
                'price' => 2500,
            ],
            [
                'name' => 'メンズカット',
                'memo' => '男性専用',
                'price' => 4500,
            ],
            [
                'name' => 'リタッチカラー',
                'memo' => '根元のみ',
                'price' => 5500,
            ],
        ]);
    }
}
