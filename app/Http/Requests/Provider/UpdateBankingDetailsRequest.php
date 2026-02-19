<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankingDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Seuls les service_providers peuvent mettre à jour leurs coordonnées bancaires.
     * La mise à jour porte toujours sur le compte de l'utilisateur authentifié (pas de user_id externe).
     */
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user !== null && $user->user_role === 'service_provider';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'bank_account_holder' => 'required|string|max:255',
            'bank_account_iban' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{4,30}$/i',
            ],
            'bank_swift_bic' => [
                'required',
                'string',
                'max:11',
                'regex:/^[A-Z]{4}[A-Z]{2}[A-Z0-9]{2}([A-Z0-9]{3})?$/i',
            ],
            'bank_name' => 'required|string|max:255',
            'account_country' => 'required|string|exists:countries,short_name',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'bank_account_holder.required' => 'Account holder name is required.',
            'bank_account_holder.max' => 'Account holder name cannot exceed 255 characters.',
            'bank_account_iban.required' => 'IBAN is required.',
            'bank_account_iban.regex' => 'Please enter a valid IBAN.',
            'bank_swift_bic.required' => 'SWIFT/BIC code is required.',
            'bank_swift_bic.regex' => 'Please enter a valid SWIFT/BIC code.',
            'bank_name.required' => 'Bank name is required.',
            'account_country.required' => 'Account country is required.',
            'account_country.exists' => 'Please select a valid country.',
        ];
    }
}
