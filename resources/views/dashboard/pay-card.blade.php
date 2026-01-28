@extends('dashboard.layouts.master')

@section('title', 'Payment - ' . $mission->title)

@php
    $currencySymbol = $currency === 'USD' ? '$' : '€';
    $formatAmount = function($value) use ($currency, $currencySymbol) {
        if ($currency === 'USD') {
            return $currencySymbol . number_format($value, 2, '.', ',');
        }
        return number_format($value, 2, ',', ' ') . ' ' . $currencySymbol;
    };
@endphp

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Complete Payment</h1>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">{{ $mission->title }}</h3>
                <p class="text-sm text-gray-600 mt-1">Service Provider: {{ $provider->first_name }} {{ $provider->last_name }}</p>
                <div class="mt-3 space-y-1">
                    <div class="flex justify-between">
                        <span class="text-sm">Mission Amount:</span>
                        <span class="text-sm">{{ $formatAmount($amount) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm">Service Fee:</span>
                        <span class="text-sm">{{ $formatAmount($clientFee) }}</span>
                    </div>
                    <div class="flex justify-between font-semibold border-t pt-1">
                        <span>Total:</span>
                        <span>{{ $formatAmount($total) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <form id="payment-form" class="space-y-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="card-element" class="block text-sm font-medium text-gray-700 mb-2">
                        Card Information
                    </label>
                    <div id="card-element" class="p-3 border border-gray-300 rounded-md">
                        <!-- Stripe Elements will create form elements here -->
                    </div>
                    <div id="card-errors" role="alert" class="text-red-600 text-sm mt-2"></div>
                </div>

                <div>
                    <label for="cardholder-name" class="block text-sm font-medium text-gray-700 mb-2">
                        Cardholder Name
                    </label>
                    <input type="text" id="cardholder-name" name="cardholder_name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="John Doe">
                </div>
            </div>

            <button type="submit" id="submit-button" 
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                <span id="button-text">Pay {{ $formatAmount($total) }}</span>
                <span id="spinner" class="hidden">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
            </button>
        </form>

        <div class="mt-4 text-center bg-red-500 p-3 rounded-md">
            <a href="{{ route('quote-offer', ['id'=> $mission->id ]) }}" class="text-white hover:text-gray-800">
                Cancel and return to mission
            </a>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    const elements = stripe.elements();
    
    // Create card element
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#424770',
                '::placeholder': {
                    color: '#aab7c4',
                },
            },
            invalid: {
                color: '#9e2146',
            },
        },
        hidePostalCode: true,
    });
    
    cardElement.mount('#card-element');
    
    // Handle real-time validation errors from the card Element
    cardElement.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    
    // Handle form submission
    const form = document.getElementById('payment-form');
    const submitButton = document.getElementById('submit-button');
    const buttonText = document.getElementById('button-text');
    const spinner = document.getElementById('spinner');
    
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        
        // Disable the submit button and show spinner
        submitButton.disabled = true;
        buttonText.classList.add('hidden');
        spinner.classList.remove('hidden');
        
        const cardholderName = document.getElementById('cardholder-name').value;
        
        const {error, paymentIntent} = await stripe.confirmCardPayment('{{ $clientSecret }}', {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: cardholderName,
                }
            }
        });
        
        if (error) {
            // Show error to customer
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            
            // Re-enable the submit button
            submitButton.disabled = false;
            buttonText.classList.remove('hidden');
            spinner.classList.add('hidden');
        } else {
            // Payment succeeded
            fetch('{{ route('payments.stripe.process') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
                },
                body: JSON.stringify({
                    payment_intent_id: paymentIntent.id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect_url;
                } else {
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = data.error || 'Payment processing failed';
                    
                    // Re-enable the submit button
                    submitButton.disabled = false;
                    buttonText.classList.remove('hidden');
                    spinner.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = 'An unexpected error occurred';
                
                // Re-enable the submit button
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                spinner.classList.add('hidden');
            });
        }
    });
});
</script>
@endsection