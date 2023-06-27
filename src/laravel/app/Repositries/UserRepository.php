<?php
namespace App\Repositries;

use \App\Models\User;

class UserRepository implements UserRepoInterface
{
    /**
     * @param \App\Entity\User $user
     * @return User
     */
    public static function create(\App\Entity\User $user): User
    {
        return User::create(
            get_object_vars($user)
        );
    }
}
