<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class SlugPostRequest extends FormRequest
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
            ]
        ];
    }

    /**
     * Get the slug route parameter.
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->route('slug');
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'slug.exists' => __('posts.slug.invalid'),
        ];
    }

    /**
     * Method override to add slug route parameter.
     *
     * @param null $keys
     * @return array|null
     */
    public function all($keys = null): ?array
    {
        $input = array_replace_recursive($this->input(), $this->allFiles());

        // Add slug route parameter
        $input['slug'] = $this->route('slug');

        if (!$keys) {
            return $input;
        }

        $results = [];

        foreach (is_array($keys) ? $keys : func_get_args() as $key) {
            Arr::set($results, $key, Arr::get($input, $key));
        }

        // Add slug route parameter
        $results['slug'] = $this->route('slug');

        return $results;
    }
}
