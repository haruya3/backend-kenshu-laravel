<?php
namespace App\Services\Posts;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Policy\PostPolicy;
use App\Repositries\Posts\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

readonly class DeleteService implements DeleteServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
    ){}

    /**
     * @param int $post_id
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $post_id)
    {
        $user_id = Auth::id();
        $post = $this->postRepository->find($post_id);
        if(!PostPolicy::new()->canUpdateAndDelete($user_id, $post->user_id)) throw new NowUserCanNotUpdateAndDeletePostError("now user can not update and delete post. $user_id is attempt to delete $post_id");

        $this->postRepository->delete($post_id);
    }
}
