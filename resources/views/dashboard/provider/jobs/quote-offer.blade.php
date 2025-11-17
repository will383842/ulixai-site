@extends('dashboard.layouts.master')
@section('title', 'Service Request Details')

@section('content')

{{-- ============================================
    PROTECTION D'ACCÈS - PROVIDERS, ADMINS ET PROPRIÉTAIRE DE LA MISSION
    ============================================ --}}
@php
    $user = auth()->user();
    
    // ✅ CORRECTION : Vérifier le profil ServiceProvider au lieu du rôle
    $isProvider = $user && $user->serviceProvider !== null;
    
    // Vérifier le rôle admin via la table roles
    $isAdmin = false;
    if ($user && $user->roles) {
        $userRoles = $user->roles->pluck('title')->toArray();
        $isAdmin = in_array('admin', $userRoles) || in_array('Admin', $userRoles);
    }
    
    // Vérifier si l'utilisateur est le propriétaire de la mission (le demandeur qui l'a créée)
    $isOwner = $user && $mission && $mission->requester_id == $user->id;
    
    // Afficher le popup si ni provider, ni admin, ni propriétaire
    $showAccessDeniedModal = !$isProvider && !$isAdmin && !$isOwner;
@endphp

@php
  $images = json_decode($mission->attachments ?? '[]', true);
  $user = auth()->user();
  $provider = $user->serviceProvider ?? null;
  
  // Calculate remaining days
  $remainingDays = 'N/A';
  $durationMap = [
      '1 week' => 7,
      '2 weeks' => 14,
      '1 month' => 30,
      '3 months' => 90,
  ];
  
  $serviceDuration = $mission->service_duration ?? $mission->service_durition;
  if (isset($durationMap[$serviceDuration])) {
      $totalDays = $durationMap[$serviceDuration];
      $createdAt = \Carbon\Carbon::parse($mission->created_at);
      $now = \Carbon\Carbon::now();
      $daysPassed = $createdAt->diffInDays($now);
      $remainingDays = max(0, $totalDays - $daysPassed);
  }
@endphp

