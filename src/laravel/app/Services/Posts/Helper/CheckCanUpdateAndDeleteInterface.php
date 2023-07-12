<?php
namespace App\Services\Posts\Helper;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;

interface CheckCanUpdateAndDeleteInterface
{
    /**
     * @param int $user_id
     * @param int $post_own_user_id
     * @throws NowUserCanNotUpdateAndDeletePostError
     */
    public function run(int $user_id, int $post_own_user_id): void;
}
