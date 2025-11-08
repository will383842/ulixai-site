{{-- 
  ═══════════════════════════════════════════════════════════
  PROVIDER SIGNUP POPUP - Multi-step wizard
  ═══════════════════════════════════════════════════════════
  This popup is only displayed for non-authenticated users
  Handles provider registration in 16 steps with validation
--}}

@php
  // Récupérer les pays pour le step operational_countries
  use App\Models\Country; 
  $countries = Country::where('status', 1)->get();
@endphp

@if(!Auth::check())
<div id="signupPopup" 
     class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-0 sm:p-4" 
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="signup-popup-title">
  
  <!-- CONTAINER RESPONSIVE -->
  <div class="bg-white w-full h-[100dvh] sm:h-auto sm:max-w-4xl sm:max-h-[90vh] rounded-t-3xl sm:rounded-2xl overflow-hidden shadow-2xl animate-slideUp sm:animate-fadeIn flex flex-col">
    
    <!-- ═══════════════════════════════════════════════════════════
         HEADER STICKY - Progress bar et bouton close
         ═══════════════════════════════════════════════════════════ -->
    <div class="sticky sm:relative top-0 z-20 bg-white/95 sm:bg-white backdrop-blur-sm sm:backdrop-blur-none border-b-0 px-4 sm:px-8 py-0 flex items-center justify-between gap-4 h-0 overflow-hidden sm:h-auto sm:overflow-visible">
      
      <!-- Progress Bar (mobile uniquement) -->
      <div class="flex-1">
        <div class="sm:hidden">
          <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-gray-500">
              Step <span id="currentStepNum">1</span> of 16
            </span>
            <span class="text-xs font-semibold text-blue-600">
              <span id="progressPercentage">6</span>%
            </span>
          </div>
          <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden" 
               role="progressbar" 
               aria-valuenow="6" 
               aria-valuemin="0" 
               aria-valuemax="100">
            <div id="mobileProgressBar" 
                 class="h-full bg-gradient-to-r from-blue-600 to-blue-500 transition-all duration-300 ease-out" 
                 style="width: 6.25%"></div>
          </div>
        </div>
      </div>

      <!-- Close Button -->
      <button id="closePopup" 
              type="button"
              class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 active:bg-gray-200 transition-all active:scale-95 text-gray-500 hover:text-gray-800 shrink-0 absolute top-2 right-2" 
              aria-label="Close signup form">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- ═══════════════════════════════════════════════════════════
         CONTENT - Tous les steps du wizard
         ═══════════════════════════════════════════════════════════ -->
    <div class="flex-1 overflow-y-auto overscroll-contain px-4 sm:px-8 pt-0 pb-20 sm:pb-4" id="popupContentArea">
      
      {{-- Step 1: Choose profile type --}}
      @include('wizards.provider.steps.choose_step')
      
      {{-- Step 2: Native language --}}
      @include('wizards.provider.steps.native_language')
      
      {{-- Step 3: Spoken languages --}}
      @include('wizards.provider.steps.spoken_language')
      
      {{-- Step 4: Provider services --}}
      @include('wizards.provider.steps.provider_services')
      
      {{-- Step 5: Country selection --}}
      @include('wizards.provider.steps.country_selection')
      
      {{-- Step 6: Operational countries --}}
      @include('wizards.provider.steps.operational_countries', ['countries' => $countries])
      
      {{-- Step 7: Special status --}}
      @include('wizards.provider.steps.special_status')
      
      {{-- Step 8: Communication preference --}}
      @include('wizards.provider.steps.communication_preference')
      
      {{-- Step 9: Profile description --}}
      @include('wizards.provider.steps.profile_description')
      
      {{-- Step 10: Profile picture --}}
      @include('wizards.provider.steps.profile_picture')
      
      {{-- Step 11: Identity documents --}}
      @include('wizards.provider.steps.identity_documents')
      
      {{-- Step 12: First and last name --}}
      @include('wizards.provider.steps.first_last_name')
      
      {{-- Step 13: Email --}}
      @include('wizards.provider.steps.email')
      
      {{-- Step 14: Verify email --}}
      @include('wizards.provider.steps.verify_email')
      
      {{-- Step 15: Phone number --}}
      @include('wizards.provider.steps.phone_number')
      
      {{-- Step 16: Success confirmation --}}
      @include('wizards.provider.steps.success_confirmation')
      
    </div>

    {{-- ═══════════════════════════════════════════════════════════
         NAVIGATION BUTTONS (Mobile + Desktop)
         ═══════════════════════════════════════════════════════════ --}}
    @include('wizards.provider.partials.navigation-buttons')

  </div>
</div>
@endif