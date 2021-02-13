<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    /**
     * Create a comment.
     *
     * @param string $body
     * @param Post $post
     * @param User $user
     * @return Comment
     */
    public function create(string $body, Post $post, User $user): Comment
    {
        $comment = new Comment([
            'body' => $body,
            'commentable_type' => Post::class,
            'commentable_id' => $post->getAttribute('id'),
            'creator_id' => $user->getAttribute('id'),
            'parent_id' => null,
        ]);
        $comment->save();

        return $comment;
    }

    /**
     * Get comments of post given the slug of the post.
     *
     * @param string $slug
     * @return Collection
     */
    public function getAllByPost(string $slug): Collection
    {
        return Comment::query()
            ->whereHasMorph('commentable', [Post::class], function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->get();
    }
}
