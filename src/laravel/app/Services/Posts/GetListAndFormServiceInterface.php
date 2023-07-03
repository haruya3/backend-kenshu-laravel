<?php
namespace App\Services\Posts;

use App\Dto\GetListAndFormServiceDto;

interface GetListAndFormServiceInterface
{
    /**
     * @return GetListAndFormServiceDto
     */
    public function run(): GetListAndFormServiceDto;
}
