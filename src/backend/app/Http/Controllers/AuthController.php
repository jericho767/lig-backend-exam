<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Services\AuthService;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $service)
    {
        $this->authService = $service;
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
        $token = $this->authService->createToken($request->user());
        // Add user to the resulting array
        $token['user'] = $request->user();

        return LoginResource::make($token);
    }

    /**
     * Logs user out.
     */
    public function logout()
    {
        $this->authService->deleteAllUserTokens(request()->user());
    }
}
