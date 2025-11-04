<!-- 
============================================
🚀 STEP 1 - VERSION COMPACTE 2025/2026
============================================
✨ Design System avec différenciation des profils
📏 Optimisé pour popup sans scrolle
🔗 Redirection vers ulixai.com/signup
============================================
-->

<div id="step1" class="space-y-3 relative" role="region" aria-label="Choose your service">
  
  <!-- Ambient Background Effects - réduits -->
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-0 -left-4 w-48 h-48 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-15 animate-blob"></div>
    <div class="absolute -bottom-4 right-0 w-48 h-48 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-15 animate-blob animation-delay-2000"></div>
  </div>

  <!-- Card 1: Inscription Multi-Profils (Non-Providers) - Compact -->
  <article class="group relative">
    <a 
      href="/signup"
      class="modern-card modern-card-users w-full text-left overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:scale-[1.01] active:scale-[0.99] focus:outline-none focus:ring-4 focus:ring-purple-500/50 focus:ring-offset-2 block"
      role="button"
      aria-label="Join UlixAI community - Create account">
      
      <!-- Animated gradient background - Purple/Pink theme -->
      <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-fuchsia-500 to-pink-600 animate-gradient"></div>
      
      <!-- Glossy overlay -->
      <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      
      <!-- Content - Compact padding -->
      <div class="relative z-10 p-4">
        <!-- Top section: Icon + Title compact -->
        <div class="flex items-center justify-between mb-3">
          <div class="flex items-center gap-3 flex-1 min-w-0">
            <!-- Icon compact -->
            <div class="flex-shrink-0">
              <div class="w-11 h-11 bg-gradient-to-br from-purple-500 via-fuchsia-600 to-pink-600 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-white/30 transform group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            
            <!-- Title compact -->
            <div class="flex-1 min-w-0">
              <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                Join Us! 🌟
              </h2>
              <p class="text-sm font-medium text-purple-100 mt-0.5">
                Instant registration
              </p>
            </div>
          </div>
          
          <!-- Badge -->
          <span class="flex-shrink-0 px-2.5 py-1 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-full text-xs font-bold shadow-lg">
            ✨ FREE
          </span>
        </div>
        
        <!-- Description compact -->
        <div class="mb-3">
          <p class="text-sm text-purple-50 leading-relaxed">
            <strong class="text-white">Requesters</strong>, 
            <strong class="text-white">Influencers</strong>, 
            <strong class="text-white">Ambassadors</strong>, 
            <strong class="text-white">Associations</strong>, 
            <strong class="text-white">YouTubers</strong>, 
            <strong class="text-white">TikTokers</strong>, 
            <strong class="text-white">Expats</strong> 🌍✨
          </p>
        </div>
        
        <!-- Séparateur avec indication -->
        <div class="mb-3 pb-3 border-b border-white/20">
          <p class="text-xs text-purple-100 text-center italic">
            💼 Want to become a <strong>provider</strong>? Click on the blue block 💙
          </p>
        </div>
        
        <!-- CTA Button compact -->
        <div class="cta-button cta-button-users">
          <span class="font-bold text-sm">CREATE MY ACCOUNT</span>
          <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </div>
      </div>
      
      <!-- Shimmer effect -->
      <div class="shimmer"></div>
    </a>
  </article>

  <!-- Card 2: Providers (Prestataires) - Compact -->
  <article class="group relative">
    <button 
      type="button"
      id="whiteCardBtn"
      class="modern-card modern-card-providers w-full text-left overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:scale-[1.01] active:scale-[0.99] focus:outline-none focus:ring-4 focus:ring-blue-500/50 focus:ring-offset-2 pointer-events-auto cursor-pointer"
      role="button"
      aria-label="Become a service provider"
      onclick="(function(){try{if(window.showStep){window.showStep(1);}else{var s1=document.getElementById('step1'),s2=document.getElementById('step2');if(s1&&s2){s1.classList.add('hidden');s2.classList.remove('hidden');}}if(typeof window.updateNavigationButtons==='function'){window.updateNavigationButtons();}if(typeof window.updateHeaderButtons==='function'){window.updateHeaderButtons();}}catch(e){console&&console.warn&&console.warn('whiteCardBtn fallback:',e);}})();">
      
      <!-- Gradient border effect - Blue/Cyan theme -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 animate-gradient-slow"></div>
      <div class="absolute inset-[3px] bg-white rounded-[18px]"></div>
      
      <!-- Glossy overlay -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[21px]"></div>
      
      <!-- Content - Compact padding -->
      <div class="relative z-10 p-4">
        <!-- Top section: Icon + Title compact -->
        <div class="flex items-center justify-between mb-3">
          <div class="flex items-center gap-3 flex-1 min-w-0">
            <!-- Icon compact -->
            <div class="flex-shrink-0">
              <div class="w-11 h-11 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-blue-200/50 transform group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            
            <!-- Title compact -->
            <div class="flex-1 min-w-0">
              <h2 class="text-2xl sm:text-3xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent tracking-tight">
                Become a Provider! 💼
              </h2>
              <p class="text-sm font-medium text-gray-600 mt-0.5">
                Generate income
              </p>
            </div>
          </div>
          
          <!-- Badge -->
          <span class="flex-shrink-0 px-2.5 py-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full text-xs font-bold shadow-lg">
            💵 EARN
          </span>
        </div>
        
        <!-- Description compact -->
        <div class="mb-3">
          <p class="text-sm text-gray-900 leading-relaxed">
            Transform your <strong class="text-blue-600">local expertise</strong> into income. 
            Help expats and earn money! ✨
          </p>
        </div>
        
        <!-- CTA Button compact -->
        <div class="cta-button-providers">
          <span class="font-bold text-sm">BECOME A PROVIDER</span>
          <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </div>
      </div>
      
      <!-- Shimmer effect -->
      <div class="shimmer shimmer-secondary"></div>
    </button>
  </article>
  
