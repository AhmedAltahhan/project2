<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'course' => ['nullable', 'exists:courses,id'],
            'name' => ['required_without:course'],
            'package_id' => ['required_without:course','exists:packages,id'],
            'course_id' => ['nullable'],
            'image' => ['nullable', 'image'],
        ];
    }
}
