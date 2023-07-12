<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\GetEditPageServiceDto;
use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use App\Policy\PostPolicy;
use App\Services\Posts\CreatePostServiceInterface;
use App\Services\Posts\DeleteServiceInterface;
use App\Services\Posts\GetDetailPageServiceInterface;
use App\Services\Posts\GetEditPageServiceInterface;
use App\Services\Posts\GetListAndFormServiceInterface;
use App\Services\Posts\UpdateServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        try {
            $createPostService->run($request);
        }catch (\InvalidArgumentException $e) {
            abort(404);
        }catch (ValidationException $e) {
            abort(404);
        }

        return redirect('/posts');
    }

    public function getDetailPage(GetDetailPageServiceInterface $getDetailPageService, string $id)
    {
        try {
            $getDetailPageServiceDto = $getDetailPageService->run(intval($id));
            return view('posts.detail', [
                'post' => $getDetailPageServiceDto->post,
                'images' => $getDetailPageServiceDto->images,
                'tags' => $getDetailPageServiceDto->tags,
                'isOwnPost' => PostPolicy::new()->canUpdateAndDelete(Auth::id(), $getDetailPageServiceDto->post->user_id),
            ]);
        }catch (SpecifiedPostIdIsNotExistError $e){
            abort(404);
        }
    }

    public function getEditPage(GetEditPageServiceInterface $getEditPageService, string $id)
    {
        try {
            $getEditPageServiceDto = $getEditPageService->run(intval($id));
            return view('posts.edit', [
                'post' => $getEditPageServiceDto->post,
            ]);
        }catch (NowUserCanNotUpdateAndDeletePostError $e){
            error_log($e->getMessage());
            abort(403);
        }catch (SpecifiedPostIdIsNotExistError $e){
            abort(404);
        }
    }

    public function update(UpdateServiceInterface $updateService, Request $request, string $id)
    {
        try {
            $updateService->run($request, $id);
            return redirect("posts/$id");
        }catch (NowUserCanNotUpdateAndDeletePostError $e){
            error_log($e->getMessage());
            abort(403);
        }catch (ValidationException | SpecifiedPostIdIsNotExistError $e){
            abort(404);
        }
    }

    public function delete(DeleteServiceInterface $deleteService, string $id)
    {
        try {
            $deleteService->run(intval($id));
        }catch (NowUserCanNotUpdateAndDeletePostError $e){
            error_log($e->getMessage());
            abort(403);
        }catch (SpecifiedPostIdIsNotExistError $e){
            abort(404);
        }
        return redirect('/posts');
    }
}
