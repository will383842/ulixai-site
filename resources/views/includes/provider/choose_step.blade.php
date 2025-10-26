<!-- 
============================================
🚀 STEP 1 - VERSION REFONDÉE 2025/2026
============================================
✨ Design System Blue/Cyan/Teal STRICT
🎨 Palette de couleurs unifiée
💎 Respect total des spécifications
⚡ Toutes fonctionnalités préservées
============================================
-->

<div id="step1" class="space-y-4 sm:space-y-5 relative" role="region" aria-label="Choose your service">
  
  <!-- Ambient Background Effects - 3 blobs animés -->
  <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none" aria-hidden="true">
    <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
  </div>

  <!-- Card 1: I Need Help - Premium Blue/Cyan Gradient -->
  <article class="group relative">
    <button 
      type="button"
      onclick="openHelpPopup()" 
      class="modern-card modern-card-primary w-full text-left overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-blue-500/50 focus:ring-offset-2"
      role="button"
      aria-label="Request urgent help - Open help request form">
      
      <!-- Animated gradient background - Gradient header exact -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-cyan-500 to-teal-600 animate-gradient"></div>
      
      <!-- Glossy overlay -->
      <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      
      <!-- Sparkle effect on hover -->
      <div class="sparkle-container">
        <div class="sparkle"></div>
        <div class="sparkle"></div>
        <div class="sparkle"></div>
      </div>
      
      <!-- Content - Padding p-6 exact -->
      <div class="relative z-10 p-6">
        <!-- Top section: Icon + Badge -->
        <div class="flex items-start justify-between mb-8 pb-4 border-b border-white/20">
          <div class="flex items-center gap-4 flex-1 min-w-0">
            <!-- Animated Icon - Badge w-14 h-14 rounded-2xl exact -->
            <div class="icon-container flex-shrink-0">
              <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-2 ring-white/30 transform group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-7 h-7 text-white animate-pulse-subtle" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10" class="animate-draw-circle"/>
                  <path d="M12 8v4m0 4h.01" stroke-linecap="round"/>
                </svg>
              </div>
            </div>
            
            <!-- Title & Subtitle - Header exact: text-3xl sm:text-4xl font-black -->
            <div class="flex-1 min-w-0">
              <h2 class="text-3xl sm:text-4xl font-black text-white mb-1 tracking-tight transform group-hover:translate-x-1 transition-transform duration-300">
                I Need Help! 🆘
              </h2>
              <!-- Sous-titre exact: text-base sm:text-lg font-semibold text-gray-600 -->
              <p class="text-base sm:text-lg font-semibold text-gray-600 flex items-center gap-2">
                <span class="inline-block w-2 h-2 bg-green-400 rounded-full animate-ping-slow"></span>
                <span class="text-blue-100">Instant worldwide assistance</span>
              </p>
            </div>
          </div>
          
          <!-- Animated Badge -->
          <span class="flex-shrink-0 px-3 py-1.5 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-full text-xs font-black shadow-lg shadow-orange-500/50 animate-bounce-subtle">
            ⚡ LIVE
          </span>
        </div>
        
        <!-- Description - Corps de texte exact: text-sm sm:text-base -->
        <div class="mb-4">
          <p class="text-sm sm:text-base text-blue-50 leading-relaxed mb-3">
            Get <strong class="text-white">instant help</strong> from verified assistants in 
            <strong class="text-white">197 countries</strong> 
            <span class="inline-block animate-wave">🌍</span>
          </p>
          
          <!-- Feature pills - Gap exact: gap-4 -->
          <div class="flex flex-wrap gap-4">
            <span class="feature-pill">⚡ Fast response</span>
            <span class="feature-pill">✅ Verified helpers</span>
            <span class="feature-pill">🔒 Secure</span>
          </div>
        </div>
        
        <!-- CTA Button -->
        <div class="cta-button group-hover:shadow-xl group-hover:shadow-white/20 transition-shadow duration-300">
          <span class="font-bold text-base tracking-wide">CREATE MY REQUEST</span>
          <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </div>
      </div>
      
      <!-- Shimmer effect -->
      <div class="shimmer"></div>
    </button>
  </article>

  <!-- Card 2: Help Expats - Premium Blue/Cyan/Teal Border -->
  <article class="group relative">
    <button 
      type="button"
      id="whiteCardBtn"
      class="modern-card modern-card-secondary w-full text-left overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] active:scale-[0.98] focus:outline-none focus:ring-4 focus:ring-blue-500/50 focus:ring-offset-2"
      role="button"
      aria-label="Become a service provider - Help expats and earn income">
      
      <!-- Gradient border effect exact -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 animate-gradient-slow"></div>
      <div class="absolute inset-[3px] bg-white rounded-[20px]"></div>
      
      <!-- Glossy overlay -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[23px]"></div>
      
      <!-- Sparkle effect on hover -->
      <div class="sparkle-container">
        <div class="sparkle sparkle-blue"></div>
        <div class="sparkle sparkle-blue"></div>
        <div class="sparkle sparkle-blue"></div>
      </div>
      
      <!-- Content - Padding p-6 exact -->
      <div class="relative z-10 p-6">
        <!-- Top section: Icon + Badge -->
        <div class="flex items-start justify-between mb-8 pb-4 border-b border-gray-100">
          <div class="flex items-center gap-4 flex-1 min-w-0">
            <!-- Animated Icon - Badge w-14 h-14 rounded-2xl exact -->
            <div class="icon-container flex-shrink-0">
              <div class="w-14 h-14 bg-gradient-to-br from-blue-500 via-cyan-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-2 ring-blue-200/50 transform group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-7 h-7 text-white animate-pulse-subtle" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10"/>
                  <path d="M8 12l2 2 4-4" stroke-linecap="round"/>
                </svg>
              </div>
            </div>
            
            <!-- Title & Subtitle - Header exact: text-3xl sm:text-4xl font-black -->
            <div class="flex-1 min-w-0">
              <h2 class="text-3xl sm:text-4xl font-black bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 bg-clip-text text-transparent mb-1 tracking-tight transform group-hover:translate-x-1 transition-transform duration-300">
                Help Expats & Travelers! 💰
              </h2>
              <!-- Sous-titre exact: text-base sm:text-lg font-semibold text-gray-600 -->
              <p class="text-base sm:text-lg font-semibold text-gray-600 flex items-center gap-4">
                <span class="inline-block w-2 h-2 bg-green-500 rounded-full animate-ping-slow"></span>
                <span>Earn income helping others</span>
              </p>
            </div>
          </div>
          
          <!-- Animated Badge -->
          <span class="flex-shrink-0 px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full text-xs font-black shadow-lg shadow-green-500/50 animate-bounce-subtle">
            💵 EARN
          </span>
        </div>
        
        <!-- Description - Corps de texte exact: text-sm sm:text-base, text-gray-900 -->
        <div class="mb-4">
          <p class="text-sm sm:text-base text-gray-900 leading-relaxed mb-3">
            Transform your <strong class="text-blue-600">local expertise</strong> into income while helping foreigners 
            <span class="inline-block animate-wave">✨</span>
          </p>
          
          <!-- Feature pills - Gap exact: gap-4 -->
          <div class="flex flex-wrap gap-4">
            <span class="feature-pill-secondary">💼 Flexible hours</span>
            <span class="feature-pill-secondary">📈 Good income</span>
            <span class="feature-pill-secondary">🌟 Be a hero</span>
          </div>
        </div>
        
        <!-- CTA Button -->
        <div class="cta-button-secondary group-hover:shadow-xl group-hover:shadow-blue-500/20 transition-shadow duration-300">
          <span class="font-bold text-base tracking-wide">START HELPING NOW</span>
          <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
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
   🎨 DESIGN SYSTEM STRICT (2025/2026)
   Palette: Blue/Cyan/Teal uniquement
   ============================================ */

