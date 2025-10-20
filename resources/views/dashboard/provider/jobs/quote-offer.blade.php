@extends('dashboard.layouts.master')
@section('title', 'Quote Offer')

@section('content')
@php
  $images = json_decode($mission->attachments ?? '[]', true);
  $user = auth()->user();
  $provider = $user->serviceProvider;
  if($provider) {
    $providerKyc = $provider->kyc_status != 'verified' && $provider->stripe_account_id;
  }
  
@endphp
<!-- Alpine.js (add once in your layout if not already included) -->
<script src="//unpkg.com/alpinejs" defer></script>

<style>
   /* Prevent profile images from triggering any unwanted behavior */
   #public-messages-list img {
       pointer-events: none;
       user-select: none;
   }

   /* Ensure attachment images only respond to their specific modal */
   .attachment-modal-trigger {
       cursor: pointer;
   }

   .attachment-modal-trigger img {
       transition: transform 0.2s ease;
   }

   .attachment-modal-trigger:hover img {
       transform: scale(1.05);
   }
</style>
  <div class="mx-auto">
    <!-- Top Section -->
    <div class="mb-6 relative">
      <h2 class="text-lg font-bold text-blue-900 mb-4">{{ $mission->title ?? 'Service Request' }}</h2>

      <div class="border border-blue-200 rounded-xl p-4 bg-white flex items-start gap-4">
        <div class="w-14 h-14 flex items-center justify-center bg-blue-100 rounded-full">
          <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
            <path d="M10,20V14H14V20H19V12H22L12,3L2,12H5V20H10Z" />
          </svg>
        </div>
        <p class="text-gray-700 text-sm">
          {{ $mission->description ?? 'No description provided.' }}
          <span class="font-semibold text-blue-700">Details of the service request</span>
        </p>
      </div>
        <!-- Image Thumbnails -->
        <div
          class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6 mt-6"
          x-data="{
            open: false, 
            image: '',
            openModal(img) {
              this.image = img;
              this.open = true;
            },
            closeModal() {
              this.open = false;
            }
          }"
        >
        @if($images && count($images) > 0)
        @foreach($images as $img)
          <div
            class="bg-gray-200 rounded-xl overflow-hidden flex items-center justify-center attachment-modal-trigger"
            style="aspect-ratio: 4 / 3;"
            @click="openModal('{{ asset($img) }}')"
          >
            <img
              src="{{ asset($img) }}"
              alt="Attachment"
              class="w-full h-full object-cover block rounded-xl"
              loading="lazy" decoding="async"
            />
          </div>
        @endforeach
        @endif

        <!-- Modal -->
        <div
          class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
          x-show="open"
          x-transition:enter="transition ease-out duration-300 transform"
          x-transition:enter-start="opacity-0 scale-50"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-50"
          @click="closeModal()"
          style="display: none;" <!-- This ensures the modal is hidden on initial load -->
        >
          <div class="relative" @click.stop>
            <!-- Close button -->
            <button
              class="absolute top-2 right-2 bg-white rounded-full px-2 py-1 text-black"
              @click="closeModal()"
            >✕</button>

            <!-- Full Image -->
            <img
              :src="image"
              class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-lg"
            />
          </div>
        </div>
      </div>

      <div class="flex justify-end mb-4">
        @if(auth()->check() && $mission && $mission->requester_id != auth()->id())
          <button onclick="checkKycAndOpenOffer()"
            class="border-2 border-blue-400 text-blue-500 font-bold px-8 py-2 rounded-full bg-white hover:bg-blue-50 transition-all duration-150 shadow-sm text-lg"
            style="box-shadow:0 2px 8px 0 rgba(0,0,0,0.03);">
           I APPLY
          </button>
        @endif
      </div>

      <script>
        function checkKycAndOpenOffer() {
          @if(!$provider || ($provider && ($provider->kyc_status != 'verified' || !$provider->stripe_account_id)))
            // Show error toast
            toastr.error('Please complete KYC verification to apply for missions');
          @else
            // Open offer popup if KYC is complete
            document.getElementById('offerPopupModal').classList.remove('hidden');
          @endif
        }
      </script>
      @php
          if($mission->service_durition === '1 week') {
              $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeek();
          } elseif($mission->service_durition === '2 weeks') {
              $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeeks(2);
          } elseif($mission->service_durition === '1 month') {
              $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonth();
          } elseif($mission->service_durition === '3 months') {
              $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonths(3);
          } else {
              $endTime = null;
          }
          if ($endTime) {
              $remainingDays = $endTime->diffInDays(\Carbon\Carbon::now());
          } else {
              $remainingDays = 'N/A'; 
          }
      @endphp

      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div class="bg-white px-6 py-4 rounded-xl text-sm text-gray-700 shadow w-full sm:w-auto">
          <p class="text-gray-700 text-sm">Duration : {{ $mission->service_durition ?? '-' }}</p>
          <p class="text-gray-700 text-sm">Ends In : {{ $remainingDays }} Days</p>
          <p class="text-gray-700 text-sm mb-2">Country : {{ $mission->location_country ?? '-' }}</p>
          <p class="text-gray-700 text-sm mb-2">City : {{ $mission->location_city ?? '-' }}</p>
          <p class="text-gray-700 text-sm mb-2">Language : {{ $mission->language ?? '-' }}</p>
        </div>
        <div class="flex gap-4">
          <!-- Actions if needed -->
        </div>
      </div>

      <hr class="my-6 border-gray-300" />

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">

        <!-- OFFERS RECEIVED -->
        <div>
          <h3 class="text-blue-900 font-bold mb-4">OFFERS RECEIVED</h3>
          @forelse($offers as $offer)
            <div class="bg-white rounded-xl border border-blue-300 shadow p-4 mb-4">
              <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-xl text-gray-500">
                  @if($offer->provider && $offer->provider->profile_photo)
                    <img src="{{ asset($offer->provider->profile_photo) }}" class="w-12 h-12 rounded-full object-cover" alt="Provider">
                  @else
                    <i class="fas fa-user"></i>
                  @endif
                </div>
                <div class="flex-1">
                  <p class="font-semibold text-gray-900">{{ $offer->provider->first_name ?? 'Provider' }}</p>
                  <div class="flex items-center text-sm text-gray-500 gap-1">
                    <i class="fas fa-star text-blue-500"></i> {{ $offer->provider->rating ?? '5.00' }}
                  </div>
                </div>
                <div class="text-blue-900 font-bold text-lg">{{ $offer->price ?? '-' }} €</div>
              </div>
              <p class="text-sm text-gray-600 mb-2">{{ $offer->message ?? 'No message.' }}</p>
              <p class="text-sm text-gray-600 mb-2">Delivery time: {{ $offer->delivery_time ?? '-' }}</p>
              <div class="flex gap-3">
                @if(auth()->check() && $mission && $mission->requester_id == auth()->id())
                  <button type="button" onclick="chooseProvider({{$offer->provider->id}}, {{$mission->id}}, '{{$offer->provider->first_name}}')" class="text-sm bg-yellow-400 text-black px-4 py-1.5 rounded-full font-semibold hover:bg-yellow-500 transition">
                   I choose {{ $offer->provider->first_name ?? 'provider' }}
                  </button>
                @endif
              </div>
            </div>
          @empty
            <div class="text-gray-500 py-6">No offers received yet.</div>
          @endforelse
        </div>

        <!-- PUBLIC MESSAGES -->
        <div>
          <h3 class="text-blue-900 font-bold mb-4">PUBLIC MESSAGES</h3>
          <div class="bg-white rounded-xl shadow p-4 flex flex-col max-h-[400px] h-[600px] mb-12">
            <div id="public-messages-list" class="space-y-10 overflow-y-auto pr-2">
              <!-- Messages will be loaded here -->
            </div>
            <form id="publicMessageForm" class="flex gap-2 mt-4">
              <input type="text" name="message" id="publicMessageInput" placeholder="Type your public message..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
              <button type="submit"
                      class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition font-medium">
                Send
              </button>
            </form>
            <div id="public-message-error" class="text-red-600 text-sm mt-2 hidden"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Confirmation Popup Modal -->
