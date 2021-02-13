<?php

namespace App\Http\Resources;

use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
        /** @var Post $post */
        $post = $this->resource;
        /** @var Carbon $createdAt */
        $createdAt = $post->getAttribute('created_at');
        /** @var Carbon $updatedAt */
        $updatedAt = $post->getAttribute('updated_at');
        /** @var Carbon $deletedAt */
        $deletedAt = $post->getAttribute('deleted_at');

        return [
            'id' => $post->getAttribute('id'),
            'user_id' => $post->getAttribute('user_id'),
            'title' => $post->getAttribute('title'),
            'content' => $post->getAttribute('content'),
            'slug' => $post->getAttribute('slug'),
            'created_at' => $createdAt ? $createdAt->format('Y-m-d G:i:s') : null,
            'updated_at' => $updatedAt ? $updatedAt->format('Y-m-d G:i:s') : null,
            'deleted_at' => $deletedAt ? $deletedAt->format('Y-m-d G:i:s') : null,
            'image' => $this->when($post->relationLoaded('image'), function () use ($post) {
                /** @var Image $image */
                $image = $post->getRelation('image');

                if ($image !== null) {
                    return $image->getAttribute('url');
                } else {
                    return null;
                }
            }),
        ];
    }
}
