<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Posts\GetListAndFormServiceInterface;

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
}
