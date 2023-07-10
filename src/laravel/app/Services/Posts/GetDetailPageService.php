<?php
namespace App\Services\Posts;

use App\Dto\GetDetailPageServiceDto;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\Tags\TagrepositoryInterface;

readonly class GetDetailPageService implements GetDetailPageServiceInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private ImageRepositoryInterface $imageRepository,
        private TagrepositoryInterface $tagrepository,
    ){}

    /**
     * @param int $post_id
     * @return GetDetailPageServiceDto
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $post_id): GetDetailPageServiceDto
    {
        $post = $this->postRepository->find($post_id);
        $images = $this->imageRepository->findFromPost($post_id);
        $tags = $this->tagrepository->findFromPost($post_id);

        return new GetDetailPageServiceDto(
            post: $post,
            images: $images,
            tags: $tags,
        );
    }
}
