
@extends('dashboard.layouts.master')

@section('title', 'Affiliations')

@section('content') 

 <div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Main Content -->
    <div class="flex-1 main-content">
      <div class="p-4 sm:p-6 md:p-8">

        <!-- Top Stats -->
        <div class="flex flex-wrap gap-4 items-center justify-between mb-6">
        
        </div>

        <!-- Referral Banner -->
        <div class="bg-blue-800 p-6 rounded-2xl text-white mb-6 relative overflow-hidden">
          <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div class="flex-1">
              <p class="text-sm mb-2">You can make life easier for your friends abroad</p>
              <h3 class="text-xl sm:text-2xl font-bold mb-4">Share your affiliate link and earn passive income</h3>
              <div class="flex flex-col sm:flex-row gap-2 mb-4">
                <input id="copy-link" type="text" disabled value="{{ env('APP_URL') . '/affiliate/sign-up/?code=' . $user->affiliate_code }}" class="bg-white bg-opacity-20 text-white placeholder-gray-200 px-4 py-2 rounded-lg w-full" />
                <button class="bg-white text-purple-600 px-4 py-2 rounded-lg font-medium w-full sm:w-auto" onclick="copyLink()">Invite Friends</button>
              </div>
            </div>
            <div class="w-full sm:w-auto">
              <div class="bg-white bg-opacity-20 p-4 rounded-xl">
                <p class="text-sm mb-2">You earn for 75% for life</p>
                <p class="text-xs">On the services fees spent by your friends</p>
                <div class="mt-3 flex justify-center">
                  <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Social Share Icons -->
 @include('pages.socialmediacard')

  <!-- User Status Boxes -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
  <!-- Invited Box -->
  <!-- <div class="bg-blue-100 border border-blue-400 rounded-lg p-4">
    <h3 class="font-semibold text-blue-800 mb-3 flex items-center gap-2">
      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zM16 13c-.29 0-.62.02-.97.05 1.16.84 1.97 2.01 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
      </svg>
      Invited (8)
    </h3>
    <ul class="space-y-2 text-sm text-blue-900">
      <li class="flex justify-between">Williams Julin <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Simone Blanc <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Christian Julin <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Christophe Sassieoq <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Christophe Cornillon <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Philippe Sega <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Babeth Ghrog <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
      <li class="flex justify-between">Laurent Antoinet <span class="bg-blue-500 text-white text-xs px-3 py-1 rounded-full">Remind</span></li>
    </ul>
  </div> -->

  <!-- Registered Box -->
  
  <div class="bg-blue-100 border border-blue-300 rounded-lg p-4">
    @if($affiliates && $affiliates->count() > 0)
    <h3 class="font-semibold text-blue-700 mb-3 flex items-center gap-2">
      <svg class="w-4 h-4 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 8 1.35 8 4v2H4v-2c0-2.65 5.3-4 8-4zm0-2a3 3 0 100-6 3 3 0 000 6z"/>
      </svg>
      Registered ({{ $affiliates->count() }})
    </h3>
    <ul class="space-y-2 text-sm text-blue-900">
        @foreach($affiliates as $affiliate)
          <li class="flex justify-between">
            <span class="">Name:  {{ $affiliate->name }} </span>
            <span class="">Email:  {{ $affiliate->email }} </span>   
          </li>
        @endforeach
    </ul>
    @else
      <li class="text-gray-500">No registered affiliates yet.</li>
    @endif
  </div>

  <!-- Active Box -->
  <div class="bg-blue-100 border border-blue-400 rounded-lg p-4">
    @if($affiliates && $affiliates->count() > 0)
    <h3 class="font-semibold text-green-700 mb-3 flex items-center gap-2">
      <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24">
        <path d="M9 11L12 14L22 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
      </svg>
      Last Active
    </h3>
    <ul class="space-y-2 text-sm text-blue-900">
      @foreach($affiliates as $affiliate)
        <li class="flex justify-between">
          <span class="">Name:  {{ $affiliate->name }} </span>
          <span class="">Active at :  {{ $affiliate->last_login_at }} </span>   
        </li>
      @endforeach
    </ul>
    @else
      <li class="text-gray-500">No registered affiliates yet.</li>
    @endif
  </div>
</div>

<!-- My Earnings Button -->
<div class="flex justify-center mt-4 mb-12">
  <button class="flex items-center gap-2 px-6 py-3 rounded-full text-white font-semibold text-base shadow transition-all"
    style="background: linear-gradient(90deg, #654de4 0%, #34c4ff 100%);">
    
    <img src="https://cdn-icons-png.flaticon.com/512/833/833472.png" class="w-5 h-5" alt="money-icon" />
  <a href="{{ route('my-earning-payment') }}">  My earnings & my payments </a>
  </button>
</div>

<script>
  function copyLink() {
    const input = document.getElementById('copy-link');
    navigator.clipboard.writeText(input.value)  // Use Clipboard API
      .then(() => {
        alert('Affiliate link copied to clipboard!');
      })
      .catch(err => {
        alert('Failed to copy the link!');
        console.error(err);
      });
  }
</script>
@endsection