<style>
    /* ============================================
       MOBILE-FIRST RESPONSIVE DESIGN
       Breakpoints: 
       - Base: 320px+ (mobile)
       - SM: 640px+ (large mobile)
       - MD: 768px+ (tablet)
       - LG: 1024px+ (desktop)
       - XL: 1280px+ (large desktop)
    ============================================ */
    
    :root {
        --primary-blue: #007AFF;
        --primary-blue-light: #5AC8FA;
        --secondary-gray: #E5E5EA;
        --text-primary: #000000;
        --text-secondary: #3C3C43;
        --text-tertiary: #8E8E93;
        --bg-primary: #FFFFFF;
        --bg-secondary: #F2F2F7;
        --bg-tertiary: #E5E5EA;
        --success-green: #34C759;
        --danger-red: #FF3B30;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 10px 24px rgba(0, 0, 0, 0.15);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --radius-full: 9999px;
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
        box-sizing: border-box;
    }
    
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background: #E8E8ED;
    }
    
    /* ============================================
       CONTAINER - MOBILE FIRST
    ============================================ */
    .request-details-container {
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        padding: 0.5rem;
        padding-bottom: 2rem; /* Padding bottom pour mobile */
    }
    
    @media (min-width: 640px) {
        .request-details-container {
            padding: 1rem;
            padding-bottom: 2.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .request-details-container {
            max-width: 1400px;
            padding: 2rem;
            padding-bottom: 3rem;
        }
    }
    
    /* ============================================
       PROVIDER INFO BANNER - DESKTOP UNIQUEMENT
    ============================================ */
    .provider-info-banner {
        display: none; /* Caché sur mobile */
        background: linear-gradient(135deg, #007AFF, #5AC8FA);
        color: white;
        padding: 0.75rem 1rem;
        border-radius: var(--radius-md);
        align-items: center;
        gap: 0.625rem;
        margin-bottom: 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 1024px) {
        .provider-info-banner {
            display: flex; /* Visible uniquement sur desktop */
            padding: 1rem 1.5rem;
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
    }
    
    .provider-info-banner i {
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    @media (min-width: 1024px) {
        .provider-info-banner i {
            font-size: 1.125rem;
        }
    }
    
    /* ============================================
       REQUEST CARD - MOBILE FIRST
    ============================================ */
    .request-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0, 0, 0, 0.06);
    }
    
    @media (min-width: 768px) {
        .request-card {
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }
    }
    
    @media (min-width: 1024px) {
        .request-card {
            padding: 2rem;
            border-radius: var(--radius-xl);
        }
    }
    
    /* ============================================
       CATEGORY BADGE - MOBILE FIRST
    ============================================ */
    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        border-radius: var(--radius-full);
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 768px) {
        .category-badge {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
    }
    
    /* ============================================
       TITLE - MOBILE FIRST
    ============================================ */
    .request-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 0.75rem 0;
        line-height: 1.3;
        letter-spacing: -0.3px;
    }
    
    @media (min-width: 640px) {
        .request-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    }
    
    @media (min-width: 1024px) {
        .request-title {
            font-size: 2rem;
            letter-spacing: -0.5px;
        }
    }
    
    /* ============================================
       DESCRIPTION - MOBILE FIRST
    ============================================ */
    .request-description {
        color: var(--text-secondary);
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        white-space: pre-wrap;
        word-break: break-word;
    }
    
    @media (min-width: 768px) {
        .request-description {
            font-size: 0.9375rem;
            margin-bottom: 1.25rem;
        }
    }
    
    /* ============================================
       IMAGE GALLERY - MOBILE FIRST
    ============================================ */
    .image-gallery {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 640px) {
        .image-gallery {
            grid-template-columns: repeat(3, 1fr);
            gap: 0.75rem;
        }
    }
    
    @media (min-width: 1024px) {
        .image-gallery {
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }
    }
    
    .gallery-item {
        position: relative;
        aspect-ratio: 4 / 3;
        border-radius: var(--radius-sm);
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 768px) {
        .gallery-item {
            border-radius: var(--radius-md);
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
            z-index: 10;
        }
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    
    /* ============================================
       INFO GRID - MOBILE FIRST
    ============================================ */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 640px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }
    }
    
    @media (min-width: 1024px) {
        .info-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
    }
    
    .info-item {
        background: var(--bg-secondary);
        border-radius: var(--radius-sm);
        padding: 0.75rem;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    
    @media (min-width: 768px) {
        .info-item {
            padding: 1rem;
            border-radius: var(--radius-md);
            gap: 0.375rem;
        }
        
        .info-item:hover {
            background: var(--bg-tertiary);
            transform: translateY(-2px);
        }
    }
    
    .info-label {
        font-size: 0.625rem;
        font-weight: 600;
        color: var(--text-tertiary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
    }
    
    @media (min-width: 768px) {
        .info-label {
            font-size: 0.6875rem;
        }
    }
    
    .info-value {
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    @media (min-width: 768px) {
        .info-value {
            font-size: 0.875rem;
            gap: 0.375rem;
        }
    }
    
    .info-value i {
        color: var(--primary-blue);
        font-size: 0.875rem;
    }
    
    @media (min-width: 768px) {
        .info-value i {
            font-size: 1rem;
        }
    }
    
    /* ============================================
       APPLY BUTTON - MOBILE FIRST
       Sur mobile : Fixé en bas au-dessus de la navbar
       Sur desktop : Position normale
    ============================================ */
    .apply-button-container {
        position: fixed;
        /* S'adapte automatiquement à la hauteur de la navbar + safe area */
        bottom: calc(60px + env(safe-area-inset-bottom, 0px));
        left: 0;
        right: 0;
        z-index: 999;
        display: flex;
        justify-content: center;
        padding: 0.5rem 0.75rem;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.95));
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }
    
    @media (min-width: 768px) {
        .apply-button-container {
            bottom: calc(70px + env(safe-area-inset-bottom, 0px));
            padding: 0.75rem 1rem;
        }
    }
    
    @media (min-width: 1024px) {
        .apply-button-container {
            /* Sur desktop : position normale, pas fixée */
            position: sticky;
            bottom: 0.5rem;
            left: auto;
            right: auto;
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            box-shadow: none;
            border-top: none;
            padding: 0;
            margin: 1rem 0;
        }
    }
    
    .btn-apply {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        font-weight: 700;
        font-size: 0.875rem;
        padding: 0.875rem 2rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        width: 100%;
        max-width: 350px;
    }
    
    @media (min-width: 768px) {
        .btn-apply {
            font-size: 1rem;
            padding: 1rem 2.5rem;
            gap: 0.75rem;
            max-width: 400px;
        }
        
        .btn-apply:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
        }
    }
    
    @media (min-width: 1024px) {
        .btn-apply {
            width: auto;
            max-width: none;
        }
    }
    
    /* ============================================
       SECTION DIVIDER - MOBILE FIRST
    ============================================ */
    .section-divider {
        height: 1px;
        background: var(--bg-tertiary);
        margin: 1rem 0;
    }
    
    @media (min-width: 768px) {
        .section-divider {
            background: linear-gradient(90deg, transparent, var(--bg-tertiary), transparent);
            margin: 1.5rem 0;
        }
    }
    
    @media (min-width: 1024px) {
        .section-divider {
            margin: 2rem 0;
        }
    }
    
    /* ============================================
       CONTENT LAYOUT - OFFRES ET MESSAGERIE CÔTE À CÔTE
       Mobile: tout empilé verticalement
       Desktop: Offres | Messagerie côte à côte
    ============================================ */
    .content-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        padding-bottom: 1.5rem; /* Espace en bas sur mobile */
    }
    
    @media (min-width: 1024px) {
        .content-layout {
            grid-template-columns: 400px 1fr;
            gap: 1.5rem;
            padding-bottom: 0;
        }
    }
    
    @media (min-width: 1280px) {
        .content-layout {
            grid-template-columns: 450px 1fr;
            gap: 2rem;
        }
    }
    
    /* ============================================
       SECTION HEADER - MOBILE FIRST
    ============================================ */
    .section-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .section-header {
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
    }
    
    .section-icon {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
        box-shadow: var(--shadow-sm);
        flex-shrink: 0;
    }
    
    @media (min-width: 768px) {
        .section-icon {
            width: 36px;
            height: 36px;
            font-size: 1.125rem;
            border-radius: var(--radius-md);
        }
    }
    
    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        letter-spacing: -0.2px;
    }
    
    @media (min-width: 768px) {
        .section-title {
            font-size: 1.125rem;
            letter-spacing: -0.3px;
        }
    }
    
    /* ============================================
       OFFERS SECTION - MOBILE FIRST
    ============================================ */
    .offers-section {
        background: white;
        border-radius: var(--radius-md);
        padding: 1rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 1rem;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }
    
    @media (min-width: 768px) {
        .offers-section {
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }
    }
    
    @media (min-width: 1024px) {
        .offers-section {
            margin-bottom: 0;
            height: 600px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
    }
    
    .offers-section::-webkit-scrollbar {
        width: 4px;
    }
    
    .offers-section::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .offers-section::-webkit-scrollbar-thumb {
        background: var(--bg-tertiary);
        border-radius: var(--radius-full);
    }
    
    .offers-section .section-header {
        flex-shrink: 0;
    }
    
    .offer-card {
        background: linear-gradient(135deg, #FFF9E6 0%, #FFF4CC 100%);
        border: 2px solid #FFE066;
        border-radius: var(--radius-md);
        padding: 0.875rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s;
    }
    
    .offer-card:last-child {
        margin-bottom: 0;
    }
    
    @media (min-width: 768px) {
        .offer-card {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: var(--radius-lg);
        }
        
        .offer-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: #FFCC00;
        }
    }
    
    .offer-header {
        display: flex;
        align-items: center;
        gap: 0.625rem;
        margin-bottom: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .offer-header {
            gap: 0.875rem;
            margin-bottom: 0.875rem;
        }
    }
    
    .provider-avatar {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #FFCC00;
        box-shadow: var(--shadow-sm);
    }
    
    @media (min-width: 768px) {
        .provider-avatar {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-width: 3px;
        }
    }
    
    .provider-info {
        flex: 1;
        min-width: 0;
    }
    
    .provider-name {
        font-weight: 700;
        color: #8B6914;
        font-size: 0.875rem;
        margin-bottom: 0.125rem;
    }
    
    @media (min-width: 768px) {
        .provider-name {
            font-size: 0.9375rem;
            margin-bottom: 0.25rem;
        }
    }
    
    .provider-rating {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        color: #A87C1A;
        font-size: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .provider-rating {
            gap: 0.375rem;
            font-size: 0.8125rem;
        }
    }
    
    .offer-price {
        font-size: 1.125rem;
        font-weight: 800;
        color: #8B6914;
        white-space: nowrap;
    }
    
    @media (min-width: 768px) {
        .offer-price {
            font-size: 1.25rem;
        }
    }
    
    .offer-message {
        color: #6B5416;
        font-size: 0.8125rem;
        line-height: 1.5;
        margin-bottom: 0.625rem;
    }
    
    @media (min-width: 768px) {
        .offer-message {
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 0.75rem;
        }
    }
    
    .offer-delivery {
        color: #A87C1A;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-bottom: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .offer-delivery {
            font-size: 0.8125rem;
            gap: 0.375rem;
            margin-bottom: 0.875rem;
        }
    }
    
    .btn-choose-provider {
        background: linear-gradient(135deg, #FFCC00, #FFB300);
        color: #6B5416;
        font-weight: 700;
        font-size: 0.8125rem;
        padding: 0.625rem 1.25rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        width: 100%;
        transition: all 0.2s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    @media (min-width: 768px) {
        .btn-choose-provider {
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
        }
        
        .btn-choose-provider:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 204, 0, 0.4);
        }
    }
    
    .empty-state {
        text-align: center;
        padding: 2rem 1rem;
        color: var(--text-tertiary);
    }
    
    @media (min-width: 768px) {
        .empty-state {
            padding: 3rem 1.5rem;
        }
    }
    
    .empty-icon {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        opacity: 0.3;
    }
    
    @media (min-width: 768px) {
        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    }
    
    .empty-text {
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    @media (min-width: 768px) {
        .empty-text {
            font-size: 0.9375rem;
        }
    }
    
    /* ============================================
       MESSAGES SECTION - MOBILE FIRST
    ============================================ */
    .messages-section {
        background: #FFFFFF;
        border-radius: var(--radius-md);
        padding: 1rem;
        box-shadow: var(--shadow-sm);
        display: flex;
        flex-direction: column;
        height: 400px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.06);
        margin-bottom: 1rem; /* Espace en bas sur mobile */
    }
    
    @media (min-width: 640px) {
        .messages-section {
            height: 500px;
            margin-bottom: 1.5rem;
        }
    }
    
    @media (min-width: 768px) {
        .messages-section {
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            height: 550px;
            margin-bottom: 2rem;
        }
    }
    
    @media (min-width: 1024px) {
        .messages-section {
            height: 600px;
            margin-bottom: 0; /* Pas de margin sur desktop */
        }
    }
    
    /* Pattern WhatsApp */
    .messages-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('{{ asset("images/logo-512x512.webp") }}');
        background-size: 80px 80px;
        background-repeat: repeat;
        background-position: 0 0;
        opacity: 0.04;
        pointer-events: none;
        z-index: 0;
    }
    
    @media (min-width: 768px) {
        .messages-section::before {
            background-size: 100px 100px;
            opacity: 0.05;
        }
    }
    
    @media (min-width: 1024px) {
        .messages-section::before {
            background-size: 120px 120px;
        }
    }
    
    .messages-section > * {
        position: relative;
        z-index: 1;
    }
    
    .messages-list {
        flex: 1;
        overflow-y: auto;
        padding: 0.25rem 0;
        margin-bottom: 0.75rem;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    
    @media (min-width: 768px) {
        .messages-list {
            padding: 0.5rem 0;
            margin-bottom: 1rem;
        }
    }
    
    .messages-list::-webkit-scrollbar {
        width: 3px;
    }
    
    @media (min-width: 768px) {
        .messages-list::-webkit-scrollbar {
            width: 4px;
        }
    }
    
    .messages-list::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .messages-list::-webkit-scrollbar-thumb {
        background: var(--bg-tertiary);
        border-radius: var(--radius-full);
    }
    
    /* Messages iPhone style - CORRIGÉ POUR ÉVITER L'AFFICHAGE VERTICAL */
    .message-left {
        display: flex;
        align-items: flex-start;
        gap: 0.375rem;
        margin-bottom: 0.625rem;
        width: 100%;
    }
    
    @media (min-width: 768px) {
        .message-left {
            gap: 0.5rem;
            margin-bottom: 0.875rem;
        }
    }
    
    .message-left img {
        width: 28px;
        height: 28px;
        min-width: 28px;
        flex-shrink: 0;
        border-radius: 50%;
        object-fit: cover;
    }
    
    @media (min-width: 768px) {
        .message-left img {
            width: 32px;
            height: 32px;
            min-width: 32px;
        }
    }
    
    .message-left > div {
        flex: 1;
        min-width: 0;
        max-width: 85%;
    }
    
    @media (min-width: 768px) {
        .message-left > div {
            max-width: 70%;
        }
    }
    
    @media (min-width: 1024px) {
        .message-left > div {
            max-width: 60%;
        }
    }
    
    .message-bubble-left {
        background: var(--secondary-gray);
        color: var(--text-primary);
        padding: 0.625rem 0.75rem;
        border-radius: 16px 16px 16px 4px;
        width: fit-content;
        max-width: 100%;
        box-shadow: var(--shadow-sm);
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    @media (min-width: 768px) {
        .message-bubble-left {
            padding: 0.75rem 1rem;
            border-radius: 18px 18px 18px 4px;
        }
    }
    
    .message-right {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 0.625rem;
        width: 100%;
    }
    
    @media (min-width: 768px) {
        .message-right {
            margin-bottom: 0.875rem;
        }
    }
    
    .message-bubble-right {
        background: var(--primary-blue);
        color: white;
        padding: 0.625rem 0.75rem;
        border-radius: 16px 16px 4px 16px;
        max-width: 85%;
        width: fit-content;
        box-shadow: 0 1px 2px rgba(0, 122, 255, 0.3);
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    @media (min-width: 768px) {
        .message-bubble-right {
            padding: 0.75rem 1rem;
            border-radius: 18px 18px 4px 18px;
            max-width: 70%;
        }
    }
    
    @media (min-width: 1024px) {
        .message-bubble-right {
            max-width: 60%;
        }
    }
    
    .message-author {
        font-size: 0.625rem;
        font-weight: 600;
        margin-bottom: 0.125rem;
        opacity: 0.8;
    }
    
    @media (min-width: 768px) {
        .message-author {
            font-size: 0.6875rem;
            margin-bottom: 0.25rem;
        }
    }
    
    .message-text {
        font-size: 0.875rem;
        line-height: 1.4;
        white-space: pre-wrap;
        word-break: break-word;
    }
    
    @media (min-width: 768px) {
        .message-text {
            font-size: 0.9375rem;
        }
    }
    
    .message-time {
        font-size: 0.625rem;
        margin-top: 0.125rem;
        opacity: 0.6;
        text-align: right;
    }
    
    @media (min-width: 768px) {
        .message-time {
            font-size: 0.6875rem;
            margin-top: 0.25rem;
        }
    }
    
    /* Message Form */
    .message-form {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-top: 0.75rem;
        border-top: 1px solid var(--bg-tertiary);
    }
    
    @media (min-width: 768px) {
        .message-form {
            gap: 0.625rem;
            padding-top: 0.875rem;
        }
    }
    
    .message-input-wrapper {
        flex: 1;
        position: relative;
    }
    
    .message-input {
        width: 100%;
        min-height: 34px;
        max-height: 80px;
        padding: 0.5rem 0.875rem;
        background: #F0F0F0;
        border: 2px solid #D1D1D6;
        border-radius: 17px;
        font-size: 0.875rem;
        font-family: inherit;
        resize: none;
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .message-input {
            min-height: 36px;
            max-height: 100px;
            padding: 0.625rem 1rem;
            border-radius: 18px;
            font-size: 0.9375rem;
        }
    }
    
    .message-input:focus {
        outline: none;
        background: white;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.1);
    }
    
    @media (min-width: 768px) {
        .message-input:focus {
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
        }
    }
    
    .message-input::placeholder {
        color: #8E8E93;
    }
    
    /* Emoji Button */
    .btn-emoji {
        width: 34px;
        height: 34px;
        min-width: 34px;
        background: transparent;
        border: none;
        border-radius: 50%;
        font-size: 1.25rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    @media (min-width: 768px) {
        .btn-emoji {
            width: 36px;
            height: 36px;
            min-width: 36px;
            font-size: 1.375rem;
        }
        
        .btn-emoji:hover {
            background: #F0F0F0;
        }
    }
    
    .btn-emoji:active {
        transform: scale(0.9);
    }
    
    /* Voice Button */
    .btn-voice {
        width: 34px;
        height: 34px;
        min-width: 34px;
        background: transparent;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--text-tertiary);
    }
    
    @media (min-width: 768px) {
        .btn-voice {
            width: 36px;
            height: 36px;
            min-width: 36px;
        }
        
        .btn-voice:hover {
            background: #F0F0F0;
        }
    }
    
    .btn-voice i {
        font-size: 1rem;
    }
    
    @media (min-width: 768px) {
        .btn-voice i {
            font-size: 1.125rem;
        }
    }
    
    .btn-voice:active {
        transform: scale(0.9);
    }
    
    /* Voice Button - Listening State */
    .btn-voice.listening {
        background: #FF3B30;
        color: white;
        animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(255, 59, 48, 0.7);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(255, 59, 48, 0);
        }
    }
    
    .btn-send-message {
        width: 34px;
        height: 34px;
        min-width: 34px;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(0, 122, 255, 0.3);
        flex-shrink: 0;
        /* Forcer l'affichage de l'icône uniquement */
        font-size: 0 !important;
        line-height: 0 !important;
        text-indent: 0 !important;
        overflow: hidden;
    }
    
    @media (min-width: 768px) {
        .btn-send-message {
            width: 36px;
            height: 36px;
            min-width: 36px;
            box-shadow: 0 2px 8px rgba(0, 122, 255, 0.3);
        }
        
        .btn-send-message:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 122, 255, 0.4);
        }
    }
    
    .btn-send-message:active {
        transform: scale(0.95);
    }
    
    .btn-send-message i {
        font-size: 0.875rem !important;
        display: block !important;
        visibility: visible !important;
        line-height: 1 !important;
        text-indent: 0 !important;
        position: relative;
        z-index: 1;
    }
    
    @media (min-width: 768px) {
        .btn-send-message i {
            font-size: 1rem !important;
        }
    }
    
    /* Empêcher tout texte d'apparaître dans le bouton */
    .btn-send-message::before,
    .btn-send-message::after {
        content: none !important;
    }
    
    /* Messages Closed */
    .messages-closed {
        text-align: center;
        padding: 2rem 1rem;
        background: linear-gradient(135deg, #FFF9E6 0%, #FFF4CC 100%);
        border: 2px solid #FFE066;
        border-radius: var(--radius-md);
    }
    
    @media (min-width: 768px) {
        .messages-closed {
            padding: 3rem 1.5rem;
            border-radius: var(--radius-lg);
        }
    }
    
    .messages-closed-icon {
        font-size: 2.5rem;
        color: #A87C1A;
        margin-bottom: 0.75rem;
        opacity: 0.6;
    }
    
    @media (min-width: 768px) {
        .messages-closed-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    }
    
    .messages-closed-title {
        font-size: 1rem;
        font-weight: 700;
        color: #6B5416;
        margin-bottom: 0.5rem;
    }
    
    @media (min-width: 768px) {
        .messages-closed-title {
            font-size: 1.125rem;
            margin-bottom: 0.75rem;
        }
    }
    
    .messages-closed-text {
        font-size: 0.8125rem;
        color: #8B6914;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 768px) {
        .messages-closed-text {
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }
    }
    
    .btn-private-message {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: var(--radius-full);
        font-weight: 700;
        font-size: 0.8125rem;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .btn-private-message {
            padding: 0.875rem 1.75rem;
            font-size: 0.875rem;
            gap: 0.625rem;
        }
        
        .btn-private-message:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
        }
    }
    
    /* ============================================
       IMAGE MODAL - MOBILE FIRST
    ============================================ */
    .image-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    .image-modal.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .image-modal-content {
        max-width: 95vw;
        max-height: 95vh;
        position: relative;
    }
    
    @media (min-width: 768px) {
        .image-modal-content {
            max-width: 90vw;
            max-height: 90vh;
        }
    }
    
    .image-modal-content img {
        max-width: 100%;
        max-height: 95vh;
        border-radius: var(--radius-sm);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
    }
    
    @media (min-width: 768px) {
        .image-modal-content img {
            max-height: 90vh;
            border-radius: var(--radius-lg);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }
    }
    
    .image-modal-close {
        position: absolute;
        top: -0.75rem;
        right: -0.75rem;
        width: 36px;
        height: 36px;
        background: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.25rem;
        color: var(--text-primary);
        box-shadow: var(--shadow-lg);
        transition: all 0.2s;
        z-index: 10;
    }
    
    @media (min-width: 768px) {
        .image-modal-close {
            top: -1rem;
            right: -1rem;
            width: 40px;
            height: 40px;
            font-size: 1.5rem;
        }
        
        .image-modal-close:hover {
            transform: rotate(90deg) scale(1.1);
        }
    }
    
    /* ============================================
       MODALS - MOBILE FIRST
    ============================================ */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }
    
    @media (min-width: 768px) {
        .modal-overlay {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    }
    
    .modal-overlay.active {
        opacity: 1;
        pointer-events: all;
    }
    
    .modal-content {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
        padding: 1.5rem 1rem;
        position: relative;
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s;
        max-height: 90vh;
        overflow-y: auto;
    }
    
    @media (min-width: 768px) {
        .modal-content {
            padding: 2rem 1.5rem;
            border-radius: var(--radius-xl);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1);
        opacity: 1;
    }
    
    .modal-close {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        width: 28px;
        height: 28px;
        background: var(--bg-secondary);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1rem;
        color: var(--text-secondary);
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .modal-close {
            top: 1rem;
            right: 1rem;
            width: 32px;
            height: 32px;
            font-size: 1.125rem;
        }
        
        .modal-close:hover {
            background: var(--bg-tertiary);
            transform: rotate(90deg);
        }
    }
    
    .modal-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.75rem;
        box-shadow: 0 6px 16px rgba(0, 122, 255, 0.3);
    }
    
    @media (min-width: 768px) {
        .modal-icon {
            width: 64px;
            height: 64px;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            box-shadow: 0 8px 24px rgba(0, 122, 255, 0.3);
        }
    }
    
    .modal-title {
        font-size: 1.125rem;
        font-weight: 800;
        color: var(--text-primary);
        text-align: center;
        margin-bottom: 0.5rem;
        letter-spacing: -0.3px;
    }
    
    @media (min-width: 768px) {
        .modal-title {
            font-size: 1.375rem;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }
    }
    
    .modal-subtitle {
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    @media (min-width: 768px) {
        .modal-subtitle {
            font-size: 0.9375rem;
            margin-bottom: 1.5rem;
        }
    }
    
    .modal-features {
        list-style: none;
        padding: 0;
        margin: 0 0 1rem 0;
    }
    
    @media (min-width: 768px) {
        .modal-features {
            margin-bottom: 1.5rem;
        }
    }
    
    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 0.625rem;
        padding: 0.625rem 0;
        border-bottom: 1px solid var(--bg-secondary);
    }
    
    @media (min-width: 768px) {
        .feature-item {
            gap: 0.875rem;
            padding: 0.875rem 0;
        }
    }
    
    .feature-item:last-child {
        border-bottom: none;
    }
    
    .feature-icon {
        width: 24px;
        min-width: 24px;
        height: 24px;
        background: var(--success-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .feature-icon {
            width: 28px;
            min-width: 28px;
            height: 28px;
            font-size: 0.875rem;
        }
    }
    
    .feature-text {
        flex: 1;
        font-size: 0.8125rem;
        line-height: 1.6;
        color: var(--text-secondary);
    }
    
    @media (min-width: 768px) {
        .feature-text {
            font-size: 0.9375rem;
        }
    }
    
    .feature-highlight {
        font-weight: 700;
        color: var(--text-primary);
    }
    
    .modal-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .modal-actions {
            gap: 0.875rem;
        }
    }
    
    @media (min-width: 1024px) {
        .modal-actions {
            flex-direction: row;
        }
    }
    
    .btn-modal-primary {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        color: white;
        font-weight: 700;
        font-size: 0.9375rem;
        padding: 0.875rem 1.75rem;
        border-radius: var(--radius-full);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
        text-decoration: none;
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .btn-modal-primary {
            font-size: 1rem;
            padding: 1rem 2rem;
            gap: 0.625rem;
        }
        
        .btn-modal-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 122, 255, 0.4);
        }
    }
    
    .btn-modal-secondary {
        background: transparent;
        color: var(--danger-red);
        font-weight: 600;
        font-size: 0.875rem;
        padding: 0.75rem 1.5rem;
        border: 2px solid var(--danger-red);
        border-radius: var(--radius-full);
        cursor: pointer;
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .btn-modal-secondary {
            font-size: 0.9375rem;
            padding: 0.875rem 2rem;
        }
        
        .btn-modal-secondary:hover {
            background: var(--danger-red);
            color: white;
        }
    }
    
    /* ============================================
       FORM STYLES - MOBILE FIRST
    ============================================ */
    .form-group {
        margin-bottom: 1rem;
    }
    
    @media (min-width: 768px) {
        .form-group {
            margin-bottom: 1.25rem;
        }
    }
    
    .form-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    
    @media (min-width: 768px) {
        .form-label {
            font-size: 0.875rem;
            margin-bottom: 0.625rem;
        }
    }
    
    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 0.875rem;
        background: var(--bg-secondary);
        border: 2px solid var(--bg-tertiary);
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        font-family: inherit;
        transition: all 0.2s;
    }
    
    @media (min-width: 768px) {
        .form-input,
        .form-textarea {
            padding: 0.875rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.9375rem;
        }
    }
    
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        background: white;
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.1);
    }
    
    @media (min-width: 768px) {
        .form-input:focus,
        .form-textarea:focus {
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
        }
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }
    
    @media (min-width: 768px) {
        .form-textarea {
            min-height: 100px;
        }
    }
    
    .form-error {
        color: var(--danger-red);
        font-size: 0.75rem;
        margin-top: 0.375rem;
        display: none;
    }
    
    @media (min-width: 768px) {
        .form-error {
            font-size: 0.8125rem;
            margin-top: 0.5rem;
        }
    }
    
    .form-error.visible {
        display: block;
    }
    
    /* Success Modal */
    .modal-success-icon {
        width: 64px;
        height: 64px;
        background: var(--success-green);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2rem;
        animation: successPulse 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @media (min-width: 768px) {
        .modal-success-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
            font-size: 2.5rem;
        }
    }
    
    @keyframes successPulse {
        0% { transform: scale(0); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    /* ============================================
       UTILITY CLASSES
    ============================================ */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Hide scroll to top button */
    #scrollToTop,
    .scroll-to-top,
    .back-to-top,
    [class*="scroll-top"],
    [id*="scroll-top"] {
        display: none !important;
    }
    
    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<div class="request-details-container" @if($showAccessDeniedModal) style="filter: blur(8px); pointer-events: none;" @endif>
    
    {{-- Bandeau informatif Provider - visible uniquement pour les providers/admins (pas pour les owners) --}}
    @if(($isProvider || $isAdmin) && !$isOwner)
    <div class="provider-info-banner">
        <i class="fas fa-user-tie"></i>
        <span>Provider view - You can submit a price proposal for this service request</span>
    </div>
    @endif
    
    <!-- REQUEST CARD -->
    <div class="request-card">
        
        <!-- Category Badge -->
        <div class="category-badge">
            <i class="fas fa-folder-open"></i>
            <span>
                {{ $mission->category->name ?? 'Category' }} 
                @if($mission->subcategory)
                    › {{ $mission->subcategory->name }}
                @endif
                @if($mission->subsubcategory)
                    › {{ $mission->subsubcategory->name }}
                @endif
            </span>
        </div>
        
        <!-- Title -->
        <h1 class="request-title">{{ $mission->title }}</h1>
        
        <!-- Description -->
        <div class="request-description">{{ $mission->description }}</div>
        
        <!-- Image Gallery -->
        @if($images && count($images) > 0)
        <div class="image-gallery">
            @foreach($images as $img)
            <div class="gallery-item"
     onclick="openImageModal('{{ asset($img) }}')"
     role="button"
     tabindex="0"
     onkeydown="if(event.key==='Enter') openImageModal('{{ asset($img) }}')"
     aria-label="View attachment">
    <img src="{{ asset($img) }}" alt="Mission attachment" loading="lazy" />
</div>
            @endforeach
        </div>
        @endif
        
        <!-- Info Grid -->
        <div class="info-grid">
            <!-- Time remaining before deletion -->
            <div class="info-item">
                <div class="info-label">Ad Unpublished In</div>
                <div class="info-value">
                    <i class="fas fa-calendar-times"></i>
                    <span>{{ $remainingDays }} {{ $remainingDays == 1 ? 'Day' : 'Days' }}</span>
                </div>
            </div>
            
            <!-- Country of assistance -->
            <div class="info-item">
                <div class="info-label">Country of Assistance</div>
                <div class="info-value">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $mission->location_country ?? 'Not specified' }}</span>
                </div>
            </div>
            
            <!-- City -->
            @if($mission->location_city)
            <div class="info-item">
                <div class="info-label">City</div>
                <div class="info-value">
                    <i class="fas fa-city"></i>
                    <span>{{ $mission->location_city }}</span>
                </div>
            </div>
            @endif
            
            <!-- Spoken languages -->
            <div class="info-item">
                <div class="info-label">Spoken Languages</div>
                <div class="info-value">
                    <i class="fas fa-language"></i>
                    <span>
                        @php
                            $languages = json_decode($mission->spoken_languages ?? '[]', true);
                            if (empty($languages)) {
                                $languages = $mission->language ? [$mission->language] : ['Not specified'];
                            } else {
                                // Supprimer les doublons
                                $languages = array_unique($languages);
                            }
                            echo implode(', ', $languages);
                        @endphp
                    </span>
                </div>
            </div>
            
            <!-- Type of need -->
            <div class="info-item">
                <div class="info-label">Type of Need</div>
                <div class="info-value">
                    <i class="fas fa-{{ $mission->is_remote ? 'laptop' : 'handshake' }}"></i>
                    <span>{{ $mission->is_remote ? 'Online' : 'In-Person' }}</span>
                </div>
            </div>
            
            <!-- Urgency -->
            <div class="info-item">
                <div class="info-label">Urgency</div>
                <div class="info-value">
                    @php
                        $urgencyMap = [
                            'urgent' => ['icon' => 'exclamation-circle', 'color' => '#FF3B30', 'label' => 'Urgent'],
                            'high' => ['icon' => 'clock', 'color' => '#FF9500', 'label' => 'Within a week'],
                            'medium' => ['icon' => 'calendar', 'color' => '#FFCC00', 'label' => '1-2 weeks'],
                            'low' => ['icon' => 'calendar-alt', 'color' => '#34C759', 'label' => 'More than a month']
                        ];
                        $urgency = $urgencyMap[$mission->urgency] ?? ['icon' => 'calendar', 'color' => '#8E8E93', 'label' => 'Not specified'];
                    @endphp
                    <i class="fas fa-{{ $urgency['icon'] }}" style="color: {{ $urgency['color'] }};"></i>
                    <span style="color: {{ $urgency['color'] }}; font-weight: 700;">{{ $urgency['label'] }}</span>
                </div>
            </div>
            
            <!-- Duration in country -->
            @if($mission->requester_duration_in_country)
            <div class="info-item">
                <div class="info-label">In Country Since</div>
                <div class="info-value">
                    <i class="fas fa-hourglass-half"></i>
                    <span>{{ $mission->requester_duration_in_country }}</span>
                </div>
            </div>
            @endif
            
            <!-- Requester's origin country -->
            @if($mission->requester && $mission->requester->country)
            <div class="info-item">
                <div class="info-label">Requester's Origin Country</div>
                <div class="info-value">
                    <i class="fas fa-flag"></i>
                    <span>{{ $mission->requester->country }}</span>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Apply Button -->
        @if(auth()->check() && $mission && $mission->requester_id != auth()->id())