/* CARDS - Specs exactes du design system */
.modern-card {
  position: relative;
  border-radius: 24px; /* rounded-2xl exact */
  padding: 1.5rem; /* p-6 exact */
  cursor: pointer;
  touch-action: manipulation;
  -webkit-tap-highlight-color: transparent;
  will-change: transform;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* transition-all duration-300 exact */
}

/* Card Primary - Border et Shadow exacts */
.modern-card-primary {
  box-shadow: 
    0 20px 50px -12px rgba(59, 130, 246, 0.4); /* shadow-lg exact */
  border: 2px solid #60a5fa; /* border-2 border-blue-400 exact */
}

.modern-card:hover {
  box-shadow: 
    0 25px 60px -12px rgba(59, 130, 246, 0.5); /* hover:shadow-xl exact */
}

/* Card Secondary - Border et Shadow exacts */
.modern-card-secondary {
  box-shadow: 
    0 20px 50px -12px rgba(8, 145, 178, 0.3); /* shadow-lg exact */
  border: 2px solid #60a5fa; /* border-2 border-blue-400 exact */
}

/* ============================================
   ✨ ANIMATED GRADIENTS - Specs exactes
   ============================================ */

@keyframes gradient {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.animate-gradient {
  background-size: 200% 200%;
  animation: gradient 8s ease infinite;
}

.animate-gradient-slow {
  background-size: 200% 200%;
  animation: gradient 15s ease infinite;
}

/* ============================================
   ✨ SPARKLE EFFECTS
   ============================================ */

.sparkle-container {
  position: absolute;
  inset: 0;
  overflow: hidden;
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.5s;
}

.group:hover .sparkle-container {
  opacity: 1;
}

.sparkle {
  position: absolute;
  width: 3px;
  height: 3px;
  background: white;
  border-radius: 50%;
  box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.8);
  animation: sparkle-float 3s ease-in-out infinite;
}

.sparkle:nth-child(1) {
  top: 20%;
  left: 20%;
  animation-delay: 0s;
}

.sparkle:nth-child(2) {
  top: 60%;
  left: 80%;
  animation-delay: 1s;
}

