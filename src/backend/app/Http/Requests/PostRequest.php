<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
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
                'file',
                'size:5000' // 5mb
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
     * @return UploadedFile|null
     */
    public function getUploadedImage(): ?UploadedFile
    {
        return $this->file('image');
    }
}
