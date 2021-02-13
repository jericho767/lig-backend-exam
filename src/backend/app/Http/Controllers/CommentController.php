<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPostRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $service)
    {
        $this->commentService = $service;
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
}
