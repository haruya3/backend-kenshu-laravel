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
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;

class GetListAndFormTest extends TestCase
{
    use RefreshDatabase;
    public function test_userRepository_find__期待したユーザを取得できること()
    {
        $testUserCollection = UserFactory::new()->create();
        $userRepository = new UserRepository();

        $user = $userRepository->find($testUserCollection->id);

        //nameは一意制約を持っているため取得したデータで名前が期待したものなら、期待したユーザとします
        $this->assertSame($testUserCollection->name, $user->name);
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
        $testPostCollection = Post::factory()->create();
        $imageRepository = new ImageRepository;
        $testImageCollection = ImageFactory::new()->specifyPost_id($testPostCollection->id)->create();

        $images = $imageRepository->findFromPost($testPostCollection->id);
        $this->assertSame($testImageCollection->id, $images[0]->id);
    }

    #[DataProvider('tagByPostDataProvider')]
    public function test_tagRepository_findFromPost__タグを持つ記事のidが渡された時、期待したタグを取得できること(string $expected_tag_name)
    {
        $testPostCollection = PostFactory::new()->create();
        $testTagCollection = TagFactory::new()->specifyName($expected_tag_name)->create();

        //postsとtagsの中間テーブルにテストデータを挿入する
        $testPostTagSeeder = new TestPostTagSeeder;
        $testPostTagSeeder->run($testPostCollection->id, $testTagCollection->id);
        $testRepository = new TagRepository;

        $tag = $testRepository->findFromPost($testPostCollection->id);

        assertSame($expected_tag_name, $tag[0]->name);
    }

    public static function tagByPostDataProvider():array
    {
        return [
            'タグ名が「総合」であること' => ['総合'],
            'タグ名が「テクノロジー」であること' => ['テクノロジー'],
        ];
    }
}
