{{--
  ═══════════════════════════════════════════════════════════
  WIZARD NAVIGATION BUTTONS - STYLES CSS
  ═══════════════════════════════════════════════════════════
  Global styles for wizard navigation buttons
  Used by: Provider wizard, Requester wizard
  
  These styles are included in the header for optimal performance
  (loaded once for all wizards)
--}}

<style>
  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 WIZARD CONTENT AREA
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  /* Smooth scrolling */
  #popupContentArea { 
    scroll-behavior: smooth; 
    -webkit-overflow-scrolling: touch; 
  }

  /* Custom scrollbar for desktop */
  @media (min-width: 640px) {
    #popupContentArea::-webkit-scrollbar { width: 8px; }
    #popupContentArea::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #popupContentArea::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    #popupContentArea::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
  }

  /* Backdrop blur effect for mobile header */
  @supports (backdrop-filter: blur(12px)) {
    @media (max-width: 639px) {
      .backdrop-blur-sm { backdrop-filter: blur(12px); }
    }
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 ANIMATIONS
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  /* Animation shake for validation errors */
  @keyframes shake { 
    0%, 100% { transform: translateX(0); } 
    25% { transform: translateX(-10px); } 
    75% { transform: translateX(10px); } 
  }
  .shake { animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97); }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 NAVIGATION BUTTONS - MOBILE
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  /* Mobile: Fixed Bottom Navigation */
  @media (max-width: 639px) {
    #mobileNavButtons {
      position: fixed; 
      bottom: 0; 
      left: 0; 
      right: 0;
      background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
      padding: 12px; 
      display: flex; 
      gap: 12px; 
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
      z-index: 60; 
      backdrop-filter: blur(8px);
    }
    
    #mobileNavButtons button { 
      flex: 1; 
      height: 48px; 
      border-radius: 16px; /* ✨ PLUS ARRONDI (12px → 16px) */
      font-weight: 600; 
      font-size: 15px; 
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      gap: 8px; 
    }
    
    #mobileNavButtons .btn-back { 
      background: white; 
      color: #3b82f6; /* ✨ TEXTE EN BLEU (#64748b → #3b82f6) */
      border: 2px solid #e2e8f0; 
      flex: 0.8; 
    }
    
    #mobileNavButtons .btn-back:active { 
      background: #f8fafc; 
      transform: scale(0.98); 
    }
    
    #mobileNavButtons .btn-next { 
      background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%); /* ✨ PLUS FONCÉ (bleu plus sombre) */
      color: white; 
      border: none; 
      box-shadow: 0 4px 12px rgba(29, 78, 216, 0.4); /* ✨ Ombre ajustée */
    }
    
    #mobileNavButtons .btn-next:active { 
      transform: scale(0.98); 
      box-shadow: 0 2px 8px rgba(29, 78, 216, 0.3); 
    }
    
    #mobileNavButtons .btn-next:disabled { 
      background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%); /* ✨ GRIS QUAND INACTIF */
      box-shadow: none; 
      opacity: 0.6; 
      cursor: not-allowed;
    }
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 NAVIGATION BUTTONS - DESKTOP
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  /* Desktop: In-Flow Navigation */
  @media (min-width: 640px) {
    #desktopNavButtons {
      position: sticky; 
      bottom: 0; 
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
      gap: 16px;
      margin-top: 16px; 
      padding: 12px 0; 
      background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
      backdrop-filter: blur(8px); 
      border-top: 1px solid #e5e7eb; 
      z-index: 60;
    }
    
    #desktopNavButtons button { 
      padding: 12px 32px; 
      border-radius: 16px; /* ✨ PLUS ARRONDI (12px → 16px) */
      font-weight: 600; 
      font-size: 15px; 
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
      display: inline-flex; 
      align-items: center; 
      gap: 8px; 
    }
    
    #desktopNavButtons .btn-back { 
      background: white; 
      color: #3b82f6; /* ✨ TEXTE EN BLEU (#64748b → #3b82f6) */
      border: 2px solid #e2e8f0; 
    }
    
    #desktopNavButtons .btn-back:hover { 
      background: #eff6ff; /* ✨ Fond bleu clair au hover */
      border-color: #3b82f6; /* ✨ Bordure bleue au hover */
      transform: translateY(-2px); 
      box-shadow: 0 4px 8px rgba(59, 130, 246, 0.15); /* ✨ Ombre bleue */
    }
    
    #desktopNavButtons .btn-back:active { 
      transform: translateY(0); 
    }
    
    #desktopNavButtons .btn-next { 
      background: linear-gradient(135deg, #1d4ed8 0%, #1e3a8a 100%); /* ✨ PLUS FONCÉ (bleu plus sombre) */
      color: white; 
      border: none; 
      box-shadow: 0 4px 12px rgba(29, 78, 216, 0.4); /* ✨ Ombre ajustée */
    }
    
    #desktopNavButtons .btn-next:hover { 
      background: linear-gradient(135deg, #1e3a8a 0%, #172554 100%); /* ✨ Encore plus foncé au hover */
      transform: translateY(-2px); 
      box-shadow: 0 6px 16px rgba(29, 78, 216, 0.5); 
    }
    
    #desktopNavButtons .btn-next:active { 
      transform: translateY(0); 
    }
    
    #desktopNavButtons .btn-next:disabled { 
      background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%); /* ✨ GRIS QUAND INACTIF */
      box-shadow: none; 
      opacity: 0.6; 
      cursor: not-allowed; 
      transform: none; 
    }
    
    #desktopNavButtons .btn-next:disabled:hover { 
      transform: none; 
    }
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 BUTTON ICONS ANIMATIONS
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  .btn-back svg, 
  .btn-next svg { 
    transition: transform 0.3s ease; 
  }
  
  .btn-back:hover svg { 
    transform: translateX(-4px); 
  }
  
  .btn-next:hover svg { 
    transform: translateX(4px); 
  }
</style>