<div class="apply-button-container">
    <button onclick="openOfferModal()" class="btn-apply">
        <i class="fas fa-paper-plane"></i>
        <span>Make a Price Proposal</span>
    </button>
</div>
@endif
    </div>
    
    <!-- Section Divider -->
    <div class="section-divider"></div>
    
    <!-- Main Content Layout: Offres | Messagerie -->
    <div class="content-layout">
        
        <!-- OFFERS SECTION (left column) -->
        <div class="offers-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h2 class="section-title">Offres recues</h2>
            </div>
            
            @forelse($offers as $offer)
            <div class="offer-card">
                <div class="offer-header">
                    @if($offer->provider && $offer->provider->profile_photo)
                    <img src="{{ asset($offer->provider->profile_photo) }}"
                         alt="{{ $offer->provider->first_name ?? 'Provider' }}"
                         class="provider-avatar" />
                    @else
                    <div class="provider-avatar" style="background: linear-gradient(135deg, #FFB300, #FF8F00); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700;">
                        {{ substr($offer->provider->first_name ?? 'P', 0, 1) }}
                    </div>
                    @endif
                    
                    <div class="provider-info">
                        <div class="provider-name">{{ $offer->provider->first_name ?? 'Provider' }}</div>
                        <div class="provider-rating">
                            <i class="fas fa-star"></i>
                            <span>{{ $offer->provider->rating ?? '5.0' }}</span>
                        </div>
                    </div>
                    
                    <div class="offer-price">{{ $offer->price ?? '-' }} €</div>
                </div>
                
                <div class="offer-message">{{ $offer->message ?? 'No message provided.' }}</div>
                
                <div class="offer-delivery">
                    <i class="fas fa-clock"></i>
                    <span>Delivery: {{ $offer->delivery_time ?? '-' }}</span>
                </div>
                
                @if(auth()->check() && $mission && $mission->requester_id == auth()->id())
