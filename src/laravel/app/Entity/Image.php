<?php
namespace App\Entity;

readonly class Image
{
    function __construct(
        public int $id,
        public string $image_url,
        public int $post_id
    ){}
}
