<?php
namespace App\tests\Unit\Services\Helper;

use App\Exceptions\CustomExceptions\NowUserCanNotUpdateAndDeletePostError;
use App\Services\Posts\Helper\CheckCanUpdateAndDelete;
use Tests\TestCase;

class CheckCanUpdateAndDeleteTest extends TestCase
{
    public function test_run__現在ログインしているユーザとpostの所有者が違う時、NowUserCanNotUpdateAndDeletePostErrorをthrowすること()
    {
        $this->expectException(NowUserCanNotUpdateAndDeletePostError::class);

        $nowLoginedUserId = 1;
        $postOwnUserId = 2;
        $checkCanUpdateAndDelete = new CheckCanUpdateAndDelete();

        $checkCanUpdateAndDelete->run($nowLoginedUserId, $postOwnUserId);
    }
}
