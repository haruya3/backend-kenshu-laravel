<?php
declare(strict_types=1);

namespace App\Repositries\Tags;

use App\Entity\Tag;
use App\Models\Post;

class TagRepository implements TagrepositoryInterface
{
    /**
     * @param int $post_id
     * @return Tag[]
     */
    public function findFromPost(int $post_id): array
    {
        $tagItems = Post::find($post_id)->tags()->get();

        if($tagItems === []) return [];

        return $tagItems->map(function ($tagItem){
            return new Tag(
               id: $tagItem->id,
               name: $tagItem->name,
            );
        })->toArray();
    }
}
