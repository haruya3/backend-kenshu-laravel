<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestPostTagSeeder extends Seeder
{
    /**
     * @param int $post_id
     * @param int $tag_id
     */
    public function run(int $post_id, int $tag_id): void
    {
        DB::table('post_tag')->insert([
            'post_id' => $post_id,
            'tag_id' => $tag_id,
        ]);
    }
}
