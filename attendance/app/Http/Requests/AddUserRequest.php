<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'username' => 'required|string|max:100|unique:users,username|regex:/^[^\s-]+$/',
            'firstname' => 'required|string|max:100|regex:/^[\pL\s]+$/u',
            'lastname' => 'required|string|max:100|regex:/^[\pL\s]+$/u',
            'email' => 'required|string|max:150|unique:users,email',
            'dob' => 'required|date',
            'gender' => 'required|boolean',
            'password' => 'required|string|min:8|max:64|regex:/^[^\s-]+$/',
        ];
    }

    public function messages(): array
    {
        return [

            'role.required' => 'The role field is required.',
            'role.int' => 'The role must be an integer.',

            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a string.',
            'username.max' => 'The username may not be greater than 100 characters.',
            'username.unique' => 'The username has already been taken.',
            'username.regex' => 'The username is not valid to create a new user',

            'firstname.required' => 'The first name field is required.',
            'firstname.string' => 'The first name must be a string.',
            'firstname.max' => 'The first name may not be greater than 100 characters.',
            'firstname.regex' => 'Your first name contains invalid characters',

            'lastname.required' => 'The last name field is required.',
            'lastname.string' => 'The last name must be a string.',
            'lastname.max' => 'The last name may not be greater than 100 characters.',
            'lastname.regex' => 'Your last name contains invalid characters',

            'email.required' => 'The email field is required.',
            'email.string' => 'The email must be a string.',
            'email.max' => 'The email may not be greater than 150 characters.',

            'dob.required' => 'The date of birth field is required.',
            'dob.date' => 'The date of birth must be a valid date.',

            'gender.required' => 'The gender field is required.',
            'gender.boolean' => 'The gender must be a boolean value.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 64 characters.',
            'password.regex' => 'The password is not valid to create a new user',
        ];
    }
}
