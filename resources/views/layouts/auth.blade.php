{{--
  ═══════════════════════════════════════════════════════════
  🔐 LAYOUT AUTH - Pages d'authentification
  ═══════════════════════════════════════════════════════════

  Layout minimaliste pour login, signup, forgot-password, etc.

  Usage:
  @extends('layouts.auth')

  @section('title', 'Login - Ulixai')
  @section('content')
    <!-- Formulaire -->
  @endsection

  @version 1.0.0
--}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- SEO --}}
  <title>@yield('title', 'Ulixai')</title>
  <meta name="description" content="@yield('description', 'Ulixai - Global Help Network')">
  <meta name="robots" content="@yield('robots', 'index, follow')">
  <link rel="canonical" href="{{ url()->current() }}">

  {{-- Favicons --}}
  <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/faviccon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

  {{-- PWA --}}
  <meta name="theme-color" content="#f8fafc">

  {{-- jQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{-- Toastr --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  {{-- Tailwind CSS --}}
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  {{-- Alpine.js --}}
  <script src="https://unpkg.com/alpinejs@3.x.x" defer></script>

  {{-- Auth Page Styles --}}
  <style>
    html, body {
      background: #f8fafc;
    }

    /* Prevent FOUC */
    .page-loader, .loader, .splash-screen, [class*="loader"] {
      display: none !important;
    }

    /* Auth container */
    .auth-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    /* Auth card */
    .auth-card {
      width: 100%;
      max-width: 440px;
      background: white;
      border-radius: 1.5rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    @media (max-width: 480px) {
      .auth-card {
        border-radius: 1rem;
        margin: 0.5rem;
      }
    }

    /* Focus states */
    input:focus, button:focus {
      outline: none;
      ring: 2px;
      ring-color: #3b82f6;
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        transition-duration: 0.01ms !important;
      }
    }
  </style>

  {{-- Page-specific head --}}
  @yield('head')
</head>

@php
  use App\Models\Country;
  $countries = Country::where('status', 1)->get();
@endphp

<body class="min-h-screen bg-slate-50 antialiased">

  {{-- Header simplifié pour auth --}}
  @include('includes.header.navbar-desktop')
  @include('includes.header.navbar-mobile')

  {{-- Main Content --}}
  <main class="auth-container pt-20">
    @yield('content')
  </main>

  {{-- Footer minimal ou complet selon préférence --}}
  @include('includes.footer')

  {{-- Wizards (au cas où) --}}
  @include('wizards.provider.signup-popup')
  @include('wizards.requester.steps.popup_request_help')

  {{-- Cookie Banner --}}
  @include('includes.cookie-banner')

  {{-- Floating Bug Report --}}
  @include('components.floating-bug-report')

  {{-- Scripts --}}
  @include('includes.header.scripts')

  {{-- Session Messages --}}
  @if (session('success'))
    <script>toastr.success('{{ session('success') }}', 'Success');</script>
  @endif
  @if (session('error'))
    <script>toastr.error('{{ session('error') }}', 'Error');</script>
  @endif

  {{-- Page scripts --}}
  @yield('scripts')

</body>
</html>