<button onclick="chooseProvider({{ $offer->provider->id }}, '{{ addslashes($offer->provider->first_name) }}')"
        class="btn-choose-provider">
    Choose {{ $offer->provider->first_name }}
</button>
@endif
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="empty-text">No offers received yet</div>
            </div>
            @endforelse
        </div>
        
        <!-- MESSAGES SECTION (right column) -->
        <div class="messages-section">
            <div class="section-header">
                <div class="section-icon">
                    <i class="fas fa-{{ is_null($mission->selected_provider_id) ? 'comments' : 'lock' }}"></i>
                </div>
                <h2 class="section-title">
                    {{ is_null($mission->selected_provider_id) ? 'Messages publics' : 'Messages publics fermés' }}
                </h2>
            </div>
            
            @if(is_null($mission->selected_provider_id))
                <!-- Public Messaging Open -->
                <div class="messages-list" id="messagesList"></div>
                
                <form id="publicMessageForm" class="message-form">
                    <button type="button" class="btn-emoji" id="emojiBtn" translate="no" aria-label="Emoji">
                        😊
                    </button>
                    <button type="button" class="btn-voice" id="voiceBtn" translate="no" aria-label="Voice input" style="display: none;">
                        <i class="fas fa-microphone"></i>
                    </button>
                    <div class="message-input-wrapper">
                        <textarea id="publicMessageInput"
                                  class="message-input"
                                  placeholder="Type a message..."
                                  rows="1"
                                  maxlength="500"
                                  required></textarea>
                    </div>
                    <button type="submit" class="btn-send-message" translate="no" aria-label="Send message">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                </form>
                
                <div id="public-message-error" class="form-error"></div>
            @else
                <!-- Public Messaging Closed -->
                <div class="messages-closed">
                    <div class="messages-closed-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="messages-closed-title">Public Messaging Closed</h3>
                    <p class="messages-closed-text">
                        This mission now has a selected provider.<br>
                        Public messaging is no longer available.
                    </p>
                    <a href="{{ route('user.conversation') }}" class="btn-private-message">
                        <i class="fas fa-comments"></i>
                        <span>Use Private Messaging</span>
                    </a>
                </div>
            @endif
        </div>
        
    </div>
    
    <!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()" role="dialog" aria-modal="true">
    <div class="image-modal-content" onclick="event.stopPropagation()">
        <button class="image-modal-close" onclick="closeImageModal()">✕</button>
        <img id="imageModalImg" src="" alt="Full size attachment" />
    </div>
