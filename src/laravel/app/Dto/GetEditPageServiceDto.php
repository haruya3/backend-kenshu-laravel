<?php
namespace App\Dto;

use App\Entity\Post;

readonly class GetEditPageServiceDto
{
    public function __construct(
        public Post $post,
    ){}
}
