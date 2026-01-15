<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
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
            'payment_intent_id' => 'required|string|starts_with:pi_',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'payment_intent_id.required' => 'Payment intent ID is required.',
            'payment_intent_id.string' => 'Payment intent ID must be a string.',
            'payment_intent_id.starts_with' => 'Invalid payment intent ID format.',
        ];
    }
}
