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
}
