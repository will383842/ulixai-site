@extends('dashboard.layouts.master')

@section('title', 'Job List')

@section('content')
    <!-- Main Content -->
    <div class="flex-1 p-4 sm:p-6 lg:pl-10 lg:pr-8">
      <!-- Tabs -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-end gap-4 mb-6 mr-12">
    <a href="{{ route('ongoing-requests')}}"
       class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-medium shadow flex items-center gap-2 hover:bg-red-700 transition cursor-pointer w-full md:w-auto text-center">
      {{ $ongoingJobs ?? ' ' }} ongoing service requests
      <span class="underline font-semibold ml-1">| DISCOVER</span>
    </a>
</div>



      <h2 class="text-xl font-bold text-blue-900 mb-6 text-center md:text-left">
        The validated missions that I must do
        <span class="text-gray-600 font-normal ml-2 block sm:inline"></span>
      </h2>
      <!-- Title -->
      <div class="flex justify-center mb-2">
        <span class="bg-blue-400 text-white text-base font-semibold px-6 py-2 rounded-lg shadow" style="letter-spacing:0.01em;">
          Current job to do
        </span>
      </div>
@php 
    $jobsAccepted = $jobs->filter(function($job) {
        return in_array($job->status, ['accepted']);
    });

    $jobsOffer = $jobs->filter(function($job) {
        return in_array($job->status, ['pending']);
    });
@endphp
      <!-- Job Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobs as $job)
        <div class="bg-white rounded-2xl shadow p-5 relative flex flex-col sm:flex-row items-center gap-4 border border-blue-100">
          <div class="flex-1 w-full">
            <h3 class="text-blue-900 font-bold text-xs mb-1 uppercase tracking-wide">{{ $job->title ?? 'Job' }}</h3>
            <div class="text-xs text-gray-700 mb-2">
              Deadline : <span class="font-semibold">{{ $job->service_durition ?? '-' }}</span>
            </div>
            <div class="flex items-center gap-2 mb-2">
              <a href="{{ route('view-job', ['id' => $job->id]) }}" class="bg-blue-600 text-white text-xs px-4 py-1.5 rounded-full font-semibold shadow hover:bg-blue-700 transition">See the job</a>
            </div>
            <div class="mt-3">
              @if($job->dispute_count ?? 0)
              <button
                type="button"
                class="bg-red-50 text-red-600 border border-red-300 text-xs px-3 py-1 rounded-full font-semibold block w-max focus:outline-none"
                onclick="openDisputePopup({{ $job->id }})"
              >
                {{ $job->dispute_count }} Ongoing dispute
              </button>
              @endif
            </div>
          </div>
          <div class="flex flex-col items-center gap-2 min-w-[120px]">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-1">
              <svg class="w-7 h-7 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
              </svg>
            </div>
            <div class="bg-white border border-blue-300 rounded-xl px-3 py-1 text-xs text-blue-900 font-semibold text-center mb-1">
              For this job<br>
              I win '-' €
            </div>
            @if($job->status === 'waiting_to_start')
              <button class="bg-green-500 hover:bg-green-600 text-white text-xs font-semibold px-5 py-2 rounded-lg shadow transition" onclick="startMission({{$job->id}})" >Start</button>
            @elseif($job->status === 'in_progress')
            <button class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-5 py-2 rounded-lg shadow transition"
              onclick="openDeliveryConfirmPopup( {{$job->id}})"
            >Job finish</button>
            @elseif($job->status === 'disputed')
              <button class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold px-5 py-2 rounded-lg shadow transition"
                onclick="resolveDispute({{$job->id}})"
              >Resolve Dispute</button>
            @endif
          </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500 py-12">
          No current jobs to do.
        </div>
        @endforelse
      </div>

      <!-- My Quote Offers Section -->
      <div class="flex justify-center mt-10 mb-2">
        <span class="bg-blue-400 text-white text-base font-semibold px-6 py-2 rounded-lg shadow" style="letter-spacing:0.01em;">
          My quote offers
        </span>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($offers as $offer)
        <div class="bg-blue-100 rounded-2xl shadow p-5 flex flex-row items-center gap-4 border border-blue-200">
          <div class="flex-1">
            <h3 class="text-blue-900 font-bold text-sm mb-1">{{ $offer->mission->title ?? 'Job' }}</h3>
            <div class="text-sm text-gray-700 mb-2 flex flex-col">
              <span>Deadline : <span class="font-semibold">{{ $offer->mission->service_durition ?? '-' }}</span></span>
              <span>Published : <span class="font-semibold">{{ $offer->mission->created_at->diffForHumans() }}</span></span>
              <span>Offer Price : <span class="font-semibold">{{ $offer->price ?? '-' }} €</span></span>
              <span>Country: <span class="font-semibold">{{ $offer->mission->location_country ?? '-' }}</span></span>
              <span>Language: <span class="font-semibold">{{ $offer->mission->language ?? '-' }}</span></span>
            </div>
            
            <a href="{{ route('qoute-offer', ['id' => $offer->mission->id])}}" class="bg-blue-600 text-white text-sm px-5 py-2 rounded-full font-semibold shadow hover:bg-blue-700 transition inline-block">See the job</a>
          </div>
          <div class="flex flex-col items-center min-w-[64px]">
            <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center">
              <svg class="w-7 h-7 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
              </svg>
            </div>
          </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500 py-12">
          No pending quote offers.
        </div>
        @endforelse
      </div>

      <!-- Tabs moved to bottom and centered -->
      <div class="flex justify-center mt-10 mb-12 pb-12">
       <div class="flex gap-4 flex-wrap">
  {{-- <button class="bg-blue-600 text-white px-4 py-1 rounded-full font-medium shadow hover:bg-blue-700">
    UPCOMING
  </button> --}}

  <a href="{{ route('provider.jobs.archive', auth()->id()) }}"
     class="text-blue-600 font-medium underline hover:text-blue-800">
    ARCHIVED
  </a>
