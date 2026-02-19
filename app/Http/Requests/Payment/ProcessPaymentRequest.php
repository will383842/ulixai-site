<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Vérifie que le payment_intent_id a bien été créé dans la session de l'utilisateur
     * courant (stocké lors du checkout). Empêche qu'un utilisateur confirme un PI
     * appartenant à une autre session.
     */
    public function authorize(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $piId = $this->input('payment_intent_id');

        return session('pending_pi.' . $piId) === auth()->id();
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
