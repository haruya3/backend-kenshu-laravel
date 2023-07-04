<?php
declare(strict_types=1);

namespace App\Repositries\Tags;

use App\Entity\Tag;
use App\Models\Post;

class TagRepository implements TagrepositoryInterface
{
    /**
     * @param int $post_id
     * @return Tag[] | string
     */
    public function findFromPost(int $post_id): array | string
    {
        $tagItems = Post::find($post_id)->tags()->get()->toArray();
        if(empty($tagItems)){
            return '';
        }

        return array_map(function ($tagItem){
            return new Tag(
               id: $tagItem['id'],
               name: $tagItem['name'],
            );
        }, $tagItems);
    }
}
