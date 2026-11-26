<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:courses,code',
            'description' => 'nullable|string|max:1000',
            'credits' => 'nullable|integer|min:1',
        ];
    }
}