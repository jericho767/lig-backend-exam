<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostRequest;
use App\Http\Requests\SlugPostRequest;
use App\Http\Resources\PostResource;
use App\Services\ImageService;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    private $postService;
    private $imageService;

    public function __construct(PostService $service, ImageService $imageService)
    {
        $this->postService = $service;
        $this->imageService = $imageService;
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

    /**
     * Get the post given the slug.
     *
     * @param SlugPostRequest $request
     * @return PostResource
     */
    public function get(SlugPostRequest $request): PostResource
    {
        return PostResource::make($this->postService->getPost($request->getSlug()));
    }

    /**
     * Create post.
     *
     * @param AddPostRequest $request
     * @return PostResource
     */
    public function create(AddPostRequest $request): PostResource
    {
        // Create the post
        $post = $this->postService->create([
            'title' => $request->getTitle(),
            'content' => $request->getPostContent(),
        ], $request->user());

        // Create the related image
        $this->imageService->createImage([
            'url' => $request->getImageUrl(),
            'imageable_type' => get_class($post),
            'imageable_id' => $post->getAttribute('id'),
        ]);

        // Load image relation of the post
        $post->load('image');

        return PostResource::make($post);
    }
}
