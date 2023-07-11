<?php
namespace App\Services\Posts;

use App\Dto\GetDetailPageServiceDto;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

interface GetDetailPageServiceInterface
{
    /**
     * @param int $post_id
     * @return GetDetailPageServiceDto
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $post_id): GetDetailPageServiceDto;
}
