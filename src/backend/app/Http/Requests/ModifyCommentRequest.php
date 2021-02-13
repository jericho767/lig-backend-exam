<?php

namespace App\Http\Requests;

use App\Models\Comment;
use App\Models\User;
use App\Services\CommentService;
use Illuminate\Validation\Rule;

class ModifyCommentRequest extends AddCommentRequest
{
    private $commentService;

    public function __construct(
        CommentService $service,
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null
    )
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->commentService = $service;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $comment = $this->commentService->getCommentById(intval($this->route('id')));

        if ($comment) {
            /** @var User $user */
            $user = $this->user();

            // Can modify comment only if the user is the owner of the comment
            return $user->getAttribute('id') === $comment->getAttribute('creator_id');
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = parent::rules();
        // Add rules for the current route
        $rules['id'] = [
            Rule::exists((new Comment())->getTable(), 'id'),
        ];

        if ($this->route()->getActionMethod() === 'delete') {
            // No need for checking of the body if the method is delete.
            unset($rules['body']);
        }

        return $rules;
    }

    /**
     * Get the ID of the comment.
     *
     * @return int
     */
    public function getId(): int
    {
        return intval($this->route('id'));
    }
}
