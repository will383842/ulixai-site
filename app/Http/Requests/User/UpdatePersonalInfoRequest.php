<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonalInfoRequest extends FormRequest
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
        $userId = auth()->id();

        $rules = [
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date|before:today',
            'gender' => 'nullable|in:Male,Female',
            'address' => 'nullable|string|max:500',
            'country' => 'nullable|string|max:255',
            'preferred_language' => 'nullable|string|max:255',
            'preferred_currency' => 'nullable|in:EUR,USD',
            'whatsapp_number' => 'nullable|string|max:20',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
        ];

        // Add service provider specific validation
        if (auth()->user()->user_role === 'service_provider') {
            $rules['provider_native_language'] = 'nullable|string|max:255';
            $rules['spoken_languages'] = 'nullable|array';
            $rules['spoken_languages.*'] = 'string|max:255';
        } else {
            $rules['spoken_languages_text'] = 'nullable|string|max:500';
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Your name is required.',
            'name.max' => 'Name cannot exceed 255 characters.',
            'dob.date' => 'Please provide a valid date of birth.',
            'dob.before' => 'Date of birth must be in the past.',
            'gender.in' => 'Please select a valid gender.',
            'address.max' => 'Address cannot exceed 500 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'whatsapp_number.max' => 'Phone number cannot exceed 20 characters.',
        ];
    }
}
