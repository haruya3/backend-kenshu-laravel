<?php
namespace App\Services\Posts;

use App\Models\Post;

interface GetListAndFormInterface
{
    /**
     * @return Post
     */
    public function run(): Post;
}