.sparkle:nth-child(3) {
  top: 80%;
  left: 40%;
  animation-delay: 2s;
}

.sparkle-blue {
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%);
  box-shadow: 0 0 10px 2px rgba(59, 130, 246, 0.8);
}

@keyframes sparkle-float {
  0%, 100% {
    transform: translateY(0) scale(0);
    opacity: 0;
  }
  50% {
    transform: translateY(-20px) scale(1);
    opacity: 1;
  }
}

/* ============================================
   ✨ SHIMMER EFFECT
   ============================================ */

.shimmer {
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.1),
    transparent
  );
  transform: rotate(45deg);
  animation: shimmer 3s infinite;
  pointer-events: none;
}

.shimmer-secondary {
  background: linear-gradient(
    90deg,
    transparent,
    rgba(59, 130, 246, 0.1),
    transparent
  );
}

@keyframes shimmer {
  0% {
    transform: translateX(-100%) rotate(45deg);
  }
  100% {
    transform: translateX(100%) rotate(45deg);
  }
}

/* ============================================
   🏷️ FEATURE PILLS - Gradient primaire exact
   ============================================ */

.feature-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.375rem 0.75rem;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(10px);
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 600;
  color: white;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: all 0.3s;
}

.feature-pill:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
}

.feature-pill-secondary {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.375rem 0.75rem;
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%); /* Gradient primaire exact */
  backdrop-filter: blur(10px);
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 600;
  color: white;
  border: 1px solid rgba(59, 130, 246, 0.2);
  transition: all 0.3s;
  opacity: 0.9;
}

.feature-pill-secondary:hover {
  opacity: 1;
  transform: translateY(-2px);
}

/* ============================================
   🚀 CTA BUTTONS - Specs exactes
   ============================================ */

.cta-button {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.5rem; /* px-6 py-3 convertis */
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 16px; /* rounded-2xl exact */
  color: rgb(37, 99, 235); /* text-blue-600 */
  box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.3);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid rgba(255, 255, 255, 0.5); /* border-2 */
}

.cta-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.4);
}

.cta-button-secondary {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.5rem; /* px-6 py-3 convertis */
  background: linear-gradient(135deg, #3b82f6 0%, #0891b2 100%); /* Gradient primaire exact */
  border-radius: 16px; /* rounded-2xl exact */
  color: white;
  box-shadow: 0 10px 30px -10px rgba(59, 130, 246, 0.5);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid rgba(255, 255, 255, 0.3); /* border-2 */
}

.cta-button-secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.6);
}

/* ============================================
   🎭 ANIMATIONS - Float et autres
   ============================================ */

/* Animation Float - Specs exactes */
@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-8px); /* -8px exact comme spécifié */
  }
}

/* Animation Blob - Pour ambient background */
@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
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

/* Pulse Subtle */
@keyframes pulse-subtle {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.7;
  }
}

.animate-pulse-subtle {
  animation: pulse-subtle 3s ease-in-out infinite;
}

/* Bounce Subtle */
@keyframes bounce-subtle {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
}

.animate-bounce-subtle {
  animation: bounce-subtle 2s ease-in-out infinite;
}

/* Ping Slow */
@keyframes ping-slow {
  75%, 100% {
    transform: scale(2);
    opacity: 0;
  }
}

.animate-ping-slow {
  animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite;
}

/* Wave Animation */
@keyframes wave {
  0%, 100% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(-20deg);
  }
  75% {
    transform: rotate(20deg);
  }
}

.animate-wave {
  display: inline-block;
  animation: wave 2s ease-in-out infinite;
  transform-origin: 70% 70%;
}

/* Draw Circle */
@keyframes draw-circle {
  0% {
    stroke-dasharray: 0 100;
  }
  100% {
    stroke-dasharray: 100 0;
  }
}

.animate-draw-circle {
  stroke-dasharray: 100;
  animation: draw-circle 2s ease-in-out infinite;
}

/* ============================================
   📱 RESPONSIVE OPTIMIZATIONS
   ============================================ */

@media (max-width: 640px) {
  .modern-card {
    padding: 1rem;
    border-radius: 20px;
  }
  
  .feature-pill,
  .feature-pill-secondary {
    font-size: 0.7rem;
    padding: 0.25rem 0.625rem;
  }
  
  .cta-button,
  .cta-button-secondary {
    padding: 0.875rem 1.25rem;
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

/* High contrast mode */
@media (prefers-contrast: high) {
  .modern-card {
    border: 3px solid currentColor;
  }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  .modern-card-secondary .absolute.inset-\[3px\] {
    background: #1a1a1a;
  }
}

/* ============================================
   ⚡ PERFORMANCE OPTIMIZATIONS
   ============================================ */

/* GPU acceleration */
.modern-card,
.icon-container > div,
.sparkle,
.shimmer {
  transform: translateZ(0);
  backface-visibility: hidden;
  perspective: 1000px;
}

/* Reduce repaints */
.modern-card {
  contain: layout style paint;
}
</style>