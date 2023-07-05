<?php
declare(strict_types=1);

namespace App\Services\Posts;

use App\Dto\GetListAndFormServiceDto;
use App\Repositries\Posts\ImageRepositoryInterface;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\Tags\TagRepository;
use App\Repositries\Tags\TagrepositoryInterface;
use App\Repositries\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class GetListAndFormService implements GetListAndFormServiceInterface
{
    private readonly UserRepositoryInterface $userRepository;
    private readonly PostRepositoryInterface $postRepository;
    private readonly ImageRepositoryInterface $imageRepository;
    private readonly TagrepositoryInterface $tagrepository;
    public function __construct(
        UserRepositoryInterface  $userRepository,
        PostRepositoryInterface  $postRepository,
        ImageRepositoryInterface $imageRepository,
        TagRepository            $tagrepository
    )
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
        $this->tagrepository = $tagrepository;
    }


    public function run(): GetListAndFormServiceDto
    {
        $user = $this->userRepository->find(Auth::id());

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
