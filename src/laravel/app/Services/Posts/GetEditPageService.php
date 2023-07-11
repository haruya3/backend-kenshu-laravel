<?php
namespace App\Services\Posts;

use App\Dto\GetEditPageServiceDto;
use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Policy\PostPolicy;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Services\Posts\Helper\CheckCanUpdateAndDeleteInterface;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

readonly class GetEditPageService implements GetEditPageServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private CheckCanUpdateAndDeleteInterface $checkCanUpdateAndDelete,
    ){}

    /**
     * @param int $post_id
     * @return GetEditPageServiceDto
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws SpecifiedPostIdIsNotExistError
     *
     */
    public function run(int $post_id): GetEditPageServiceDto
    {
        /** @throws NowUserCanNotUpdateAndDeletePostError */
        $this->checkCanUpdateAndDelete->run(
            user_id: Auth::id(),
            post_own_user_id: $this->postRepository->find($post_id)->user_id,
        );

        $post = $this->postRepository->find($post_id);
        return new GetEditPageServiceDto(
            post: $post,
        );
    }
}
