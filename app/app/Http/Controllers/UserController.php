<?php

namespace App\Http\Controllers;

use App\Http\Dto\UserDTO;
use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\PatchUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\RateLimiter;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService){}

    public function authenticateUser(AuthenticationRequest $request): Response
    {
        try {
            $token = $this->userService->authenticateUser(
                $request->get('email'),
                $request->get('password')
            );

            return new Response(['token' => $token]);
        } catch (\Exception $exception) {
            RateLimiter::hit('authentication-request:'.$request->ip());

            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode() ?? 401
            );
        }
    }

    public function index(): Response
    {
        return new Response($this->userService->getUsers());
    }

    public function store(UserRequest $request): Response
    {
        try {
            return new Response($this->userService->registerUser(
                $this->requestToUserDTO($request)
            ));
        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }
    }

    public function show(string $userId): Response
    {
        return new Response($this->userService->getUserInfo($userId));
    }

    public function update(UpdateUserRequest $request, User $userId)
    {
        try {
            return new Response($this->userService->updateUser(
                $this->requestToUserDTO($request),
                $userId
            ));

        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }
    }

    public function patch(PatchUserRequest $request, string $userId): Response
    {
        try {
            return new Response($this->userService->patchUser(
                $this->requestToUserDTO($request),
                $userId
            ));

        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }
    }

    public function destroy($userId): Response
    {
        try {
            return new Response($this->userService->deleteUser($userId));
        } catch (\Exception $exception) {
            return new Response(
                ['error' => $exception->getMessage()],
                $exception->getCode()
            );
        }

    }

    private function requestToUserDTO(Request $request): UserDTO
    {
        return new UserDTO(
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $request->get('password')
        );
    }
}
