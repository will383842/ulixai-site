{{--
  ═══════════════════════════════════════════════════════════
  WIZARD NAVIGATION BUTTONS - STYLES CSS
  ═══════════════════════════════════════════════════════════
  Global styles for wizard navigation buttons
  Used by: Provider wizard, Requester wizard
  
  These styles are included in the header for optimal performance
  (loaded once for all wizards)
  
  @version 2.1.0
  @updated 2025-01-08 - Nouvelle charte graphique ULIXAI
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
      padding: 12px 20px 12px 12px; /* ✨ Padding-right augmenté à 20px pour éviter que le bouton touche le bord */
      display: flex; 
      gap: 16px; /* ✨ GAP AUGMENTÉ (12px → 16px) pour éviter que les boutons se touchent */
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
      z-index: 60; 
      backdrop-filter: blur(8px);
    }
    
    #mobileNavButtons button { 
      flex: 1; 
      height: 48px; 
      border-radius: 24px; /* ✨ PLUS ARRONDI (16px → 24px) */
      font-weight: 600; 
      font-size: 15px; 
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); 
      display: flex; 
      align-items: center; 
      justify-content: center; 
      gap: 8px; 
    }
    
    /* ✨ BOUTON BACK - TEXTE EN BLEU */
    #mobileNavButtons .btn-back { 
      background: white; 
      color: #1E40AF; /* ✨ BLEU ROI CHIC */
      border: 2px solid #e2e8f0; 
      flex: 0.65; /* ✨ Réduit pour laisser plus d'espace */
    }
    
    #mobileNavButtons .btn-back:active { 
      background: #f8fafc; 
      transform: scale(0.98); 
    }
    
    /* ✨ BOUTON NEXT - BLEU MARINE PROFOND ET CHIC */
    #mobileNavButtons .btn-next { 
      background: #1E3A8A; /* ✨ BLEU MARINE - profond et chic */
      color: white; 
      border: none; 
      box-shadow: 0 4px 12px rgba(30, 58, 138, 0.45); 
      flex: 0.85; /* ✨ Réduit (0.9 → 0.85) pour ne pas toucher le bord */
    }
    
    #mobileNavButtons .btn-next:active { 
      transform: scale(0.98); 
      box-shadow: 0 2px 8px rgba(30, 58, 138, 0.35); 
    }
    
    /* ✨ ÉTAT DISABLED - GRIS PLUS VISIBLE */
    #mobileNavButtons .btn-next:disabled { 
      background: #B8B8B8; /* ✨ GRIS PLUS CONTRASTÉ (au lieu du gradient gris clair) */
      color: #6B7280; /* ✨ Texte gris foncé pour meilleure lisibilité */
      box-shadow: none; 
      opacity: 1; /* ✨ Pas d'opacité réduite pour garder la visibilité */
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
      border-radius: 24px; /* ✨ PLUS ARRONDI (16px → 24px) */
      font-weight: 600; 
      font-size: 15px; 
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
      display: inline-flex; 
      align-items: center; 
      gap: 8px; 
    }
    
    /* ✨ BOUTON BACK - TEXTE EN BLEU */
    #desktopNavButtons .btn-back { 
      background: white; 
      color: #1E40AF; /* ✨ BLEU ROI CHIC */
      border: 2px solid #e2e8f0; 
    }
    
    #desktopNavButtons .btn-back:hover { 
      background: #EFF6FF; /* ✨ Fond bleu très clair au hover */
      border-color: #1E40AF; /* ✨ Bordure bleu CHIC */
      transform: translateY(-2px); 
      box-shadow: 0 4px 8px rgba(30, 64, 175, 0.15); 
    }
    
    #desktopNavButtons .btn-back:active { 
      transform: translateY(0); 
    }
    
    /* ✨ BOUTON NEXT - BLEU MARINE PROFOND ET CHIC */
    #desktopNavButtons .btn-next { 
      background: #1E3A8A; /* ✨ BLEU MARINE - profond et chic */
      color: white; 
      border: none; 
      box-shadow: 0 4px 12px rgba(30, 58, 138, 0.45); 
    }
    
    #desktopNavButtons .btn-next:hover { 
      background: #1E40AF; /* ✨ Version plus lumineuse au hover (Bleu Roi) */
      transform: translateY(-2px); 
      box-shadow: 0 6px 16px rgba(30, 58, 138, 0.55); 
    }
    
    #desktopNavButtons .btn-next:active { 
      transform: translateY(0); 
    }
    
    /* ✨ ÉTAT DISABLED - GRIS PLUS VISIBLE */
    #desktopNavButtons .btn-next:disabled { 
      background: #B8B8B8; /* ✨ GRIS PLUS CONTRASTÉ */
      color: #6B7280; /* ✨ Texte gris foncé */
      box-shadow: none; 
      opacity: 1; /* ✨ Pas d'opacité réduite */
      cursor: not-allowed; 
      transform: none; 
    }
    
    #desktopNavButtons .btn-next:disabled:hover { 
      transform: none; 
      background: #B8B8B8; /* ✨ Pas de changement au hover */
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