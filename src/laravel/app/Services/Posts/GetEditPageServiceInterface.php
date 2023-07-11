<?php
declare(strict_types=1);

namespace App\Services\Posts;

use App\Dto\GetEditPageServiceDto;
use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

interface GetEditPageServiceInterface
{
    /**
     * @param int $post_id
     * @return GetEditPageServiceDto
     * @throws NowUserCanNotUpdateAndDeletePostError
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $post_id): GetEditPageServiceDto;
}
