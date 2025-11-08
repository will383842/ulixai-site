{{--
  ═══════════════════════════════════════════════════════════
  WIZARD NAVIGATION BUTTONS
  ═══════════════════════════════════════════════════════════
  Reusable navigation buttons for multi-step wizards
  Used by: Provider wizard, Requester wizard, etc.
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
  
  <button id="mobileNextBtn" 
          type="button" 
          class="btn-next" 
          aria-label="Continue to next step">
    <span>Continue</span>
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
  
  <button id="desktopNextBtn" 
          type="button" 
          class="btn-next" 
          aria-label="Continue to next step">
    <span>Continue</span>
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
    </svg>
  </button>
</div>