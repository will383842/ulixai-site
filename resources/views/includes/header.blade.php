{{-- 
  ═══════════════════════════════════════════════════════════
  🎯 HEADER - MAIN ORCHESTRATOR
  ═══════════════════════════════════════════════════════════
  
  Ce fichier est le point d'entrée principal du header.
  Il orchestre tous les composants modulaires.
  
  Structure :
  - HEAD (meta, CSS, scripts externes)
  - NAVBAR DESKTOP
  - NAVBAR MOBILE (+ menu bottom sheet)
  - BREADCRUMB
  - WIZARDS POPUPS
  - COOKIE BANNER
  - SCRIPTS (JS initialization)
  
  ⚠️ IMPORTANT : Ce fichier ne contient PAS @yield('content')
  Le contenu est géré par les layouts spécifiques (master.blade.php, etc.)
  
  @version 2.0.1
  @refactored 2025-01-08
  @fixed 2025-01-XX - Suppression duplication @yield('content')
  @author ULIXAI Team
--}}

<!DOCTYPE html>
<html lang="fr">

{{-- ═══════════════════════════════════════════════════════════
     📦 HEAD COMPONENT
     Meta tags, CSS, Google Analytics, External Resources
     ═══════════════════════════════════════════════════════════ --}}
@include('includes.header.head')

@php
  // Récupération sûre de la configuration du site
  $settings = \App\Models\SiteSetting::first();
  $legal = $settings ? ($settings->legal_info ?? []) : [];
  
  // Récupérer les pays pour les wizards
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp

<body class="min-h-screen bg-white pt-20">

{{-- ═══════════════════════════════════════════════════════════
     🖥️ NAVBAR DESKTOP
     Logo, buttons, language selector, auth menu
     ═══════════════════════════════════════════════════════════ --}}
@include('includes.header.navbar-desktop')

{{-- ═══════════════════════════════════════════════════════════
     📱 NAVBAR MOBILE
     Header mobile, hamburger menu, bottom sheet
     ═══════════════════════════════════════════════════════════ --}}
@include('includes.header.navbar-mobile')

{{-- ═══════════════════════════════════════════════════════════
     🍞 BREADCRUMB
     Fil d'Ariane (navigation hierarchique)
     ═══════════════════════════════════════════════════════════ --}}
@include('includes.header.breadcrumb')

{{-- ═══════════════════════════════════════════════════════════
     🎯 WIZARDS POPUPS
     Provider signup & Help request flows
     ═══════════════════════════════════════════════════════════ --}}
@include('wizards.provider.signup-popup')
@include('wizards.requester.steps.popup_request_help')

{{-- ═══════════════════════════════════════════════════════════
     🍪 COOKIE BANNER
     RGPD compliance
     ═══════════════════════════════════════════════════════════ --}}
@include('includes.cookie-banner')

{{-- ═══════════════════════════════════════════════════════════
     🔧 SCRIPTS COMPONENT
     Google Translate, Language selectors, Help buttons, etc.
     
     ⚠️ NOTE IMPORTANTE :
     @yield('content') doit être placé dans les layouts spécifiques
     (master.blade.php pour le dashboard, app.blade.php pour le site public, etc.)
     PAS dans ce fichier header pour éviter la duplication de contenu !
     ═══════════════════════════════════════════════════════════ --}}
@include('includes.header.scripts')

</body>
</html>