<?php
namespace App\Services\User;

use App\Models\User;

interface CreateNewUserServiceInterface
{
    /**
     * @param array $input
     * @return User
     */
    public function run(array $input): User;
}
