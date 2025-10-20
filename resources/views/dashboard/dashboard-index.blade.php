@extends('dashboard.layouts.master')

@section('title', 'Main Dashboard')

@section('content')

@if($user->user_role === 'service_requester')
<div id="google_translate_element" class="hidden"></div>
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
     <div class="flex flex-col sm:flex-row flex-wrap gap-4 mb-6 items-center justify-center">
        <button class="bg-blue-400 text-white px-4 py-2 rounded-full text-sm">{{ $user->referrals()->count() }} referrals</button>
        <button class="bg-blue-400 text-white px-6 py-2 rounded-full text-sm">My earnings thanks to my referrals {{ number_format(auth()->user()->commissions->sum('amount'), 2) }}
 €</button>
      </div>
  <!-- You can display missions if needed -->
  {{-- 
  <div class="mt-6">
    <h3 class="text-lg font-bold mb-2 text-blue-900">My Service Requests</h3>
    <ul>
      @foreach($missions as $mission)
        <li class="mb-2">
          <span class="font-semibold">{{ $mission->title }}</span>
          <span class="text-xs text-gray-200 ml-2">{{ $mission->status }}</span>
        </li>
      @endforeach
    </ul>
  </div>
  --}}
@elseif($user->user_role === 'service_provider')
  @php
    $provider = $user->serviceProvider ?? null;
    $in_progress = $provider->missions->where('status', 'in_progress')->count();
  @endphp
  <div class="main-content">
    <div class="p-4 sm:p-6 md:p-8">
      <div class="flex flex-wrap gap-4 items-start justify-start mb-6">
        <div class="w-full max-w-xs border-2 border-blue-400 rounded-2xl p-4 bg-white text-center">
          <h2 class="text-base font-medium text-blue-500 mb-1">My total balance</h2>
          <div class="text-3xl font-bold text-blue-600 mb-1">{{$balance['available'] ?? 00.0}} €</div>
        </div>
      </div>
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
      <!-- Referrals Section -->
      <div class="flex flex-col sm:flex-row flex-wrap gap-4 mb-6 items-center justify-center">
        <button class="bg-blue-400 text-white px-4 py-2 rounded-full text-sm">{{ $user->referrals()->count() }} referrals</button>
        <button class="bg-blue-400 text-white px-6 py-2 rounded-full text-sm">My earnings thanks to my referrals {{ number_format(auth()->user()->commissions->sum('amount'), 2) }}
 €</button>
      </div>
      <!-- Progress Bar (Zelper style) -->
      @php
        $points = $reputationPoints ?? 0;
        $progress = $progressLevel ?? 0;
        $circleRadius = 32;
        $circleCircumference = 2 * pi() * $circleRadius;
        $offset = $circleCircumference - ($progress / 100 * $circleCircumference);

        // Fetch all auto reputation badges, sorted by threshold
        $badges = \App\Models\Badge::where('type', 'reputation')->where('is_auto', true)->orderBy('threshold')->get();
        $currentBadge = $user->badges()->where('type', 'reputation')->where('is_auto', true)->orderByDesc('threshold')->first();
      @endphp

      <div class="relative bg-blue-100 rounded-2xl px-2 py-6 mb-6 overflow-visible">
        <div class="relative h-10 flex items-center">
          <!-- Full background bar -->
          <div class="absolute left-0 right-0 top-1/2 -translate-y-1/2 h-6 bg-blue-200 rounded-full w-full"></div>
          <!-- Filled progress -->
          <div class="absolute left-0 top-1/2 -translate-y-1/2 h-6 bg-blue-500 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
          <!-- Dots -->
          <div class="relative flex justify-between items-center w-full z-10 px-2">
            @foreach ($badges as $badge)
              <div class="flex flex-col items-center w-1/{{ count($badges) }}">
                <div class="w-5 h-5 rounded-full z-10 border-2
                  {{ ($points >= $badge->threshold) ? 'bg-blue-600 border-blue-600' : 'bg-white border-blue-500' }}">
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <!-- Labels above -->
        <div class="grid grid-cols-{{ count($badges) }} text-center mt-2 mb-1 text-sm font-semibold text-blue-900">
          @foreach ($badges as $badge)
            <span>{{ $badge->title }}</span>
          @endforeach
        </div>
        <!-- Points below -->
        <div class="grid grid-cols-{{ count($badges) }} text-center text-xs text-gray-700">
          @foreach ($badges as $badge)
            <span>{{ $badge->threshold }} pts</span>
          @endforeach
        </div>
        <!-- Current score and badge below bar -->
        <p class="text-center text-sm mt-4 font-medium text-blue-700">
          Your Points: <strong>{{ $points }}</strong>
          @if($currentBadge)
            <span class="inline-flex items-center ml-2 px-2 py-1 bg-blue-200 text-blue-800 rounded-full text-xs font-semibold">
              <!-- <img src="/images/badges/{{ $currentBadge->icon }}" alt="{{ $currentBadge->title }}" class="w-5 h-5 mr-1 inline-block" /> -->
              {{ $currentBadge->title }}
            </span>
          @endif
          / {{ $badges->max('threshold') }}
        </p>
      </div>

      <!-- End Progress Bar (Zelper style) -->

      <!-- Bottom Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Activity Calendar -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
          <?php
            // Calendar logic
            $month = isset($_GET['month']) ? intval($_GET['month']) : 8;
            $year = isset($_GET['year']) ? intval($_GET['year']) : 2022;
            $selected = [4,5,6]; // Example: highlight 4,5,6
            $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
            $daysInMonth = date('t', $firstDayOfMonth);
            $startDay = date('w', $firstDayOfMonth); // 0 (Sun) - 6 (Sat)
            $monthName = date('F Y', $firstDayOfMonth);

            // Previous/next month logic
            $prevMonth = $month - 1;
            $prevYear = $year;
            if ($prevMonth < 1) { $prevMonth = 12; $prevYear--; }
            $nextMonth = $month + 1;
            $nextYear = $year;
            if ($nextMonth > 12) { $nextMonth = 1; $nextYear++; }
          ?>
          <div class="flex items-center justify-between mb-2">
            <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>" class="text-gray-400 hover:text-blue-600 text-xl px-2" aria-label="Prev month">
              <i class="fas fa-chevron-left"></i>
            </a>
            <h4 class="font-medium text-gray-800 text-center flex-1"><?php echo $monthName; ?></h4>
            <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>" class="text-gray-400 hover:text-blue-600 text-xl px-2" aria-label="Next month">
              <i class="fas fa-chevron-right"></i>
            </a>
          </div>
          <div class="w-full overflow-x-auto">
            <div class="min-w-[350px] grid grid-cols-7 gap-y-1 text-center text-xs text-gray-400 mb-1">
              <span>Su</span><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span>
            </div>
            <div class="min-w-[350px] grid grid-cols-7 gap-y-2 text-center text-base font-medium">
              <?php
                // Fill initial empty cells
                for ($i = 0; $i < $startDay; $i++) {
                  echo '<span class="text-gray-300"></span>';
                }
                // Print days of month
                for ($day = 1; $day <= $daysInMonth; $day++) {
                  $classes = "calendar-day";
                  // Highlight selected days (for August 2022: 4,5,6)
                  if ($year == 2022 && $month == 8 && in_array($day, $selected)) {
                    if ($day == 4) {
                      $classes .= " bg-blue-100 text-blue-700 font-bold rounded-full";
                    } else {
                      $classes .= " bg-blue-500 text-white font-bold rounded-full";
                    }
                  }
                  echo "<span class=\"$classes\">$day</span>";
                }
                // Fill trailing empty cells
                $totalCells = $startDay + $daysInMonth;
                $remaining = (7 - ($totalCells % 7)) % 7;
                for ($i = 0; $i < $remaining; $i++) {
                  echo '<span class="text-gray-300"></span>';
                }
              ?>
            </div>
          </div>
        </div>

        <!-- Progress Circle -->
        <div class="bg-white p-6 rounded-2xl shadow-sm flex flex-col items-center">
          <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Diamond Ulysse Progress</h3>

          <div class="relative w-24 h-24 mb-4">
            <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 80 80">
              <!-- Background circle -->
              <circle
                cx="40"
                cy="40"
                r="{{ $circleRadius }}"
                stroke="#e5e7eb"
                stroke-width="6"
                fill="none"
              />
              <!-- Foreground progress circle -->
              <circle
                cx="40"
                cy="40"
                r="{{ $circleRadius }}"
                stroke="#3b82f6"
                stroke-width="6"
                fill="none"
                stroke-dasharray="{{ $circleCircumference }}"
                stroke-dashoffset="{{ $offset }}"
                stroke-linecap="round"
                class="transition-all duration-700 ease-out"
              />
            </svg>

            <!-- Percentage in center -->
            <div class="absolute inset-0 flex items-center justify-center">
              <span class="text-2xl font-bold text-blue-600">{{ $progress }}%</span>
            </div>
          </div>

          <p class="text-sm text-gray-600 text-center">
            You have earned <strong>{{ $points }} pts</strong> out of 300.
          </p>
        </div>

        <!-- Earnings Card -->
        <div class="bg-white p-6 rounded-2xl shadow-sm flex flex-col items-center">
          <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Total Earned as a Ulixai provider</h3>
          <div class="text-4xl font-bold text-blue-600"> {{$balance['available'] ?? 00.0}} €</div>
        </div>
      </div>

      <!-- Action Cards -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-8">
        <div class="bg-blue-400 text-white p-6 rounded-2xl text-center">
          <div class="text-3xl font-bold mb-2">1</div>
          <div class="text-sm">Service requests</div>
        </div>
        <div class="bg-blue-400 text-white p-6 rounded-2xl text-center">
          <div class="text-3xl font-bold mb-2">{{ $in_progress ?? 0 }}</div>
          <div class="text-sm">Job to done</div>
        </div>
        <div class="bg-blue-400 text-white p-6 rounded-2xl text-center">
          <div class="text-3xl font-bold mb-2">3</div>
          <div class="text-sm">Ulysse payments to trigger</div>
        </div>
      </div>
    </div>
  </div>
