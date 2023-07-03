<?php
namespace App\Entity;
class Post{
    public readonly int $id;
    public readonly string $title;
    public readonly string $content;
    public readonly string $thumnail_url;
    public readonly int $user_id;

    function __construct(
        int $id,
        string $title,
        string $content,
        string $thumnail_url,
        int $user_id
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->thumnail_url = $thumnail_url;
        $this->user_id = $user_id;
    }
}
