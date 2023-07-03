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
    public function test_UplodedFileValidation_validate__正常なファイルをアップロードした時、そのファイルでバリデーションを通過してtrueを返すこと()
    {
        $file = self::getNormalUploadedDummyFile();
        assertTrue(UploadedFileValidation::validate($file));
    }

    public function test_StoreFileService_run__正常なファイルをアップロードした時、そのファイルが保存されていること()
    {
        $file = self::getNormalUploadedDummyFile();

        Storage::disk()->assertExists(StoreFileService::run($file));
    }

    /**
     * 期待されたMIMETYPEとはUploadFileValidation::EXPECTED_FILE_MIME_TYPE_LISTにある通り
     * 'image/jpg', 'image/jpeg', 'image/png'
     */
    public function test_StoreFileService_run__アップロードされたファイルが期待されたMIMETYPEでない時、InvalidArgumentExceptionをthrowすること()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('uploded file is not expected extention');

        $file = UploadedFile::fake()->create(name: 'can_not_upload_ファイル.php', mimeType: 'text/x-php');
        StoreFileService::run($file);
    }

    public function test_User_buildValidationUserParams__正常なユーザ情報の時、そのユーザ情報でモデルバリデーションを通過してUserオブジェクトを返すこと()
    {
        $user = UserFactory::new()->normalUser()->make();

        $user = User::buildValidatedUserParams(
            name: $user->getAttributeValue('name'),
            email: $user->getAttributeValue('email'),
            password: $user->getAttributeValue('password'),
            password_confirmation: $user->getAttributeValue('password_confirmation'),
            profile_image_url: $user->getAttributeValue('profile_image_url'),
        );

        self::assertInstanceOf(\App\Entity\User::class, $user);
    }


    public function test_User_buildValidationUserParams__ユーザの名前が空の時、ValidationExceptionをthrowすること()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The name field is required.');

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
        $maxCharacters = self::MAX_CHARACTERS;
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("The name field must not be greater than {$maxCharacters} characters.");

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

    use RefreshDatabase;

    public function test_UserRepository_create__正常なユーザ情報の時、そのユーザ情報をDBに登録できること()
    {
        $user = new \App\Entity\User(
            id: 1,
            name: 'test',
            email: 'test@test.com',
            password: 'testpassword',
            profile_image_url: '/public/image/user_profile/fkeoafe.png',
        );

        $userRepository = new UserRepository;
        self::assertInstanceOf(User::class, $userRepository->create($user));
    }

    /**
     * @return \Illuminate\Http\Testing\File
     */
    private static function getNormalUploadedDummyFile()
    {
        Storage::fake();
        return UploadedFile::fake()->image('can_upload_ファイル.jpg')->size(5000);
    }
}
