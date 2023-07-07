<?php
namespace App\Repositries\Posts;

use App\Entity\Post;
use App\Entity\Tag;

interface PostTagRepositoryInterface
{
    /**
     * @param int $postId
     * @param array $tagIds
     * @return bool
     */
    public function create(int $postId, array $tagIds): bool;
}
