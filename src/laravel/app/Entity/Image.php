<?php
namespace App\Entity;

class Image
{
    public readonly int $id;
    public readonly string $image_url;
    public readonly int $post_id;

    function __construct(
        int $id,
        string $image_url,
        int $post_id
    )
    {
        $this->id = $id;
        $this->image_url = $image_url;
        $this->post_id = $post_id;
    }
}
