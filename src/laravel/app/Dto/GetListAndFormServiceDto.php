<?php
namespace App\Dto;

use App\Entity\Post;
use App\Entity\User;

class GetListAndFormServiceDto
{
    public readonly User $user;

    /** @var Post[] */
    public readonly array $posts;

    /**
     * @param User $user
     * @param array $posts
     */
    function __construct(
        User $user,
        array $posts,
    )
    {
        $this->user = $user;
        $this->posts = $posts;
    }
}
