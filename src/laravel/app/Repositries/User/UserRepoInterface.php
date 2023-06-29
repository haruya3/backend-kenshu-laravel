<?php
namespace App\Repositries\User;

use App\Models\User;

interface UserRepoInterface
{
    public function create(\App\Entity\User $user): User;
}
