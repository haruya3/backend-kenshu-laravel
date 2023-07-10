<?php
namespace App\tests\Unit\Posts;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Repositries\Posts\ImageRepository;
use App\Repositries\Posts\PostRepository;
use App\Repositries\Posts\PostTagRepository;
use Database\Factories\PostFactory;
use Database\Factories\UserFactory;
use Database\Seeders\TagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;
    public function test_PostRepository_create__期待したPostオブジェクトが渡された時、postsテーブルにレコードを作成できていること()
    {
        $user = UserFactory::new()->create();
        $testPost = Post::buildValidatedPostEntity(
            title: 'test',
            content: 'testです',
            thumnail_image_url: '/public/post_thumnail_image/test.png',
            user_id:  $user->id,
        );

        (new PostRepository)->create($testPost);

        $actualPostTitle = Post::all()->first()->title;
        $this->assertSame($testPost->title, $actualPostTitle);
    }

    public function test_ImageRepository_createByPost__期待したImageオブジェクトが渡された時、imagesテーブルにレコードを作成できていること()
    {
        $testPost = PostFactory::new()->create();
        $testImage = Image::buildValidatedImageEntity(
            image_url: 'post_image',
            post_id: $testPost->id,
        );

        (new ImageRepository())->createByPost(array($testImage));

        $actualImageUrl = Image::all()->first()->image_url;
        $this->assertSame($testImage->image_url, $actualImageUrl);
    }

    public function test_PostTagRepository_create__期待した記事のidとタグのidが渡された時、post_tagテーブルにレコードを作成できていること()
    {
        //テスト用データベースにタグテーブルの作成
        TagSeeder::run();
        $testTag = Tag::all()->first();
        $testPost = PostFactory::new()->create();

        (new PostTagRepository)->create($testPost->id, array($testTag->id));

        $actualTagId = DB::select('select tag_id from post_tag')[0]->tag_id;
        $this->assertSame($testTag->id, $actualTagId);
    }
}
