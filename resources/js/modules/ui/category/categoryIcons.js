/**
 * ===================================================================
 * SYSTÈME D'ICÔNES INTELLIGENT ET STABLE
 * ===================================================================
 * 
 * Garantit :
 * 1. Correspondance sémantique (icône = sens de la catégorie)
 * 2. Stabilité absolue (même catégorie = même icône toujours)
 * 3. Pas de doublons dans une famille
 */

// ==================== BIBLIOTHÈQUE D'ICÔNES ====================

export const iconLibrary = {
  
  // ==================== ADMINISTRATIVE & VISAS ====================
  passport: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="6" y="3" width="9" height="13" rx="0.8" stroke="white" stroke-width="1.2" fill="white"/>
    <circle cx="10.5" cy="7" r="1.5" fill="white" opacity="0.3"/>
    <rect x="8" y="9.5" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="8" y="11" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M16 12 L21 12 L21 20 L16 20 Z" fill="white"/>
    <circle cx="18.5" cy="15" r="1.2" fill="white" opacity="0.3"/>
    <rect x="17" y="17" width="3" height="0.3" rx="0.15" fill="white" opacity="0.3"/>
  </svg>`,

  visa: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="8" width="11" height="9" rx="0.5" stroke="white" stroke-width="1" fill="white"/>
    <rect x="6" y="10" width="2.5" height="3" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="9" y="10.5" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="9" y="12" width="3" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="10.5" cy="14.5" r="1" fill="white" opacity="0.2"/>
    <circle cx="18" cy="10" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M16 10 L18 12 L20 8" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  document: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M6 3 L6 21 L14 21 L14 8 L9 3 Z" fill="white"/>
    <path d="M9 3 L9 8 L14 8" fill="white" opacity="0.3"/>
    <rect x="8" y="11" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="8" y="13" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="8" y="15" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M16 12 L20 12 L20 20 L16 20 Z" fill="white"/>
    <path d="M17 14 L19 16 L17 18" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  certificate: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="5" width="14" height="9" rx="0.5" fill="white"/>
    <circle cx="11" cy="9.5" r="1.3" stroke="white" stroke-width="0.8" fill="none" opacity="0.3"/>
    <path d="M9 15 L10 19 L10.5 17 L12 17 L10.5 15.5 Z" fill="white"/>
    <path d="M13 15 L12 19 L11.5 17 L10 17 L11.5 15.5 Z" fill="white"/>
    <circle cx="18.5" cy="16" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17 16 L18.5 17.5 L20 15" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  embassy: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L5 6.5 L5 7.5 L17 7.5 L17 6.5 Z" fill="white"/>
    <rect x="6.5" y="8.5" width="1.5" height="7" fill="white"/>
    <rect x="10" y="8.5" width="1.5" height="7" fill="white"/>
    <rect x="13.5" y="8.5" width="1.5" height="7" fill="white"/>
    <rect x="5" y="15.5" width="12" height="1.5" fill="white"/>
    <circle cx="19" cy="10" r="2.5" stroke="white" stroke-width="1" fill="none"/>
    <path d="M19 8 L19 12 M17 10 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  stamp: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="7" r="2.5" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <path d="M10 4.5 L10 9.5 M7.5 7 L12.5 7" stroke="white" stroke-width="0.8"/>
    <rect x="5" y="11" width="10" height="1.2" rx="0.5" fill="white"/>
    <rect x="4" y="12.5" width="12" height="1.2" rx="0.6" fill="white"/>
    <rect x="3" y="14" width="14" height="1.8" rx="0.8" fill="white"/>
    <path d="M18 6 L21 6 L21 16 L18 16" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
    <circle cx="19.5" cy="11" r="1.5" fill="white"/>
  </svg>`,

  // ==================== BANKS & MONEY ====================
  bank: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L4 6.5 L4 7.5 L18 7.5 L18 6.5 Z" fill="white"/>
    <rect x="5.5" y="8.5" width="1.5" height="6" fill="white"/>
    <rect x="10.5" y="8.5" width="1.5" height="6" fill="white"/>
    <rect x="15.5" y="8.5" width="1.5" height="6" fill="white"/>
    <rect x="4" y="14.5" width="14" height="1.5" fill="white"/>
    <circle cx="19.5" cy="10" r="2.5" fill="white"/>
    <path d="M18.5 10 L19.5 11 L21 9" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  money: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="9" width="14" height="7" rx="0.8" fill="white"/>
    <circle cx="10" cy="12.5" r="2" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <circle cx="6" cy="12.5" r="0.8" fill="white" opacity="0.3"/>
    <circle cx="14" cy="12.5" r="0.8" fill="white" opacity="0.3"/>
    <path d="M18 8 L22 8 L22 18 L18 18" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M19 11 L21 11 M19 13 L21 13 M19 15 L21 15" stroke="white" stroke-width="1" stroke-linecap="round"/>
  </svg>`,

  card: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="2" y="7" width="16" height="9" rx="1" fill="white"/>
    <rect x="2" y="9" width="16" height="1.8" fill="white" opacity="0.3"/>
    <rect x="4" y="12.5" width="3" height="2" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="20" cy="11.5" r="2.5" fill="white"/>
    <rect x="18.5" y="11" width="3" height="1" rx="0.3" fill="white" opacity="0.3"/>
  </svg>`,

  tax: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="3" width="10" height="14" rx="0.5" fill="white"/>
    <rect x="7" y="6" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="8" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="10" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M12 12 L14 14 L12 16" stroke="white" stroke-width="1" stroke-linecap="round"/>
    <circle cx="18.5" cy="13" r="2.5" fill="white"/>
    <path d="M18.5 11.5 L18.5 14.5" stroke="white" stroke-width="1" stroke-linecap="round" opacity="0.3"/>
    <path d="M17 13 L20 13" stroke="white" stroke-width="1" stroke-linecap="round" opacity="0.3"/>
  </svg>`,

  insurance: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L5 5.5 L5 11 Q5 15 11 18 Q17 15 17 11 L17 5.5 Z" fill="white"/>
    <path d="M8 11 L10 13 L14 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
    <circle cx="19" cy="16" r="2" fill="white"/>
    <path d="M18 16 L19 17 L20.5 15" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  investment: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M3 15 L7 11 L11 13 L18 6" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14 6 L18 6 L18 10" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <circle cx="20.5" cy="15" r="2.5" fill="white"/>
    <path d="M20.5 13.5 L20.5 16.5 M18.5 15 L22.5 15" stroke="white" stroke-width="0.8" stroke-linecap="round" opacity="0.3"/>
  </svg>`,

  pension: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="8" width="12" height="10" rx="0.5" fill="white"/>
    <circle cx="10" cy="11.5" r="1.5" stroke="white" stroke-width="0.8" fill="none" opacity="0.3"/>
    <path d="M7 14.5 Q10 13 13 14.5" stroke="white" stroke-width="1" opacity="0.3"/>
    <circle cx="19" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 10 L19 14 M17 12 L21 12" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  loan: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="8" width="14" height="8" rx="1" fill="white"/>
    <circle cx="10" cy="12" r="2.5" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <path d="M18 12 L22 12 M20 10 L20 14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M8.5 12 L9.5 12 M10.5 12 L11.5 12" stroke="white" stroke-width="1" stroke-linecap="round" opacity="0.3"/>
  </svg>`,

  // ==================== MOVING & LOGISTICS ====================
  box: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M4 8 L11 4 L18 8 L18 15 L11 19 L4 15 Z" fill="white"/>
    <path d="M4 8 L11 12 L18 8 M11 12 L11 19" stroke="white" stroke-width="1" opacity="0.3"/>
    <path d="M19 10 L22 12 L22 16 L19 18" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
    <path d="M19 14 L22 14" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  truck: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="2" y="9" width="11" height="6" rx="0.5" fill="white"/>
    <path d="M13 10 L16 10 L18 13 L18 15 L13 15 Z" fill="white"/>
    <circle cx="6" cy="16" r="1.3" fill="white"/>
    <circle cx="15" cy="16" r="1.3" fill="white"/>
    <circle cx="20.5" cy="11" r="2" stroke="white" stroke-width="1" fill="none"/>
    <path d="M19 11 L20.5 12.5 L22 10" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  storage: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="5" width="12" height="12" rx="0.5" fill="white"/>
    <rect x="4" y="9" width="12" height="0.5" fill="white" opacity="0.3"/>
    <rect x="4" y="13" width="12" height="0.5" fill="white" opacity="0.3"/>
    <circle cx="7" cy="11" r="0.5" fill="white" opacity="0.3"/>
    <circle cx="7" cy="15" r="0.5" fill="white" opacity="0.3"/>
    <path d="M17 8 L21 10 L21 16 L17 14 Z" fill="white"/>
    <path d="M17 11 L21 13" stroke="white" stroke-width="0.5" opacity="0.3"/>
  </svg>`,

  package: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="6" width="10" height="10" rx="0.5" fill="white"/>
    <path d="M5 9 L15 9 M10 6 L10 16" stroke="white" stroke-width="1" opacity="0.3"/>
    <circle cx="18.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17 13 L18.5 14.5 L20 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  customs: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="6" width="12" height="10" rx="0.5" fill="white"/>
    <path d="M8 10 L10 12 L13 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
    <rect x="7" y="13" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M17 8 L21 8 L21 16 L17 16" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
    <path d="M18 12 L20 12" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
  </svg>`,

  international_moving: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M4 8 L10 5 L16 8 L16 14 L10 17 L4 14 Z" fill="white"/>
    <path d="M4 8 L10 11 L16 8 M10 11 L10 17" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="19.5" cy="11.5" r="4" stroke="white" stroke-width="1" fill="none"/>
    <path d="M14.5 11.5 L24.5 11.5 M19.5 6.5 Q17 11.5 19.5 16.5 M19.5 6.5 Q22 11.5 19.5 16.5" stroke="white" stroke-width="0.6" opacity="0.3"/>
  </svg>`,

  packing: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="6" width="12" height="11" rx="0.5" fill="white"/>
    <path d="M4 9 L16 9 M10 6 L10 17" stroke="white" stroke-width="1" opacity="0.3"/>
    <path d="M7 12 L9 12 M11 12 L13 12 M7 14 L9 14" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="19.5" cy="12.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 12.5 L19.5 14 L21 11.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== TRANSPORT ====================
  car: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M5 12 L7 8 L14 8 L16 12 L16 16 L5 16 Z" fill="white"/>
    <rect x="6" y="9" width="3" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="11" y="9" width="3" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="7" cy="16" r="1.2" fill="white"/>
    <circle cx="13" cy="16" r="1.2" fill="white"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11 L19.5 12.5 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  license: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="7" width="13" height="9" rx="0.8" fill="white"/>
    <rect x="6" y="9" width="3" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="10" y="9.5" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="10" y="11" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="10" y="12.5" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19.5" cy="11.5" r="2" fill="white"/>
    <path d="M18.5 11.5 L19.5 12.5 L20.5 10.5" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  scooter: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="6" cy="16" r="1.8" fill="white"/>
    <circle cx="15" cy="16" r="1.8" fill="white"/>
    <path d="M7.5 16 L10.5 10 L13 10" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <circle cx="13" cy="8" r="0.8" fill="white"/>
    <circle cx="19.5" cy="10" r="2.2" stroke="white" stroke-width="1" fill="none"/>
    <path d="M18 10 L19.5 11.5 L21 9" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  ticket: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="8" width="14" height="7" rx="0.5" fill="white"/>
    <circle cx="3" cy="11.5" r="0.8" fill="white"/>
    <circle cx="17" cy="11.5" r="0.8" fill="white"/>
    <rect x="8.5" y="10" width="0.4" height="3" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="10" y="10" width="0.4" height="3" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="20" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 11.5 L20 12.5 L21.5 10.5" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  transport: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="8" width="12" height="7" rx="0.8" fill="white"/>
    <circle cx="8" cy="16" r="1.2" fill="white"/>
    <circle cx="13" cy="16" r="1.2" fill="white"/>
    <rect x="6" y="10" width="2.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="12" y="10" width="2.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <path d="M17 9 L21 11 L21 15 L17 13 Z" fill="white"/>
  </svg>`,

  metro: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="6" width="10" height="10" rx="1.8" fill="white"/>
    <rect x="7" y="8" width="3" height="4" rx="0.5" fill="white" opacity="0.3"/>
    <rect x="11.5" y="8" width="2" height="4" rx="0.5" fill="white" opacity="0.3"/>
    <circle cx="8" cy="17" r="0.8" fill="white"/>
    <circle cx="13" cy="17" r="0.8" fill="white"/>
    <path d="M16 9 L20 11 L20 14 L16 12 Z" fill="white"/>
  </svg>`,

  bus: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="7" width="12" height="9" rx="1.2" fill="white"/>
    <rect x="6" y="9" width="2.5" height="3" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="9.5" y="9" width="2.5" height="3" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="13" y="9" width="2" height="3" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="7" cy="17" r="1" fill="white"/>
    <circle cx="13" cy="17" r="1" fill="white"/>
    <circle cx="19.5" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11.5 L19.5 13 L21 10.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  ferry: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M4 12 L4 14 L16 14 L16 12 L10 8 Z" fill="white"/>
    <rect x="7" y="9" width="2" height="3" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M3 15 Q10 13 17 15" stroke="white" stroke-width="1.2" opacity="0.3"/>
    <circle cx="20" cy="10" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 10 L20 11.5 L21.5 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  taxi: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="9" y="5" width="3.5" height="1.8" rx="0.5" fill="white"/>
    <path d="M5 10 L7 7.5 L14 7.5 L16 10 L16 14.5 L5 14.5 Z" fill="white"/>
    <rect x="6" y="8.5" width="3.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="11.5" y="8.5" width="3.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="7" cy="15" r="1.2" fill="white"/>
    <circle cx="14" cy="15" r="1.2" fill="white"/>
    <circle cx="20" cy="11" r="2" fill="white"/>
    <path d="M18.5 11 L20 12.5 L21.5 10" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  // ==================== HEALTH ====================
  health: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 5 L8 8 L8 11 L11 14 L14 11 L14 8 Z" fill="white"/>
    <path d="M11 8 L11 12 M9 10 L13 10" stroke="white" stroke-width="1.2" stroke-linecap="round" opacity="0.3"/>
    <circle cx="18.5" cy="14" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17 14 L18.5 15.5 L20 13" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  medicine: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="7" y="6" width="7" height="11" rx="0.8" fill="white"/>
    <path d="M10.5 9 L10.5 14 M8 11.5 L13 11.5" stroke="white" stroke-width="1.3" stroke-linecap="round" opacity="0.3"/>
    <circle cx="18" cy="13" r="2.2" fill="white"/>
    <path d="M16.5 13 L17.5 14 L19.5 12" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  hospital: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="5" width="10" height="14" rx="0.5" fill="white"/>
    <path d="M10 8 L10 13 M7.5 10.5 L12.5 10.5" stroke="white" stroke-width="1.3" stroke-linecap="round" opacity="0.3"/>
    <rect x="7.5" y="15" width="1.5" height="4" fill="white" opacity="0.3"/>
    <rect x="11" y="15" width="1.5" height="4" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 9 L19 13 M17 11 L21 11" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  wellbeing: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 4 Q7 6.5 7 10.5 Q7 14.5 11 17 Q15 14.5 15 10.5 Q15 6.5 11 4" fill="white"/>
    <path d="M9 10 Q11 8 13 10" stroke="white" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.3"/>
    <circle cx="19" cy="14" r="2" fill="white"/>
    <path d="M18 14 L19 15 L20.5 13" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  dentist: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M10 5 Q8 6 8 8 L8 13 Q8 15 9 16.5 L9 19" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <path d="M13 5 Q15 6 15 8 L15 13 Q15 15 14 16.5 L14 19" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11 L19.5 12.5 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  optician: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="7" cy="11" r="3.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="14" cy="11" r="3.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M10.5 11 L10.5 11" stroke="white" stroke-width="1" stroke-linecap="round"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11 L19.5 12.5 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  physiotherapy: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="9" cy="6" r="2" fill="white"/>
    <path d="M9 8 L9 12 M6.5 10 L11.5 10" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M9 12 L7 16 M9 12 L11 16" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M15 9 L18 9 M15 12 L18 12 M15 15 L18 15" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <circle cx="20" cy="12" r="1.5" fill="white"/>
  </svg>`,

  spa: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 4 Q7 6.5 7 10.5 Q7 14.5 11 17 Q15 14.5 15 10.5 Q15 6.5 11 4" fill="white"/>
    <path d="M9 11 Q11 9 13 11" stroke="white" stroke-width="1.2" stroke-linecap="round" fill="none" opacity="0.3"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="19" cy="11" r="1" fill="white"/>
  </svg>`,

  massage: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="9" cy="6" r="2.2" fill="white"/>
    <path d="M9 8.5 L9 13 M6.5 11 L11.5 11" stroke="white" stroke-width="1.5" stroke-linecap="round" opacity="0.3"/>
    <ellipse cx="9" cy="15.5" rx="3" ry="1.8" fill="white"/>
    <circle cx="18" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="18" cy="11" r="1" fill="white"/>
  </svg>`,

  // ==================== FAMILY & EDUCATION ====================
  child: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="6" r="2" fill="white"/>
    <path d="M10 8.5 L10 13 M7 10.5 L13 10.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <path d="M10 13 L7.5 17 M10 13 L12.5 17" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <circle cx="18" cy="8" r="2.5" fill="white"/>
    <path d="M18 11 L18 15 M15.5 13 L20.5 13" stroke="white" stroke-width="1.8" stroke-linecap="round" opacity="0.3"/>
  </svg>`,

  school: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L4 6.5 L4 15 L11 18.5 L18 15 L18 6.5 Z" fill="white"/>
    <path d="M11 6.5 L11 18.5" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="11" cy="5" r="0.8" fill="white" opacity="0.3"/>
    <path d="M19 9 L22 9 M19 12 L22 12 M19 15 L22 15" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  book: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M5 4 L5 18 L15 18 L15 4 Z" fill="white"/>
    <path d="M10 4 L10 18" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <rect x="7" y="7" width="2.5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="9" width="2.5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1" fill="none"/>
    <path d="M17.5 11 L19 12.5 L20.5 10" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  language: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="11" r="7" fill="white"/>
    <path d="M3 11 L17 11 M10 4 Q7 11 10 18 M10 4 Q13 11 10 18" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <path d="M18 8 L21 8 M18 11 L21 11 M18 14 L21 14" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  teacher: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="6" width="12" height="9" rx="0.5" fill="white"/>
    <rect x="6" y="8" width="3.5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="6" y="10" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M11 10 L13 12 L15 10" stroke="white" stroke-width="1" stroke-linecap="round"/>
    <circle cx="19" cy="11" r="2" fill="white"/>
    <path d="M19 9 L19 11 L21 11" stroke="white" stroke-width="0.8" opacity="0.3"/>
  </svg>`,

  university: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L3 6.5 L3 16 L11 19.5 L19 16 L19 6.5 Z" fill="white"/>
    <path d="M11 6.5 L11 19.5" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <path d="M7 8.5 L7 15" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <path d="M15 8.5 L15 15" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <rect x="9" y="2" width="4" height="1.5" rx="0.5" fill="white"/>
  </svg>`,

  training_center: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="6" width="12" height="12" rx="0.5" fill="white"/>
    <circle cx="10" cy="11" r="2" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <rect x="6" y="14.5" width="8" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11 L19 12.5 L20.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  wedding: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="7" cy="7" r="2" fill="white"/>
    <circle cx="14" cy="7" r="2" fill="white"/>
    <path d="M4 13 Q7 11 10.5 13" fill="white"/>
    <path d="M10.5 13 Q14 11 17.5 13" fill="white"/>
    <path d="M7 13 L7 17 M14 13 L14 17" stroke="white" stroke-width="1.2"/>
    <circle cx="20" cy="11" r="2" fill="white"/>
    <path d="M19 11 L20 12 L21.5 10" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  birthday: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="12" width="10" height="6" rx="0.5" fill="white"/>
    <rect x="7" y="9" width="2" height="3" rx="0.3" fill="white"/>
    <rect x="11" y="9" width="2" height="3" rx="0.3" fill="white"/>
    <path d="M8 7 L8 9 M12 7 L12 9" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="19" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 13 L19 14.5 L20.5 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== WORK & BUSINESS ====================
  briefcase: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="9" width="14" height="9" rx="0.8" fill="white"/>
    <rect x="7" y="6" width="6" height="3" rx="0.5" fill="white"/>
    <rect x="3" y="12" width="14" height="0.5" fill="white" opacity="0.3"/>
    <circle cx="19.5" cy="13.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13.5 L19.5 15 L21 12.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  cv: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="3" width="10" height="16" rx="0.5" fill="white"/>
    <circle cx="10" cy="6.5" r="1.3" fill="white" opacity="0.3"/>
    <rect x="7" y="9" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="11" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="13" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="15" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M16 7 L20 7 L20 17 L16 17" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
    <circle cx="18" cy="12" r="1.5" fill="white"/>
  </svg>`,

  company: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="8" width="12" height="11" rx="0.5" fill="white"/>
    <rect x="7" y="11" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="12" y="11" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="7" y="14" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="12" y="14" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="8.5" y="5" width="3" height="3" rx="0.3" fill="white"/>
    <circle cx="19" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 11 L19 15 M17 13 L21 13" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  interview: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="7" r="2.5" fill="white"/>
    <path d="M5 15 Q10 12 15 15" fill="white"/>
    <rect x="7" y="17" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11" r="2" fill="white"/>
    <rect x="17.5" y="13" width="3" height="0.8" rx="0.3" fill="white"/>
    <path d="M19 13 L19 15" stroke="white" stroke-width="0.8"/>
  </svg>`,

  freelance: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="7" width="12" height="9" rx="0.8" fill="white"/>
    <rect x="6" y="9" width="3.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <path d="M11 10 L15 10 M11 12 L14 12" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <rect x="6" y="13" width="8" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="19" cy="11.5" r="1" fill="white"/>
  </svg>`,

  architect: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M4 8 L4 18 L12 18 L12 8" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M2 8 L14 8 L13 5 L3 5 Z" fill="white"/>
    <rect x="6" y="11" width="2" height="2" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="10" y="11" width="2" height="2" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M15 10 L22 10 M15 13 L20 13 M15 16 L21 16" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  engineer: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="8" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M10 10.5 L10 13.5" stroke="white" stroke-width="1.2"/>
    <circle cx="10" cy="15" r="1.5" fill="white"/>
    <path d="M8.5 15 L5 18 M11.5 15 L15 18" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
    <path d="M16 6 L22 9 L22 13 L16 10 Z" fill="white"/>
    <path d="M16 8 L22 11" stroke="white" stroke-width="0.5" opacity="0.3"/>
  </svg>`,

  accountant: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="5" width="12" height="14" rx="0.5" fill="white"/>
    <rect x="6" y="8" width="8" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="6" y="10" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="6" y="12" width="7" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="6" y="14" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M17 9 L21 9 M17 12 L21 12 M17 15 L21 15" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
  </svg>`,

  consultant: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="9" cy="7" r="2.5" fill="white"/>
    <path d="M5 13.5 Q9 11 13 13.5 L13 17 L5 17 Z" fill="white"/>
    <rect x="7.5" y="9.5" width="3" height="1.5" rx="0.5" fill="white"/>
    <rect x="16" y="8" width="6" height="9" rx="0.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11 L20.5 11 M17.5 13 L20.5 13 M17.5 15 L19.5 15" stroke="white" stroke-width="0.8" opacity="0.3"/>
  </svg>`,

  // ==================== HOME ====================
  home: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L4 9 L4 18 L18 18 L18 9 Z" fill="white"/>
    <rect x="9" y="13" width="3" height="5" fill="white" opacity="0.3"/>
    <rect x="6" y="10" width="2.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="13" y="10" width="2.5" height="2.5" rx="0.3" fill="white" opacity="0.3"/>
    <path d="M19 7 L22 9 L22 16 L19 14 Z" fill="white"/>
  </svg>`,

  key: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="15" cy="7" r="3.5" fill="white"/>
    <rect x="3" y="12" width="9" height="1.8" rx="0.9" fill="white"/>
    <rect x="6" y="11" width="0.7" height="3.5" rx="0.35" fill="white"/>
    <rect x="9" y="11" width="0.7" height="3.5" rx="0.35" fill="white"/>
    <circle cx="20" cy="16" r="2" stroke="white" stroke-width="1" fill="none"/>
    <path d="M19 16 L20 17 L21.5 15" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  cleaning: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="7" cy="5" r="1.8" fill="white"/>
    <rect x="6" y="7" width="2" height="9" rx="0.5" fill="white"/>
    <path d="M4.5 16 L9.5 16 L8 18 L6 18 Z" fill="white"/>
    <circle cx="17" cy="9" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M15.5 9 L17 10.5 L18.5 8" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M16 12 L16 17" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
  </svg>`,

  repair: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M7 7 L14 14 M7 14 L14 7" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <circle cx="7" cy="7" r="1.8" fill="white"/>
    <circle cx="14" cy="14" r="1.8" fill="white"/>
    <circle cx="19" cy="16" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 16 L19 17.5 L20.5 15" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  renovation: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="8" width="12" height="9" rx="0.5" fill="white"/>
    <path d="M7 11 L10 11 M12 11 L15 11 M7 13 L10 13 M12 13 L15 13" stroke="white" stroke-width="1.2" opacity="0.3"/>
    <rect x="9" y="5" width="3" height="3" rx="0.5" fill="white"/>
    <circle cx="19" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13 L19 14 L21 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  inspection: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="9" cy="10" r="6" fill="white"/>
    <path d="M14 14 L18 18" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <path d="M7 10 L9 12 L12 8" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
    <circle cx="20" cy="8" r="2" stroke="white" stroke-width="1" fill="none"/>
    <path d="M19 8 L20 9 L21.5 7" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  gardening: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M10 14 L10 18" stroke="white" stroke-width="1.5"/>
    <path d="M7 7 Q7 4 10 4 Q13 4 13 7" fill="white"/>
    <path d="M5 10 Q5 7 10 7 Q15 7 15 10" fill="white"/>
    <rect x="8.5" y="17.5" width="3" height="1.5" rx="0.5" fill="white"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11 L19 12.5 L20.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  plumbing: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M5 8 L5 15" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M5 11 L12 11" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <path d="M12 8 L12 15" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <circle cx="8.5" cy="13" r="1.5" fill="white"/>
    <path d="M16 8 L20 8 M16 11 L20 11 M16 14 L20 14" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
  </svg>`,

  painting: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="7" y="4" width="3" height="8" rx="0.3" fill="white"/>
    <path d="M8.5 12 L8.5 18" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <rect x="6" y="18" width="5" height="2" rx="0.5" fill="white"/>
    <circle cx="17" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M15.5 11 L17 12.5 L18.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  carpentry: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M5 7 L12 14 M5 14 L12 7" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <circle cx="5" cy="7" r="1.5" fill="white"/>
    <circle cx="12" cy="14" r="1.5" fill="white"/>
    <path d="M15 9 L19 9 M15 12 L19 12 M15 15 L19 15" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <circle cx="21" cy="12" r="1.2" fill="white"/>
  </svg>`,

  // ==================== SERVICES ====================
  phone: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="6" y="3" width="9" height="16" rx="0.8" fill="white"/>
    <circle cx="10.5" cy="16.5" r="0.8" fill="white" opacity="0.3"/>
    <rect x="8" y="5" width="5" height="9" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="18.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17 13 L18.5 14.5 L20 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  wifi: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M3 9 Q10 4 17 9" stroke="white" stroke-width="1.8" stroke-linecap="round" fill="none"/>
    <path d="M6 12 Q10 9 14 12" stroke="white" stroke-width="1.8" stroke-linecap="round" fill="none"/>
    <path d="M8.5 15 Q10 13.5 11.5 15" stroke="white" stroke-width="1.8" stroke-linecap="round" fill="none"/>
    <circle cx="10" cy="17" r="0.8" fill="white"/>
    <circle cx="20" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 11 L20 12.5 L21.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  mail: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="2" y="6" width="16" height="11" rx="0.8" fill="white"/>
    <path d="M2 6 L10 12 L18 6" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="20.5" cy="14" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 14 L20.5 15.5 L22 13" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  translation: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="6" width="7" height="5.5" rx="0.5" fill="white"/>
    <rect x="10.5" y="11.5" width="7" height="5.5" rx="0.5" fill="white"/>
    <path d="M5 8.5 L7 8.5 M6 7.5 L6 9.5 M5 12.5 L7 12.5" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <path d="M12.5 14 L14.5 14 M13.5 13 L13.5 15" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="20" cy="9" r="2" stroke="white" stroke-width="1" fill="none"/>
    <path d="M18.5 9 L20 10.5 L21.5 8" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  interpreter: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="8" cy="7" r="2.2" fill="white"/>
    <circle cx="14" cy="15" r="2.2" fill="white"/>
    <path d="M8 9.5 L8 13.5 L14 12" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11 L19.5 12.5 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== ANIMALS ====================
  pet: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="7" cy="7" r="1.3" fill="white"/>
    <circle cx="14" cy="7" r="1.3" fill="white"/>
    <circle cx="5" cy="11" r="1.3" fill="white"/>
    <circle cx="16" cy="11" r="1.3" fill="white"/>
    <ellipse cx="10.5" cy="13" rx="3.5" ry="4.5" fill="white"/>
    <circle cx="20" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 13 L20 14.5 L21.5 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  veterinary: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 5 L8 8 L8 11 L11 14 L14 11 L14 8 Z" fill="white"/>
    <ellipse cx="11" cy="16" rx="2.2" ry="1.3" fill="white"/>
    <path d="M11 8.5 L11 12 M9 10.25 L13 10.25" stroke="white" stroke-width="1" stroke-linecap="round" opacity="0.3"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11 L19 12.5 L20.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== CONCIERGE ====================
  calendar: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="5" width="12" height="12" rx="0.8" fill="white"/>
    <rect x="4" y="5" width="12" height="2.5" fill="white" opacity="0.3"/>
    <rect x="7" y="10" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="10" y="10" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="13" y="10" width="1.5" height="1.5" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="19.5" cy="13.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13.5 L19.5 15 L21 12.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  shopping: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M5 6 L7 16 L16 16 L18 6 Z" fill="white"/>
    <path d="M8 6 L8 4.5 Q8 3.5 9 3.5 L12 3.5 Q13 3.5 13 4.5 L13 6" stroke="white" stroke-width="1.3" fill="none"/>
    <circle cx="9" cy="17.5" r="0.8" fill="white"/>
    <circle cx="14" cy="17.5" r="0.8" fill="white"/>
    <circle cx="20" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 12 L20 13.5 L21.5 11" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  food: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M4 8 L4 18 M7 8 L7 18 M10 8 L10 11.5 Q10 14 7 14" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <path d="M13 8 Q16 8 16 10.5 L16 18" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <path d="M13 10.5 L16 10.5" stroke="white" stroke-width="1.3"/>
    <circle cx="20" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 13 L20 14.5 L21.5 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  delivery: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="10" width="7" height="5.5" rx="0.5" fill="white"/>
    <path d="M11 11.5 L14 11.5 L16 14 L16 15.5 L11 15.5 Z" fill="white"/>
    <circle cx="7" cy="16.5" r="1.2" fill="white"/>
    <circle cx="14" cy="16.5" r="1.2" fill="white"/>
    <circle cx="19.5" cy="10" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 10 L19.5 11.5 L21 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  concierge: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="6.5" r="2.2" fill="white"/>
    <path d="M6 13.5 Q10 11 14 13.5 L14 17 L6 17 Z" fill="white"/>
    <rect x="8.5" y="9" width="3" height="1.8" rx="0.5" fill="white"/>
    <circle cx="19" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11.5 L19 13 L20.5 10.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== TECH ====================
  computer: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="2" y="5" width="16" height="10" rx="0.8" fill="white"/>
    <rect x="4" y="7" width="12" height="6" rx="0.5" fill="white" opacity="0.3"/>
    <rect x="7" y="16" width="7" height="0.8" rx="0.4" fill="white"/>
    <rect x="9" y="15" width="3" height="1" fill="white"/>
    <circle cx="20.5" cy="10" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 10 L20.5 11.5 L22 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  settings: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="11" r="2.5" fill="white"/>
    <path d="M10 5 L10 7 M10 15 L10 17 M4 11 L6 11 M14 11 L16 11" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <path d="M6 6 L7.5 7.5 M12.5 14.5 L14 16 M14 6 L12.5 7.5 M7.5 14.5 L6 16" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <circle cx="20" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M20 9 L20 13 M18 11 L22 11" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  software: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="5" width="12" height="12" rx="0.8" fill="white"/>
    <path d="M8 9.5 L10 11.5 L8 13.5 M11 9.5 L13 11.5 L11 13.5" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11 L19.5 12.5 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  backup: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M6 13 Q6 9 10.5 9 Q15 9 15 13" fill="white"/>
    <path d="M10.5 9 L10.5 16 M8 14 L10.5 11.5 L13 14" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
    <rect x="4" y="16.5" width="12" height="1.8" rx="0.5" fill="white"/>
    <circle cx="19.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13 L19.5 14.5 L21 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== LEGAL ====================
  lawyer: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M7 10 L7 18 L14 18 L14 10" fill="white"/>
    <path d="M5 10 L16 10 L15 6.5 L6 6.5 Z" fill="white"/>
    <rect x="9 13" width="3" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="19" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 13 L19 14.5 L20.5 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  contract: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="3" width="10" height="16" rx="0.5" fill="white"/>
    <rect x="7" y="6" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="8" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="10" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M8 15 Q10 13 12 15" stroke="white" stroke-width="1.3" fill="none"/>
    <circle cx="18.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17 13 L18.5 14.5 L20 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  notary: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="5" width="10" height="12" rx="0.5" fill="white"/>
    <circle cx="10" cy="10" r="1.8" stroke="white" stroke-width="0.8" fill="none" opacity="0.3"/>
    <path d="M10 12 L10 14" stroke="white" stroke-width="1"/>
    <rect x="7" y="14.5" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11.5 L19 13 L20.5 10.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  complaint: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L3 18 L19 18 Z" fill="white"/>
    <rect x="10" y="9" width="2" height="4.5" rx="0.5" fill="white" opacity="0.3"/>
    <circle cx="11" cy="15" r="0.8" fill="white" opacity="0.3"/>
    <circle cx="20.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M20.5 9.5 L20.5 12.5" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  dispute: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="11" cy="11" r="8" fill="white"/>
    <path d="M7 11 L15 11 M11 7 L11 15" stroke="white" stroke-width="1.8" stroke-linecap="round" opacity="0.3"/>
    <circle cx="20" cy="15" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M20 13 L20 17" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  hearing: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M7 10 L7 18 L14 18 L14 10" fill="white"/>
    <path d="M5 10 L16 10 L15 6.5 L6 6.5 Z" fill="white"/>
    <circle cx="10.5" cy="13.5" r="1.3" fill="white" opacity="0.3"/>
    <circle cx="19.5" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 12 L19.5 13.5 L21 11" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== TRAVEL ====================
  plane: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M2 11 L9 11 L9 7.5 L12.5 7.5 L12.5 11 L19 11 L17.5 13.5 L12.5 13.5 L12.5 16 L11 17 L9.5 16 L9.5 13.5 L4.5 13.5 Z" fill="white"/>
    <circle cx="21" cy="7" r="2" fill="white"/>
    <path d="M19.5 7 L21 8.5 L22.5 6.5" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  hotel: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="6" width="14" height="12" rx="0.5" fill="white"/>
    <rect x="6" y="9" width="2.5" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="12" y="9" width="2.5" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="6" y="13.5" width="2.5" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="12" y="13.5" width="2.5" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="20" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 11 L20 12.5 L21.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  suitcase: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="9" width="12" height="9" rx="0.8" fill="white"/>
    <rect x="8" y="6" width="5" height="3" rx="0.5" fill="white"/>
    <rect x="9.5" y="9" width="1.8" height="9" fill="white" opacity="0.3"/>
    <circle cx="19.5" cy="13.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13.5 L19.5 15 L21 12.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  train: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="6" width="10" height="9" rx="1.5" fill="white"/>
    <rect x="7" y="8" width="3.5" height="3.5" rx="0.5" fill="white" opacity="0.3"/>
    <rect x="12" y="8" width="1.5" height="3.5" rx="0.5" fill="white" opacity="0.3"/>
    <circle cx="8" cy="16" r="0.8" fill="white"/>
    <circle cx="13" cy="16" r="0.8" fill="white"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11 L19.5 12.5 L21 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== GARDEN ====================
  garden: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 15 L11 18.5" stroke="white" stroke-width="1.8"/>
    <path d="M7.5 7.5 Q7.5 4 11 4 Q14.5 4 14.5 7.5" fill="white"/>
    <path d="M5 11 Q5 7.5 11 7.5 Q17 7.5 17 11" fill="white"/>
    <rect x="9" y="18" width="4" height="1.8" rx="0.5" fill="white"/>
    <circle cx="20" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 12 L20 13.5 L21.5 11" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  outdoor: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L5 11 L7 11 L4 16 L8.5 14.5 L9.5 18 L11 13.5 L12.5 18 L13.5 14.5 L18 16 L15 11 L17 11 Z" fill="white"/>
    <circle cx="20.5" cy="9" r="2" fill="white"/>
    <path d="M19 9 L20.5 10.5 L22 8.5" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  pool: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="10" width="12" height="7" rx="0.8" fill="white"/>
    <path d="M6 12.5 Q8 10.5 10 12.5 Q12 14.5 14 12.5 Q16 10.5 18 12.5" stroke="white" stroke-width="1.2" fill="none" opacity="0.3"/>
    <circle cx="7" cy="7" r="1.3" fill="white"/>
    <circle cx="19.5" cy="13.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13.5 L19.5 15 L21 12.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== ENERGY ====================
  electricity: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M13 3 L6 11 L10 11 L9 19 L16 11 L12 11 Z" fill="white"/>
    <circle cx="20" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 12 L20 13.5 L21.5 11" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  water: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 Q7 7.5 7 12 Q7 16.5 11 19 Q15 16.5 15 12 Q15 7.5 11 3" fill="white"/>
    <path d="M9 13 Q11 11 13 13" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <circle cx="19.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13 L19.5 14.5 L21 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  gas: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M8 17 L8 10 Q8 8 10 8 L12 8 Q14 8 14 10 L14 17" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
    <circle cx="11" cy="12.5" r="1.8" fill="white"/>
    <rect x="6" y="17" width="9" height="1.8" rx="0.9" fill="white"/>
    <circle cx="19.5" cy="12.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 12.5 L19.5 14 L21 11.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== FOLDER ====================
  folder: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M3 6 L3 17 L18 17 L18 8 L11 8 L9 6 Z" fill="white"/>
    <path d="M3 8 L18 8" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="20.5" cy="12.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19 12.5 L20.5 14 L22 11.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  file: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M6 3 L6 19 L15 19 L15 8 L11 3 Z" fill="white"/>
    <path d="M11 3 L11 8 L15 8" fill="white" opacity="0.3"/>
    <rect x="8" y="11" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="8" y="13" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="19" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 12 L19 13.5 L20.5 11" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== EMERGENCY ====================
  alert: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L3 18 L19 18 Z" fill="white"/>
    <rect x="10" y="9" width="2" height="4.5" rx="0.5" fill="white" opacity="0.3"/>
    <circle cx="11" cy="15" r="0.8" fill="white" opacity="0.3"/>
    <circle cx="20.5" cy="10" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M20.5 8.5 L20.5 11.5" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  emergency: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="11" cy="11" r="8" fill="white"/>
    <path d="M11 6 L11 12 M11 14 L11 16" stroke="white" stroke-width="1.8" stroke-linecap="round" opacity="0.3"/>
    <circle cx="20" cy="15" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M20 13 L20 17" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  accident: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 5 L8 8 L8 11 L11 14 L14 11 L14 8 Z" fill="white"/>
    <path d="M11 8 L11 11.5 M11 12.5 L11 13.5" stroke="white" stroke-width="1.3" stroke-linecap="round" opacity="0.3"/>
    <circle cx="19.5" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19.5 9 L19.5 13" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,

  // ==================== REGISTRATION ====================
  registration: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="4" width="12" height="14" rx="0.5" fill="white"/>
    <circle cx="10" cy="8.5" r="1.8" fill="white" opacity="0.3"/>
    <rect x="7" y="12" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="7" y="14" width="5" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <path d="M14 16 L15.5 17.5 L18 15" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
    <circle cx="19.5" cy="9" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 9 L19.5 10.5 L21 8" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  identifier: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="8" width="14" height="7" rx="0.8" fill="white"/>
    <rect x="5" y="10" width="2.5" height="3.5" rx="0.3" fill="white" opacity="0.3"/>
    <rect x="9" y="10.5" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="9" y="12.5" width="4" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="20" cy="12" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 12 L20 13.5 L21.5 11" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  // ==================== OTHER ====================
  assistance: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="11" cy="11" r="8" fill="white"/>
    <path d="M11 7.5 Q13 7.5 13 9.5 Q13 10.5 11 11.5 L11 13" stroke="white" stroke-width="1.3" stroke-linecap="round" fill="none" opacity="0.3"/>
    <circle cx="11" cy="15" r="0.8" fill="white" opacity="0.3"/>
    <circle cx="20" cy="15" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 15 L20 16.5 L21.5 14" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  support: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 4 Q7 6.5 7 11 Q7 15.5 11 18 Q15 15.5 15 11 Q15 6.5 11 4" fill="white"/>
    <circle cx="11" cy="11" r="2.5" fill="white" opacity="0.3"/>
    <circle cx="19.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 13 L19.5 14.5 L21 12" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  guide: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="9" cy="7.5" r="2.5" fill="white"/>
    <path d="M5 14.5 Q9 12 13 14.5 L13 18 L5 18 Z" fill="white"/>
    <path d="M15 7.5 L19 7.5 M17 5.5 L17 9.5" stroke="white" stroke-width="1.3" stroke-linecap="round"/>
    <circle cx="19.5" cy="14" r="2" fill="white"/>
  </svg>`,

  meeting: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="8" cy="7.5" r="1.8" fill="white"/>
    <circle cx="14" cy="7.5" r="1.8" fill="white"/>
    <path d="M4.5 14 Q8 11.5 11.5 14" fill="white"/>
    <path d="M10.5 14 Q14 11.5 17.5 14" fill="white"/>
    <circle cx="20" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 11 L20 12.5 L21.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  subscription: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="7" width="12" height="9" rx="0.8" fill="white"/>
    <path d="M8 11 L10 13 L14 9" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
    <rect x="7" y="4" width="1.5" height="3" rx="0.5" fill="white"/>
    <rect x="12.5" y="4" width="1.5" height="3" rx="0.5" fill="white"/>
    <circle cx="19.5" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 11.5 L19.5 13 L21 10.5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  cancellation: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="11" cy="11" r="8" fill="white"/>
    <path d="M7 7 L15 15 M15 7 L7 15" stroke="white" stroke-width="1.8" stroke-linecap="round" opacity="0.3"/>
    <circle cx="20" cy="15" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 13.5 L21.5 16.5 M21.5 13.5 L18.5 16.5" stroke="white" stroke-width="1" stroke-linecap="round"/>
  </svg>`,

  forwarding: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="3" y="7" width="9" height="9" rx="0.5" fill="white"/>
    <path d="M12 7 L18 11.5 L12 16" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
    <circle cx="20.5" cy="11.5" r="2" fill="white"/>
    <path d="M19 11.5 L20.5 13 L22 10.5" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  diplomatic: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="8" cy="8" r="5.5" stroke="white" stroke-width="1" fill="none"/>
    <path d="M3 8 L13 8 M8 2.5 Q5.5 8 8 13.5 M8 2.5 Q10.5 8 8 13.5" stroke="white" stroke-width="0.8" opacity="0.3"/>
    <circle cx="17" cy="15" r="5.5" stroke="white" stroke-width="1" fill="none"/>
    <path d="M12 15 L22 15 M17 9.5 Q14.5 15 17 20.5 M17 9.5 Q19.5 15 17 20.5" stroke="white" stroke-width="0.8" opacity="0.3"/>
  </svg>`,

  apostille: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="5" y="4" width="10" height="14" rx="0.5" fill="white"/>
    <circle cx="10" cy="10" r="2.5" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <path d="M8 15 Q10 13 12 15" stroke="white" stroke-width="1" fill="none"/>
    <rect x="7" y="16.5" width="6" height="0.4" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="18.5" cy="12" r="2.5" fill="white"/>
    <path d="M17 12 L18.5 13.5 L20 11" stroke="white" stroke-width="0.8" stroke-linecap="round" stroke-linejoin="round" opacity="0.3"/>
  </svg>`,

  museum: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L4 6.5 L4 7.5 L18 7.5 L18 6.5 Z" fill="white"/>
    <rect x="6" y="8.5" width="2" height="8" fill="white"/>
    <rect x="10" y="8.5" width="2" height="8" fill="white"/>
    <rect x="14" y="8.5" width="2" height="8" fill="white"/>
    <rect x="4" y="16.5" width="14" height="1.5" fill="white"/>
    <circle cx="20" cy="11" r="2" fill="white"/>
  </svg>`,

  cinema: `<svg viewBox="0 0 24 24" fill="none">
    <rect x="4" y="6" width="12" height="12" rx="0.5" fill="white"/>
    <rect x="6" y="8" width="8" height="6" rx="0.3" fill="white" opacity="0.3"/>
    <circle cx="7" cy="16" r="0.8" fill="white" opacity="0.3"/>
    <circle cx="11" cy="16" r="0.8" fill="white" opacity="0.3"/>
    <circle cx="19" cy="11" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M17.5 11 L19 12.5 L20.5 10" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  theater: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="7" cy="9" r="3" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M6 8 Q7 7 8 8" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <path d="M7 11 Q7 12 7 12" stroke="white" stroke-width="1" stroke-linecap="round" opacity="0.3"/>
    <circle cx="15" cy="9" r="3" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M14 10 Q15 11 16 10" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <path d="M15 7 Q15 6 15 6" stroke="white" stroke-width="1" stroke-linecap="round" opacity="0.3"/>
  </svg>`,

  vip: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="11" cy="9" r="3" fill="white"/>
    <path d="M6 16 Q11 13 16 16 L16 19 L6 19 Z" fill="white"/>
    <path d="M8 5 L11 9 L14 5" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
    <circle cx="19.5" cy="13" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="19.5" cy="13" r="1" fill="white"/>
  </svg>`,

  limousine: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M3 11 L5 9 L16 9 L18 11 L18 14 L3 14 Z" fill="white"/>
    <rect x="6" y="10" width="2" height="2" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="10" y="10" width="2" height="2" rx="0.2" fill="white" opacity="0.3"/>
    <rect x="14" y="10" width="2" height="2" rx="0.2" fill="white" opacity="0.3"/>
    <circle cx="5" cy="15" r="1" fill="white"/>
    <circle cx="16" cy="15" r="1" fill="white"/>
    <circle cx="20.5" cy="11.5" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="20.5" cy="11.5" r="1" fill="white"/>
  </svg>`,

  security: `<svg viewBox="0 0 24 24" fill="none">
    <path d="M11 3 L5 5.5 L5 11 Q5 15 11 18 Q17 15 17 11 L17 5.5 Z" fill="white"/>
    <circle cx="11" cy="11" r="2.5" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
    <circle cx="20" cy="14" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18.5 14 L20 15.5 L21.5 13" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  surveillance: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="10" cy="11" r="4.5" stroke="white" stroke-width="1.2" fill="none"/>
    <circle cx="10" cy="11" r="2" fill="white"/>
    <path d="M13 14 L16 17" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
    <circle cx="19.5" cy="10" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M18 10 L19.5 11.5 L21 9" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>`,

  alarm: `<svg viewBox="0 0 24 24" fill="none">
    <circle cx="11" cy="11" r="7" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M11 7 L11 11 L14 13" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
    <circle cx="19.5" cy="15" r="2.5" stroke="white" stroke-width="1.2" fill="none"/>
    <path d="M19.5 13 L19.5 17" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
  </svg>`,
};

