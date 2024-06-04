<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "firstname"=>'required|string|max:150',
            "lastname"=>'required|string|max:150',
            "dob"=>'required|date',
            "gender"=>'required|boolean',
            "email"=>'required|email|unique:students,email',
            "telephone"=>'required|integer|digits:10|unique:students,telephone',
            "user_id"=>'required|exists:users,id',
        ];
    }
}
