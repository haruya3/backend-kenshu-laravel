<?php
namespace App\Services\Posts\Helper;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Policy\PostPolicy;
use Illuminate\Support\Facades\Auth;

class CheckCanUpdateAndDelete implements CheckCanUpdateAndDeleteInterface
{
    /**
     * @param int $user_id
     * @param int $post_own_user_id
     * @throws NowUserCanNotUpdateAndDeletePostError
     */
    public function run(int $user_id, int $post_own_user_id)
    {
        $message = "now user can not update and delete post. user of user id:$user_id is attempt to update or delete post of post user_id:$post_own_user_id";
        if(!PostPolicy::new()->canUpdateAndDelete($user_id, $post_own_user_id)) throw new NowUserCanNotUpdateAndDeletePostError($message);
    }
}
