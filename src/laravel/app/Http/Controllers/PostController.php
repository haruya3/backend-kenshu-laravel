<?php

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
        ]);
    }
}
