<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'email'         => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password'      => 'required|string|min:6|max:255|confirmed',
            'profile_image' => 'nullable|image|mimes:png,jpg|max:2024',
            'roles'         => 'nullable|array|min:1',
            'roles.*'       => 'required|string|exists:roles,name',
            'update_slug'   => 'nullable|boolean'
        ];
    }
}
