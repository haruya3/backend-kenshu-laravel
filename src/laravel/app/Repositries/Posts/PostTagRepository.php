<?php
namespace App\Repositries\Posts;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PostTagRepository implements PostTagRepositoryInterface
{
    /**
     * @param int $postId
     * @param array $tagIds
     * @return bool
     * @throws QueryException
     */
    public function create(int $postId, array $tagIds): bool
    {
        DB::table('post_tag')->insert(
            array_map(fn ($tagId) =>
                [
                    'post_id' => $postId,
                    'tag_id' => $tagId,
                ]
            ,$tagIds)
        );

        return true;
    }
}
