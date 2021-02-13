<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\SlugPostRequest;
use App\Http\Requests\ModifyCommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;
use App\Services\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
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
     * @param SlugPostRequest $request
     * @return AnonymousResourceCollection
     */
    public function byPostSlug(SlugPostRequest $request): AnonymousResourceCollection
    {
        return CommentResource::collection($this->commentService->getAllByPost($request->getSlug()));
    }

    /**
     * Create a comment.
     *
     * @param AddCommentRequest $request
     * @return CommentResource
     */
    public function create(AddCommentRequest $request): CommentResource
    {
        return CommentResource::make(
            $this->commentService->create(
                $request->getBody(),
                $this->postService->getPost($request->getSlug()),
                $request->user())
        );
    }

    /**
     * Update a comment.
     *
     * @param ModifyCommentRequest $request
     * @return CommentResource
     */
    public function update(ModifyCommentRequest $request): CommentResource
    {
        return CommentResource::make($this->commentService->update($request->getBody(), $request->getId()));
    }

    /**
     * Delete a comment.
     *
     * @param ModifyCommentRequest $request
     * @return JsonResponse|null
     * @throws Exception
     */
    public function delete(ModifyCommentRequest $request): ?JsonResponse
    {
        if ($this->commentService->delete($request->getId())) {
            return response()->json(['status' => __('comments.deleted')]);
        }

        return null;
    }
}
