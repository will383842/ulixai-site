@extends('dashboard.layouts.master')

@section('title', __('Payment Cancelled'))

@section('content')
<div class="flex-1 p-4 sm:p-6 lg:p-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 text-center">
        <div class="mb-6">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-3xl"></i>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ __('Payment Cancelled') }}</h1>

        <p class="text-gray-600 mb-6">
            {{ __('Your payment was cancelled. No charges have been made to your account.') }}
        </p>

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
        @endif

        <div class="space-y-3">
            <a href="{{ url()->previous() }}" class="block w-full bg-blue-500 text-white rounded-lg py-2.5 text-sm font-semibold hover:bg-blue-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Try Again') }}
            </a>

            <a href="{{ route('dashboard') }}" class="block w-full bg-gray-200 text-gray-700 rounded-lg py-2.5 text-sm font-semibold hover:bg-gray-300 transition">
                {{ __('Return to Dashboard') }}
            </a>
        </div>

        <p class="text-xs text-gray-500 mt-6">
            {{ __('If you encountered any issues, please contact our support team.') }}
        </p>
    </div>
</div>
@endsection
