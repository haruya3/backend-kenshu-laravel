<?php
declare(strict_types=1);
namespace App\Services\User;

use App\Models\User;
use App\Repositries\User\UserRepositoryInterface;
use App\Services\StoreFileService;
use App\Services\StoreFileServiceInterface;

class CreateNewUserService implements CreateNewUserServiceInterface
{
    private readonly UserRepositoryInterface $userRepository;

    private readonly StoreFileServiceInterface $storeFileService;

    public function __construct(UserRepositoryInterface $userRepository, StoreFileServiceInterface $storeFileService)
    {
        $this->userRepository = $userRepository;
        $this->storeFileService = $storeFileService;
    }

    /**
     * @param array $input
     * @return User
     * @throws \InvalidArgumentException
     */
    public function run(array $input): User
    {
        $profile_image_url = $this->storeFileService->run($input['profile-image']);

        try {
            return $this->userRepository->create(User::buildValidatedUserParams(
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
