<?php
namespace App\Repositries\Posts;


use App\Entity\Post;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

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

    /**
     * @param int $id
     * @return Post
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function find(int $id): Post;

    /**
     * @param Post $post
     * @return mixed
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function update(Post $post);
}
