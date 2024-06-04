<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "credential" => "required|string",
            "password" => "required|string|min:8|max:64",
        ];
    }

    public function messages()
    {
        return [
            'credential.required' => 'The email or username field is required.',
            'password.required' => 'The password field is required.',
            'password.min'=>'The password must be at least 8 characters.',
            'password.max'=>'The password may not be greater than 64 characters.',
        ];
    }
}
