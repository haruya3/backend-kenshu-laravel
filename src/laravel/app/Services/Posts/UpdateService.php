<?php
namespace App\Services\Posts;

use App\Entity\Post;
use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Policy\PostPolicy;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Services\Posts\Helper\CheckCanUpdateAndDeleteInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

readonly class UpdateService implements UpdateServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private CheckCanUpdateAndDeleteInterface $checkCanUpdateAndDelete,
    ){}

    /**
     * @param Request $request
     * @param string $post_id
     * @return Post
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws \Illuminate\Validation\ValidationException
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(Request $request, string $post_id)
    {
        /** @throws NowUserCanNotUpdateAndDeletePostError */
        $this->checkCanUpdateAndDelete->run(
            user_id: Auth::id(),
            post_own_user_id: $this->postRepository->find($post_id)->user_id,
        );

        $post = \App\Models\Post::buildValidatedPostEntityForUpdate(
            id: $post_id,
            title: $request['title'],
            content: $request['content'],
            user_id: Auth::id(),
        );

        $this->postRepository->update($post);
    }
}
