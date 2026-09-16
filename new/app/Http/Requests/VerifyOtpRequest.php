<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'otp' => [
                'required',
                'regex:/^[0-9]{6}$/',  // Exactly 6 digits
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'otp.required' => 'OTP is required.',
            'otp.regex' => 'OTP must be exactly 6 digits.',
        ];
    }
}
