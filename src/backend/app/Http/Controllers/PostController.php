<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostRequest;
use App\Http\Requests\ModifyPostRequest;
use App\Http\Requests\SlugPostRequest;
use App\Http\Resources\PostResource;
use App\Services\ImageService;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return PostResource::collection($this->postService->get(intval(request()->get('page'))))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Get the post given the slug.
     *
     * @param SlugPostRequest $request
     * @return JsonResponse
     */
    public function get(SlugPostRequest $request): JsonResponse
    {
        return PostResource::make($this->postService->getPost($request->getSlug()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Create post.
     *
     * @param AddPostRequest $request
     * @return JsonResponse
     */
    public function create(AddPostRequest $request): JsonResponse
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

        return PostResource::make($post)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update a post.
     *
     * @param ModifyPostRequest $request
     * @return JsonResponse
     */
    public function update(ModifyPostRequest $request): JsonResponse
    {
        return PostResource::make($this->postService->updateTitle($request->getSlug(), $request->getTitle()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Delete a post.
     *
     * @param ModifyPostRequest $request
     * @return JsonResponse|null
     * @throws Exception
     */
    public function delete(ModifyPostRequest $request): ?JsonResponse
    {
        if ($this->postService->delete($request->getSlug())) {
            return response()->json(['status' => __('posts.deleted')]);
        }

        return null;
    }
}
