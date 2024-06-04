<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRolesRequest extends FormRequest
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
            "user_id" => "required|exists:users,id",
            "role_id" => [
                'required',
                'exists:roles,id',
                Rule::unique('user_roles')->where(function ($query) {
                    return $query->where('user_id', $this->user_id)
                        ->where('role_id', $this->role_id);
                }),
            ],
        ];
    }
}
