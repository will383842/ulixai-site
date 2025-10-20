@extends('dashboard.layouts.master')

@section('title', 'Service Request Details')

@section('content')
@php
    if($mission->service_durition === '1 week') {
        $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeek();
    } elseif($mission->service_durition === '2 weeks') {
        $endTime = \Carbon\Carbon::parse($mission->created_at)->addWeeks(2);
    } elseif($mission->service_durition === '1 month') {
        $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonth();
    } elseif($mission->service_durition === '3 months') {
        $endTime = \Carbon\Carbon::parse($mission->created_at)->addMonths(3);
    } else {
        $endTime = null;
    }
    if ($endTime) {
        $remainingDays = $endTime->diffInDays(\Carbon\Carbon::now());
    } else {
        $remainingDays = 'N/A'; 
    }
@endphp
<!-- Main Content -->
<div class="flex-1 p-4 sm:p-6 lg:pl-10 lg:pr-8">
  <div class="bg-white rounded-2xl shadow p-4 sm:p-8 mx-auto space-y-6">

    <!-- Title -->
    <h2 class="text-blue-900 font-bold text-lg sm:text-xl">{{ $mission->title ?? 'Service Request' }}</h2>

    <!-- Requester Info -->
    <div class="space-y-2 text-sm text-gray-800">
      <p>Requester Name: <span class="text-red-500 font-medium">{{ $mission->requester->name ?? '-' }}</span></p>
      <p>Requester Phone Number: <span class="text-red-600 font-semibold">{{ $mission->requester->phone_number ?? '-' }}</span></p>
      <p>Date: {{ $mission->created_at ? $mission->created_at->format('d/m/Y') : '-' }}</p>
      <p>Ends at: {{ $remainingDays }} Days</p>
      <p class="break-words">Location: {{ $mission->location_city ?? '' }}</p>
    </div>

    <!-- Service Details -->
    <h3 class="text-blue-900 font-bold mt-6">DETAILS OF THE SERVICE REQUEST</h3>
    <div class="border border-blue-200 rounded-xl p-4 text-gray-700 text-sm bg-blue-50">
      {{ $mission->description ?? '-' }}
    </div>

    <!-- Image Thumbnails -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
      @if(!empty($mission->attachments))
        @foreach(json_decode($mission->attachments, true) as $img)
          <div class="border border-blue-200 rounded-xl p-4 flex items-center justify-center h-32 bg-blue-50">
            <img src="{{ asset($img) }}" class="w-full h-full object-contain" alt="Attachment" />
          </div>
        @endforeach
      @else
        @for ($i = 0; $i < 4; $i++)
        <div class="border border-blue-200 rounded-xl p-4 flex items-center justify-center h-32 bg-blue-50">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M4 16l4-4a3 3 0 014 0l4 4M2 20h20M12 12a4 4 0 100-8 4 4 0 000 8z"/>
          </svg>
        </div>
        @endfor
      @endif
    </div>

    <!-- Action Buttons + Cancel -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-6">

      <!-- Left Buttons -->
      <div class="flex flex-wrap gap-4">
        <!-- <a href="modifyrequest.php" class="bg-blue-600 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-700 transition">MODIFICATIONS</a> -->
        <a href="{{ route('user.conversation') }}" class="border border-blue-500 text-blue-600 px-6 py-2 rounded-full font-medium hover:bg-blue-50 transition">PRIVATE MESSAGING</a>
      </div>

      <!-- Right Text -->
      <div class="text-left sm:text-right">
        <a href="#" onclick="openCancelServicePopup(event)" class="text-blue-600 font-medium underline">I Start Dispute</a>
      </div>
    </div>

  </div>
</div>

