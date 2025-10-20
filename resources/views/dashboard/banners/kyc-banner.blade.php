@php
    $user = auth()->user();
    $provider = $user->serviceProvider ?? null;

@endphp
@if($user->user_role === 'service_provider')
    @if ($provider->kyc_status != 'verified' && $provider->stripe_account_id)
      <div id="kyc-banner" class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded-md shadow-md flex justify-between items-center mb-4 animate-pulse">
          <div>
              <h3 class="font-semibold text-lg">Complete Your KYC</h3>
              <p class="text-sm">To receive payouts, please complete your identity verification.</p>
          </div>
          <button
              id="start-kyc-btn"
              onclick=completeKYC()
              class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded font-semibold text-sm transition-all"
          >
              Continue
          </button>
      </div>
  @endif
@endif

<script>
    function completeKYC() {
        fetch("{{ route('stripe.kyc.link') }}")
        .then(res => res.json())
        .then(data => {
            if (data.completed) {
                alert("You're already verified!");
                document.getElementById('kyc-banner').remove();
            } else if (data.url) {
                window.location.href = data.url;
            } else {
                alert("Failed to get Stripe onboarding link.");
            }
        })
        .catch(err => {
            console.error(err);
            alert("Something went wrong. Please try again later.");
        });
    }
    
</script>