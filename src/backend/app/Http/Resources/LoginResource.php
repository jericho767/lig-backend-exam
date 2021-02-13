<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @noinspection PhpMissingParamTypeInspection
     */
    public function toArray($request): array
    {
        /** @var Carbon $expiresAt */
        $expiresAt = $this->resource['expires_at'];

        return [
            'token' => $this->resource['token'],
            'expires_at' => $expiresAt !== null ? $expiresAt->format('Y-m-d G:i:s') : null,
            // Token type is always bearer
            'token_type' => 'bearer',
            // The user in the resource is not returned
        ];
    }
}