</div>

<style>
/* ============================================
   🎨 DESIGN SYSTEM - DIFFERENTIATION DES PROFILS
   ============================================ */

/* CARDS - Version compacte */
.modern-card {
  position: relative;
  border-radius: 20px;
  cursor: pointer;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
  will-change: transform;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Card Users (Purple/Pink) */
.modern-card-users {
  box-shadow: 0 15px 35px -10px rgba(168, 85, 247, 0.4);
  border: 2px solid #c084fc;
}

.modern-card-users:hover {
  box-shadow: 0 25px 50px -12px rgba(168, 85, 247, 0.6);
}

/* Card Providers (Blue/Cyan) */
.modern-card-providers {
  box-shadow: 0 15px 35px -10px rgba(59, 130, 246, 0.3);
}

.modern-card-providers:hover {
  box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
}

/* GRADIENTS - Specs exactes */
@keyframes gradient {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.animate-gradient {
  background-size: 200% 200%;
  animation: gradient 6s ease infinite;
}

@keyframes gradient-slow {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.animate-gradient-slow {
  background-size: 300% 300%;
  animation: gradient-slow 15s ease infinite;
}

/* SHIMMER EFFECT */
@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

.shimmer {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, 
    transparent 0%, 
    rgba(255, 255, 255, 0.3) 50%, 
    transparent 100%
  );
  animation: shimmer 3s infinite;
  pointer-events: none;
}

.shimmer-secondary {
  background: linear-gradient(90deg, 
    transparent 0%, 
    rgba(59, 130, 246, 0.1) 50%, 
    transparent 100%
  );
}

/* CTA BUTTONS - Users (Purple theme) */
.cta-button-users {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1.25rem;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 14px;
  color: rgb(147, 51, 234);
  box-shadow: 0 8px 20px -8px rgba(168, 85, 247, 0.4);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid rgba(255, 255, 255, 0.5);
}

.cta-button-users:hover {
  transform: translateY(-1px);
  box-shadow: 0 15px 30px -8px rgba(168, 85, 247, 0.5);
}

/* CTA BUTTONS - Providers (Blue theme) */
.cta-button-providers {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1.25rem;
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  border-radius: 14px;
  color: white;
  box-shadow: 0 8px 20px -8px rgba(59, 130, 246, 0.5);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.cta-button-providers:hover {
  transform: translateY(-1px);
  box-shadow: 0 15px 30px -8px rgba(59, 130, 246, 0.6);
}

/* ============================================
   🎭 ANIMATIONS COMPACTES
   ============================================ */

@keyframes blob {
  0%, 100% { transform: translate(0, 0) scale(1); }
  33% { transform: translate(20px, -30px) scale(1.05); }
  66% { transform: translate(-15px, 15px) scale(0.95); }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

/* ============================================
   📱 RESPONSIVE
   ============================================ */

@media (max-width: 640px) {
  .modern-card {
    padding: 0.75rem;
    border-radius: 16px;
  }
  
  .cta-button-users,
  .cta-button-providers {
    padding: 0.625rem 1rem;
  }
}

/* ============================================
   ♿ ACCESSIBILITY
   ============================================ */

@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

@media (prefers-contrast: high) {
  .modern-card {
    border: 3px solid currentColor;
  }
}

@media (prefers-color-scheme: dark) {
  .modern-card-providers .absolute.inset-\[3px\] {
    background: #1a1a1a;
  }
}

/* ============================================
   ⚡ PERFORMANCE
   ============================================ */

.modern-card,
.shimmer {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

.modern-card {
  contain: layout style paint;
}
</style>

<script>
// ============================================
// 🛡️ SCRIPT DE SECOURS POUR whiteCardBtn
// ============================================
document.addEventListener('DOMContentLoaded', function(){
  var btn = document.getElementById('whiteCardBtn');
  if (!btn) return;
  
  // Éviter la double liaison
  if (btn.__ulixaiBound) return;
  btn.__ulixaiBound = true;
  
  // Attacher le listener de secours
  btn.addEventListener('click', function(e) {
    if (window.showStep) {
      e.preventDefault();
      window.showStep(1);
    }
  });
});
</script>