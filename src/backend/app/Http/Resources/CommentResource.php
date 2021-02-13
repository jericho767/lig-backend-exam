<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
        /** @var Comment $comment */
        $comment = $this->resource;
        /** @var Carbon $createdAt */
        $createdAt = $comment->getAttribute('created_at');
        /** @var Carbon $updatedAt */
        $updatedAt = $comment->getAttribute('updated_at');

        return [
            'id' => $comment->getAttribute('id'),
            // This part I need to understand this why is this here
            'title' => null,
            'body' => $comment->getAttribute('body'),
            'commentable_type' => $comment->getAttribute('commentable_type'),
            'commentable_id' => $comment->getAttribute('commentable_id'),
            'creator_id' => $comment->getAttribute('creator_id'),
            'parent_id' => $comment->getAttribute('parent_id'),
            'created_at' => $createdAt->format('Y-m-d G:i:s'),
            'updated_at' => $updatedAt->format('Y-m-d G:i:s'),
        ];
    }
}
