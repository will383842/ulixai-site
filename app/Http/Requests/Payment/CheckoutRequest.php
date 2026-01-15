<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->status === 'active';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mission_id' => 'required|exists:missions,id',
            'provider_id' => 'required|exists:service_providers,id',
            'offer_id' => 'required|exists:mission_offers,id',
            'amount' => 'required|numeric|min:0',
            'client_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'remaining_credits' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'mission_id.required' => 'Mission is required.',
            'mission_id.exists' => 'The selected mission does not exist.',
            'provider_id.required' => 'Provider is required.',
            'provider_id.exists' => 'The selected provider does not exist.',
            'offer_id.required' => 'Offer is required.',
            'offer_id.exists' => 'The selected offer does not exist.',
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Amount cannot be negative.',
            'total.required' => 'Total amount is required.',
        ];
    }
}
