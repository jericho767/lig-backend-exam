<?php

namespace App\Http\Requests;

class AddCommentRequest extends SlugPostRequest
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
        $rules = parent::rules();

        // Add rules for the current route
        $rules['body'] = [
            'required',
            'max:200',
        ];

        return $rules;
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
