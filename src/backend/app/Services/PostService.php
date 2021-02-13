<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PostService
{
    /**
     * Create a post.
     *
     * @param array $data
     * @param User $user
     * @return Post
     */
    public function create(array $data, User $user): Post
    {
        $post = new Post([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => $this->createSlug($data['title']),
            'user_id' => $user->getAttribute('id'),
        ]);
        $post->save();

        return $post;
    }

    /**
     * Create a slug for a post.
     *
     * @param string $title
     * @return string
     */
    private function createSlug(string $title): string
    {
        $slugBase = Str::slug($title);
        $slug = $slugBase;
        $counter = 1;

        while (Post::query()->where('slug', $slug)->exists()) {
            $slug = $slugBase . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

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