</div>

      </div>
    </div>
  </div>

  <!-- Dispute Popup Modal -->
  <div id="disputePopup" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-6 sm:p-8 relative">
      <button onclick="closeDisputePopup()" class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
      <div class="flex items-center gap-2 mb-4">
        <span class="bg-red-100 text-red-600 rounded-full p-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg></span>
        <span class="text-lg font-semibold text-red-700">You have received a dispute</span>
      </div>
      <div class="text-gray-700 mb-2 text-sm">The client has sent you the following message:</div>
      <div class="bg-blue-50 rounded-lg p-4 mb-4 text-sm text-gray-800 text-left">
        Hi "name service provider",<br><br>
        I hope you're doing well. I'm contacting you because I have some concerns about the current order:
        <ul class="list-disc pl-5 my-2">
          <li>No update has been shared since the project started.</li>
          <li>The expected delivery date was 3 days ago.</li>
          <li>I sent 2 messages without a reply.</li>
        </ul>
        I'd really appreciate it if you could either provide a clear update or cancel the order if you're unable to continue. Looking forward to your response. Thanks in advance!
      </div>
      <div class="flex items-center gap-2 mb-4">
        <span class="text-orange-500 text-base"><i class="fas fa-clock"></i></span>
        <span class="text-sm text-orange-600 font-medium">Time remaining to respond: <span id="disputeTimer">23:51:43</span></span>
      </div>
      <div class="flex gap-4 mt-2">
        <button onclick="openDecisionPopup()" class="bg-white border border-red-400 text-red-600 px-6 py-2 rounded-lg font-semibold hover:bg-red-50 transition w-full">Refuse Request</button>
        <button onclick="openDecisionPopup()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition w-full">Accept Request</button>
      </div>
    </div>
  </div>

  <!-- Decision Sent Popup Modal -->
  <div id="decisionPopup" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
    <div class="bg-green-50 border border-green-200 rounded-2xl shadow-xl max-w-md w-full p-8 text-center relative">
      <button onclick="closeDecisionPopup()" class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
      <div class="flex flex-col items-center mb-4">
        <div class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
          </svg>
        </div>
        <h2 class="text-xl font-bold text-green-700 mb-2">Your decision has been sent!</h2>
      </div>
      <p class="text-gray-700 mb-2">The service requester has just received your message.<br>
        We'll keep you in the loop for what happens next.</p>
      <p class="text-gray-600 mt-4">Thanks a bunch for your trust! 🙌</p>
    </div>
  </div>
@include('dashboard.provider.jobs.delivery-confirm-popup')
  <script>
    function openDisputePopup(idx) {
      document.getElementById('disputePopup').classList.remove('hidden');
    }
    function closeDisputePopup() {
      document.getElementById('disputePopup').classList.add('hidden');
    }
    function openDecisionPopup() {
      closeDisputePopup();
      document.getElementById('decisionPopup').classList.remove('hidden');
    }
    function closeDecisionPopup() {
      document.getElementById('decisionPopup').classList.add('hidden');
    }
    function startMission(missionId) {
      if (!confirm('Are you sure you want to start this mission?')) {
        return;
      }

      fetch('/api/provider/jobs/start', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          mission_id: missionId
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Mission started successfully!');
          location.reload();
        } else {
          alert(data.message || 'Failed to start the mission. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
      });
    }

    function resolveDispute(missionId) {
      if (!confirm('Are you sure you want to resolve this mission?')) {
        return;
      }

      fetch('/api/provider/jobs/resolve', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          mission_id: missionId
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Dispute Resolved successfully!');
          location.reload();
        } else {
          alert(data.message || 'Failed to reslove the mission. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
      });
    }

  </script>

<style>
@media (max-width: 640px) {
  .grid-cols-1 > div.bg-blue-100,
  .grid-cols-1 > div.bg-white {
    flex-direction: row !important;
    align-items: center !important;
    padding: 1.25rem !important;
    gap: 0.5rem !important;
  }
  .grid-cols-1 > div.bg-blue-100 h3,
  .grid-cols-1 > div.bg-white h3 {
    font-size: 1rem !important;
    margin-bottom: 0.25rem !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
  }
  .grid-cols-1 > div.bg-blue-100 .w-16,
  .grid-cols-1 > div.bg-white .w-16 {
    margin-bottom: 0 !important;
  }
  .grid-cols-1 > div.bg-blue-100 .flex-1,
  .grid-cols-1 > div.bg-white .flex-1 {
    min-width: 0;
  }
  .grid-cols-1 > div.bg-blue-100 a,
  .grid-cols-1 > div.bg-white a {
    font-size: 1rem !important;
    padding: 0.5rem 1.25rem !important;
    border-radius: 9999px !important;
  }
}
</style>
@endsection