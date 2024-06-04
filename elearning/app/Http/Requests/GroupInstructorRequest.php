<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupInstructorRequest extends FormRequest
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
            "instructor_id" => ["required", "exists:users,id"],
            "group_id" => [
                "required", "exists:groups,id",
                Rule::unique("group_instructor")->where(function ($query) {
                    return $query->where("instructor_id", $this->instructor_id)
                        ->where("group_id", $this->group_id);
                }),
            ],
        ];
    }
}
