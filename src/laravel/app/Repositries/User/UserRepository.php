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

    /**
     * @param int $id
     * @return \App\Entity\User
     */
    public function find(int $id): \App\Entity\User
    {
        $user = User::find($id);

        return new \App\Entity\User(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            password: '',
            profile_image_url: $user->profile_image_url,
        );
    }
}
