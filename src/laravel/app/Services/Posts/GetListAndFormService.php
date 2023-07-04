<?php
declare(strict_types=1);

namespace App\Services\Posts;

use App\Dto\GetListAndFormServiceDto;
use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\Tags\TagRepository;
use App\Repositries\Tags\TagrepositoryInterface;
use App\Repositries\User\UserRepoInterface;
use Illuminate\Support\Facades\Auth;

class GetListAndFormService implements GetListAndFormServiceInterface
{
    private readonly UserRepoInterface $userRepo;
    private readonly PostRepositoryInterface $postRepository;
    private readonly ImageRepositoryInterface $imageRepository;
    private readonly TagrepositoryInterface $tagrepository;
    public function __construct(
        UserRepoInterface $userRepo,
        PostRepositoryInterface $postRepository,
        ImageRepositoryInterface $imageRepository,
        TagRepository $tagrepository
    )
    {
        $this->postRepository = $postRepository;
        $this->userRepo = $userRepo;
        $this->imageRepository = $imageRepository;
        $this->tagrepository = $tagrepository;
    }


    public function run(): GetListAndFormServiceDto
    {
        $user = $this->userRepo->find(Auth::id());

        $posts = $this->postRepository->getAll();

        $images = [];
        $tags = [];
        foreach ($posts as $post){
            $images[$post->id] = $this->imageRepository->findFromPost($post->id);
            $tags[$post->id] = $this->tagrepository->findFromPost($post->id);
        }

        return new GetListAndFormServiceDto(
            user: $user,
            posts: $posts,
            images: $images,
            tags: $tags,
        );
    }
}
