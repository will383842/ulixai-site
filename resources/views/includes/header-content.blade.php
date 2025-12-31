{{--
  ═══════════════════════════════════════════════════════════
  🎯 HEADER CONTENT - Partial (No HTML structure)
  ═══════════════════════════════════════════════════════════

  Ce fichier contient UNIQUEMENT le contenu du header
  (navbars, breadcrumb, popups, etc.) SANS la structure HTML.

  Utiliser ce fichier quand la page a déjà sa propre structure HTML.

  Usage: @include('includes.header-content')

  Pour les pages qui n'ont PAS leur propre structure HTML,
  utiliser @include('includes.header') à la place (version complète avec HTML).

  @version 1.0.0
  @created 2025-12-31
--}}

@php
  // Récupération sûre de la configuration du site
  $settings = \App\Models\SiteSetting::first();
  $legal = $settings ? ($settings->legal_info ?? []) : [];

  // Récupérer les pays pour les wizards
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp

{{-- Note: Les styles (@include('includes.header.styles')) doivent être inclus
     dans le <head> de la page parente, pas ici dans le body --}}

{{-- ♿ ACCESSIBILITY - Skip to content link --}}
<a href="#main-content" class="skip-to-content">
  Aller au contenu principal
</a>

{{-- 🖥️ NAVBAR DESKTOP --}}
@include('includes.header.navbar-desktop')

{{-- 📱 NAVBAR MOBILE --}}
@include('includes.header.navbar-mobile')

{{-- 🍞 BREADCRUMB --}}
@include('includes.header.breadcrumb')

{{-- 🎯 WIZARDS POPUPS --}}
@include('wizards.provider.signup-popup')
@include('wizards.requester.steps.popup_request_help')

{{-- 🍪 COOKIE BANNER --}}
@include('includes.cookie-banner')

{{-- 🔧 SCRIPTS COMPONENT --}}
@include('includes.header.scripts')
