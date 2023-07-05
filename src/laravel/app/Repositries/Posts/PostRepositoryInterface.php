<?php
namespace App\Repositries\Posts;


use App\Entity\Post;
interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function getAll(): array;

    /**
     * @param Post $post
     * @return bool
     */
    public function create(Post $post): bool;
}