</div>
    
<!-- Offer Modal -->
<div id="offerModal" class="modal-overlay" onclick="closeOfferModal()" role="dialog" aria-modal="true">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button onclick="closeOfferModal()" class="modal-close">✕</button>
        
        <div class="modal-icon">
            <i class="fas fa-paper-plane"></i>
        </div>
        
        <h2 class="modal-title">Send Your Offer</h2>
        
        <form id="offerForm" onsubmit="submitOfferForm(event)">
            <div class="form-group">
                <label for="offerPrice" class="form-label">Your Proposed Price (€)</label>
                <input type="number"
                       id="offerPrice"
                       class="form-input"
                       placeholder="e.g. 50"
                       min="1"
                       step="0.01"
                       required />
            </div>
            
            <div class="form-group">
                <label for="offerDelivery" class="form-label">Estimated Delivery Time</label>
                <input type="text"
                       id="offerDelivery"
                       class="form-input"
                       placeholder="e.g. 2 days"
                       maxlength="50"
                       required />
            </div>
            
            <div class="form-group">
                <label for="offerMessage" class="form-label">Message (max 300 characters)</label>
                <textarea id="offerMessage"
                          class="form-textarea"
                          maxlength="300"
                          placeholder="I'm available and ready to help!"
                          required></textarea>
            </div>
            
            <div id="offerError" class="form-error"></div>
            
            <button type="submit" class="btn-modal-primary" style="width: 100%; border: none; cursor: pointer;">
                <i class="fas fa-paper-plane"></i>
                <span>Submit Offer</span>
            </button>
        </form>
    </div>
</div>
    
<!-- Confirm Provider Modal -->
<div id="confirmModal" class="modal-overlay" onclick="closeConfirmModal()" role="dialog" aria-modal="true">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button onclick="closeConfirmModal()" class="modal-close">✕</button>
        
        <div class="modal-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h2 class="modal-title">You're Almost There! 🎯</h2>
        
        <p class="modal-subtitle">
            You're about to work with <strong id="selectedProviderNameDisplay" style="color: var(--primary-blue);"></strong>.<br>
            Here's what happens next:
        </p>
        
        <ul class="modal-features">
            <li class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="feature-text">
                    <span class="feature-highlight">Your payment is protected</span> — it's securely held by Stripe and will only be released once the job is completed.
                </div>
            </li>
            <li class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="feature-text">
                    <span class="feature-highlight">You'll unlock chat</span> with the provider right after confirming.
                </div>
            </li>
            <li class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="feature-text">
                    <span class="feature-highlight">We're here to help</span> all along — if anything goes wrong, reach out!
                </div>
            </li>
        </ul>
        
        <div class="modal-actions">
            <button onclick="confirmAndPay()" 
                    class="btn-modal-primary" 
                    style="width: 100%; border: none; cursor: pointer;">
                <i class="fas fa-check"></i>
                <span>Confirm & Pay</span>
            </button>
            <button onclick="closeConfirmModal()"
                    class="btn-modal-secondary">
                ← Choose Another Provider
            </button>
        </div>
    </div>
