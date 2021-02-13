<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\GetPostRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    private $commentService;
    private $postService;

    public function __construct(CommentService $service, PostService $postService)
    {
        $this->commentService = $service;
        $this->postService = $postService;
    }

    /**
     * Get the comments of a post given a slug.
     *
     * @param GetPostRequest $request
     * @return AnonymousResourceCollection
     */
    public function byPostSlug(GetPostRequest $request): AnonymousResourceCollection
    {
        return CommentResource::collection($this->commentService->getAllByPost($request->getSlug()));
    }

    /**
     * Create a comment.
     *
     * @param CommentRequest $request
     * @return CommentResource
     */
    public function comment(CommentRequest $request): CommentResource
    {
        return CommentResource::make(
            $this->commentService->create(
                $request->getBody(),
                $this->postService->getPost($request->getSlug()),
                $request->user())
        );
    }
}
