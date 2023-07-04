<?php
namespace App\Repositries\Tags;

use App\Entity\Tag;

interface TagrepositoryInterface
{
    /**
     * @return Tag[]
     */
    public function findFromPost(int $post_id): array;
}
