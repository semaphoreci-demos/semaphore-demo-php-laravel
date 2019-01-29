<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItCanInstantiateUserService()
    {
        $this->assertInstanceOf(UserService::class, app()->make(UserService::class));
    }

    public function testItCanCreateUser()
    {
        $service = app()->make(UserService::class);
        $fakeData = $this->fakeUserData();
        $user = $service->createUser($fakeData);
        $this->assertNotEmpty($user->id);
        $this->assertEquals($user->name, $fakeData['name']);
        $this->assertEquals($user->email, $fakeData['email']);
    }

    public function testItCanUpdateUser()
    {
        $createdUser = $this->createUser();
        $service = app()->make(UserService::class);
        $serviceResponse = $service->updateUser($createdUser, [
           'name' => 'updated name',
           'email' => 'new@email.com'
        ]);
        $this->assertTrue($serviceResponse);
        $updatedUser = User::first();
        $this->assertEquals($updatedUser->name, 'updated name');
        $this->assertEquals($updatedUser->email, 'new@email.com');
        $this->assertEquals($updatedUser->id, $createdUser->id);
    }

    public function testItCanDeleteUser()
    {
        $createdUser = $this->createUser();
        $service = app()->make(UserService::class);
        $serviceResponse = $service->deleteUser($createdUser);
        $this->assertTrue($serviceResponse);
        $this->assertCount(0, User::all());
    }



    private function createUser()
    {
        return User::create($this->fakeUserData());
    }

    /**
     * @return array
     */
    private function fakeUserData()
    {
        return [
          'name' => 'Test Account',
          'email' => 'mail@mail.com',
          'password' => '123456'
        ];
    }


}
