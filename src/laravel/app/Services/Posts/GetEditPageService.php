<?php
namespace App\Services\Posts;

use App\Dto\GetEditPageServiceDto;
use App\Entity\Post;
use App\Repositries\Posts\PostRepositoryInterface;

readonly class GetEditPageService implements GetEditPageServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
    ){}

    /**
     * @param int $id
     * @return GetEditPageServiceDto
     * @throws \App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError
     */
    public function run(int $id): GetEditPageServiceDto
    {
        $post = $this->postRepository->find($id);
        return new GetEditPageServiceDto(
            post: $post,
        );
    }
}
