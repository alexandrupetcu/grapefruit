<?php

namespace App\Http\Repository;

use App\Http\Dto\UserDTO;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function saveUser(UserDTO $userDTO): UserResource
    {
        $user = new User;
        $user->first_name = $userDTO->getFirstName();
        $user->last_name = $userDTO->getLastName();
        $user->email = $userDTO->getEmail();
        $user->password = Hash::make($userDTO->getPassword());
        $user->saveOrFail();

        return new UserResource($user);
    }

    public function getUsers(): UserCollection
    {
        return new UserCollection(User::all());
    }

    public function getUserInfo(string $id): UserResource
    {
        return new UserResource(User::where(['id' => $id])->get());
    }

    public function updateUser(UserDTO $userDTO, string $id): UserResource
    {
        $user = User::where(['id' => $id])->first();
        $user->first_name = $userDTO->getFirstName();
        $user->last_name = $userDTO->getLastName();
        $user->email = $userDTO->getEmail();
        $user->password = Hash::make($userDTO->getPassword());
        $user->save();

        return new UserResource($user);
    }

    public function patchUser(UserDTO $userDTO, string $id): UserResource
    {
        $user = User::where(['id' => $id])->first();
        $user->first_name = $userDTO->getFirstName() ?: $user->first_name;
        $user->last_name = $userDTO->getLastName() ?: $user->last_name;
        $user->email = $userDTO->getEmail() ?: $user->email;
        $user->save();

        return new UserResource($user);
    }

    public function deleteUser(string $id): UserResource
    {
        $user = User::where(['id' => $id])->first();
        $user->delete();

        return new UserResource($user);
    }


}
