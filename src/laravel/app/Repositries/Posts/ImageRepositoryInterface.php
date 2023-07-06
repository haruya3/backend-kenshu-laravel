<?php
namespace App\Repositries\Posts;

use App\Entity\Image;

interface ImageRepositoryInterface
{
    /**
     * @param int $post_id
     * @return Image[]
     */
    public function findFromPost(int $post_id): array;

    /**
     * @param Image[] $images
     * @return bool
     */
    public function createByPost(array $images): bool;
}
