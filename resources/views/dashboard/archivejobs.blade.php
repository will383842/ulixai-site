@extends('dashboard.layouts.master')

@section('title', 'Job List')

@section('content')



<div class="mb-8">
  <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">
    Archive Jobs
  </h2>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($jobs as $job)
      <div class="bg-blue-100 rounded-2xl shadow p-5 flex flex-row items-center gap-4 border border-blue-200">
        <div class="flex-1">
          <h3 class="text-blue-900 font-bold text-sm mb-1">
            {{ $job->title ?? 'Mission' }}
          </h3>
          <div class="text-sm text-gray-700 mb-2 flex flex-col">
            <span>
              Completed On :
              <span class="font-semibold">
                {{ $job->completed_at ? $job->completed_at->format('d M Y') : $job->updated_at->format('d M Y') }}
              </span>
            </span>
            <span>
              Created :
              <span class="font-semibold">{{ $job->created_at->diffForHumans() }}</span>
            </span>
            <span>
              Payment Status :
              <span class="font-semibold">{{ ucfirst($job->payment_status) ?? '-' }}</span>
            </span>
            <span>
              Country :
              <span class="font-semibold">{{ $job->location_country ?? '-' }}</span>
            </span>
            <span>
              Language :
              <span class="font-semibold">{{ $job->language ?? '-' }}</span>
            </span>
          </div>

         
        </div>
        <div class="flex flex-col items-center min-w-[64px]">
          <div class="w-16 h-16 bg-blue-200 rounded-full flex items-center justify-center">
            <svg class="w-7 h-7 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-3 text-center text-gray-500 py-12">
        No completed missions yet.
      </div>
    @endforelse
  </div>
</div>





@endsection