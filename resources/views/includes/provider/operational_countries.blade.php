<!-- 
============================================
🚀 STEP 6 - WHERE DO YOU OPERATE (CORRECTED)
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Multi-sélection avec drapeaux de pays
💎 Validation et états interactifs
⚡ Responsive 2 cols mobile / 3 cols / 4 cols desktop
🔧 Intégré avec wizard-steps.js
✅ Persistance des sélections au retour en arrière
🚀 OPTIMISATIONS MAXIMALES (CPU, GPU, Police, Taille, Rapidité)
============================================
-->

<div id="step6" class="hidden flex flex-col h-full" role="region" aria-label="Select countries where you operate">
  
  <!-- ============================================
       TITRE FIXE (STICKY)
       ============================================ -->
  <div class="sticky top-0 z-10 bg-white pt-2 pb-2 border-b border-gray-100">
    
    <!-- Ambient Background Effects - 3 blobs animés -->
    <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section -->
    <div class="text-center space-y-2 relative">
      <!-- Icon Badge -->
      <div class="flex justify-center">
        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-blue-100 transform hover:rotate-12 transition-transform duration-300">
          <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
      
      <!-- Title & Subtitle -->
      <div>
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight">
          Where Do You Operate? 🌍
        </h2>
        <p class="text-sm sm:text-base font-semibold text-gray-600">
          Select all countries where you provide services
        </p>
      </div>

      <!-- Counter Badge -->
      <div class="inline-flex items-center gap-2 px-2.5 py-1 sm:px-3 sm:py-1.5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-full">
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-xs font-bold text-blue-700">
          <span id="step6SelectedCount">0</span> country(ies) selected
        </span>
      </div>
    </div>
  </div>

  <!-- ============================================
       CONTENU SCROLLABLE
       ============================================ -->
  <div class="flex-1 overflow-y-auto pt-0 space-y-3 sm:space-y-4">

    <!-- Error Alert (Hidden by default) -->
    <div id="step6CountryError" class="hidden bg-red-50 border-l-4 border-red-500 rounded-xl p-3 shake-animation" role="alert">
      <div class="flex items-start gap-2">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <div>
          <p class="text-sm font-semibold text-red-800">Please select at least one country</p>
          <p class="text-xs text-red-600 mt-0.5">You must choose where you provide services</p>
        </div>
      </div>
    </div>

    <!-- Search Bar -->
    <div class="relative">
      <input 
        type="text" 
        id="step6Search" 
        placeholder="🔍 Search for a country..." 
        class="w-full px-4 py-3 text-sm bg-gray-200 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all font-medium placeholder:text-gray-600"
        autocomplete="off"
      >
      <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </div>
    </div>

    <!-- Countries Grid -->
    <div id="step6CountryList" class="country-list-container" role="group" aria-label="Select operational countries">
      <!-- Afghanistan -->
      <button 
        type="button"
        class="country-card"
        data-country="Afghanistan"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Afghanistan">
        <span class="country-name">Afghanistan</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Albania -->
      <button 
        type="button"
        class="country-card"
        data-country="Albania"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Albania">
        <span class="country-name">Albania</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Algeria -->
      <button 
        type="button"
        class="country-card"
        data-country="Algeria"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Algeria">
        <span class="country-name">Algeria</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Andorra -->
      <button 
        type="button"
        class="country-card"
        data-country="Andorra"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Andorra">
        <span class="country-name">Andorra</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Angola -->
      <button 
        type="button"
        class="country-card"
        data-country="Angola"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Angola">
        <span class="country-name">Angola</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Argentina -->
      <button 
        type="button"
        class="country-card"
        data-country="Argentina"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Argentina">
        <span class="country-name">Argentina</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Australia -->
      <button 
        type="button"
        class="country-card"
        data-country="Australia"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Australia">
        <span class="country-name">Australia</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Austria -->
      <button 
        type="button"
        class="country-card"
        data-country="Austria"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Austria">
        <span class="country-name">Austria</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Belgium -->
      <button 
        type="button"
        class="country-card"
        data-country="Belgium"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Belgium">
        <span class="country-name">Belgium</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Brazil -->
      <button 
        type="button"
        class="country-card"
        data-country="Brazil"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Brazil">
        <span class="country-name">Brazil</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Canada -->
      <button 
        type="button"
        class="country-card"
        data-country="Canada"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Canada">
        <span class="country-name">Canada</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- China -->
      <button 
        type="button"
        class="country-card"
        data-country="China"
        role="checkbox"
        aria-checked="false"
        aria-label="Select China">
        <span class="country-name">China</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Denmark -->
      <button 
        type="button"
        class="country-card"
        data-country="Denmark"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Denmark">
        <span class="country-name">Denmark</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Finland -->
      <button 
        type="button"
        class="country-card"
        data-country="Finland"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Finland">
        <span class="country-name">Finland</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- France -->
      <button 
        type="button"
        class="country-card"
        data-country="France"
        role="checkbox"
        aria-checked="false"
        aria-label="Select France">
        <span class="country-name">France</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Germany -->
      <button 
        type="button"
        class="country-card"
        data-country="Germany"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Germany">
        <span class="country-name">Germany</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Greece -->
      <button 
        type="button"
        class="country-card"
        data-country="Greece"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Greece">
        <span class="country-name">Greece</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- India -->
      <button 
        type="button"
        class="country-card"
        data-country="India"
        role="checkbox"
        aria-checked="false"
        aria-label="Select India">
        <span class="country-name">India</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Ireland -->
      <button 
        type="button"
        class="country-card"
        data-country="Ireland"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Ireland">
        <span class="country-name">Ireland</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Italy -->
      <button 
        type="button"
        class="country-card"
        data-country="Italy"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Italy">
        <span class="country-name">Italy</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Japan -->
      <button 
        type="button"
        class="country-card"
        data-country="Japan"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Japan">
        <span class="country-name">Japan</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Mexico -->
      <button 
        type="button"
        class="country-card"
        data-country="Mexico"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Mexico">
        <span class="country-name">Mexico</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Netherlands -->
      <button 
        type="button"
        class="country-card"
        data-country="Netherlands"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Netherlands">
        <span class="country-name">Netherlands</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Norway -->
      <button 
        type="button"
        class="country-card"
        data-country="Norway"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Norway">
        <span class="country-name">Norway</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Poland -->
      <button 
        type="button"
        class="country-card"
        data-country="Poland"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Poland">
        <span class="country-name">Poland</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Portugal -->
      <button 
        type="button"
        class="country-card"
        data-country="Portugal"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Portugal">
        <span class="country-name">Portugal</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Russia -->
      <button 
        type="button"
        class="country-card"
        data-country="Russia"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Russia">
        <span class="country-name">Russia</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- South Korea -->
      <button 
        type="button"
        class="country-card"
        data-country="South Korea"
        role="checkbox"
        aria-checked="false"
        aria-label="Select South Korea">
        <span class="country-name">South Korea</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Spain -->
      <button 
        type="button"
        class="country-card"
        data-country="Spain"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Spain">
        <span class="country-name">Spain</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Sweden -->
      <button 
        type="button"
        class="country-card"
        data-country="Sweden"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Sweden">
        <span class="country-name">Sweden</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- Switzerland -->
      <button 
        type="button"
        class="country-card"
        data-country="Switzerland"
        role="checkbox"
        aria-checked="false"
        aria-label="Select Switzerland">
        <span class="country-name">Switzerland</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- United Kingdom -->
      <button 
        type="button"
        class="country-card"
        data-country="United Kingdom"
        role="checkbox"
        aria-checked="false"
        aria-label="Select United Kingdom">
        <span class="country-name">United Kingdom</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

      <!-- United States -->
      <button 
        type="button"
        class="country-card"
        data-country="United States"
        role="checkbox"
        aria-checked="false"
        aria-label="Select United States">
        <span class="country-name">United States</span>
        <span class="check-indicator">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </span>
      </button>

    </div>

  </div>
