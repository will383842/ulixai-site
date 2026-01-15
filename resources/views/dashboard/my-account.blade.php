@extends('dashboard.layouts.master')

@section('title', 'My Account')

@section('content')

@php
    $user = auth()->user();
@endphp

{{-- User ID for JavaScript --}}
<script>window.LOGGED_IN_USER_ID = {{ auth()->user()->id }};</script>

<!-- Main Content -->
<div class="flex flex-col lg:flex-row min-h-screen">
  <div class="flex-1 p-4 sm:p-6 space-y-10">

    <!-- Wallet Section (Empty placeholder) -->
    <div class="flex flex-wrap justify-center sm:justify-start gap-4 mt-4 lg:ml-6"></div>

    @if(auth()->user()->user_role === 'service_provider')
      @include('dashboard.my-account-partials.service-provider-section')
    @else
      @include('dashboard.my-account-partials.regular-user-section')
    @endif

  </div>
</div>

<!-- Modals for Service Providers -->
@if(auth()->user()->user_role === 'service_provider')
  @include('dashboard.my-account-partials.about-you-modal')
  @include('dashboard.my-account-partials.special-status-modal', ['provider' => auth()->user()->serviceProvider])
  @include('dashboard.my-account-partials.category-search-modal')
@endif

@endsection

@section('scripts')
{{-- My Account Page JavaScript (extracted from inline for better performance) --}}
<script src="{{ mix('js/pages/my-account.js') }}" defer></script>
@endsection
