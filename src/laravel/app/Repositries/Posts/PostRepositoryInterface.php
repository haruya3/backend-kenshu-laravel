<?php
namespace App\Repositries\Posts;


use App\Entity\Post;
interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function getAll(): array;
}
