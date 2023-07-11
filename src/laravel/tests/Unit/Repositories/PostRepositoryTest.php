<?php
namespace App\tests\Unit\Repositories;

use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Models\Post;
use App\Repositries\Posts\PostRepository;
use Database\Factories\PostFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAll__記事を全件取得できること()
    {
        PostFactory::new()->count(5)->create();

        $postRepository = new PostRepository;
        $post = $postRepository->getAll();

        self::assertCount(5, $post);
    }

    public function test_create__期待したPostオブジェクトが渡された時、postsテーブルにレコードを作成できていること()
    {
        $user = UserFactory::new()->create();
        $expectedPost = Post::buildValidatedPostEntity(
            title: 'test',
            content: 'testです',
            thumnail_image_url: '/public/post_thumnail_image/test.png',
            user_id:  $user->id,
        );
        $postRepository = new PostRepository();

        $postRepository->create($expectedPost);

        $actualPostTitle = Post::all()->first()->title;
        $this->assertSame($expectedPost->title, $actualPostTitle);
    }

    public function test_find__存在するpostのidが渡された時、そのidに紐づくデータのPostが返されること()
    {
        $expectedPostCollection = PostFactory::new()->create();
        $postRepository = new PostRepository();

        $actualPost = $postRepository->find($expectedPostCollection->id);

        $this->assertSame($expectedPostCollection->id, $actualPost->id);
    }

    public function test_find__存在しないpostのidが渡された時、SpecifiedPostIdIsNotExistErrorがthrowされること()
    {
        $this->expectException(SpecifiedPostIdIsNotExistError::class);

        $notExistId = 1;
        $postRepository = new PostRepository();

        $postRepository->find($notExistId);
    }

    public function test_update__存在するpostのidが渡された時、そのpostがアップデートされていること()
    {
        $testPostCollection = PostFactory::new()->create();
        //例としてタイトルの更新をテストします
        $expectedTitle = 'title';
        $testPost = new \App\Entity\Post(
            id: $testPostCollection->id,
            title:  $expectedTitle,
            content: $testPostCollection->content,
            thumnail_url: $testPostCollection->thumnail_url,
            user_id: $testPostCollection->user_id,
        );
        $postRepository = new PostRepository();

        $postRepository->update($testPost);
        $actualTitle = Post::find($testPostCollection->id)->title;

        $this->assertSame($expectedTitle, $actualTitle);
    }

    public function test_update__存在しないpostのidが渡された時、SpecifiedPostIdIsNotExistErrorがthrowされること()
    {
        $this->expectException(SpecifiedPostIdIsNotExistError::class);

        $notExistId = 1;
        $testPost = new \App\Entity\Post(
            id: $notExistId,
            title:  'test',
            content: 'test',
            thumnail_url: '',
            user_id: 0,
        );
        $postRepository = new PostRepository();

        $postRepository->update($testPost);
    }
}