// ==================== MAPPING MOTS-CLÉS ====================

export const keywordToIcon = {
  // Administrative
  'passport': 'passport', 'passeport': 'passport', 'passaporte': 'passport',
  'visa': 'visa', 'residence': 'visa', 'permit': 'visa', 'immigration': 'visa',
  'document': 'document', 'paper': 'document', 'file': 'file', 'papers': 'document',
  'certificate': 'certificate', 'certificat': 'certificate', 'birth': 'certificate', 'marriage': 'certificate', 'divorce': 'certificate',
  'embassy': 'embassy', 'consulate': 'embassy', 'ambassade': 'embassy', 'consulat': 'embassy', 'consular': 'embassy',
  'stamp': 'stamp', 'tampon': 'stamp', 'seal': 'stamp',
  'lost': 'alert', 'stolen': 'alert', 'theft': 'alert',
  'civil': 'certificate', 'status': 'document', 'official': 'document',
  'registration': 'registration', 'register': 'registration', 'enroll': 'registration',
  'identifier': 'identifier', 'identifiers': 'identifier', 'identifiant': 'identifier',
  'expatriation': 'passport', 'expat': 'passport',
  'diplomatic': 'diplomatic', 'diplomatie': 'diplomatic', 'diplomacy': 'diplomatic',
  'apostille': 'apostille', 'legalization': 'apostille',
  
  // Banking
  'bank': 'bank', 'banking': 'bank', 'banque': 'bank', 'account': 'bank',
  'money': 'money', 'argent': 'money', 'transfer': 'money', 'currency': 'money', 'exchange': 'money',
  'card': 'card', 'carte': 'card', 'credit': 'card', 'debit': 'card',
  'tax': 'tax', 'taxation': 'tax', 'impot': 'tax', 'fiscal': 'tax', 'return': 'tax',
  'insurance': 'insurance', 'assurance': 'insurance',
  'investment': 'investment', 'investissement': 'investment', 'invest': 'investment',
  'pension': 'pension', 'retraite': 'pension', 'retirement': 'pension',
  'loan': 'loan', 'pret': 'loan', 'credit': 'loan', 'mortgage': 'loan',
  
  // Moving
  'box': 'box', 'boite': 'box', 'packaging': 'box', 'boxes': 'box',
  'truck': 'truck', 'camion': 'truck', 'moving': 'truck', 'demenagement': 'truck', 'move': 'truck',
  'storage': 'storage', 'entreposage': 'storage', 'warehouse': 'storage', 'warehousing': 'storage',
  'package': 'package', 'colis': 'package', 'parcel': 'package', 'parcels': 'package',
  'customs': 'customs', 'douane': 'customs', 'clearance': 'customs', 'duty': 'customs',
  'logistics': 'truck', 'logistique': 'truck',
  'delivery': 'delivery', 'livraison': 'delivery',
  'international': 'international_moving', 'overseas': 'international_moving',
  'packing': 'packing', 'emballage': 'packing',
  
  // Transport
  'car': 'car', 'voiture': 'car', 'vehicle': 'car', 'auto': 'car',
  'license': 'license', 'permis': 'license', 'driving': 'license', 'driver': 'license',
  'scooter': 'scooter', 'motorcycle': 'scooter', 'moto': 'scooter',
  'ticket': 'ticket', 'billet': 'ticket', 'fine': 'ticket', 'violation': 'ticket',
  'transport': 'transport', 'mobility': 'transport',
  'accident': 'accident', 'accidente': 'accident',
  'impound': 'car', 'immobilization': 'car',
  'metro': 'metro', 'subway': 'metro', 'underground': 'metro',
  'bus': 'bus', 'autobus': 'bus',
  'ferry': 'ferry', 'boat': 'ferry', 'bateau': 'ferry',
  'taxi': 'taxi',
  
  // Health
  'health': 'health', 'sante': 'health', 'medical': 'health',
  'medicine': 'medicine', 'medication': 'medicine', 'medicament': 'medicine', 'pharmacy': 'medicine',
  'hospital': 'hospital', 'hopital': 'hospital', 'clinic': 'hospital', 'emergency': 'hospital',
  'wellbeing': 'wellbeing', 'wellness': 'wellbeing', 'coaching': 'wellbeing', 'fitness': 'wellbeing',
  'consultation': 'health', 'doctor': 'health',
  'treatment': 'medicine', 'traitement': 'medicine',
  'dentist': 'dentist', 'dentiste': 'dentist', 'dental': 'dentist',
  'optician': 'optician', 'opticien': 'optician', 'glasses': 'optician',
  'physiotherapy': 'physiotherapy', 'physio': 'physiotherapy', 'kine': 'physiotherapy',
  'spa': 'spa', 'thermes': 'spa',
  'massage': 'massage', 'masseur': 'massage',
  
  // Family & Education
  'child': 'child', 'enfant': 'child', 'childcare': 'child', 'kid': 'child', 'children': 'child',
  'school': 'school', 'ecole': 'school', 'education': 'school', 'schooling': 'school',
  'book': 'book', 'livre': 'book', 'study': 'book',
  'language': 'language', 'langue': 'language', 'cours': 'language', 'courses': 'language',
  'teacher': 'teacher', 'professeur': 'teacher', 'tutor': 'teacher', 'lesson': 'teacher',
  'elderly': 'child', 'senior': 'child', 'care': 'child',
  'student': 'school', 'etudiant': 'school',
  'exam': 'certificate', 'diploma': 'certificate', 'certification': 'certificate',
  'university': 'university', 'universite': 'university', 'college': 'university',
  'training': 'training_center', 'formation': 'training_center',
  'wedding': 'wedding', 'mariage': 'wedding',
  'birthday': 'birthday', 'anniversaire': 'birthday',
  
  // Work
  'briefcase': 'briefcase', 'work': 'briefcase', 'job': 'briefcase', 'travail': 'briefcase',
  'cv': 'cv', 'resume': 'cv', 'curriculum': 'cv',
  'company': 'company', 'entreprise': 'company', 'business': 'company',
  'interview': 'interview', 'entretien': 'interview',
  'freelance': 'freelance', 'freelancing': 'freelance', 'self-employment': 'freelance',
  'employment': 'briefcase', 'emploi': 'briefcase',
  'recruit': 'interview', 'payroll': 'money',
  'incorporation': 'company', 'creation': 'company',
  'compliance': 'document', 'legal': 'lawyer', 'legislation': 'document',
  'trademark': 'stamp', 'patent': 'certificate',
  'architect': 'architect', 'architecte': 'architect',
  'engineer': 'engineer', 'ingenieur': 'engineer',
  'accountant': 'accountant', 'comptable': 'accountant',
  'consultant': 'consultant', 'conseil': 'consultant',
  
  // Home
  'home': 'home', 'maison': 'home', 'housing': 'home', 'logement': 'home',
  'key': 'key', 'cle': 'key', 'clef': 'key',
  'cleaning': 'cleaning', 'menage': 'cleaning', 'housekeeping': 'cleaning',
  'repair': 'repair', 'reparation': 'repair', 'maintenance': 'repair',
  'renovation': 'renovation', 'renovations': 'renovation', 'works': 'renovation',
  'inspection': 'inspection', 'inventory': 'inspection',
  'lease': 'contract', 'bail': 'contract', 'rental': 'home',
  'purchase': 'home', 'sale': 'home', 'buy': 'home', 'sell': 'home',
  'mortgage': 'bank', 'hypotheque': 'bank',
  'handover': 'key', 'check-in': 'key', 'check-out': 'key',
  'ironing': 'cleaning', 'repassage': 'cleaning',
  'window': 'cleaning', 'fenetre': 'cleaning',
  'gardening': 'gardening', 'jardinage': 'gardening',
  'plumbing': 'plumbing', 'plomberie': 'plumbing',
  'painting': 'painting', 'peinture': 'painting',
  'carpentry': 'carpentry', 'menuiserie': 'carpentry',
  'security': 'security', 'securite': 'security',
  'surveillance': 'surveillance', 'camera': 'surveillance',
  'alarm': 'alarm', 'alarme': 'alarm',
  
  // Services
  'phone': 'phone', 'telephone': 'phone', 'mobile': 'phone',
  'wifi': 'wifi', 'internet': 'wifi', 'network': 'wifi',
  'mail': 'mail', 'email': 'mail', 'courrier': 'mail', 'letter': 'mail',
  'translation': 'translation', 'traduction': 'translation', 'translate': 'translation',
  'interpreter': 'interpreter', 'interprete': 'interpreter', 'interpreting': 'interpreter',
  
  // Animals
  'pet': 'pet', 'animal': 'pet', 'dog': 'pet', 'cat': 'pet',
  'veterinarian': 'veterinary', 'veterinary': 'veterinary', 'vet': 'veterinary',
  'vaccination': 'medicine', 'vaccines': 'medicine',
  
  // Concierge
  'calendar': 'calendar', 'calendrier': 'calendar', 'agenda': 'calendar', 'appointment': 'calendar',
  'shopping': 'shopping', 'courses': 'shopping', 'groceries': 'shopping',
  'food': 'food', 'meal': 'food', 'repas': 'food', 'nourriture': 'food',
  'concierge': 'concierge', 'conciergerie': 'concierge',
  'sitting': 'concierge', 'surveillance': 'inspection',
  'errands': 'delivery', 'pickup': 'delivery',
  
  // Tech
  'computer': 'computer', 'ordinateur': 'computer', 'laptop': 'computer',
  'settings': 'settings', 'parametres': 'settings', 'configuration': 'settings',
  'software': 'software', 'logiciel': 'software', 'application': 'software',
  'backup': 'backup', 'sauvegarde': 'backup',
  'antivirus': 'settings', 'security': 'insurance',
  'troubleshoot': 'repair', 'install': 'settings',
  
  // Legal
  'lawyer': 'lawyer', 'avocat': 'lawyer', 'notary': 'notary', 'notaire': 'notary',
  'contract': 'contract', 'contrat': 'contract',
  'complaint': 'complaint', 'plainte': 'complaint',
  'dispute': 'dispute', 'litige': 'dispute',
  'hearing': 'hearing', 'audience': 'hearing',
  'rights': 'document', 'obligations': 'document',
  'appeal': 'document', 'recours': 'document',
  'scam': 'alert', 'arnaque': 'alert',
  
  // Travel
  'plane': 'plane', 'avion': 'plane', 'flight': 'plane',
  'hotel': 'hotel', 'accommodation': 'hotel',
  'suitcase': 'suitcase', 'valise': 'suitcase', 'luggage': 'suitcase',
  'train': 'train',
  'booking': 'calendar', 'reservation': 'calendar',
  
  // Garden
  'garden': 'garden', 'jardin': 'garden', 'outdoor': 'outdoor',
  'mowing': 'garden', 'weeding': 'garden', 'hedges': 'garden',
  'pool': 'pool', 'piscine': 'pool',
  
  // Energy
  'electricity': 'electricity', 'electric': 'electricity', 'energy': 'electricity',
  'water': 'water', 'eau': 'water',
  'gas': 'gas', 'gaz': 'gas',
  
  // Folder
  'folder': 'folder', 'dossier': 'folder',
  
  // Emergency
  'alert': 'alert', 'urgence': 'emergency', 'urgent': 'emergency',
  'incident': 'alert', 'incidents': 'alert',
  
  // Culture & Loisirs
  'museum': 'museum', 'musee': 'museum',
  'cinema': 'cinema', 'movie': 'cinema', 'film': 'cinema',
  'theater': 'theater', 'theatre': 'theater',
  
  // Services de luxe
  'vip': 'vip', 'premium': 'vip', 'luxury': 'vip',
  'limousine': 'limousine', 'limo': 'limousine',
  
  // Other
  'assistance': 'assistance', 'aide': 'assistance', 'help': 'assistance',
  'support': 'support', 'soutien': 'support',
  'guide': 'guide', 'accompany': 'guide', 'assist': 'assistance',
  'meeting': 'meeting', 'reunion': 'meeting',
  'subscription': 'subscription', 'abonnement': 'subscription', 'subscribe': 'subscription',
  'cancellation': 'cancellation', 'cancel': 'cancellation', 'terminate': 'cancellation',
  'forwarding': 'forwarding', 'redirection': 'forwarding',
};

