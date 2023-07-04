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
        $postItems = Post::all();

        return $postItems->map(function ($postItem) {
            return new \App\Entity\Post(
                id: $postItem->id,
                title: $postItem->title,
                content: $postItem->content,
                thumnail_url: $postItem->thumnail_url,
                user_id: $postItem->user_id,
            );
        })->toArray();
    }
}
