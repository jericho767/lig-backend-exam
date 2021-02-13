<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;

class UserResource extends BaseResource
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

        return [
            'name' => $user->getAttribute('name'),
            'email' => $user->getAttribute('email'),
            'created_at' => $this->formatDate($user->getAttribute('created_at')),
            'updated_at' => $this->formatDate($user->getAttribute('updated_at')),
            'id' => $user->getAttribute('id'),
        ];
    }
}