</div>

<style>
/* ============================================
   🎨 ANIMATIONS
   ============================================ */
@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(20px, -50px) scale(1.1); }
  50% { transform: translate(-20px, 20px) scale(0.9); }
  75% { transform: translate(50px, 50px) scale(1.05); }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
  20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

.shake-animation {
  animation: shake 0.5s;
}

/* ============================================
   🔍 SEARCH INPUT
   ============================================ */
#step6Search {
  transition: all 0.2s ease;
  font-feature-settings: 'kern' 1, 'liga' 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

#step6Search:hover {
  background-color: #e5e7eb;
  border-color: #60a5fa;
}

#step6Search:focus {
  background-color: white;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
}

/* ============================================
   📋 COUNTRY LIST CONTAINER
   Optimisations: Grid responsive + Scrollbar custom
   ============================================ */
.country-list-container {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.625rem;
  max-height: 420px;
  overflow-y: auto;
  
  /* Performance optimisations */
  contain: layout style paint;
  will-change: scroll-position;
  
  /* Custom scrollbar */
  scrollbar-width: thin;
  scrollbar-color: #3b82f6 #f1f5f9;
}

/* Responsive breakpoints */
@media (min-width: 640px) {
  .country-list-container {
    grid-template-columns: repeat(3, 1fr);
    gap: 0.75rem;
    max-height: 460px;
  }
}

