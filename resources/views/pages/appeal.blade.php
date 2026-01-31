@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-white">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-gavel text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{ __('notifications.moderation.appeal_title') }}</h1>
                        <p class="text-blue-100 text-sm">{{ __('notifications.moderation.appeal_subtitle') }}</p>
                    </div>
                </div>
            </div>

            {{-- Current Status --}}
            <div class="p-6 bg-gray-50 border-b">
                <h2 class="font-semibold text-gray-700 mb-3">{{ __('notifications.moderation.current_status') }}</h2>
                <div class="flex items-center gap-4">
                    @if(auth()->user()->isBanned())
                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                        <i class="fas fa-ban mr-1"></i> {{ __('moderation.status.banned') }}
                    </span>
                    @elseif(auth()->user()->isSuspended())
                    <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm font-medium">
                        <i class="fas fa-pause-circle mr-1"></i> {{ __('moderation.status.suspended') }}
                    </span>
                    @endif

                    @if(auth()->user()->strike_count > 0)
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-medium">
                        <i class="fas fa-bolt mr-1"></i> {{ auth()->user()->strike_count }} Strike(s)
                    </span>
                    @endif
                </div>

                @if(auth()->user()->ban_reason ?? auth()->user()->suspension_reason)
                <div class="mt-4 p-3 bg-white rounded-lg border">
                    <p class="text-xs text-gray-500 uppercase mb-1">{{ __('notifications.moderation.sanction_reason') }}</p>
                    <p class="text-gray-700">{{ auth()->user()->ban_reason ?? auth()->user()->suspension_reason }}</p>
                </div>
                @endif
            </div>

            {{-- Form --}}
            <form action="{{ route('appeal.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Appeal Reason --}}
                <div>
                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('notifications.moderation.appeal_reason') }} *
                    </label>
                    <textarea
                        name="reason"
                        id="reason"
                        rows="5"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="{{ __('notifications.moderation.appeal_reason_placeholder') }}"
                    >{{ old('reason') }}</textarea>
                    @error('reason')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">{{ __('notifications.moderation.min_characters', ['count' => 50]) }}</p>
                </div>

                {{-- Evidence --}}
                <div>
                    <label for="evidence" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('notifications.moderation.appeal_evidence') }}
                    </label>
                    <textarea
                        name="evidence"
                        id="evidence"
                        rows="3"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="{{ __('notifications.moderation.appeal_evidence_placeholder') }}"
                    >{{ old('evidence') }}</textarea>
                    @error('evidence')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Agreement --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="agreement" required class="mt-1 rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-blue-700">
                            {{ __('notifications.moderation.appeal_agreement') }}
                        </span>
                    </label>
                </div>

                {{-- Info Box --}}
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-medium text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas fa-info-circle text-gray-400"></i>
                        {{ __('notifications.moderation.appeal_info_title') }}
                    </h3>
                    <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                        <li>{{ __('notifications.moderation.appeal_info_1') }}</li>
                        <li>{{ __('notifications.moderation.appeal_info_2') }}</li>
                        <li>{{ __('notifications.moderation.appeal_info_3') }}</li>
                    </ul>
                </div>

                {{-- Actions --}}
                <div class="flex gap-4">
                    <a href="{{ route('banned') }}" class="flex-1 py-3 px-4 border border-gray-300 text-gray-700 rounded-lg font-medium text-center hover:bg-gray-50 transition-colors">
                        {{ __('common.cancel') }}
                    </a>
                    <button type="submit" class="flex-1 py-3 px-4 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ __('notifications.moderation.submit_appeal') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- Previous Appeals --}}
        @if(isset($previousAppeals) && $previousAppeals->count() > 0)
        <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
            <h2 class="font-semibold text-gray-700 mb-4">{{ __('notifications.moderation.previous_appeals') }}</h2>
            <div class="space-y-3">
                @foreach($previousAppeals as $appeal)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <span class="text-sm font-medium text-gray-700">{{ $appeal->created_at->format('d/m/Y') }}</span>
                        <span class="ml-2 px-2 py-0.5 rounded text-xs font-medium {{ $appeal->status === 'approved' ? 'bg-green-100 text-green-700' : ($appeal->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($appeal->status) }}
                        </span>
                    </div>
                    <span class="text-xs text-gray-500">{{ Str::limit($appeal->reason, 50) }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
