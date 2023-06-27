<?php
namespace App\Services;

use App\Models\User;

interface CreateNewUserServiceInterface
{
    /**
     * @param array $input
     * @return User
     */
    public function run(array $input): User;
}
