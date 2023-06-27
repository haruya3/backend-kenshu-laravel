<?php
namespace App\Services;

use App\Models\User;
use App\Repositries\UserRepoInterface;

class CreateNewUserService implements CreateNewUserServiceInterface
{
    private readonly UserRepoInterface $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @param array $input
     * @return User
     * @throws \InvalidArgumentException
     */
    public function run(array $input): User
    {
        $profile_image_url = StoreFileService::run($input['profile-image']);

        try {
            return $this->userRepo::create(User::buildValidatedUserParams(
                name: $input['name'],
                email: $input['email'],
                password: $input['password'],
                password_confirmation: $input['password_confirmation'],
                profile_image_url: $profile_image_url,
            ));
        }catch (\Exception $e){
            //ファイルの削除を行う。
            throw $e;
        }
    }
}
