<?php
declare(strict_types=1);

namespace App\Services\Posts;

use App\Dto\GetEditPageServiceDto;
use App\Exceptions\CustomExceptions\SpecifiedPostIdIsNotExistError;

interface GetEditPageServiceInterface
{
    /**
     * @param int $id
     * @return GetEditPageServiceDto
     * @throws SpecifiedPostIdIsNotExistError
     */
    public function run(int $id): GetEditPageServiceDto;
}