</div>
    
<!-- Success Modal -->
<div id="successModal" class="modal-overlay" onclick="closeSuccessModal()" role="dialog" aria-modal="true">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button onclick="closeSuccessModal()" class="modal-close">✕</button>
        
        <div class="modal-success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h2 class="modal-title">Thank You!</h2>
        
        <p class="modal-subtitle" style="font-weight: 600; color: var(--primary-blue);">
            Your request has been sent to the requester
        </p>
        
        <p style="text-align: center; color: var(--text-secondary); font-size: 0.875rem; line-height: 1.6;">
            You will be informed if your application is accepted via your personal messaging and by email.
        </p>
    </div>
</div>
    
</div>

{{-- Modal Accès Refusé pour les non-providers --}}
@if($showAccessDeniedModal)
<div class="modal-overlay active" id="accessDeniedModal" style="z-index: 10000;">
    <div class="modal-content" style="max-width: 450px;">
        <div style="text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🔒</div>
            <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem; color: #FF3B30;">Access Denied</h2>
            <p style="color: #666; font-size: 1rem; line-height: 1.6; margin-bottom: 2rem;">
                This page is reserved for <strong>service providers</strong> only.<br>
                You don't have permission to access this content.
            </p>
            
            <button onclick="window.history.back();" 
                    class="btn-modal-primary" 
                    style="text-decoration: none; border: none; cursor: pointer;">
                <i class="fas fa-arrow-left"></i>
                <span>Go Back</span>
            </button>
        </div>
    </div>
</div>

<script>
// Empêcher la fermeture du modal en cliquant dehors
document.getElementById('accessDeniedModal')?.addEventListener('click', function(e) {
    e.stopPropagation();
});
</script>
@endif

        
@if(is_null($mission->selected_provider_id))
<script>
// ✅ VANILLA JS POUR LES MESSAGES - STYLE IPHONE RESPONSIVE
@if(is_null($mission->selected_provider_id))
document.addEventListener('DOMContentLoaded', function() {
    const currentUserId = {{ auth()->id() ?? 'null' }};
    
    function renderPublicMessages(messages) {
        const list = document.getElementById('messagesList');
        list.innerHTML = '';
        
        if (messages.length === 0) {
            list.innerHTML = '<div class="empty-state"><div class="empty-icon"><i class="fas fa-comments"></i></div><div class="empty-text">No messages yet. Start the conversation!</div></div>';
            return;
        }
        
        messages.forEach(msg => {
            // L'ID utilisateur est maintenant dans msg.user.id (corrigé côté backend)
            const userId = (msg.user && msg.user.id) || msg.user_id || msg.sender_id;
            const isFromMe = currentUserId && userId && parseInt(userId) === parseInt(currentUserId);
            
            // FIX: Correction pour l'image de profil avec meilleure gestion des chemins
            let profileImage = '{{ asset('images/helpexpat.png') }}';
            if (msg.user && msg.user.profile_photo) {
                const photo = msg.user.profile_photo;
                
                // Si le chemin commence par http:// ou https://, utiliser tel quel
                if (photo.startsWith('http://') || photo.startsWith('https://')) {
                    profileImage = photo;
                }
                // Si le chemin commence par storage/, utiliser asset()
                else if (photo.startsWith('storage/')) {
                    profileImage = '{{ asset('') }}' + photo;
                }
                // Si le chemin commence par /, utiliser tel quel
                else if (photo.startsWith('/')) {
                    profileImage = photo;
                }
                // Sinon, ajouter le préfixe storage/
                else {
                    profileImage = '{{ asset('storage/') }}' + photo;
                }
            }
            
            // Échapper le message pour éviter les problèmes XSS
            const safeMessage = msg.message.replace(/</g, '&lt;').replace(/>/g, '&gt;');
            const userName = msg.user ? (msg.user.name || 'User') : 'User';
            
            if (isFromMe) {
                // Message à DROITE (l'utilisateur qui envoie) - Style iMessage bleu
                list.innerHTML += `
                    <div class="message-right">
                        <div class="message-bubble-right">
                            <div class="message-text">${safeMessage}</div>
                            <div class="message-time">${msg.created_at}</div>
                        </div>
                    </div>
                `;
            } else {
                // Message à GAUCHE (les autres utilisateurs) - Style iMessage gris
                list.innerHTML += `
                    <div class="message-left">
                        <img src="${profileImage}" 
                             alt="${userName}"
                             onerror="this.src='{{ asset('images/helpexpat.png') }}'" />
                        <div>
                            <div class="message-bubble-left">
                                <div class="message-author">${userName}</div>
                                <div class="message-text">${safeMessage}</div>
                                <div class="message-time">${msg.created_at}</div>
                            </div>
                        </div>
                    </div>
                `;
            }
        });
        
        // Auto-scroll to bottom
        list.scrollTop = list.scrollHeight;
    }
    
    function loadPublicMessages() {
        fetch("{{ route('mission.public-messages', $mission->id) }}")
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    renderPublicMessages(data.messages);
                }
            })
            .catch(err => {
                console.error('Error loading messages:', err);
            });
    }
    
    function sanitizeMessage(msg) {
        let out = msg;
        out = out.replace(/\b([A-Za-z0-9._%+-])[A-Za-z0-9._%+-]*@gmail\.com\b/gi, '$1@gmail.com');
        out = out.replace(/\bhttps?:\/\/[^\s)]+/gi, 'www.....com');
        out = out.replace(/\bwww\.[A-Za-z0-9-]+(?:\.[A-Za-z]{2,24})(?:\/[^\s)]*)?\b/gi, 'www.....com');
        try {
            out = out.replace(/(?<!@)\b[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi, 'www.....com');
        } catch (e) {
            out = out.replace(/\b(?![A-Za-z0-9._%+-]+@)[A-Za-z0-9-]+(?:\.[A-Za-z0-9-]+)*\.[A-Za-z]{2,24}(?:\/[^\s)]*)?\b/gi, 'www.....com');
        }
        out = out.replace(/\+?\d[\d\s\-().]{7,}\d\b/g, '[phone]');
        out = out.replace(/\s{2,}/g, ' ').trim();
        return out || '[redacted]';
    }
    
    // Initial load
    loadPublicMessages();
    
    // Refresh toutes les 5 secondes
    setInterval(loadPublicMessages, 5000);
    
    // Form submit
    const publicMessageForm = document.getElementById('publicMessageForm');
    const publicMessageInput = document.getElementById('publicMessageInput');
    const publicMessageError = document.getElementById('public-message-error');
    
    // Envoi par Entrée (Shift+Entrée = nouvelle ligne)
    if (publicMessageInput) {
        publicMessageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                publicMessageForm.dispatchEvent(new Event('submit'));
            }
        });
    }
    
    // Emoji Picker - Version optimisée avec emojis expatriation/voyage
// ✅ EMOJI PICKER MODERNE - VERSION CORRIGÉE
// Ce code remplace la section "Emoji Picker" dans votre fichier Blade

