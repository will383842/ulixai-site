{{--
  ═══════════════════════════════════════════════════════════
  WIZARD NAVIGATION BUTTONS
  ═══════════════════════════════════════════════════════════
  Reusable navigation buttons for multi-step wizards
  Used by: Provider wizard, Requester wizard, etc.
  
  @version 3.1.0
  @updated 2025-01-08
  @change Ajout bouton "Choose Your Specialties" pour Step 4
--}}

{{-- ═══════════════════════════════════════════════════════════
     MOBILE NAVIGATION (Fixed bottom)
     ═══════════════════════════════════════════════════════════ --}}
<div id="mobileNavButtons" class="sm:hidden">
  <button id="mobileBackBtn" 
          type="button" 
          class="btn-back" 
          style="display:none;" 
          aria-label="Go back">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    <span>Back</span>
  </button>
  
  {{-- Bouton Continue normal --}}
  <button id="mobileNextBtn" 
          type="button" 
          class="btn-next" 
          aria-label="Continue to next step">
    <span>Continue</span>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
  </button>
  
  {{-- Bouton spécial Step 4 - Caché par défaut --}}
  <button id="mobileSpecialtiesBtn" 
          type="button" 
          class="btn-specialties" 
          style="display:none;"
          disabled
          aria-label="Choose your specialties">
    <span>Choose Your Specialties</span>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
  </button>
</div>

{{-- ═══════════════════════════════════════════════════════════
     DESKTOP NAVIGATION (Sticky bottom)
     ═══════════════════════════════════════════════════════════ --}}
<div id="desktopNavButtons" class="hidden sm:flex px-8 pb-6">
  <button id="desktopBackBtn" 
          type="button" 
          class="btn-back" 
          style="display:none;" 
          aria-label="Go back">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    <span>Back</span>
  </button>
  
  {{-- Bouton Continue normal --}}
  <button id="desktopNextBtn" 
          type="button" 
          class="btn-next" 
          aria-label="Continue to next step">
    <span>Continue</span>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
  </button>
  
  {{-- Bouton spécial Step 4 - Caché par défaut --}}
  <button id="desktopSpecialtiesBtn" 
          type="button" 
          class="btn-specialties" 
          style="display:none;"
          disabled
          aria-label="Choose your specialties">
    <span>Choose Your Specialties</span>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
  </button>
</div>