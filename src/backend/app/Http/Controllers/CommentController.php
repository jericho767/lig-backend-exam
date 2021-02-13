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
use Illuminate\Http\Response;

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
     * @return JsonResponse
     */
    public function byPostSlug(SlugPostRequest $request): JsonResponse
    {
        return CommentResource::collection($this->commentService->getAllByPost($request->getSlug()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Create a comment.
     *
     * @param AddCommentRequest $request
     * @return JsonResponse
     */
    public function create(AddCommentRequest $request): JsonResponse
    {
        return CommentResource::make(
            $this->commentService->create(
                $request->getBody(),
                $this->postService->getPost($request->getSlug()),
                $request->user())
        )
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update a comment.
     *
     * @param ModifyCommentRequest $request
     * @return JsonResponse
     */
    public function update(ModifyCommentRequest $request): JsonResponse
    {
        return CommentResource::make($this->commentService->update($request->getBody(), $request->getId()))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
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