@media (min-width: 1024px) {
  .country-list-container {
    grid-template-columns: repeat(4, 1fr);
    gap: 0.875rem;
    max-height: 480px;
  }
}

/* Webkit scrollbar styling */
.country-list-container::-webkit-scrollbar {
  width: 6px;
}

.country-list-container::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 10px;
}

.country-list-container::-webkit-scrollbar-thumb {
  background: #3b82f6;
  border-radius: 10px;
  transition: background 0.2s;
}

.country-list-container::-webkit-scrollbar-thumb:hover {
  background: #2563eb;
}

/* ============================================
   🗺️ COUNTRY CARDS
   Optimisations: GPU acceleration + containment
   ============================================ */
.country-card {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.875rem 1rem;
  background: white;
  border: 2px solid #3b82f6;
  border-radius: 0.75rem;
  cursor: pointer;
  text-align: left;
  min-height: 3.5rem;
  
  /* Transitions optimisées */
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  
  /* Performance - GPU acceleration */
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
  
  /* Performance - CSS containment */
  contain: layout style paint;
  
  /* Touch improvements */
  -webkit-tap-highlight-color: transparent;
  user-select: none;
}

.country-card:hover {
  border-color: #2563eb;
  background: #eff6ff;
  transform: translateY(-2px) translateZ(0);
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

.country-card:active {
  transform: translateY(0) scale(0.98) translateZ(0);
}

.country-card.selected {
  background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
  border-color: #2563eb;
  color: white;
  box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.country-card.selected:hover {
  background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
  box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
}

/* ============================================
   📝 COUNTRY NAME
   Optimisations: Police + Rendu
   ============================================ */
.country-card .country-name {
  flex: 1;
  font-size: 0.875rem;
  font-weight: 600;
  color: inherit;
  text-align: left;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  
  /* Optimisations typographie */
  font-feature-settings: 'kern' 1, 'liga' 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}

/* ============================================
   ✅ CHECK INDICATOR
   Optimisations: GPU + Transitions
   ============================================ */
.country-card .check-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 1.25rem;
  height: 1.25rem;
  margin-left: 0.5rem;
  border-radius: 50%;
  background: rgba(59, 130, 246, 0.1);
  opacity: 0;
  
  /* GPU acceleration */
  transform: scale(0.8) translateZ(0);
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  
  /* Performance */
  backface-visibility: hidden;
  will-change: transform, opacity;
}

.country-card.selected .check-indicator {
  opacity: 1;
  transform: scale(1) translateZ(0);
  background: rgba(255, 255, 255, 0.2);
}

.country-card .check-indicator svg {
  color: #2563eb;
}

.country-card.selected .check-indicator svg {
  color: white;
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */
.country-card:focus-visible {
  outline: 3px solid #3b82f6;
  outline-offset: 2px;
  border-color: #2563eb;
}

/* Animations réduites pour utilisateurs qui préfèrent */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Contraste élevé */
@media (prefers-contrast: high) {
  .country-card {
    border: 3px solid currentColor;
  }
  
  .country-card.selected {
    border: 3px solid #1d4ed8;
  }
}

/* ============================================
   ⚡ OPTIMISATIONS PERFORMANCE SUPPLÉMENTAIRES
   ============================================ */

/* Optimisation GPU pour les éléments animés */
#step6 .country-card,
#step6 .check-indicator {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

/* Containment pour isoler les calculs de layout */
#step6 .country-card {
  contain: layout style paint;
}

/* Font loading optimization */
@supports (font-display: swap) {
  * {
    font-display: swap;
  }
}

/* Smooth scroll pour le container */
.country-list-container {
  scroll-behavior: smooth;
  -webkit-overflow-scrolling: touch;
}

/* Optimisation des ombres pour mobile */
@media (max-width: 640px) {
  .country-card {
    box-shadow: none;
  }
  
  .country-card:hover,
  .country-card.selected {
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
  }
}
</style>

<script>
/* ============================================
   🎯 STEP 6 - CORRECTED VERSION
   ✅ Intégré avec wizard-steps.js
   ✅ Persistance des sélections
   ⚡ Optimisations maximales
   ============================================ */

// État global
window.selectedCountries = [];

// Cache des éléments DOM (optimisation mémoire)
let cachedElementsStep6 = null;

/**
 * Récupération des éléments DOM avec cache
 * Évite les multiples querySelector (optimisation CPU)
 */
function getCachedElementsStep6() {
  if (!cachedElementsStep6) {
    cachedElementsStep6 = {
      cards: document.querySelectorAll('#step6 .country-card'),
      errorAlert: document.getElementById('step6CountryError'),
      selectedCount: document.getElementById('step6SelectedCount'),
      searchInput: document.getElementById('step6Search')
    };
  }
  return cachedElementsStep6;
}

/**
 * Toggle de sélection d'un pays (accessible globalement)
 * Multi-sélection avec mise à jour UI et persistance
 */
window.toggleCountrySelection = function(country) {
  const elements = getCachedElementsStep6();
  const index = window.selectedCountries.indexOf(country);
  const card = Array.from(elements.cards).find(c => c.getAttribute('data-country') === country);
  
  if (index > -1) {
    // Désélectionner
    window.selectedCountries.splice(index, 1);
    if (card) {
      card.classList.remove('selected');
      card.setAttribute('aria-checked', 'false');
    }
  } else {
    // Sélectionner
    window.selectedCountries.push(country);
    if (card) {
      card.classList.add('selected');
      card.setAttribute('aria-checked', 'true');
    }
  }
  
  // Mise à jour du compteur
  if (elements.selectedCount) {
    elements.selectedCount.textContent = window.selectedCountries.length;
  }
  
  // Cacher l'erreur si visible
  if (elements.errorAlert && !elements.errorAlert.classList.contains('hidden')) {
    elements.errorAlert.classList.add('hidden');
  }
  
  // Sauvegarde localStorage
  try {
    const data = JSON.parse(localStorage.getItem('provider-signup-data') || '{}');
    data.operational_countries = window.selectedCountries;
    localStorage.setItem('provider-signup-data', JSON.stringify(data));
  } catch (e) {
    console.warn('localStorage not available:', e.message);
  }
  
  // ✅ Notifier wizard-steps.js
  if (typeof window.updateNavigationButtons === 'function') {
    window.updateNavigationButtons();
  }
};

/**
 * Validation du step (accessible globalement)
 * Vérifie qu'au moins un pays est sélectionné
 */
window.validateStep6 = function() {
  const elements = getCachedElementsStep6();
  
  if (!window.selectedCountries || window.selectedCountries.length === 0) {
    // Afficher l'erreur avec animation shake
    if (elements.errorAlert) {
      elements.errorAlert.classList.remove('hidden');
      elements.errorAlert.classList.add('shake-animation');
      setTimeout(() => {
        elements.errorAlert.classList.remove('shake-animation');
      }, 500);
    }
    return false;
  }
  
  return true;
};

/**
 * Fonction de debounce pour optimiser la recherche
 * Évite les calculs inutiles pendant la frappe
 */
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

/**
 * Initialisation au chargement du DOM
 * Utilise event delegation et passive listeners pour performance
 */
document.addEventListener('DOMContentLoaded', function() {
  const elements = getCachedElementsStep6();
  const container = document.querySelector('#step6');
  
  if (!container) return;
  
  /* ==========================================
     EVENT DELEGATION (optimisation CPU)
     Un seul listener au lieu de 30+ listeners
     ========================================== */
  container.addEventListener('click', function(e) {
    const card = e.target.closest('.country-card');
    if (card) {
      const country = card.getAttribute('data-country');
      window.toggleCountrySelection(country);
    }
  }, { passive: true });
  
  /* ==========================================
     SUPPORT CLAVIER (Accessibilité)
     ========================================== */
  container.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      const card = e.target.closest('.country-card');
      if (card) {
        e.preventDefault();
        const country = card.getAttribute('data-country');
        window.toggleCountrySelection(country);
      }
    }
  });
  
  /* ==========================================
     SEARCH INPUT (avec debounce)
     Optimisation: 150ms de délai + RAF
     ========================================== */
  if (elements.searchInput) {
    const performSearch = debounce(function(searchValue) {
      const search = searchValue.toLowerCase();
      
      // Utiliser requestAnimationFrame pour éviter layout thrashing
      requestAnimationFrame(() => {
        elements.cards.forEach(card => {
          const country = card.getAttribute('data-country').toLowerCase();
          card.style.display = country.includes(search) ? '' : 'none';
        });
      });
    }, 150); // Debounce de 150ms
    
    elements.searchInput.addEventListener('input', function() {
      performSearch(this.value);
    }, { passive: true });
  }
  
  /* ==========================================
     MUTATION OBSERVER
     Détecte quand le step devient visible
     ========================================== */
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
        if (!container.classList.contains('hidden')) {
          // ✅ Notifier wizard-steps.js
          if (typeof window.updateNavigationButtons === 'function') {
            window.updateNavigationButtons();
          }
        }
      }
    });
  });
  
  observer.observe(container, { 
    attributes: true,
    attributeFilter: ['class']
  });
  
  /* ==========================================
     RESTAURATION DEPUIS LOCALSTORAGE
     Avec requestAnimationFrame pour éviter blocking
     ========================================== */
  try {
    const data = JSON.parse(localStorage.getItem('provider-signup-data') || '{}');
    
    if (data.operational_countries && Array.isArray(data.operational_countries)) {
      window.selectedCountries = data.operational_countries;
      
      // Utiliser RAF pour éviter layout thrashing
      requestAnimationFrame(() => {
        window.selectedCountries.forEach(country => {
          const card = Array.from(elements.cards).find(c => 
            c.getAttribute('data-country') === country
          );
          if (card) {
            card.classList.add('selected');
            card.setAttribute('aria-checked', 'true');
          }
        });
        
        // Mise à jour du compteur
        if (elements.selectedCount) {
          elements.selectedCount.textContent = window.selectedCountries.length;
        }
        
        // ✅ Notifier wizard-steps.js
        if (typeof window.updateNavigationButtons === 'function') {
          window.updateNavigationButtons();
        }
      });
    }
  } catch (e) {
    console.warn('Could not restore selection:', e.message);
  }
});

/* ==========================================
   💡 OPTIMISATIONS NOTES:
   
   1. Event Delegation: 1 listener au lieu de 30+
   2. Passive Listeners: Améliore scroll performance
   3. RAF (requestAnimationFrame): Évite layout thrashing
   4. Debouncing: Optimise la recherche (150ms)
   5. Cache DOM: Évite querySelectorAll répétés
   6. CSS Containment: Isole les calculs de layout
   7. GPU Acceleration: translateZ(0) + backface-visibility
   8. Will-change: Optimise les propriétés animées
   9. MutationObserver: Détection efficace de visibilité
   10. Intégration wizard-steps.js: Coordination parfaite
   ========================================== */
</script>