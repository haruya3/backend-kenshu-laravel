<?php
namespace App\Services\Posts;

use App\Models\Post;
use App\Repositries\Posts\PostRepository;
use App\Repositries\Posts\PostRepositoryInterface;

class GetListAndFormService implements GetListAndFormInterface
{
    private readonly PostRepositoryInterface $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function run(): Post
    {
        $postItems = $this->postRepository->getPosts()->all();
        $posts = array_map(function ($postItem) {
                return new \App\Entity\Post(
                    id: $postItem->getAttribute('id'),
                    title: $postItem->getAttribute('title'),
                    content: $postItem->getAttribute('content'),
                    thumnail_url: $postItem->getAttribute('thumnail_url'),
                    user_id: $postItem->getAttribute('user_id'),
                );
            }, $postItems;


//        foreach ($items->getPosts() as $item){
//            $item->
//        }
        return new Post;
    }
}
