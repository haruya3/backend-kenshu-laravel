<?php
namespace App\tests\Unit\Posts;

use App\Models\Post;
use App\Repositries\Posts\ImageRepository;
use App\Repositries\Posts\PostRepository;
use App\Repositries\Tags\TagRepository;
use App\Repositries\User\UserRepository;
use Database\Factories\ImageFactory;
use Database\Factories\PostFactory;
use Database\Factories\TagFactory;
use Database\Factories\UserFactory;
use Database\Seeders\TestPostTagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

class GetListAndFormTest extends TestCase
{
    use RefreshDatabase;
    public function test_userRepo_find__期待したユーザを取得できること()
    {
        $testUserCollection = UserFactory::new()->create();
        $userRepository = new UserRepository();

        $user = $userRepository->find($testUserCollection->id);

        //nameは一意制約を持っているため取得したデータで名前が期待したものなら、期待したユーザとします
        assertSame($testUserCollection->name, $user->name);
    }

    public function test_postRepository_getAll__記事を全件取得できること()
    {
        PostFactory::new()->count(5)->create();

        $postRepository = new PostRepository;
        $post = $postRepository->getAll();

        self::assertCount(5, $post);
    }

    public function test_imageRepository_findFromPost__画像を持つ記事のidが渡された時、期待した画像を取得できること()
    {
        $testPostCollection = Post::factory(3)->create();
        $imageRepository = new ImageRepository;

        foreach ($testPostCollection as $testPost){
            $testImageCollection = ImageFactory::new()->specifyPost_id($testPost->id)->count(2)->create();

            $images = $imageRepository->findFromPost($testPost->id);

            foreach ($images as $key => $image){
                assertSame($testImageCollection[$key]->id, $image->id);
            }
        }
    }

    public function test_tagRepository_findFromPost__タグを持つ記事のidが渡された時、期待したタグを取得できること()
    {
        $testPostCollection = PostFactory::new()->count(3)->create();
        $testTagNameIs総合 = TagFactory::new()->nameIs総合()->create();
        $testTagNameIsテクノロジー = TagFactory::new()->nameIsテクノロジー()->create();
        //postsとtagsの中間テーブルにテストデータを挿入する
        $testPostTagSeeder = new TestPostTagSeeder;
        $testRepository = new TagRepository;

        foreach ($testPostCollection as $testPost){
            $testPostTagSeeder->run($testPost->id, $testTagNameIs総合->id);
            $testPostTagSeeder->run($testPost->id, $testTagNameIsテクノロジー->id);

            $tags = $testRepository->findFromPost($testPost->id);

            assertSame($testTagNameIs総合->name, $tags[0]->name);
            assertSame($testTagNameIsテクノロジー->name, $tags[1]->name);
        }
    }
}
