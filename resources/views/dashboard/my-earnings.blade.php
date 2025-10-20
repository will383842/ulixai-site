@extends('dashboard.layouts.master')

@section('title', 'My Earnings')

@section('content')
@php
    if ($user->user_role === 'service_provider') {
        $missionsEarnings = \App\Models\Mission::with('transactions')
            ->where('selected_provider_id', $user->serviceprovider->id)
            ->where('status', 'completed')
            ->where('payment_status', 'released')
            ->get();

        $totalEarnings = $missionsEarnings->flatMap->transactions->sum('amount_paid');
        $providerEarnings = round($totalEarnings * 0.80, 2); // deduct 20%
    }

    $canWithdraw = ($user->pending_affiliate_balance >= 30) || ($balance['available'] ?? 0) > 30;
@endphp

<div class="flex-1 px-4 sm:px-6 lg:px-8 py-8 space-y-10">

    <!-- Page Header -->
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">My Earnings</h1>
    </div>

    <!-- Wallet Summary -->
    <div class="flex justify-center">
        <div class="w-full max-w-md bg-white border-2 border-blue-400 rounded-2xl p-6 text-center shadow-lg">
            <h2 class="text-base font-medium text-blue-500 mb-1">My Total Available Balance</h2>
            <div class="text-4xl font-extrabold text-blue-700">
                {{ number_format(
                    $user->user_role === 'service_provider'
                        ? ($balance['available'] ?? 0.00)
                        : ($user->pending_affiliate_balance ?? 0.00),
                    2
                ) }} €
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="flex gap-6 justify-center items-start max-w-6xl mx-auto">
        <!-- Affiliate Commission Card -->
        <div class="bg-white border-2 border-blue-400 rounded-2xl p-6 text-center shadow-lg sm:min-w-[350px] md:min-w-[500px]">
            @if($user->user_role === 'service_provider')
                <h3 class="text-base font-medium text-blue-500 mb-2">Total Affiliate Commission Earned</h3>
                <p class="text-3xl font-bold text-blue-700 mb-4">
                    {{ number_format($user->pending_affiliate_balance, 2) }} €
                </p>
            @else
                <h3 class="text-base font-medium text-blue-500 mb-2">Affiliate Balance</h3>
                <p class="text-3xl font-bold text-blue-700 mb-4">
                    {{ number_format($user->pending_affiliate_balance, 2) }} €
                </p>
            @endif
        </div>

        <!-- Missions Earnings Card -->
        @if($user->user_role === 'service_provider')
        <div class="bg-white border-2 border-blue-400 rounded-2xl p-6 text-center shadow-lg sm:min-w-[350px] md:min-w-[500px]">
            <h3 class="text-base font-medium text-blue-500 mb-2">Missions Carried Out</h3>
            <p class="text-3xl font-bold text-blue-700 mb-4">
                {{ number_format($providerEarnings ?? 0.00, 2) }} €
            </p>
        </div>
        @endif

    </div>

    <!-- Single Withdraw Button -->
    @if($canWithdraw)
        <div class="flex justify-center mt-10">
            <form method="POST" action="{{ route('affiliate.withdraw') }}" class="w-full max-w-sm">
                @csrf
                <input type="hidden" name="withdraw_all_balances" value="true">
                <button class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-blue-700 transition transform hover:scale-105">
                    Withdraw My Earnings
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
