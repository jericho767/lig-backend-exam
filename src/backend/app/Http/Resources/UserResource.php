<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @noinspection PhpMissingParamTypeInspection
     */
    public function toArray($request): array
    {
        /** @var User $user */
        $user = $this->resource;
        /** @var Carbon $createdAt */
        $createdAt = $user->getAttribute('created_at');
        /** @var Carbon $updatedAt */
        $updatedAt = $user->getAttribute('updated_at');

        return [
            'name' => $user->getAttribute('name'),
            'email' => $user->getAttribute('email'),
            'created_at' => $createdAt->format('Y-m-d G:i:s'),
            'updated_at' => $updatedAt->format('Y-m-d G:i:s'),
            'id' => $user->getAttribute('id'),
        ];
    }
}
