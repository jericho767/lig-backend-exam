<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $service)
    {
        $this->postService = $service;
    }

    /**
     * Get the list of posts by page.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->get(intval(request()->get('page'))));
    }
}
