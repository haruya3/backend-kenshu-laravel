<?php
namespace App\tests\Unit\Repositories;

use App\Models\Image;
use App\Models\Post;
use App\Repositries\Posts\ImageRepository;
use Database\Factories\ImageFactory;
use Database\Factories\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class ImageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_createByPost__期待したImageオブジェクトが渡された時、imagesテーブルにレコードを作成できていること()
    {
        $testPost = PostFactory::new()->create();
        $expectedImage = Image::buildValidatedImageEntity(
            image_url: 'post_image',
            post_id: $testPost->id,
        );
        $imageRepository = new ImageRepository();

        $imageRepository->createByPost(array($expectedImage));

        $actualImageUrl = Image::all()->first()->image_url;
        $this->assertSame($expectedImage->image_url, $actualImageUrl);
    }
    public function test_findFromPost__画像を持つ記事のidが渡された時、期待した画像を取得できること()
    {
        $testPostCollection = Post::factory()->create();
        $imageRepository = new ImageRepository;
        $testImageCollection = ImageFactory::new()->specifyPost_id($testPostCollection->id)->create();

        $images = $imageRepository->findFromPost($testPostCollection->id);
        $this->assertSame($testImageCollection->id, $images[0]->id);
    }


    public function test_findFromPost__画像を持たない記事のidが渡された時、空の配列を取得できること()
    {
        $testPostCollection = PostFactory::new()->create();
        $imageRepository = new ImageRepository();

        $image = $imageRepository->findFromPost($testPostCollection->id);

        assertTrue(empty($image));
    }

}
