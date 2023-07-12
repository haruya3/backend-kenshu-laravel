<?php
namespace App\Services\Posts;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

interface DeleteServiceInterface
{
    /**
     * @param int $post_id
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $post_id);
}