<div id="confirmProviderModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 text-center relative">
    <div class="flex justify-center mb-4">
      <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto">
        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
        </svg>
      </div>
    </div>
    <h2 class="text-xl font-bold text-blue-800 mb-2">You're almost there! <span class="align-middle">🎯</span></h2>
    <p class="text-gray-700 mb-2">You're about to work with <span id="provider-name" class="font-semibold text-blue-700"></span>.<br>
      Here's what happens next:</p>
    <ul class="text-left text-sm text-gray-700 mb-6 space-y-3 mt-4">
      <li class="flex items-start gap-2">
        <span class="text-purple-500 mt-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg></span>
        <span><span class="font-semibold">Your payment is protected</span> — it’s securely held by Stripe and will only be released to the provider once the job is completed.</span>
      </li>
      <li class="flex items-start gap-2">
        <span class="text-purple-500 mt-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg></span>
        <span><span class="font-semibold">You'll unlock chat</span> with the provider right after confirming your request.</span>
      </li>
      <li class="flex items-start gap-2">
        <span class="text-purple-500 mt-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg></span>
        <span><span class="font-semibold">We're here to help</span> all along your service request — if anything goes wrong, just reach out!</span>
      </li>
    </ul>
    <div class="flex flex-col gap-3">
      <a href="#" id="pay-provider" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full px-6 py-3 text-lg flex items-center justify-center gap-2 transition">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
        Confirm & Pay
      </a>
      <button id="chooseAnotherProviderBtn" type="button" class="border border-red-400 text-red-600 rounded-full px-6 py-2 font-semibold bg-white hover:bg-red-50 transition text-sm">
        &larr; Choose another provider
      </button>
    </div>
    <button id="closeConfirmProviderModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
  </div>
