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
     * @return int
     */
    public function create(Post $post): int;
}
