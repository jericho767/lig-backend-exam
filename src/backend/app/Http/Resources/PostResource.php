<?php

namespace App\Http\Resources;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;

class PostResource extends BaseResource
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

        return [
            'id' => $post->getAttribute('id'),
            'user_id' => $post->getAttribute('user_id'),
            'title' => $post->getAttribute('title'),
            'content' => $post->getAttribute('content'),
            'slug' => $post->getAttribute('slug'),
            'created_at' => $this->formatDate($post->getAttribute('created_at')),
            'updated_at' => $this->formatDate($post->getAttribute('updated_at')),
            'deleted_at' => $this->formatDate($post->getAttribute('deleted_at')),
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
