<?php
namespace App\Services\Posts;

use App\Entity\Post;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Repositries\Posts\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

readonly class UpdateService implements UpdateServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
    ){}

    /**
     * @param Request $request
     * @param string $post_id
     * @return Post
     * @throws \Illuminate\Validation\ValidationException
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(Request $request, string $post_id)
    {
        $post = \App\Models\Post::buildValidatedPostEntityForUpdate(
            id: $post_id,
            title: $request['title'],
            content: $request['content'],
            user_id: Auth::id(),
        );

        $this->postRepository->update($post);
    }
}
