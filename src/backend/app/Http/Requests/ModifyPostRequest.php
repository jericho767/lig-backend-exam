<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Services\PostService;

class ModifyPostRequest extends SlugPostRequest
{
    private $postService;

    public function __construct(
        PostService $postService,
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
        $this->postService = $postService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $post = $this->postService->getPost($this->route('slug'));

        if ($post !== null) {
            /** @var User $user */
            $user = $this->user();

            return $post->getAttribute('user_id') === $user->getAttribute('id');
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
        return array_merge(
            ['title' => AddPostRequest::POST_RULES['title']],
            parent::rules()
        );
    }

    /**
     * Get the title parameter.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get('title');
    }
}
