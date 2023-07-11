<?php
namespace App\tests\Unit\User;

use App\Models\Rules\NameValidationRules;
use App\Models\User;
use App\Repositries\User\UserRepository;
use App\Services\StoreFileService;
use App\Services\UploadedFileValidation;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class CreateUserTest extends TestCase
{
    public function test_User_buildValidationUserParams__ユーザの名前が空の時、ValidationExceptionをthrowすること()
    {
        $this->expectException(ValidationException::class);

        $userOnNameEmpty = UserFactory::new()->nameIsEmpty()->make();

        User::buildValidatedUserParams(
            name: $userOnNameEmpty->getAttributeValue('name'),
            email: $userOnNameEmpty->getAttributeValue('email'),
            password: $userOnNameEmpty->getAttributeValue('password'),
            password_confirmation: $userOnNameEmpty->getAttributeValue('password_confirmation'),
            profile_image_url: $userOnNameEmpty->getAttributeValue('profile_image_url'),
        );
    }

    use NameValidationRules;
    public function test_User_buildValidationUserParams__ユーザの名前が最大値を超えている時、ValidationExceptionをthrowすること()
    {
        $this->expectException(ValidationException::class);

        $userOnNameEmpty = UserFactory::new()->nameIsOverMaxCharacters()->make();

        User::buildValidatedUserParams(
            name: $userOnNameEmpty->getAttributeValue('name'),
            email: $userOnNameEmpty->getAttributeValue('email'),
            password: $userOnNameEmpty->getAttributeValue('password'),
            password_confirmation: $userOnNameEmpty->getAttributeValue('password_confirmation'),
            profile_image_url: $userOnNameEmpty->getAttributeValue('profile_image_url'),
        );
    }

    public function test_User_buildValidationUserParams__ユーザの名前が重複する時、ValidationExceptionをthrowすること()
    {
        $this->expectException(ValidationException::class);

        //重複させるユーザ情報を作成
        $user = UserFactory::new()->create();

        User::buildValidatedUserParams(
            name: $user->getAttributeValue('name'),
            email: $user->getAttributeValue('email'),
            password: $user->getAttributeValue('password'),
            password_confirmation: $user->getAttributeValue('password'),
            profile_image_url: $user->getAttributeValue('profile_image_url'),
        );
    }
}
