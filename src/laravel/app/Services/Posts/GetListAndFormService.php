<?php
namespace App\Services\Posts;

use App\Dto\GetListAndFormServiceDto;
use App\Models\Post;
use App\Repositries\Posts\PostRepositoryInterface;
use App\Repositries\User\UserRepoInterface;
use Illuminate\Support\Facades\Auth;

class GetListAndFormService implements GetListAndFormServiceInterface
{
    private readonly UserRepoInterface $userRepo;
    private readonly PostRepositoryInterface $postRepository;
    public function __construct(UserRepoInterface $userRepo, PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepo = $userRepo;
    }


    public function run(): GetListAndFormServiceDto
    {
        $user = $this->userRepo->find(Auth::id());

        $posts = $this->postRepository->getAll();

        //postsに紐づく、tags, imagesのレコードを取得する。

        return new GetListAndFormServiceDto(
            user: $user,
            posts: $posts,
        );
    }
}
