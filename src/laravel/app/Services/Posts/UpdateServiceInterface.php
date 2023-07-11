<?php
namespace App\Services\Posts;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;
use \Illuminate\Http\Request;
interface UpdateServiceInterface
{
    /**
     * @param Request $request
     * @param string $post_id
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws \Illuminate\Validation\ValidationException
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(Request $request, string $post_id);
}
