<?php
namespace App\Repositries\User;

use App\Models\User;

interface UserRepoInterface
{
    public static function create(\App\Entity\User $user): User;
}