// ==================== SYSTÈME DE CACHE ET TRACKING ====================

// Cache global pour garantir la stabilité
const iconCache = new Map();

// Tracking des icônes utilisées par famille (par catégorie parente)
const familyIconUsage = new Map();

// ==================== FONCTIONS UTILITAIRES ====================

function generateStableHash(str) {
  let hash = 0;
  for (let i = 0; i < str.length; i++) {
    hash = ((hash << 5) - hash) + str.charCodeAt(i);
  }
  return Math.abs(hash);
}

function normalizeString(str) {
  return str.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim();
}

function getAvailableIcons(usedIcons = []) {
  const allIcons = Object.keys(iconLibrary);
  return allIcons.filter(icon => !usedIcons.includes(icon));
}

// ==================== SYSTÈME DE SCORING ====================

function findBestMatchingIcon(categoryName, excludedIcons = []) {
  const normalized = normalizeString(categoryName);
  const words = normalized.split(/[\s\-_&,/()]+/);
  
  const iconScores = new Map();
  const availableIcons = Object.keys(iconLibrary).filter(
    icon => !excludedIcons.includes(icon)
  );
  
  availableIcons.forEach(iconName => {
    let score = 0;
    
    // 1. Correspondance exacte de mot (score max: 100)
    words.forEach(word => {
      if (keywordToIcon[word] === iconName) {
        score += 100;
      }
    });
    
    // 2. Correspondance partielle dans le nom de catégorie (score: 50)
    Object.entries(keywordToIcon).forEach(([keyword, icon]) => {
      if (icon === iconName) {
        if (normalized.includes(keyword)) {
          score += 50;
        }
        // 3. Correspondance partielle des mots (score: 20)
        words.forEach(word => {
          if (word.includes(keyword) || keyword.includes(word)) {
            score += 20;
          }
        });
      }
    });
    
    if (score > 0) {
      iconScores.set(iconName, score);
    }
  });
  
  if (iconScores.size > 0) {
    const sortedIcons = [...iconScores.entries()].sort((a, b) => b[1] - a[1]);
    return sortedIcons[0][0];
  }
  
  return null;
}

