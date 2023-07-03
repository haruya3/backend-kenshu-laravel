<?php
namespace App\Repositries\Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @return \App\Entity\Post[]
     */
    public function getAll(): array
    {
        $postItems = Post::all()->all();

        return array_map(function ($postItem) {
            return new \App\Entity\Post(
                id: $postItem->getAttribute('id'),
                title: $postItem->getAttribute('title'),
                content: $postItem->getAttribute('content'),
                thumnail_url: $postItem->getAttribute('thumnail_url'),
                user_id: $postItem->getAttribute('user_id'),
            );
        }, $postItems);
    }
}
