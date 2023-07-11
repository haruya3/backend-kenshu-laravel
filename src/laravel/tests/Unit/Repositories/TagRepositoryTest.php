<?php
namespace App\tests\Unit\Repositories;

use App\Repositries\Tags\TagRepository;
use Database\Factories\PostFactory;
use Database\Factories\TagFactory;
use Database\Seeders\TestPostTagSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

class TagRepositoryTest extends TestCase
{
    use RefreshDatabase;
    #[DataProvider('tagByPostDataProvider')]
    public function test_findFromPost__タグを持つ記事のidが渡された時、期待したタグを取得できること(string $expected_tag_name)
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

    public function test_findFromPost__タグを持たない記事のidが渡された時、空の配列を取得できること()
    {
        $testPostCollection = PostFactory::new()->create();
        $tagRepository = new TagRepository();

        $tag = $tagRepository->findFromPost($testPostCollection->id);

        assertTrue(empty($tag));
    }

    public static function tagByPostDataProvider():array
    {
        return [
            'タグ名が「総合」であること' => ['総合'],
            'タグ名が「テクノロジー」であること' => ['テクノロジー'],
        ];
    }
}
