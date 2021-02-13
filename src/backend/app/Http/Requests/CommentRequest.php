<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Validation\Rule;

class CommentRequest extends GetPostRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'slug' => [
                'required',
                Rule::exists((new Post())->getTable(), 'slug'),
            ],
            'body' => [
                'required',
                'max:200',
            ],
        ];
    }

    /**
     * Get the body parameter.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->get('body');
    }
}
