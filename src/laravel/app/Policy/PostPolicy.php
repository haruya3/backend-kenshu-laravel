<?php
declare(strict_types=1);

namespace App\Policy;

use App\Entity\Post;
use App\Entity\User;

class PostPolicy
{
    /**
     * @param int $user_id
     * @param Post $post
     * @return bool
     */
    public function update(int $now_user_id, int $post_own_user_id)
    {
        return $now_user_id === $post_own_user_id;
    }

    /**
     * @return PostPolicy
     */
    public static function new(): PostPolicy
    {
        return new PostPolicy();
    }
}
