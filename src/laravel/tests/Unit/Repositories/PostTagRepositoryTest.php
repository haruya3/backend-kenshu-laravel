<?php
namespace App\tests\Unit\Repositories;

use App\Models\Tag;
use App\Repositries\Posts\PostTagRepository;
use Database\Factories\PostFactory;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PostTagRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_create__期待した記事のidとタグのidが渡された時、post_tagテーブルにレコードを作成できていること()
    {
        //テスト用データベースにタグテーブルの作成
        TagSeeder::run();
        $expectedTag = Tag::all()->first();
        $expetedPost = PostFactory::new()->create();
        $postTagRepository = new PostTagRepository();

        $postTagRepository->create($expetedPost->id, array($expectedTag->id));

        $actualTagId = DB::select('select tag_id from post_tag')[0]->tag_id;
        $this->assertSame($expectedTag->id, $actualTagId);
    }
}
