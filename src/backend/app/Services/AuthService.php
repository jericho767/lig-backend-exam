<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;

class AuthService
{
    /**
     * Create user.
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Mark email as verified
        $user->markEmailAsVerified();

        $user->save();

        return $user;
    }

    /**
     * Deletes all the user's tokens.
     *
     * @param User $user
     */
    public function deleteAllUserTokens(User $user)
    {
        $user->tokens()->delete();
    }

    /**
     * Create a token for the user and returns it with the expiration date.
     *
     * @param User $user
     * @return array
     */
    public function createToken(User $user): array
    {
        $token = $user->createToken($this->createTokenName($user));

        return [
            'token' => $token->plainTextToken,
            'expires_at' => $this->getTokenExpiry($token),
        ];
    }

    /**
     * Get the expiration date of the token. Null if no expiry.
     *
     * @param NewAccessToken $accessToken
     * @return Carbon|null
     */
    private function getTokenExpiry(NewAccessToken $accessToken): ?Carbon
    {
        $expiration = config('sanctum.expiration');

        if ($expiration === null) {
            return null;
        } else {
            /** @var Carbon $tokenCreatedAt */
            $tokenCreatedAt = $accessToken->accessToken->getAttribute('created_at');

            return $tokenCreatedAt->addMinutes($expiration);
        }
    }

    /**
     * Creates a token name.
     *
     * @param User $user
     * @return string
     */
    private function createTokenName(User $user): string
    {
        return $user->getAttribute('id') . '-' . Carbon::now()->timestamp;
    }
}