</div>

<!-- Offer Popup Modal -->
<div id="offerPopupModal" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
  <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center relative">
    <button id="closeOfferPopupBtn" class="absolute top-2 right-3 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
    <h2 class="text-xl font-bold text-blue-800 mb-3">Send your offer</h2>
    <form id="offerForm" class="space-y-4 text-left">
      <div>
        <label class="block text-sm font-semibold text-blue-900 mb-1">Your proposed price (€)</label>
        <input type="number" name="price" class="w-full border rounded-lg px-3 py-2" placeholder="e.g. 50" required>
      </div>
      <div>
        <label class="block text-sm font-semibold text-blue-900 mb-1">Estimated delivery time (in days)</label>
        <input type="text" name="delivery_time" class="w-full border rounded-lg px-3 py-2" placeholder="e.g. 2 days" required>
      </div>
      <div>
        <label class="block text-sm font-semibold text-blue-900 mb-1">A short message (max 300 characters)</label>
        <textarea name="message" class="w-full border rounded-lg px-3 py-2" maxlength="300" placeholder="I'm available and ready to help!" required></textarea>
      </div>
      <div id="offer-error" class="text-red-600 text-sm hidden"></div>
      <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-full py-2 mt-2 transition">
        I'm sending my offer
      </button>
    </form>
  </div>
</div>

<!-- Offer Sent Confirmation Popup -->
<div id="offerSentPopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
  <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center relative">
    <button id="closeOfferSentPopupBtn" class="absolute top-2 right-3 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
    <h2 class="text-xl font-bold text-blue-900 mb-1">Thank You !</h2>
    <div class="text-blue-800 font-semibold mb-2">Your request has been sent to the requester</div>
    <div class="text-gray-700 text-sm">
      You will be informed if your application is accepted via your personal messaging and by email.
    </div>
  </div>
</div>

