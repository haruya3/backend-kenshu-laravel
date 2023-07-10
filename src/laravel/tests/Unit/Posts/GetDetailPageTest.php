<?php
declare(strict_types=1);

namespace App\tests\Unit\Posts;

use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Repositries\Posts\PostRepository;
use Database\Factories\PostFactory;
use Tests\TestCase;

class GetDetailPageTest extends TestCase
{
    public function test_PostRepository_find__存在するpostのidが渡された時、そのidに紐づくデータのPostが返されること()
    {
        $expectedPostCollection = PostFactory::new()->create();
        $postRepository = new PostRepository();

        $actualPost = $postRepository->find($expectedPostCollection->id);

        $this->assertSame($expectedPostCollection->id, $actualPost->id);
    }

    public function test_PostRepository_find__存在しないpostのidが渡された時、SpecifiedPostIdIsNotExistErrorがthrowされること()
    {
        $this->expectException(SpecifiedPostIdIsNotExistError::class);

        $notExistId = 1;
        $postRepository = new PostRepository();

        $postRepository->find($notExistId);
    }
}
