<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Posts\CreatePostServiceInterface;
use App\Services\Posts\GetListAndFormServiceInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function indexAndCreate(GetListAndFormServiceInterface $getListAndFormService)
    {
        $getListAndFormServiceDto = $getListAndFormService->run();
        return view('posts.listAndForm', [
            'user' => $getListAndFormServiceDto->user,
            'posts' => $getListAndFormServiceDto->posts,
            'images' => $getListAndFormServiceDto->images,
            'tags' => $getListAndFormServiceDto->tags,
        ]);
    }

    public function createPost(CreatePostServiceInterface $createPostService, Request $request)
    {
        $createPostService->run($request);
        return redirect('/posts');
    }
}
