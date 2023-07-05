<?php
namespace App\Repositries\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(\App\Entity\User $user): User;
}