<!-- Cancel Service Popup Modal -->
<div id="cancelServicePopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
  <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center relative">
    <button onclick="closeCancelServicePopup()" class="absolute top-2 right-3 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
    <h2 class="text-xl font-bold text-blue-800 mb-3">WHY DO YOU WISH TO CANCEL THIS ADD?</h2>
    <form id="cancelServiceForm" class="space-y-4 text-left">
      <div>
        <select class="w-full border rounded-lg px-3 py-2" required>
          <option value="">Select a reason...</option>
          <option>I made a mistake in the information provided.</option>
          <option>My situation has changed, I no longer need the service.</option>
          <option>I found a solution elsewhere.</option>
          <option>The timing is too short to organize this mission.</option>
          <option>My budget is not sufficient for the type of service I need.</option>
          <option>I didn’t receive any relevant proposals.</option>
          <option>The available providers do not match my criteria.</option>
          <option>I’ve decided to postpone this request.</option>
          <option>I submitted this request just to test the platform.</option>
          <option>Other reason (please specify below)</option>
        </select>
      </div>
      <div>
        <textarea class="w-full border rounded-lg px-3 py-2" maxlength="300" placeholder="Describe here the reason for your cancellation" required></textarea>
      </div>
      <div class="text-xs text-blue-700 mb-2">
        Your service provider will recieve your mesasge . they have 3 days to respond
      </div>
      <div class="flex justify-between items-center mt-4">
        <button type="button" onclick="closeCancelServicePopup()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full px-4 py-2 text-xs transition">
          I keep my add online 
        </button>
        <button type="submit" class="text-red-700 underline font-semibold text-xs">
          I confirm the dispute
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Dispute Sent Confirmation Popup -->
<div id="disputeSentPopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
  <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 text-center relative">
    <div class="flex flex-col items-center">
      <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center mb-4">
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
        </svg>
      </div>
      <h3 class="text-lg font-bold text-blue-800 mb-2">Your decision has been sent!</h3>
      <div class="text-gray-700 mb-1">The service provider has just received your message.<br>
        We'll keep you in the loop for what happens next.<br>
        <span class="block mt-2">Thanks a bunch for your trust! 🙌</span>
      </div>
    </div>
  </div>
</div>

<div id="loadingPopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-xs w-full p-8 text-center relative">
        <div class="flex flex-col items-center">
            <div class="w-16 h-16 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mb-4"></div>
            <h3 class="text-lg font-bold text-blue-800 mb-2">Canceling...</h3>
            <div class="text-blue-800 font-semibold">Please wait while we process your request.</div>
        </div>
    </div>
</div>

<script>
  function openCancelServicePopup(e) {
    e.preventDefault();
    document.getElementById('cancelServicePopup').classList.remove('hidden');
  }
  function closeCancelServicePopup() {
    document.getElementById('cancelServicePopup').classList.add('hidden');
  }
  function openDisputeSentPopup() {
    document.getElementById('disputeSentPopup').classList.remove('hidden');
  }
  function closeDisputeSentPopup() {
    document.getElementById('disputeSentPopup').classList.add('hidden');
  }

  function closeLoadingPopup() {
      document.getElementById('loadingPopup').classList.add('hidden');
  }

  function openLoadingPopup() {
      document.getElementById('loadingPopup').classList.remove('hidden');
  }
  document.getElementById('cancelServiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const reason = this.querySelector('select').value;
    const description = this.querySelector('textarea').value;
    if( !reason) {
      alert('Please select the reason');
      return;
    }
    openLoadingPopup();
    fetch('/api/mission/cancel', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        mission_id: {{ $mission->id }},
        reason: reason,
        description: description,
        cancelled_by: 'requester',
        cancelled_on: new Date().toISOString()
      })
    }).then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then(data => {
      console.log(data);
      if (data.success) {
        closeCancelServicePopup();
        closeLoadingPopup();
        openDisputeSentPopup();
      } else {
        closeLoadingPopup();
        alert('Error: ' + data.message);
      }
    }).catch(error => {
      console.error('There was a problem with the fetch operation:', error);
    });
  });
  document.getElementById('disputeSentPopup').addEventListener('click', function(e) {
    if (e.target === this) closeDisputeSentPopup();
  });
</script>
@endsection