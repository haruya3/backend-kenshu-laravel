<?php
namespace App\Services\Posts;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Policy\PostPolicy;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Services\Posts\Helper\CheckCanUpdateAndDelete;
use App\Services\Posts\Helper\CheckCanUpdateAndDeleteInterface;
use Illuminate\Support\Facades\Auth;

readonly class DeleteService implements DeleteServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private CheckCanUpdateAndDeleteInterface $checkCanUpdateAndDelete,
    ){}

    /**
     * @param int $post_id
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $post_id)
    {
        /** @throws  NowUserCanNotUpdateAndDeletePostError */
        $this->checkCanUpdateAndDelete->run(
            user_id: Auth::id(),
            post_own_user_id: $this->postRepository->find($post_id)->user_id,
        );

        $this->postRepository->delete($post_id);
    }
}
