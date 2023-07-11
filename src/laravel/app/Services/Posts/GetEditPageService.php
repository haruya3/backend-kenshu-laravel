<?php
namespace App\Services\Posts;

use App\Dto\GetEditPageServiceDto;
use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Policy\PostPolicy;
use App\Repositries\Posts\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

readonly class GetEditPageService implements GetEditPageServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
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
        $user_id = Auth::id();
        if(!PostPolicy::new()->canUpdate($user_id, $post_id)) throw new NowUserCanNotUpdateAndDeletePostError("now user can not update and delete post. user of user id:$user_id is attempt to update post of post id:$post_id");

        $post = $this->postRepository->find($post_id);
        return new GetEditPageServiceDto(
            post: $post,
        );
    }
}
