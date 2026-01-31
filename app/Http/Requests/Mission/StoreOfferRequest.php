<?php

namespace App\Http\Requests\Mission;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only service providers can create offers
        return auth()->check() &&
               auth()->user()->serviceProvider !== null &&
               auth()->user()->status === 'active';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'price' => 'required|numeric|min:10|max:1000000', // Min 10€ pour couvrir les frais de service
            'delivery_time' => 'required|string|max:50',
            'message' => 'required|string|min:10|max:1000',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'price.required' => 'Please specify your price for this service.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price must be at least 10€ to cover service fees.',
            'price.max' => 'Price cannot exceed 1,000,000.',
            'delivery_time.required' => 'Please specify your estimated delivery time.',
            'delivery_time.max' => 'Delivery time description is too long.',
            'message.required' => 'Please include a message with your offer.',
            'message.min' => 'Your message must be at least 10 characters.',
            'message.max' => 'Your message cannot exceed 1000 characters.',
        ];
    }
}
