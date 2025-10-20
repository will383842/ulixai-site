@extends('dashboard.layouts.master')

@section('title', 'Point Calculation')

@section('content')

@php

  $user = auth()->user();

  if($user && $user->user_role === 'service_provider') {
    $reputationPoints = $user->serviceprovider->points ?? 0;
    $points = $reputationPoints ?? 0;
    $progress = min(100, round(($points ?? 0) / 300 * 100)) ?? 0;
    $circleRadius = 32;
    $circleCircumference = 2 * pi() * $circleRadius;
    $offset = $circleCircumference - ($progress / 100 * $circleCircumference);

    $milestones = [
        ['label' => 'Ulysse', 'point' => 0],
        ['label' => 'Ulysse ++', 'point' => 100],
        ['label' => 'Top Ulysse', 'point' => 200],
        ['label' => 'Ulysse diamond', 'point' => 300],
    ];
  }
  
@endphp
  <!-- Page Layout -->
  <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6">
      <!-- Points Header Card -->
      <div class="bg-white rounded-2xl shadow p-4 sm:p-6 mb-8 mx-auto">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
          <span class="bg-blue-900 text-white text-sm px-4 py-1 rounded-full font-semibold">
            You have <span class="text-yellow-300 font-bold" id="points">{{ $reputationPoints  }}</span> points
          </span>
          <span class="text-sm text-gray-500">
            You are <span id="remainingPoints">{{300 - $reputationPoints }}</span> points away to be seen to the maximum
          </span>
        </div>

        <h2 class="text-blue-900 font-bold text-md mb-2">
          Do you want to be seen to the maximum? Reach the levels to have the maximum number of services
        </h2>

        <p class="text-sm text-gray-700 mb-4 leading-relaxed text-center sm:text-left">
          For each service, you earn, if you have:<br>
          5 stars = +20 points<br>
          4 stars = +5 points<br>
          3 stars = +0 points<br>
          2 stars = −20 points<br>
          1 star = −50 points<br>
          <span class="text-red-600 font-semibold block mt-2">If you cancel a service job, you lose 150 points</span>
        </p>
        
        <p class="text-sm text-gray-800 font-medium mb-6">
          The more points you have, the more visible you are
        </p>
      <div class="relative bg-blue-100 rounded-2xl px-2 py-6 mb-6 overflow-visible">
        <div class="relative h-10 flex items-center">
          <!-- Full background bar -->
          <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-6 bg-blue-200 rounded-full w-full"></div>
          
          <!-- Filled progress -->
          <div class="absolute left-0 top-1/2 -translate-y-1/2 h-6 bg-blue-500 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>

          <!-- Dots -->
          <div class="relative flex justify-between items-center w-full z-10 px-2">
            @foreach ($milestones as $milestone)
              <div class="flex flex-col items-center w-1/4">
                <div class="w-5 h-5 rounded-full z-10 border-2 
                  {{ $points >= $milestone['point'] ? 'bg-blue-600 border-blue-600' : 'bg-white border-blue-500' }}">
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Labels above -->
        <div class="grid grid-cols-4 text-center mt-2 mb-1 text-sm font-semibold text-blue-900">
          @foreach ($milestones as $milestone)
            <span>{{ $milestone['label'] }}</span>
          @endforeach
        </div>

        <!-- Points below -->
        <div class="grid grid-cols-4 text-center text-xs text-gray-700">
          @foreach ($milestones as $milestone)
            <span>{{ $milestone['point'] }} pts</span>
          @endforeach
        </div>

        <!-- Current score below bar -->
        <p class="text-center text-sm mt-4 font-medium text-blue-700">
          Your Points: <strong>{{ $points }} / 300</strong>
        </p>
      </div>
        </div>
      </div>
    </main>

  </div>

  <!-- Progress Script -->
  <!-- <script>
    const currentPoints = 112;
    const maxPoints = 300;

    document.getElementById("points").textContent = currentPoints;
    document.getElementById("remainingPoints").textContent = maxPoints - currentPoints;

    const fill = document.getElementById("progressFill");
    const percentage = Math.min((currentPoints / maxPoints) * 100, 100);
    fill.style.width = percentage + "%";
  </script> -->
@endsection