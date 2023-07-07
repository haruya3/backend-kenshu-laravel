<?php
namespace App\Services\Posts;

use Illuminate\Http\Request;

interface CreatePostServiceInterface
{
    /**
     * @param Request $request
     */
    public function run(Request $request): void;
}
