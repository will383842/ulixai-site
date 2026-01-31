@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            @if(auth()->user()->isBanned())
            {{-- Banned State --}}
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-ban text-red-500 text-4xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ __('notifications.moderation.account_banned') }}</h1>
            <p class="text-gray-600 mb-6">
                {{ __('notifications.moderation.banned_message') }}
            </p>

            @if(auth()->user()->banned_until)
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-700">
                    <strong>{{ __('notifications.moderation.ban_until') }}:</strong>
                    {{ auth()->user()->banned_until->format('d/m/Y H:i') }}
                </p>
            </div>
            @else
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-700">
                    <strong>{{ __('notifications.moderation.permanent_ban') }}</strong>
                </p>
            </div>
            @endif

            @if(auth()->user()->ban_reason)
            <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                <p class="text-xs text-gray-500 uppercase mb-1">{{ __('notifications.moderation.reason') }}</p>
                <p class="text-gray-700">{{ auth()->user()->ban_reason }}</p>
            </div>
            @endif

            @elseif(auth()->user()->isSuspended())
            {{-- Suspended State --}}
            <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-pause-circle text-orange-500 text-4xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ __('notifications.moderation.account_suspended') }}</h1>
            <p class="text-gray-600 mb-6">
                {{ __('notifications.moderation.suspended_message') }}
            </p>

            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-orange-700">
                    <strong>{{ __('notifications.moderation.suspension_until') }}:</strong>
                    {{ auth()->user()->suspended_until->format('d/m/Y H:i') }}
                </p>
                <p class="text-xs text-orange-600 mt-2">
                    {{ __('notifications.moderation.time_remaining') }}: {{ auth()->user()->suspended_until->diffForHumans() }}
                </p>
            </div>

            @if(auth()->user()->suspension_reason)
            <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                <p class="text-xs text-gray-500 uppercase mb-1">{{ __('notifications.moderation.reason') }}</p>
                <p class="text-gray-700">{{ auth()->user()->suspension_reason }}</p>
            </div>
            @endif
            @endif

            {{-- Strike Count --}}
            @if(auth()->user()->strike_count > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-center gap-2 mb-2">
                    @for($i = 1; $i <= 3; $i++)
                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $i <= auth()->user()->strike_count ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                        <i class="fas fa-bolt text-sm"></i>
                    </div>
                    @endfor
                </div>
                <p class="text-sm text-yellow-700">
                    {{ auth()->user()->strike_count }}/3 strikes
                </p>
            </div>
            @endif

            {{-- Actions --}}
            <div class="space-y-3">
                @if(auth()->user()->canAppeal())
                <a href="{{ route('appeal.create') }}" class="block w-full py-3 px-4 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    <i class="fas fa-gavel mr-2"></i>
                    {{ __('notifications.moderation.appeal_action') }}
                </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full py-3 px-4 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('auth.logout') }}
                    </button>
                </form>

                <a href="mailto:support@ulixai.com" class="block text-sm text-gray-500 hover:text-gray-700">
                    {{ __('notifications.moderation.contact_support') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
