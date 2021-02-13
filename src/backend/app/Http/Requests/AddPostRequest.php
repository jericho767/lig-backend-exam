<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPostRequest extends FormRequest
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
            'title' => [
                'required',
                'max:20',
            ],
            'content' => [
                'required',
                'max:200',
            ],
            'image' => [
                'required',
                'max:200',
            ],
        ];
    }

    /**
     * Getter method for fetching the `title` parameter.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get('title');
    }

    /**
     * Getter method for fetching the `content` parameter.
     *
     * @return string
     */
    public function getPostContent(): string
    {
        return $this->get('content');
    }

    /**
     * Getter method for the uploaded image.
     *
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->get('image');
    }
}
