<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',      // At least one uppercase
                'regex:/[a-z]/',      // At least one lowercase
                'regex:/[0-9]/',      // At least one number
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ];
    }
}
