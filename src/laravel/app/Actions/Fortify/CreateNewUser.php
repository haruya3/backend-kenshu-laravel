<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\User\CreateNewUserServiceInterface;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    private readonly CreateNewUserServiceInterface $createNewUserService;

    public function __construct(CreateNewUserServiceInterface $createNewUserService)
    {
        $this->createNewUserService = $createNewUserService;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        try{
            return $this->createNewUserService->run($input);
        }catch (\InvalidArgumentException $e){
            error_log($e->getMessage());
            abort(404);
        }
    }
}
