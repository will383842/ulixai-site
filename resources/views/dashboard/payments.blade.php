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
        $providerFee = number_format($commissions->provider_fee * $missionAmount, 2, '.', '');
        $total = $missionAmount + $clientFee;
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
              <span class="text-sm">{{ number_format($missionAmount, 2) }} €</span>
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

          <span class="text-sm">{{ $clientFee }} €</span>
        </div>

        <div class="border-t pt-3 flex justify-between font-semibold">
          <span>TOTAL</span>
          <span>{{ number_format($total, 2) }} €</span>
        </div>
        <div class="flex justify-between text-xs text-gray-500 pt-2">
          {{-- <span>Provider receives (after {{ $providerFeePercent }}% fee):</span> --}}
          {{-- <span>{{ number_format($netToProvider, 2) }} €</span> --}}
        </div>
        <form id="stripeCheckoutForm" method="POST" action="{{ route('payments.stripe.checkout') }}">
            @csrf
            <input type="hidden" name="mission_id" value="{{ $offer->mission_id }}">
            <input type="hidden" name="provider_id" value="{{ $provider->id }}">
            <input type="hidden" name="offer_id" value="{{ $offer->id }}">
            <input type="hidden" name="amount" value="{{ $missionAmount }}">
            <input type="hidden" name="client_fee" value="{{ $clientFee }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="remaining_credits" value="{{ $remainingCreditBalance }}">
            <button type="submit" class="w-full bg-blue-500 text-white rounded-lg py-2.5 text-sm font-semibold hover:bg-blue-600 transition">
              RESERVE FOR {{ number_format($total, 2) }} €
            </button>
          </form>
          <p class="text-xs text-gray-500 text-center">
            This is a prepayment secured by stripe. payment will only be made to the service provider after the end of the mission
          </p>
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

const token = stripe.tokens.create({
  account: {
    business_type: 'individual',
    individual: {
      first_name: '{{ $provider->first_name ?? "" }}',  
      last_name: '{{ $provider->last_name ?? "" }}',
      email: '{{ $provider->email ?? "" }}',
    },
    tos_shown_and_accepted: true,
  },
});

console.log('Creating account token...', token);

</script>
@endsection
