<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * @var User|Model
     */
    private $user;

    /**
     * UserService constructor.
     * @param User|Model $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createUser(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return $this->user->create($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     */
    public function updateUser(User $user, array $data): bool
    {
        return $user->update($data);
    }

    /**
     * @param User $user
     * @return bool|null
     * @throws \Exception
     */
    public function deleteUser(User $user) : bool
    {
        return $user->delete();
    }

    /**
     * @return mixed
     */
    public function getPaginated(): LengthAwarePaginator
    {
        return $this->user->paginate(20);
    }

    /**
     * @param User $user
     * @param $password
     * @return bool
     */
    public function changePassword(User $user, $password): bool
    {
        $user->password = bcrypt($password);
        return $user->save();
    }
}
