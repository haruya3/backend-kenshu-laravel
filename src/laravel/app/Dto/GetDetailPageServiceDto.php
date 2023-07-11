<?php
namespace App\Dto;

use App\Entity\Image;
use App\Entity\Post;
use App\Entity\Tag;

readonly class GetDetailPageServiceDto
{
    /**
     * @param Post $post
     * @param array<Image> $images
     * @param array<Tag> $tags
     */
    public function __construct(
      public Post $post,
      public array $images,
      public array $tags,
    ){}
}
