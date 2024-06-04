<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupStudentRequest extends FormRequest
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
            "student_id" => ["required","exist:student,id"],
            "group_id" => ["required","exist:group,id",
                Rule::unique('group_student')->where(function ($query) {
                    $query->where('student_id',$this->student_id)
                        ->where('group_id',$this->group_id);
                })],
        ];
    }
}
