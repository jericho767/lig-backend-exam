<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                Rule::unique((new User())->getTable(), 'email'),
            ],
            'password' => [
                'required',
                'confirmed',
            ],
            'password_confirmation' => [
                'required',
            ],
        ];
    }

    /**
     * Get the name parameter.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->get('name');
    }

    /**
     * Get the email parameter.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->get('email');
    }

    /**
     * Get the password parameter.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get('password');
    }
}
