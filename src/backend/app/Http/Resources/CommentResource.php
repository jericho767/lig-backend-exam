<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentResource extends BaseResource
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

        return [
            'id' => $comment->getAttribute('id'),
            'title' => null,
            'body' => $comment->getAttribute('body'),
            'commentable_type' => $comment->getAttribute('commentable_type'),
            'commentable_id' => $comment->getAttribute('commentable_id'),
            'creator_id' => $comment->getAttribute('creator_id'),
            'parent_id' => $comment->getAttribute('parent_id'),
            'created_at' => $this->formatDate($comment->getAttribute('created_at')),
            'updated_at' => $this->formatDate($comment->getAttribute('updated_at')),
        ];
    }
}
