<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['required','confirmed','min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }
}
