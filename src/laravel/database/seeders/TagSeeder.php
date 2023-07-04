<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagNameList = ['総合', 'テクノロジー', 'モバイル', 'アプリ', 'エンタメ', 'ビューティー', 'ファッション', 'ライフスタイル', 'ビジネス', 'グルメ', 'スポーツ'];
        foreach ($tagNameList as $tagName){
           dd( Tag::create([
                'name' => $tagName
            ]));
        }
    }
}
