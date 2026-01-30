@extends('dashboard.layouts.master')

@section('title', 'Payments')

@section('content')
    <!-- Main Content -->

     @php
        // Platform fee (client-side, e.g., 5%)
        $clientFeePercent = config('ulixai.fees.client', 5);
        $providerFeePercent = config('ulixai.fees.provider', 15);
        $commissions = \App\Models\UlixCommission::where('is_active', true)->first();
        $missionAmount = $offer->price ?? 0;
        $clientFee = $clientFee ?? 0;
        $total = $missionAmount + $clientFee;

        // Determine currency symbol based on mission budget_currency
        $currencyCode = $mission->budget_currency ?? 'EUR';
        $currencySymbols = [
            'EUR' => '€',
            'USD' => '$',
            'GBP' => '£',
            'CHF' => 'CHF',
            'CAD' => 'CA$',
            'AUD' => 'A$',
            'JPY' => '¥',
            'CNY' => '¥',
            'INR' => '₹',
            'BRL' => 'R$',
            'MXN' => 'MX$',
            'XOF' => 'CFA',
            'XAF' => 'CFA',
            'MAD' => 'DH',
            'TND' => 'DT',
            'DZD' => 'DA',
        ];
        $currencySymbol = $currencySymbols[$currencyCode] ?? $currencyCode;

        // ✅ Calculer les frais prestataire avec le minimum appliqué
        $calculatedProviderFee = $commissions->provider_fee * $missionAmount;
        $minimumServiceFee = config('currencies.minimum_service_fee.' . $currencyCode, 10);
        $providerFee = max($calculatedProviderFee, $minimumServiceFee);
        $isMinimumApplied = $calculatedProviderFee < $minimumServiceFee;
        $netToProvider = $missionAmount - $providerFee;
      @endphp
    <div class="flex-1 p-4 sm:p-6 lg:p-8">
      <h1 class="text-xl sm:text-2xl font-bold mb-6 sm:mb-8 text-center lg:text-left">
        I VALIDATE {{ $provider->first_name ?? 'Provider' }}
      </h1>

      <div class="flex flex-col lg:flex-row gap-6 justify-center items-start">
        <!-- Order Summary -->
        <div class="w-full max-w-md bg-white rounded-lg p-6 mx-auto lg:mx-0">
          <div class="flex items-center mb-6">
            <img src="{{ $provider->profile_photo ? asset($provider->profile_photo) : 'https://randomuser.me/api/portraits/men/75.jpg' }}" alt="Profile Photo" class="w-16 h-16 rounded-full object-cover mr-4 border border-gray-300" />

            <div class="flex-1">
              <div class="flex items-center mb-2">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="text-sm font-medium">Profile verified</span>
              </div>
              <div class="flex items-center">
                <i class="fas fa-star text-yellow-400 mr-1"></i>
                <span class="text-sm">{{ $reviews  ?? '5.0' }} / 5</span>
              </div>
            </div>
            <div class="text-right">
              <i class="fas fa-file-alt text-blue-500 text-2xl"></i>
            </div>
          </div>
          <div class="text-center mb-6">
            <div class="text-sm text-gray-600 mb-1">Expected delivery</div>
            <div class="font-semibold">{{ $offer->delivery_time ?? '-' }} Days</div>
          </div>

          <div class="border-t pt-4 space-y-3">
            <div class="flex justify-between">
              <span class="text-sm">{{ $provider->first_name ?? 'Provider' }}</span>
              <span class="text-sm">{{ number_format($missionAmount, 2) }} {{ $currencySymbol }}</span>
            </div>
         <div class="flex justify-between items-center">
          <div class="flex items-center space-x-1 relative">
            <span class="text-sm">Service fees</span>
            
            <!-- Info icon with hover percentage -->
            <div class="relative group">
              <i class="fas fa-info-circle text-gray-400 cursor-pointer"></i>
              <div class="absolute left-1/2 -translate-x-1/2 top-full mt-1 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 shadow whitespace-nowrap">
                {{ $clientFeePercent }}%
              </div>
            </div>
          </div>

          <span class="text-sm">{{ number_format($clientFee, 2) }} {{ $currencySymbol }}</span>
        </div>

        <div class="border-t pt-3 flex justify-between font-semibold">
          <span>TOTAL</span>
          <span>{{ number_format($total, 2) }} {{ $currencySymbol }}</span>
        </div>
        <div class="flex justify-between text-xs text-gray-500 pt-2">
          {{-- <span>Provider receives (after {{ $providerFeePercent }}% fee):</span> --}}
          {{-- <span>{{ number_format($netToProvider, 2) }} €</span> --}}
        </div>
        {{-- ✅ Sélecteur de méthode de paiement --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Payment Method') }}</label>
            <div class="space-y-2" id="paymentMethodSelector">
              {{-- Stripe Option --}}
              @if($isStripeAvailable ?? true)
              <label class="flex items-center p-3 border rounded-lg cursor-pointer transition hover:bg-gray-50 {{ ($recommendedGateway ?? 'stripe') === 'stripe' ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}"
                     id="stripeOptionLabel">
                <input type="radio" name="payment_gateway" value="stripe"
                       class="form-radio text-blue-600"
                       {{ ($recommendedGateway ?? 'stripe') === 'stripe' ? 'checked' : '' }}
                       onchange="updatePaymentMethod('stripe')">
                <div class="ml-3 flex-1">
                  <div class="flex items-center">
                    <svg class="w-8 h-8 mr-2" viewBox="0 0 60 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M59.64 12.5C59.64 8.28 56.16 6.36 52.13 6.36C48.1 6.36 44.63 8.28 44.63 12.15C44.63 16.02 48.1 17.33 51.19 17.33C52.89 17.33 55.53 16.79 57.54 14.9L55.27 12.88C54.34 13.83 52.69 14.28 51.41 14.28C49.77 14.28 48.45 13.71 48.09 12.11H59.58C59.62 11.73 59.64 11.12 59.64 12.5ZM48.12 9.82C48.51 8.46 49.71 7.82 51.17 7.82C52.63 7.82 53.78 8.44 54.2 9.82H48.12ZM39.8 17.19H43.69V6.58H39.8V17.19ZM39.8 5.2H43.69V2H39.8V5.2ZM34.4 9.07C35.56 9.07 36.42 9.46 37.13 10.24L39.41 8.18C38.18 6.78 36.54 6.36 34.61 6.36C30.74 6.36 27.47 8.66 27.47 11.9C27.47 15.14 30.74 17.33 34.49 17.33C36.51 17.33 38.17 16.87 39.41 15.54L37.13 13.51C36.42 14.29 35.54 14.64 34.4 14.64C32.48 14.64 31.22 13.49 31.22 11.9C31.22 10.31 32.48 9.07 34.4 9.07ZM22.99 6.58V7.34C22.12 6.66 21.01 6.36 19.69 6.36C16.15 6.36 13.38 8.78 13.38 11.9C13.38 15.02 16.15 17.33 19.69 17.33C21.01 17.33 22.12 17.03 22.99 16.35V17.19H26.89V6.58H22.99ZM20.25 14.28C18.41 14.28 17.17 13.21 17.17 11.9C17.17 10.59 18.41 9.52 20.25 9.52C22.09 9.52 23.33 10.59 23.33 11.9C23.33 13.21 22.09 14.28 20.25 14.28ZM8.58 17.19H12.54V0H8.58V17.19ZM0.36 17.19H4.32V0H0.36V17.19Z" fill="#635BFF"/>
                    </svg>
                    <span class="font-medium">Stripe</span>
                    @if(($recommendedGateway ?? 'stripe') === 'stripe')
                      <span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">{{ __('Recommended') }}</span>
                    @endif
                  </div>
                  <p class="text-xs text-gray-500 mt-1">{{ __('Credit card, Apple Pay, Google Pay') }}</p>
                </div>
              </label>
              @endif

              {{-- PayPal Option --}}
              @if($isPayPalAvailable ?? false)
              <label class="flex items-center p-3 border rounded-lg cursor-pointer transition hover:bg-gray-50 {{ ($recommendedGateway ?? 'stripe') === 'paypal' ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}"
                     id="paypalOptionLabel">
                <input type="radio" name="payment_gateway" value="paypal"
                       class="form-radio text-blue-600"
                       {{ ($recommendedGateway ?? 'stripe') === 'paypal' ? 'checked' : '' }}
                       onchange="updatePaymentMethod('paypal')">
                <div class="ml-3 flex-1">
                  <div class="flex items-center">
                    <svg class="w-8 h-8 mr-2" viewBox="0 0 101 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12.237 6.954h8.183c2.727 0 5.136.898 6.177 3.618 1.115 2.935.114 5.962-2.162 7.826-2.048 1.678-4.682 2.236-7.295 2.236h-1.954c-.57 0-1.056.414-1.145.974l-.87 5.52c-.089.56-.575.974-1.145.974H8.354c-.476 0-.828-.431-.74-.898L11.09 7.852c.089-.56.575-.974 1.147-.974" fill="#009cde"/>
                      <path d="M39.43 6.954h8.182c2.727 0 5.137.898 6.178 3.618 1.115 2.935.113 5.962-2.163 7.826-2.048 1.678-4.681 2.236-7.294 2.236h-1.954c-.57 0-1.057.414-1.146.974l-.87 5.52c-.088.56-.574.974-1.144.974h-3.672c-.476 0-.828-.431-.74-.898l3.476-19.352c.089-.56.575-.974 1.147-.974" fill="#012169"/>
                      <path d="M22.19 4.536L18.707 24H14.12l1.59-8.953c.089-.56-.264-.99-.74-.99H12.06l1.867-9.521h8.263z" fill="#003087"/>
                    </svg>
                    <span class="font-medium">PayPal</span>
                    @if(($recommendedGateway ?? 'stripe') === 'paypal')
                      <span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">{{ __('Recommended') }}</span>
                    @endif
                  </div>
                  <p class="text-xs text-gray-500 mt-1">{{ __('PayPal balance, credit card via PayPal') }}</p>
                </div>
              </label>
              @endif
            </div>
          </div>

          {{-- ✅ Formulaire Stripe --}}
          <form id="stripeCheckoutForm" method="POST" action="{{ route('payments.stripe.checkout') }}" class="{{ ($recommendedGateway ?? 'stripe') !== 'stripe' ? 'hidden' : '' }}">
            @csrf
            <input type="hidden" name="mission_id" value="{{ $offer->mission_id }}">
            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
            <input type="hidden" name="amount" value="{{ $missionAmount }}">
            <input type="hidden" name="client_fee" value="{{ $clientFee }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="remaining_credits" value="{{ $remainingCreditBalance }}">
            <button type="submit" class="w-full bg-blue-500 text-white rounded-lg py-2.5 text-sm font-semibold hover:bg-blue-600 transition">
              <i class="fas fa-lock mr-2"></i>
              RESERVE FOR {{ number_format($total, 2) }} {{ $currencySymbol }}
            </button>
          </form>

          {{-- ✅ Formulaire PayPal --}}
          @if($isPayPalAvailable ?? false)
          <div id="paypalCheckoutContainer" class="{{ ($recommendedGateway ?? 'stripe') !== 'paypal' ? 'hidden' : '' }}">
            <button type="button" id="paypalCheckoutBtn" onclick="initiatePayPalCheckout()" class="w-full bg-yellow-400 text-blue-900 rounded-lg py-2.5 text-sm font-semibold hover:bg-yellow-500 transition">
              <i class="fab fa-paypal mr-2"></i>
              RESERVE FOR {{ number_format($total, 2) }} {{ $currencySymbol }}
            </button>
            <div id="paypalLoading" class="hidden text-center py-2">
              <i class="fas fa-spinner fa-spin mr-2"></i>
              {{ __('Redirecting to PayPal...') }}
            </div>
            <div id="paypalError" class="hidden mt-2 p-2 bg-red-100 text-red-700 text-sm rounded"></div>
          </div>
          @endif

          <p class="text-xs text-gray-500 text-center mt-3">
            {{ __('This is a prepayment held in escrow. Payment will only be released to the service provider after the mission is completed.') }}
          </p>

          {{-- ✅ Information sur les frais de service minimum --}}
          <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-start space-x-2">
              <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
              <div class="text-xs text-blue-700">
                <p class="font-semibold mb-1">{{ __('Provider Service Fee') }}</p>
                <p>{{ __('A minimum service fee of') }} <strong>{{ $minimumServiceFee }}{{ $currencySymbol }}</strong> {{ __('applies if the calculated commission does not reach this amount.') }}</p>
                @if($isMinimumApplied)
                  <p class="mt-1 text-blue-600">
                    <i class="fas fa-check-circle"></i>
                    {{ __('The minimum fee applies to this transaction.') }}
                  </p>
                @endif
              </div>
            </div>
          </div>
      </div>

      {{-- <div class="mt-4 text-right">
        <i class="fas fa-info-circle text-gray-400"></i>
      </div> --}}
      </div>
    </div>
  </div>
</div>
<script>
const stripe = Stripe('{{ config('services.stripe.key') }}');

/**
 * Met à jour la méthode de paiement sélectionnée
 * @param {string} gateway - 'stripe' ou 'paypal'
 */
function updatePaymentMethod(gateway) {
  const stripeForm = document.getElementById('stripeCheckoutForm');
  const paypalContainer = document.getElementById('paypalCheckoutContainer');
  const stripeLabel = document.getElementById('stripeOptionLabel');
  const paypalLabel = document.getElementById('paypalOptionLabel');

  if (gateway === 'stripe') {
    // Afficher formulaire Stripe
    if (stripeForm) stripeForm.classList.remove('hidden');
    if (paypalContainer) paypalContainer.classList.add('hidden');

    // Mettre à jour les styles
    if (stripeLabel) {
      stripeLabel.classList.add('border-blue-500', 'bg-blue-50');
      stripeLabel.classList.remove('border-gray-200');
    }
    if (paypalLabel) {
      paypalLabel.classList.remove('border-blue-500', 'bg-blue-50');
      paypalLabel.classList.add('border-gray-200');
    }
  } else if (gateway === 'paypal') {
    // Afficher formulaire PayPal
    if (stripeForm) stripeForm.classList.add('hidden');
    if (paypalContainer) paypalContainer.classList.remove('hidden');

    // Mettre à jour les styles
    if (paypalLabel) {
      paypalLabel.classList.add('border-blue-500', 'bg-blue-50');
      paypalLabel.classList.remove('border-gray-200');
    }
    if (stripeLabel) {
      stripeLabel.classList.remove('border-blue-500', 'bg-blue-50');
      stripeLabel.classList.add('border-gray-200');
    }
  }
}

// Initialiser au chargement
document.addEventListener('DOMContentLoaded', function() {
  const selectedGateway = document.querySelector('input[name="payment_gateway"]:checked');
  if (selectedGateway) {
    updatePaymentMethod(selectedGateway.value);
  }
});

/**
 * Initie le checkout PayPal via API
 */
async function initiatePayPalCheckout() {
  const btn = document.getElementById('paypalCheckoutBtn');
  const loading = document.getElementById('paypalLoading');
  const errorDiv = document.getElementById('paypalError');

  // Désactiver le bouton et afficher le loading
  btn.disabled = true;
  btn.classList.add('opacity-50', 'cursor-not-allowed');
  loading.classList.remove('hidden');
  errorDiv.classList.add('hidden');

  try {
    const response = await fetch('{{ route('payments.paypal.checkout') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        mission_id: {{ $offer->mission_id }},
        provider_id: {{ $provider->id }},
        offer_id: {{ $offer->id }},
        amount: {{ $missionAmount }},
        client_fee: {{ $clientFee }},
        total: {{ $total }},
        remaining_credits: {{ $remainingCreditBalance }},
      }),
    });

    const data = await response.json();

    if (data.success && data.approval_url) {
      // Rediriger vers PayPal
      window.location.href = data.approval_url;
    } else {
      throw new Error(data.error || 'PayPal checkout failed');
    }
  } catch (error) {
    console.error('PayPal checkout error:', error);
    errorDiv.textContent = error.message || '{{ __("An error occurred. Please try again.") }}';
    errorDiv.classList.remove('hidden');

    // Réactiver le bouton
    btn.disabled = false;
    btn.classList.remove('opacity-50', 'cursor-not-allowed');
    loading.classList.add('hidden');
  }
}
</script>
@endsection