// Emoji Picker - Version complète et moderne avec 540+ emojis
const emojiBtn = document.getElementById('emojiBtn');
if (emojiBtn) {
    const emojis = {
        'Expressions': [
            '😀', '😃', '😄', '😁', '😆', '😅', '🤣', '😂', '🙂', '🙃', 
            '😉', '😊', '😇', '🥰', '😍', '🤩', '😘', '😗', '😚', '😙',
            '😋', '😛', '😜', '🤪', '😝', '🤑', '🤗', '🤭', '🤫', '🤔',
            '🤐', '🤨', '😐', '😑', '😶', '😏', '😒', '🙄', '😬', '🤥',
            '😌', '😔', '😪', '🤤', '😴', '😷', '🤒', '🤕', '🤢', '🤮',
            '🤧', '🥵', '🥶', '😵', '🤯', '🤠', '🥳', '😎', '🤓', '🧐',
            '😕', '😟', '🙁', '☹️', '😮', '😯', '😲', '😳', '🥺', '😦',
            '😧', '😨', '😰', '😥', '😢', '😭', '😱', '😖', '😣', '😞',
            '😓', '😩', '😫', '🥱', '😤', '😡', '😠', '🤬', '😈', '👿',
            '💀', '☠️', '💩', '🤡', '👹', '👺', '👻', '👽', '👾', '🤖'
        ],
        'Gestes': [
            '👋', '🤚', '🖐️', '✋', '🖖', '👌', '🤏', '✌️', '🤞', '🤟',
            '🤘', '🤙', '👈', '👉', '👆', '🖕', '👇', '☝️', '👍', '👎',
            '✊', '👊', '🤛', '🤜', '👏', '🙌', '👐', '🤲', '🤝', '🙏',
            '✍️', '💅', '🤳', '💪', '🦾', '🦿', '🦵', '🦶', '👂', '🦻',
            '👃', '🧠', '🦷', '🦴', '👀', '👁️', '👅', '👄', '💋', '🩸'
        ],
        'Cœurs': [
            '❤️', '🧡', '💛', '💚', '💙', '💜', '🖤', '🤍', '🤎', '💔',
            '❣️', '💕', '💞', '💓', '💗', '💖', '💘', '💝', '💟', '💌',
            '💢', '💥', '💫', '💦', '💨', '🕳️', '💬', '👁️‍🗨️', '🗨️', '🗯️',
            '💭', '💤', '✨', '⭐', '🌟', '💫', '🔥', '☄️', '💧', '🌊'
        ],
        'Expatriation': [
            '✈️', '🛫', '🛬', '🌍', '🌎', '🌏', '🗺️', '🧳', '🎒', '👜',
            '🛂', '🛃', '🛄', '🛅', '🏠', '🏡', '🏘️', '🏚️', '🏗️', '🏢',
            '🏙️', '🌆', '🌇', '🌃', '🌉', '🌁', '🏖️', '🏝️', '⛱️', '🏔️',
            '⛰️', '🗻', '🏕️', '⛺', '🏞️', '🗼', '🗽', '⛪', '🕌', '🛕',
            '🕍', '⛩️', '🕋', '⛲', '⛱️', '🌅', '🌄', '🌠', '🎇', '🎆'
        ],
        'Transport': [
            '🚗', '🚕', '🚙', '🚌', '🚎', '🏎️', '🚓', '🚑', '🚒', '🚐',
            '🚚', '🚛', '🚜', '🛻', '🦯', '🦽', '🦼', '🛴', '🚲', '🛵',
            '🏍️', '🛺', '🚨', '🚔', '🚍', '🚘', '🚖', '🚡', '🚠', '🚟',
            '🚃', '🚋', '🚞', '🚝', '🚄', '🚅', '🚈', '🚂', '🚆', '🚇',
            '🚊', '🚉', '🚁', '🛩️', '🛫', '🛬', '🚀', '🛰️', '💺', '⛵',
            '🛶', '🚤', '🛥️', '🛳️', '⛴️', '🚢', '⚓', '⛽', '🚧', '🚦'
        ],
        'Pays': [
            '🇫🇷', '🇺🇸', '🇬🇧', '🇪🇸', '🇮🇹', '🇩🇪', '🇵🇹', '🇨🇭', '🇧🇪', '🇳🇱',
            '🇨🇦', '🇦🇺', '🇳🇿', '🇯🇵', '🇨🇳', '🇰🇷', '🇹🇭', '🇻🇳', '🇮🇳', '🇮🇩',
            '🇵🇭', '🇸🇬', '🇲🇾', '🇧🇷', '🇲🇽', '🇦🇷', '🇨🇱', '🇨🇴', '🇵🇪', '🇿🇦',
            '🇪🇬', '🇲🇦', '🇰🇪', '🇳🇬', '🇷🇺', '🇺🇦', '🇵🇱', '🇨🇿', '🇸🇪', '🇳🇴',
            '🇩🇰', '🇫🇮', '🇬🇷', '🇹🇷', '🇮🇱', '🇸🇦', '🇦🇪', '🇶🇦', '🇭🇰', '🇸🇬'
        ],
        'Activités': [
            '⚽', '🏀', '🏈', '⚾', '🥎', '🎾', '🏐', '🏉', '🥏', '🎱',
            '🏓', '🏸', '🏒', '🏑', '🥍', '🏏', '⛳', '🏹', '🎣', '🤿',
            '🥊', '🥋', '🎽', '🛹', '🛷', '⛸️', '🥌', '🎿', '⛷️', '🏂',
            '🏋️', '🤸', '🤼', '🤽', '🤾', '🤺', '🧗', '🧘', '🏇', '🚴',
            '🚵', '🤹', '🎪', '🎭', '🎨', '🎬', '🎤', '🎧', '🎼', '🎹',
            '🥁', '🎷', '🎺', '🎸', '🪕', '🎻', '🎲', '♟️', '🎯', '🎮'
        ],
        'Nourriture': [
            '🍕', '🍔', '🍟', '🌭', '🥪', '🌮', '🌯', '🥙', '🧆', '🥚',
            '🍳', '🥘', '🍲', '🥣', '🥗', '🍿', '🧈', '🧂', '🥫', '🍱',
            '🍘', '🍙', '🍚', '🍛', '🍜', '🍝', '🍠', '🍢', '🍣', '🍤',
            '🍥', '🥮', '🍡', '🥟', '🥠', '🥡', '🦀', '🦞', '🦐', '🦑',
            '🦪', '🍦', '🍧', '🍨', '🍩', '🍪', '🎂', '🍰', '🧁', '🥧',
            '🍫', '🍬', '🍭', '🍮', '🍯', '🍼', '🥛', '☕', '🫖', '🍵',
            '🍶', '🍾', '🍷', '🍸', '🍹', '🍺', '🍻', '🥂', '🥃', '🥤',
            '🧃', '🧉', '🧊', '🥢', '🍽️', '🍴', '🥄', '🔪', '🏺', '🌶️'
        ],
        'Symboles': [
            '✅', '❌', '❓', '❗', '⭐', '💯', '🔥', '💪', '👍', '👎',
            '🙏', '💰', '💵', '💴', '💶', '💷', '💸', '💳', '🧾', '💹',
            '✔️', '☑️', '✖️', '➕', '➖', '➗', '💲', '💱', '™️', '©️',
            '®️', '〰️', '➰', '➿', '🔚', '🔙', '🔛', '🔝', '🔜', '✔️',
            '☑️', '🔘', '🔴', '🟠', '🟡', '🟢', '🔵', '🟣', '⚫', '⚪'
        ]
    };
    
    let pickerOpen = false;
    let closePickerHandler = null;
    
    emojiBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Si déjà ouvert, fermer
        const existing = document.getElementById('emojiPicker');
        if (existing) {
            existing.remove();
            pickerOpen = false;
            if (closePickerHandler) {
                document.removeEventListener('click', closePickerHandler);
                closePickerHandler = null;
            }
            return;
        }
        
        // Créer le picker
        const picker = document.createElement('div');
        picker.id = 'emojiPicker';
        picker.style.cssText = `
            position: fixed;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            z-index: 10000;
            max-height: 450px;
            overflow-y: auto;
            padding: 12px;
            -webkit-overflow-scrolling: touch;
        `;
        
        // Scrollbar personnalisée
        picker.innerHTML = `<style>
            #emojiPicker::-webkit-scrollbar {
                width: 6px;
            }
            #emojiPicker::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }
            #emojiPicker::-webkit-scrollbar-thumb {
                background: #ccc;
                border-radius: 10px;
            }
            #emojiPicker::-webkit-scrollbar-thumb:hover {
                background: #999;
            }
        </style>`;
        
        // Position responsive
        if (window.innerWidth < 768) {
            picker.style.cssText += `
                bottom: 70px;
                left: 10px;
                right: 10px;
                max-height: 65vh;
            `;
        } else {
            const rect = emojiBtn.getBoundingClientRect();
            picker.style.cssText += `
                bottom: ${window.innerHeight - rect.top + 10}px;
                left: ${rect.left}px;
                width: 380px;
            `;
        }
        
        // Contenu avec toutes les catégories
        let html = '';
        for (const [category, emojiList] of Object.entries(emojis)) {
            html += `
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 11px; font-weight: 600; color: #666; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">${category}</div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(40px, 1fr)); gap: 4px;">
                        ${emojiList.map(em => `
                            <button type="button" class="emoji-item" style="
                                background: transparent;
                                border: none;
                                font-size: 28px;
                                cursor: pointer;
                                padding: 8px;
                                border-radius: 8px;
                                transition: all 0.15s;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            " onmouseover="this.style.background='#f0f0f0'; this.style.transform='scale(1.2)'" onmouseout="this.style.background='transparent'; this.style.transform='scale(1)'">${em}</button>
                        `).join('')}
                    </div>
                </div>
            `;
        }
        
        picker.innerHTML += html;
        document.body.appendChild(picker);
        pickerOpen = true;
        
        // Fonction pour fermer le picker
        function closePicker() {
            const pickerElement = document.getElementById('emojiPicker');
            if (pickerElement) {
                pickerElement.remove();
            }
            pickerOpen = false;
            if (closePickerHandler) {
                document.removeEventListener('click', closePickerHandler);
                closePickerHandler = null;
            }
        }
        
        // Clic sur emoji - FERMETURE AUTOMATIQUE APRÈS SÉLECTION ✅
        picker.querySelectorAll('.emoji-item').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const emoji = this.textContent;
                const cursorPos = publicMessageInput.selectionStart || 0;
                const textBefore = publicMessageInput.value.substring(0, cursorPos);
                const textAfter = publicMessageInput.value.substring(publicMessageInput.selectionEnd || cursorPos);
                
                publicMessageInput.value = textBefore + emoji + textAfter;
                publicMessageInput.selectionStart = publicMessageInput.selectionEnd = cursorPos + emoji.length;
                publicMessageInput.focus();
                
                // ✅ FERMER LE PICKER IMMÉDIATEMENT
                closePicker();
            });
        });
        
        // Fermer en cliquant dehors
        setTimeout(() => {
            closePickerHandler = function(e) {
                const pickerElement = document.getElementById('emojiPicker');
                if (pickerElement && !pickerElement.contains(e.target) && e.target !== emojiBtn) {
                    closePicker();
                }
            };
            document.addEventListener('click', closePickerHandler);
        }, 100);
    });
}
    
    // ✅ DICTÉE VOCALE (SPEECH-TO-TEXT) - Web Speech API
    // Détection automatique : le bouton n'apparaît que si le navigateur supporte
    const voiceBtn = document.getElementById('voiceBtn');
    let recognition = null;
    let isListening = false;
    
    // Fonction pour arrêter l'enregistrement vocal
    function stopVoiceRecording() {
        if (isListening && recognition) {
            recognition.stop();
            isListening = false;
            if (voiceBtn) {
                voiceBtn.classList.remove('listening');
                voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
            }
        }
    }
    
    if (voiceBtn && publicMessageInput) {
        // Vérifier si le navigateur supporte la Web Speech API
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        
        if (SpeechRecognition) {
            // ✅ Navigateur compatible → Afficher le bouton
            voiceBtn.style.display = 'flex';
            
            voiceBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (isListening) {
                    // Arrêter l'écoute
                    stopVoiceRecording();
                    return;
                }
                
                // Démarrer l'écoute
                recognition = new SpeechRecognition();
                
                // Configuration
                recognition.continuous = true; // Continue d'écouter
                recognition.interimResults = true; // Résultats en temps réel
                
                // Détecter automatiquement la langue du navigateur
                const userLang = navigator.language || 'en-US';
                recognition.lang = userLang;
                
                // Événement : démarrage
                recognition.onstart = function() {
                    isListening = true;
                    voiceBtn.classList.add('listening');
                    voiceBtn.innerHTML = '<i class="fas fa-stop"></i>';
                };
                
                // Événement : résultat
                recognition.onresult = function(event) {
                    let interimTranscript = '';
                    let finalTranscript = '';
                    
                    for (let i = event.resultIndex; i < event.results.length; i++) {
                        const transcript = event.results[i][0].transcript;
                        if (event.results[i].isFinal) {
                            finalTranscript += transcript + ' ';
                        } else {
                            interimTranscript += transcript;
                        }
                    }
                    
                    // Ajouter le texte au textarea
                    if (finalTranscript) {
                        const currentText = publicMessageInput.value;
                        publicMessageInput.value = currentText + finalTranscript;
                    }
                };
                
                // Événement : fin
                recognition.onend = function() {
                    isListening = false;
                    voiceBtn.classList.remove('listening');
                    voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
                };
                
                // Événement : erreur
                recognition.onerror = function(event) {
                    console.error('Speech recognition error:', event.error);
                    isListening = false;
                    voiceBtn.classList.remove('listening');
                    voiceBtn.innerHTML = '<i class="fas fa-microphone"></i>';
                    
                    // Messages d'erreur conviviaux
                    if (event.error === 'not-allowed' || event.error === 'permission-denied') {
                        alert('Microphone access denied. Please allow microphone access in your browser settings.');
                    } else if (event.error === 'no-speech') {
                        // Silence détecté, ne rien faire
                    } else if (event.error === 'network') {
                        alert('Network error. Please check your internet connection.');
                    }
                };
                
                // Démarrer la reconnaissance
                try {
                    recognition.start();
                } catch (error) {
                    console.error('Failed to start recognition:', error);
                }
            });
        } else {
            // ❌ Navigateur non compatible (Safari, Firefox ancien, etc.)
            // Le bouton reste caché (display: none)
            console.info('Web Speech API not supported in this browser');
        }
    }
    
    if (publicMessageForm) {
        publicMessageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            publicMessageError.classList.remove('visible');
            publicMessageError.textContent = '';
            
            // ✅ Arrêter l'enregistrement vocal si actif
            stopVoiceRecording();
            
            const raw = publicMessageInput.value.trim();
            if (!raw) return;
            
            const msg = sanitizeMessage(raw);
            
            fetch("{{ route('mission.public-message', $mission->id) }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: msg })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    publicMessageInput.value = '';
                    loadPublicMessages();
                } else {
                    publicMessageError.textContent = data.message || 'Failed to send message.';
                    publicMessageError.classList.add('visible');
                }
            })
            .catch(() => {
                publicMessageError.textContent = 'Failed to send message.';
                publicMessageError.classList.add('visible');
            });
        });
    }
});
@endif
</script>

