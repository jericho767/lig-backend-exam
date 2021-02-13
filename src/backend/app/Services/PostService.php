<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{
    /**
     * Get a collection of Post by page.
     *
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function get(int $page): LengthAwarePaginator
    {
        return Post::query()
            ->with(['image'])
            ->forPage($page)
            ->paginate();
    }

    /**
     * Get a post given a slug.
     *
     * @param string $slug
     * @return Post
     */
    public function getPost(string $slug): Post
    {
        /** @var Post $post */
        $post = Post::query()
            ->with(['image'])
            ->where('slug', $slug)
            ->firstOrFail();

        return $post;
    }
}
