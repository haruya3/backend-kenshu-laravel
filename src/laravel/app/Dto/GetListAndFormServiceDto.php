<?php
namespace App\Dto;

use App\Entity\Image;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\User;

class GetListAndFormServiceDto
{
    public readonly User $user;

    /** @var Post[] */
    public readonly array $posts;

    /** @var array{int: Image[] | array} */
    public readonly array $images;

    /** @var array{int: Tag[] | array} */
    public readonly array $tags;

    /**
     * @param User $user
     * @param array $posts
     * @param array{int: Image[] | array} $images
     * @param array{int: Tag[] | array} $tags
     */
    function __construct(
        User $user,
        array $posts,
        array $images,
        array $tags,
    )
    {
        $this->user = $user;
        $this->posts = $posts;
        $this->images = $images;
        $this->tags = $tags;
    }
}
