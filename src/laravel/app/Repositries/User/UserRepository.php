<?php
namespace App\Repositries\User;

use App\Models\User;

class UserRepository implements UserRepoInterface
{
    /**
     * @param \App\Entity\User $user
     * @return User
     */
    public function create(\App\Entity\User $user): User
    {
        return User::create(
            get_object_vars($user)
        );
    }
}