@endif

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
<style>
  @media (max-width: 600px) {
    .calendar-day {
      min-width: 32px;
      min-height: 32px;
      font-size: 0.95rem;
    }
    .min-w-\[350px\] {
      min-width: 350px !important;
    }
  }
  .calendar-day {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    min-height: 36px;
    font-size: 1rem;
    margin: 0 auto;
    transition: background 0.2s, color 0.2s;
  }

  .shrek-face {
      background: linear-gradient(135deg, #86efac 0%, #4ade80 100%);
  }

  .promo-gradient-1 {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
  }

  .promo-gradient-2 {
      background: linear-gradient(135deg, #ec4899 0%, #f97316 100%);
  }

  .referral-gradient {
      background: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
  }

  .calendar-day {
      padding: 8px;
      text-align: center;
      font-size: 14px;
      cursor: pointer;
      border-radius: 4px;
  }

  .calendar-day:hover {
      background-color: #f3f4f6;
  }

  .calendar-day.today {
      background-color: #3b82f6;
      color: white;
  }

  .calendar-day.selected {
      background-color: #dbeafe;
      color: #1d4ed8;
  }

  .progress-circle {
      stroke-dasharray: 201;
      stroke-dashoffset: 50;
      transition: stroke-dashoffset 0.5s ease-in-out;
  }

  html, body {
      overflow-x: hidden;
  }

  .sidebar {
      overflow-y: auto;
      scrollbar-width: none;
      -ms-overflow-style: none; 
  }

  .sidebar::-webkit-scrollbar {
      display: none;
  }

  .main-content {
      overflow-y: auto;
      scrollbar-width: none; 
      -ms-overflow-style: none;
  }

  .main-content::-webkit-scrollbar {
      display: none;
  }

  
  .category-card .w-14.h-14,
  .category-card .w-14.h-14.bg-blue-500,
  .category-card .w-14.h-14.bg-orange-400,
  .category-card .w-14.h-14.bg-green-500,
  .category-card .w-14.h-14.bg-gray-500,
  .category-card .w-14.h-14.bg-red-500,
  .category-card .w-14.h-14.bg-purple-500 {
      width: 56px !important;
      height: 56px !important;
      min-width: 56px !important;
      min-height: 56px !important;
      border-radius: 9999px !important;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 !important;
  }

  
  .category-card .bg-blue-500,
  .category-card .bg-blue-600 {
    border-radius: 9999px !important;
    min-width: 56px !important;
    min-height: 56px !important;
    width: 56px !important;
    height: 56px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
  }

  
  .category-card {
    min-width: 0 !important;
  }
</style>
<div class = "mb-12"></div>

@endsection