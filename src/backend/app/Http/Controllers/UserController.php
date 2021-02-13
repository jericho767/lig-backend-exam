<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    /**
     * Register a user.
     *
     * @param RegisterUserRequest $request
     * @return UserResource
     */
    public function register(RegisterUserRequest $request): UserResource
    {
        return UserResource::make($this->userService->create([
            'email' => $request->getEmail(),
            'name' => $request->getName(),
            'password' => $request->getPassword(),
        ]));
    }

    /**
     * Authenticate login user.
     *
     * @param LoginRequest $request
     * @return LoginResource
     * @throws ValidationException
     */
    public function login(LoginRequest $request): LoginResource
    {
        $request->authenticate();
        // Fetch API token for the authenticated user
        $token = $this->userService->createToken($request->user());
        // Add user to the resulting array
        $token['user'] = $request->user();

        return LoginResource::make($token);
    }

    /**
     * Logs user out.
     */
    public function logout()
    {
        $this->userService->deleteAllUserTokens(request()->user());
    }
}
