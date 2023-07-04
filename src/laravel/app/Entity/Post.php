<?php
namespace App\Entity;
readonly class Post{
    function __construct(
        public int $id,
        public string $title,
        public string $content,
        public string $thumnail_url,
        public int $user_id
    ){}
}
