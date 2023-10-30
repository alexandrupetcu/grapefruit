<?php

namespace App\Http\Services;

use App\Exceptions\DatabaseException;
use App\Exceptions\InvalidCredentials;
use App\Http\Dto\UserDTO;
use App\Http\Repository\UserRepository;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {}

    /**
     * @throws InvalidCredentials
     */
    public function authenticateUser(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();
        if (!$user) {
            throw new InvalidCredentials();
        }

        if (Hash::check($password, $user->password)) {
            $createdToken = $user->createToken('authToken');
            return $createdToken->accessToken;
        }

        throw new InvalidCredentials();
    }

    public function registerUser(UserDTO $user): UserResource
    {
        try {
            return $this->userRepository->saveUser($user);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    public function getUsers(): UserCollection
    {
        try {
            return $this->userRepository->getUsers();
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    public function getUserInfo(string $id): UserResource
    {
        try {
            return $this->userRepository->getUserInfo($id);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    public function updateUser(UserDTO $user, string $id): UserResource
    {
        try {
            return $this->userRepository->updateUser($user, $id);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    public function patchUser(UserDTO $user, string $id): UserResource
    {
        try {
            return $this->userRepository->patchUser($user, $id);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }

    public function deleteUser(string $userId): UserResource
    {
        try {
            return $this->userRepository->deleteUser($userId);
        } catch (\Exception $exception) {
            throw new DatabaseException();
        }
    }
}
