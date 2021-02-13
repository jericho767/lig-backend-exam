<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
