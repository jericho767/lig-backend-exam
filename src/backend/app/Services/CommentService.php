<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
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
