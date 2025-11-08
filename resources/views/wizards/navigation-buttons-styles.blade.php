{{--
  ═══════════════════════════════════════════════════════════
  WIZARD NAVIGATION BUTTONS - STYLES CSS
  ═══════════════════════════════════════════════════════════
  ⚡ VERSION PROPRE - Sans !important
  ✅ Le JavaScript ne touche JAMAIS au style
  ✅ Le JavaScript gère UNIQUEMENT btn.disabled = true/false
  ✅ Haute spécificité CSS pour éviter les conflits
  
  @version 3.1.0
  @updated 2025-01-08
  @change Ajout styles pour btn-specialties
--}}

<style>
  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 WIZARD CONTENT AREA
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  #popupContentArea { 
    scroll-behavior: smooth; 
    -webkit-overflow-scrolling: touch; 
  }

  @media (min-width: 640px) {
    #popupContentArea::-webkit-scrollbar { 
      width: 8px; 
    }
    #popupContentArea::-webkit-scrollbar-track { 
      background: #f1f5f9; 
      border-radius: 4px; 
    }
    #popupContentArea::-webkit-scrollbar-thumb { 
      background: #cbd5e1; 
      border-radius: 4px; 
    }
    #popupContentArea::-webkit-scrollbar-thumb:hover { 
      background: #94a3b8; 
    }
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 ANIMATIONS
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  @keyframes shake { 
    0%, 100% { transform: translateX(0); } 
    25% { transform: translateX(-10px); } 
    75% { transform: translateX(10px); } 
  }
  
  .shake { 
    animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97); 
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🎨 BASE STYLES - COMMUN MOBILE + DESKTOP
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  /* Tous les boutons - styles de base */
  div#mobileNavButtons button,
  div#desktopNavButtons button { 
    font-weight: 600; 
    font-size: 15px; 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    gap: 8px; 
    border: none;
    outline: none;
    position: relative;
  }

  /* Animations des icônes */
  div#mobileNavButtons button.btn-back svg,
  div#desktopNavButtons button.btn-back svg { 
    transition: transform 0.3s ease; 
  }
  
  div#mobileNavButtons button.btn-next svg,
  div#mobileNavButtons button.btn-specialties svg,
  div#desktopNavButtons button.btn-next svg,
  div#desktopNavButtons button.btn-specialties svg { 
    transition: transform 0.3s ease; 
  }
  
  div#mobileNavButtons button.btn-back:not(:disabled):hover svg,
  div#desktopNavButtons button.btn-back:not(:disabled):hover svg { 
    transform: translateX(-4px); 
  }
  
  div#mobileNavButtons button.btn-next:not(:disabled):hover svg,
  div#mobileNavButtons button.btn-specialties:not(:disabled):hover svg,
  div#desktopNavButtons button.btn-next:not(:disabled):hover svg,
  div#desktopNavButtons button.btn-specialties:not(:disabled):hover svg { 
    transform: translateX(4px); 
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     📱 MOBILE - FIXED BOTTOM NAVIGATION
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  @media (max-width: 639px) {
    div#mobileNavButtons {
      position: fixed; 
      bottom: 0; 
      left: 0; 
      right: 0;
      background: linear-gradient(to top, white 0%, white 85%, rgba(255,255,255,0.95) 100%);
      padding: 12px 20px 12px 12px;
      display: flex; 
      gap: 16px;
      box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.08);
      z-index: 60; 
      backdrop-filter: blur(8px);
    }
    
    div#mobileNavButtons button { 
      flex: 1; 
      height: 48px; 
      border-radius: 24px;
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON BACK - ENABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#mobileNavButtons button.btn-back:not(:disabled) { 
      background: white; 
      color: #1E40AF;
      border: 2px solid #e2e8f0; 
      flex: 0.65;
      cursor: pointer;
    }
    
    div#mobileNavButtons button.btn-back:not(:disabled):active { 
      background: #f8fafc; 
      transform: scale(0.98); 
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON NEXT - ENABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#mobileNavButtons button.btn-next:not(:disabled) { 
      background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
      color: white; 
      border: none;
      box-shadow: 0 4px 12px rgba(30, 58, 138, 0.45); 
      flex: 0.85;
      cursor: pointer;
    }
    
    div#mobileNavButtons button.btn-next:not(:disabled):active { 
      transform: scale(0.98); 
      box-shadow: 0 2px 8px rgba(30, 58, 138, 0.35); 
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON NEXT - DISABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#mobileNavButtons button.btn-next:disabled { 
      background: #9CA3AF;
      color: #374151;
      border: 2px solid #D1D5DB;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      cursor: not-allowed;
      flex: 0.85;
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON SPECIALTIES (Step 4) - ENABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#mobileNavButtons button.btn-specialties:not(:disabled) { 
      background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
      color: white; 
      border: none;
      box-shadow: 0 4px 12px rgba(147, 51, 234, 0.45); 
      flex: 0.85;
      cursor: pointer;
    }
    
    div#mobileNavButtons button.btn-specialties:not(:disabled):active { 
      transform: scale(0.98); 
      box-shadow: 0 2px 8px rgba(147, 51, 234, 0.35); 
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON SPECIALTIES - DISABLED (GRISÉ)
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#mobileNavButtons button.btn-specialties:disabled { 
      background: #9CA3AF;
      color: #374151;
      border: 2px solid #D1D5DB;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      cursor: not-allowed;
      flex: 0.85;
    }
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     🖥️ DESKTOP - STICKY BOTTOM NAVIGATION
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  @media (min-width: 640px) {
    div#desktopNavButtons {
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
    
    div#desktopNavButtons button { 
      padding: 12px 32px; 
      border-radius: 24px;
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON BACK - ENABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#desktopNavButtons button.btn-back:not(:disabled) { 
      background: white; 
      color: #1E40AF;
      border: 2px solid #e2e8f0;
      cursor: pointer;
    }
    
    div#desktopNavButtons button.btn-back:not(:disabled):hover { 
      background: #EFF6FF;
      border-color: #1E40AF;
      transform: translateY(-2px); 
      box-shadow: 0 4px 8px rgba(30, 64, 175, 0.15); 
    }
    
    div#desktopNavButtons button.btn-back:not(:disabled):active { 
      transform: translateY(0); 
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON NEXT - ENABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#desktopNavButtons button.btn-next:not(:disabled) { 
      background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
      color: white; 
      border: none;
      box-shadow: 0 4px 12px rgba(30, 58, 138, 0.45);
      cursor: pointer;
    }
    
    div#desktopNavButtons button.btn-next:not(:disabled):hover { 
      background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
      transform: translateY(-2px); 
      box-shadow: 0 6px 16px rgba(30, 58, 138, 0.55); 
    }
    
    div#desktopNavButtons button.btn-next:not(:disabled):active { 
      transform: translateY(0); 
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON NEXT - DISABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#desktopNavButtons button.btn-next:disabled { 
      background: #9CA3AF;
      color: #374151;
      border: 2px solid #D1D5DB;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      cursor: not-allowed; 
      transform: none; 
    }
    
    div#desktopNavButtons button.btn-next:disabled:hover { 
      transform: none; 
      background: #9CA3AF;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON SPECIALTIES (Step 4) - ENABLED
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#desktopNavButtons button.btn-specialties:not(:disabled) { 
      background: linear-gradient(135deg, #9333ea 0%, #ec4899 100%);
      color: white; 
      border: none;
      box-shadow: 0 4px 12px rgba(147, 51, 234, 0.45);
      cursor: pointer;
    }
    
    div#desktopNavButtons button.btn-specialties:not(:disabled):hover { 
      background: linear-gradient(135deg, #a855f7 0%, #f472b6 100%);
      transform: translateY(-2px); 
      box-shadow: 0 6px 16px rgba(147, 51, 234, 0.55); 
    }
    
    div#desktopNavButtons button.btn-specialties:not(:disabled):active { 
      transform: translateY(0); 
    }
    
    /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
       BOUTON SPECIALTIES - DISABLED (GRISÉ)
       ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
    div#desktopNavButtons button.btn-specialties:disabled { 
      background: #9CA3AF;
      color: #374151;
      border: 2px solid #D1D5DB;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      cursor: not-allowed; 
      transform: none; 
    }
    
    div#desktopNavButtons button.btn-specialties:disabled:hover { 
      transform: none; 
      background: #9CA3AF;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }
  }

  /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
     ♿ ACCESSIBILITY
     ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
  
  @media (prefers-reduced-motion: reduce) {
    div#mobileNavButtons button,
    div#desktopNavButtons button,
    div#mobileNavButtons button svg,
    div#desktopNavButtons button svg {
      animation: none;
      transition: none;
    }
  }

  @media (prefers-contrast: high) {
    div#mobileNavButtons button,
    div#desktopNavButtons button {
      border: 3px solid currentColor;
    }
  }
</style>