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
            ->forPage($page)
            ->paginate();
    }
}
