<?php
namespace App\tests\Unit\Repositories;

use App\Models\User;
use App\Repositries\User\UserRepository;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_find__期待したユーザを取得できること()
    {
        $testUserCollection = UserFactory::new()->create();
        $userRepository = new UserRepository();

        $user = $userRepository->find($testUserCollection->id);

        //nameは一意制約を持っているため取得したデータで名前が期待したものなら、期待したユーザとします
        $this->assertSame($testUserCollection->name, $user->name);
    }


    public function test_create__正常なユーザ情報の時、そのユーザ情報をDBに登録できること()
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
}