// ==================== FONCTION PRINCIPALE ====================

/**
 * Obtient une icône stable et unique pour une catégorie
 * @param {string} categoryName - Nom de la catégorie
 * @param {number|string} categoryId - ID unique de la catégorie
 * @param {string} parentId - ID de la catégorie parente (pour tracking de famille)
 * @returns {string} SVG de l'icône
 */
export function getCategoryIcon(categoryName, categoryId, parentId = 'root') {
  // Créer une clé stable unique
  const stableKey = `${parentId}/${categoryId}`;
  
  // 1. Vérifier le cache (garantit la stabilité)
  if (iconCache.has(stableKey)) {
    return iconCache.get(stableKey);
  }
  
  // 2. Obtenir les icônes déjà utilisées dans cette famille
  if (!familyIconUsage.has(parentId)) {
    familyIconUsage.set(parentId, new Set());
  }
  const usedInFamily = Array.from(familyIconUsage.get(parentId));
  
  // 3. Chercher la meilleure correspondance sémantique
  let selectedIconName = findBestMatchingIcon(categoryName, usedInFamily);
  
  // 4. Si pas de match, utiliser un hash stable sur les icônes disponibles
  if (!selectedIconName) {
    const availableIcons = getAvailableIcons(usedInFamily);
    
    if (availableIcons.length === 0) {
      // Si toutes les icônes sont utilisées, réinitialiser pour cette famille
      familyIconUsage.get(parentId).clear();
      selectedIconName = 'folder'; // Icône par défaut
    } else {
      const hashSource = `${categoryName}_${categoryId}`;
      const hash = generateStableHash(hashSource);
      selectedIconName = availableIcons[hash % availableIcons.length];
    }
  }
  
  // 5. Enregistrer l'icône utilisée
  familyIconUsage.get(parentId).add(selectedIconName);
  const iconSVG = iconLibrary[selectedIconName] || iconLibrary['folder'];
  iconCache.set(stableKey, iconSVG);
  
  return iconSVG;
}

/**
 * Réinitialise le cache (utile pour tests ou développement)
 */
export function clearIconCache() {
  iconCache.clear();
  familyIconUsage.clear();
}

/**
 * Pour la compatibilité avec l'ancien code
 */
export function getCategoryIconName(categoryName, categoryId, parentId = 'root') {
  const stableKey = `${parentId}/${categoryId}`;
  
  if (iconCache.has(stableKey)) {
    // Trouver le nom de l'icône depuis le SVG
    const svg = iconCache.get(stableKey);
    for (const [name, svgContent] of Object.entries(iconLibrary)) {
      if (svgContent === svg) {
        return name;
      }
    }
  }
  
  // Si pas en cache, calculer
  getCategoryIcon(categoryName, categoryId, parentId);
  return getCategoryIconName(categoryName, categoryId, parentId);
}

export default { iconLibrary, keywordToIcon, getCategoryIcon, getCategoryIconName, clearIconCache };