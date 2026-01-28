<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Mission;
use App\Models\MissionOffer;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // ✅ SÉCURITÉ: Vérifie que l'utilisateur est authentifié et actif
        if (!auth()->check() || auth()->user()->status !== 'active') {
            return false;
        }

        // ✅ SÉCURITÉ: Vérifie que l'utilisateur est propriétaire de la mission
        $mission = Mission::find($this->mission_id);
        if (!$mission || $mission->requester_id !== auth()->id()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mission_id' => 'required|exists:missions,id',
            'provider_id' => 'required|exists:service_providers,id',
            'offer_id' => [
                'required',
                'exists:mission_offers,id',
                // ✅ SÉCURITÉ: Vérifie que l'offre appartient à la mission et au provider
                function ($attribute, $value, $fail) {
                    $offer = MissionOffer::find($value);
                    if (!$offer) {
                        $fail('The selected offer does not exist.');
                        return;
                    }
                    if ($offer->mission_id != $this->mission_id) {
                        $fail('The offer does not belong to this mission.');
                    }
                    if ($offer->provider_id != $this->provider_id) {
                        $fail('The offer does not belong to this provider.');
                    }
                    if ($offer->status !== 'pending') {
                        $fail('This offer is no longer available.');
                    }
                },
            ],
            // ✅ SÉCURITÉ: Limite de montant max à 100 000€
            'amount' => 'required|numeric|min:0.01|max:100000',
            'client_fee' => 'required|numeric|min:0|max:10000',
            'total' => [
                'required',
                'numeric',
                'min:0.01',
                'max:110000', // amount + max client_fee
                // ✅ SÉCURITÉ: Vérifie que total = amount + client_fee (tolérance 1 centime)
                function ($attribute, $value, $fail) {
                    $expectedTotal = (float) $this->amount + (float) $this->client_fee;
                    if (abs((float) $value - $expectedTotal) > 0.01) {
                        $fail('The total amount does not match amount + fees.');
                    }
                },
            ],
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
            'amount.min' => 'Amount must be at least 0.01€.',
            'amount.max' => 'Amount cannot exceed 100,000€.',
            'client_fee.max' => 'Client fee cannot exceed 10,000€.',
            'total.required' => 'Total amount is required.',
            'total.max' => 'Total amount cannot exceed 110,000€.',
        ];
    }
}
