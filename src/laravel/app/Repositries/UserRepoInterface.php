<?php
namespace App\Repositries;

use \App\Models\User;

interface UserRepoInterface
{
    public static function create(\App\Entity\User $user): User;
}
