<?php
namespace App\Dto;

use App\Entity\Image;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;

readonly class GetListAndFormServiceDto
{
    /**
     * @param User $user
     * @param Post[] $posts
     * @param array{int: Image[] | array} $images
     * @param array{int: Tag[] | array} $tags
     */
    function __construct(
        public User $user,
        public array $posts,
        public array $images,
        public array $tags,
    ){}
}
