<?php
namespace App\Repositries\Posts;

use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Models\Post;
use Illuminate\Database\QueryException;

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

    /**
     * @param \App\Entity\Post $post
     * @return int
     * @throws QueryException
     */
    public function create(\App\Entity\Post $post): int
    {
        $createdPostModel = Post::create(get_object_vars($post));
        return $createdPostModel->id;
    }

    /**
     * @param int $id
     * @return \App\Entity\Post
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function find(int $id): \App\Entity\Post
    {
        $postModel = Post::find($id);
        if(is_null($postModel)) throw new SpecifiedPostIdIsNotExistError("post of $id is not exist");

        return new \App\Entity\Post(
            id: $postModel->id,
            title: $postModel->title,
            content: $postModel->content,
            thumnail_url: $postModel->thumnail_url,
            user_id: $postModel->user_id,
        );
    }
}