<script>
  // Alpine.js data for attachment modal
  function attachmentModal() {
    return {
      open: false,
      image: '',
      init() {
        // Ensure modal starts closed on page load
        this.open = false;
        this.image = '';
      },
      openModal(imgSrc) {
        this.open = true;
        this.image = imgSrc;
      },
      closeModal() {
        this.open = false;
        this.image = '';
      }
    }
  }

  // Modal logic
  document.addEventListener('DOMContentLoaded', function() {
    // const chooseBtns = document.querySelectorAll('.bg-yellow-400');
    // const modal = document.getElementById('confirmProviderModal');
    const modal = document.getElementById('confirmProviderModal');
    const closeModalBtn = document.getElementById('closeConfirmProviderModal');
    const chooseAnotherBtn = document.getElementById('chooseAnotherProviderBtn');
    if (closeModalBtn) closeModalBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });
    if (chooseAnotherBtn) chooseAnotherBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });
    if (modal) modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.classList.add('hidden');
    });

    // Offer popup logic
    const openOfferPopupBtn = document.getElementById('openOfferPopupBtn');
    const offerPopupModal = document.getElementById('offerPopupModal');
    const closeOfferPopupBtn = document.getElementById('closeOfferPopupBtn');
    const offerForm = document.getElementById('offerForm');
    const offerSentPopup = document.getElementById('offerSentPopup');
    const closeOfferSentPopupBtn = document.getElementById('closeOfferSentPopupBtn');

    if (openOfferPopupBtn) openOfferPopupBtn.addEventListener('click', () => {
      offerPopupModal.classList.remove('hidden');
    });
    if (closeOfferPopupBtn) closeOfferPopupBtn.addEventListener('click', () => {
      offerPopupModal.classList.add('hidden');
    });
    if (offerForm) offerForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const errorDiv = document.getElementById('offer-error');
      errorDiv.classList.add('hidden');
      const formData = new FormData(offerForm);
      fetch("{{ route('mission.offer', $mission->id) }}", {
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(async res => {
        const json = await res.json();
        if (json.status === 'success') {
          offerPopupModal.classList.add('hidden');
          offerSentPopup.classList.remove('hidden');
          offerForm.reset();
        } else {
          errorDiv.textContent = json.message || 'Failed to submit offer.';
          errorDiv.classList.remove('hidden');
        }
      })
      .catch(() => {
        errorDiv.textContent = 'Failed to submit offer. Please try again.';
        errorDiv.classList.remove('hidden');
      });
    });
    if (closeOfferSentPopupBtn) closeOfferSentPopupBtn.addEventListener('click', () => {
      offerSentPopup.classList.add('hidden');
    });
    if (offerPopupModal) offerPopupModal.addEventListener('click', (e) => {
      if (e.target === offerPopupModal) offerPopupModal.classList.add('hidden');
    });
    if (offerSentPopup) offerSentPopup.addEventListener('click', (e) => {
      if (e.target === offerSentPopup) offerSentPopup.classList.add('hidden');
    });
  });

  //Choose Provider
  function chooseProvider(provider, mission_id, name) {
    const modal = document.getElementById('confirmProviderModal');
    modal.classList.remove('hidden');
    const providerName = document.getElementById('provider-name');
    providerName.textContent = name;
    const confirmPay = document.getElementById('pay-provider');
    const baseUrl = `{{ route('user.payments') }}`;
    confirmPay.href = `${baseUrl}?id=${provider}&mission_id=${mission_id}`;
  }


  // Public messaging AJAX
  function renderPublicMessages(messages) {
    const list = document.getElementById('public-messages-list');
    list.innerHTML = '';
    messages.forEach(msg => {
      // Get profile image with fallback to helpexpat.png
      const profileImage = msg.user.profile_photo ? '{{ asset('') }}' + msg.user.profile_photo : '{{ asset('images/helpexpat.png') }}';

      list.innerHTML += `
        <div class="space-y-3">
          <div class="flex gap-3 items-start">
            <img src="${profileImage}" class="w-10 h-10 rounded-full object-cover" alt="Profile" />
            <div class="text-sm">
              <p class="font-semibold text-gray-900">${msg.user.name} <span class="text-xs text-gray-500 ml-1">${msg.created_at}</span></p>
              <p class="text-gray-700">${msg.message}</p>
            </div>
          </div>
        </div>
      `;
    });
  }

  function loadPublicMessages() {
    fetch("{{ route('mission.public-messages', $mission->id) }}")
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          renderPublicMessages(data.messages);
        }
      });
  }

  document.addEventListener('DOMContentLoaded', function() {
    loadPublicMessages();

    const publicMessageForm = document.getElementById('publicMessageForm');
    const publicMessageInput = document.getElementById('publicMessageInput');
    const publicMessageError = document.getElementById('public-message-error');

  function sanitizeMessage(msg) {
    let out = msg;

    // 1) Gmail → first letter + @gmail.com
    out = out.replace(/\b([A-Za-z0-9._%+-])[A-Za-z0-9._%+-]*@gmail\.com\b/gi, '$1@gmail.com');

    // 2) URLs with protocol → www.....com
    out = out.replace(/\bhttps?:\/\/[^\s)]+/gi, 'www.....com');

    // 3) URLs starting with www. → www.....com
    out = out.replace(/\bwww\.[A-Za-z0-9-]+(?:\.[A-Za-z]{2,24})(?:\/[^\s)]*)?\b/gi, 'www.....com');

    // 4) Bare domains (not part of emails) → www.....com
    try {
      out = out.replace(
        /(?<!@)\b[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi,
        'www.....com'
      );
    } catch (e) {
      // Fallback (no lookbehind support)
      out = out.replace(
        /\b(?![A-Za-z0-9._%+-]+@)[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi,
        'www.....com'
      );
    }

    // 5) Any phone number (with + or just digits) → [phone]
    // - Matches +CC plus 7+ digits
    // - Or plain digit sequences with 10+ digits
    out = out.replace(/\+?\d[\d\s\-().]{7,}\d\b/g, '[phone]');

    // Cleanup spaces
    out = out.replace(/\s{2,}/g, ' ').trim();

    return out;
  }

  if (publicMessageForm) {
    publicMessageForm.addEventListener('submit', function (e) {
      e.preventDefault();
      publicMessageError.classList.add('hidden');

      const raw = publicMessageInput.value.trim();
      if (!raw) return;

      let msg = sanitizeMessage(raw);

      if (!msg) msg = '[redacted]';

      fetch("{{ route('mission.public-message', $mission->id) }}", {
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ message: msg })
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          publicMessageInput.value = '';
          loadPublicMessages();
        } else {
          publicMessageError.textContent = data.message || 'Failed to send message.';
          publicMessageError.classList.remove('hidden');
        }
      })
      .catch(() => {
        publicMessageError.textContent = 'Failed to send message.';
        publicMessageError.classList.remove('hidden');
      });
    });
  }
});
</script>

@endsection