<script>
// ═══════════════════════════════════════════════════════════
// VANILLA JS - GESTION DES MODALS
// ═══════════════════════════════════════════════════════════

// Variables globales
let selectedProviderId = null;
let selectedProviderName = '';

// ─────────────────────────────────────────────────────────
// IMAGE MODAL
// ─────────────────────────────────────────────────────────

function openImageModal(imageUrl) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('imageModalImg');
    
    img.src = imageUrl;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// ─────────────────────────────────────────────────────────
// OFFER MODAL
// ─────────────────────────────────────────────────────────

function openOfferModal() {
    const modal = document.getElementById('offerModal');
    modal.classList.add('active');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeOfferModal() {
    const modal = document.getElementById('offerModal');
    modal.classList.remove('active');
    modal.style.display = 'none';
    document.body.style.overflow = '';
    
    // Reset form
    document.getElementById('offerForm').reset();
    document.getElementById('offerError').textContent = '';
}

async function submitOfferForm(event) {
    event.preventDefault();
    
    const price = document.getElementById('offerPrice').value;
    const delivery = document.getElementById('offerDelivery').value;
    const message = document.getElementById('offerMessage').value;
    
    const errorDiv = document.getElementById('offerError');
    errorDiv.textContent = '';
    
    const formData = new FormData();
    formData.append('price', price);
    formData.append('delivery_time', delivery);
    formData.append('message', message);
    
    try {
        const response = await fetch("{{ route('mission.offer', $mission->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.status === 'success') {
            closeOfferModal();
            openSuccessModal();
            setTimeout(() => location.reload(), 3000);
        } else {
            errorDiv.textContent = data.message || 'Failed to submit offer.';
            errorDiv.style.display = 'block';
        }
    } catch (error) {
        errorDiv.textContent = 'Failed to submit offer. Please try again.';
        errorDiv.style.display = 'block';
    }
}

// ─────────────────────────────────────────────────────────
// CONFIRM MODAL
// ─────────────────────────────────────────────────────────

function chooseProvider(providerId, providerName) {
    console.log('🎯 Provider selected:', providerId, providerName);
    
    selectedProviderId = providerId;
    selectedProviderName = providerName;
    
    // Afficher le nom
    document.getElementById('selectedProviderNameDisplay').textContent = providerName;
    
    // Ouvrir le modal
    const modal = document.getElementById('confirmModal');
    modal.classList.add('active');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeConfirmModal() {
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('active');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

function confirmAndPay() {
    const missionId = {{ $mission->id }};
    const paymentUrl = "{{ route('user.payments') }}" + "?id=" + selectedProviderId + "&mission_id=" + missionId;
    
    console.log('💳 REDIRECTING TO:', paymentUrl);
    console.log('🎯 Provider ID:', selectedProviderId);
    console.log('📦 Mission ID:', missionId);
    
    // Vérification
    if (!selectedProviderId) {
        alert('ERROR: No provider selected');
        return;
    }
    
    // Redirection
    window.location.href = paymentUrl;
}

// ─────────────────────────────────────────────────────────
// SUCCESS MODAL
// ─────────────────────────────────────────────────────────

function openSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.add('active');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.classList.remove('active');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

// ─────────────────────────────────────────────────────────
// CLOSE MODALS ON OUTSIDE CLICK
// ─────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', function() {
    ['imageModal', 'offerModal', 'confirmModal', 'successModal'].forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('active');
                    this.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
        }
    });
});
</script>
@endif

@endsection