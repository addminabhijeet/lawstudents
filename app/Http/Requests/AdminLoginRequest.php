<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required','string','max:255'],
            'password' => ['required','string','min:6','max:255'],
            'remember' => ['nullable','boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Email or username is required',
            'login.max' => 'Login must not exceed 255 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must not exceed 255 characters',
        ];
    }
}
