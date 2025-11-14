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
        $providerEarnings = round($totalEarnings * 0.80, 2);
    }

    $canWithdraw = ($user->pending_affiliate_balance >= 30) || ($balance['available'] ?? 0) > 30;
@endphp

<style>
    :root {
        --color-primary: #2563eb;
        --color-primary-light: #3b82f6;
        --color-secondary: #06b6d4;
        --color-success: #10b981;
        --color-warning: #f59e0b;
        --color-danger: #ef4444;
        --color-purple: #8b5cf6;
        --color-gradient-start: #6366f1;
        --color-gradient-mid: #8b5cf6;
        --color-gradient-end: #d946ef;
        --color-text-primary: #0f172a;
        --color-text-secondary: #64748b;
        --color-text-tertiary: #94a3b8;
        --color-bg-primary: #ffffff;
        --color-bg-secondary: #f8fafc;
        --border-radius-sm: 0.75rem;
        --border-radius-md: 1rem;
        --border-radius-lg: 1.25rem;
        --border-radius-xl: 1.5rem;
        --transition-base: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    * {
        -webkit-tap-highlight-color: transparent;
    }
    
    .earnings-container-2025 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0.875rem;
        background: #ffffff;
        min-height: 100vh;
    }
    
    /* HEADER */
    .earnings-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .earnings-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }
    
    .earnings-title i {
        color: var(--color-primary);
        font-size: 1.5rem;
    }
    
    .earnings-subtitle {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        font-weight: 500;
    }
    
    /* HERO BALANCE CARD */
    .hero-balance-card {
        background: linear-gradient(135deg, var(--color-gradient-start) 0%, var(--color-gradient-mid) 50%, var(--color-gradient-end) 100%);
        border-radius: var(--border-radius-xl);
        padding: 2rem 1.5rem;
        margin: 0 auto 2rem;
        max-width: 600px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(99, 102, 241, 0.4);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .hero-balance-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .hero-icon {
        width: 72px;
        height: 72px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        color: white;
        font-size: 2rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        position: relative;
        z-index: 1;
    }
    
    .hero-label {
        font-size: 0.9375rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
        position: relative;
        z-index: 1;
    }
    
    .hero-amount {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        line-height: 1;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .hero-currency {
        font-size: 2rem;
        margin-left: 0.25rem;
    }
    
    .hero-subtitle {
        font-size: 0.8125rem;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
        position: relative;
        z-index: 1;
    }
    
    /* EARNINGS GRID */
    .earnings-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-bottom: 2rem;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .earnings-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 2px solid #e2e8f0;
        border-radius: var(--border-radius-lg);
        padding: 1.5rem;
        transition: var(--transition-base);
        position: relative;
        overflow: hidden;
    }
    
    .earnings-card:hover {
        border-color: var(--color-primary);
        box-shadow: 0 12px 32px rgba(37, 99, 235, 0.15);
        transform: translateY(-3px);
    }
    
    .earnings-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        transition: width 0.3s ease;
    }
    
    .earnings-card:hover::before {
        width: 8px;
    }
    
    .earnings-card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }
    
    .earnings-card-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--border-radius-md);
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    
    .earnings-card-icon.warning {
        background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .earnings-card-content {
        flex: 1;
    }
    
    .earnings-card-label {
        font-size: 0.875rem;
        color: var(--color-text-secondary);
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .earnings-card-value {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        line-height: 1;
    }
    
    .earnings-card-currency {
        font-size: 1.5rem;
        color: var(--color-text-secondary);
        margin-left: 0.25rem;
    }
    
    .earnings-card-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .earnings-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    .earnings-badge.success {
        background: #d1fae5;
        color: #065f46;
    }
    
    .earnings-badge.info {
        background: #dbeafe;
        color: #1e40af;
    }
    
    /* WITHDRAW SECTION */
    .withdraw-section {
        max-width: 600px;
        margin: 0 auto 2rem;
    }
    
    .withdraw-info-box {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 2px solid #93c5fd;
        border-radius: var(--border-radius-lg);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    
    .withdraw-info-icon {
        width: 48px;
        height: 48px;
        background: var(--color-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        color: white;
        font-size: 1.25rem;
    }
    
    .withdraw-info-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
    }
    
    .withdraw-info-text {
        font-size: 0.8125rem;
        color: var(--color-text-secondary);
        line-height: 1.6;
    }
    
    .withdraw-btn {
        width: 100%;
        background: linear-gradient(135deg, var(--color-success) 0%, #059669 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: var(--border-radius-lg);
        font-weight: 700;
        font-size: 1rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        position: relative;
        overflow: hidden;
        touch-action: manipulation;
    }
    
    .withdraw-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .withdraw-btn:hover::before,
    .withdraw-btn:focus::before {
        left: 100%;
    }
    
    .withdraw-btn:hover,
    .withdraw-btn:focus {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 12px 32px rgba(16, 185, 129, 0.5);
    }
    
    .withdraw-btn:active {
        transform: translateY(0) scale(0.98);
    }
    
    .withdraw-btn:focus {
        outline: 3px solid rgba(16, 185, 129, 0.5);
        outline-offset: 2px;
    }
    
    .withdraw-btn i {
        font-size: 1.125rem;
    }
    
    .withdraw-disabled {
        background: #e5e7eb;
        color: var(--color-text-tertiary);
        cursor: not-allowed;
        box-shadow: none;
        pointer-events: none;
    }
    
    .withdraw-disabled::before {
        display: none;
    }
    
    .minimum-notice {
        background: #fef3c7;
        border: 2px solid #fde68a;
        border-radius: var(--border-radius-md);
        padding: 1rem;
        margin-top: 1rem;
        text-align: center;
    }
    
    .minimum-notice-text {
        font-size: 0.875rem;
        color: #92400e;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .minimum-notice-text i {
        color: var(--color-warning);
    }
    
    /* EMPTY STATE */
    .empty-earnings {
        text-align: center;
        padding: 3rem 1.5rem;
        background: var(--color-bg-secondary);
        border: 2px dashed #cbd5e1;
        border-radius: var(--border-radius-lg);
        max-width: 600px;
        margin: 2rem auto;
    }
    
    .empty-earnings-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--color-primary);
        font-size: 2rem;
    }
    
    .empty-earnings-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.75rem;
    }
    
    .empty-earnings-text {
        font-size: 0.9375rem;
        color: var(--color-text-secondary);
        line-height: 1.6;
    }
    
    /* SCREEN READER */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
    
    /* RESPONSIVE - TABLET */
    @media (min-width: 640px) {
        .earnings-container-2025 {
            padding: 1.5rem;
        }
        
        .earnings-title {
            font-size: 2rem;
        }
        
        .hero-balance-card {
            padding: 2.5rem 2rem;
        }
        
        .hero-amount {
            font-size: 4rem;
        }
        
        .earnings-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .earnings-card {
            padding: 2rem;
        }
        
        .withdraw-btn {
            padding: 1.125rem 2.5rem;
            font-size: 1.0625rem;
        }
    }
    
    /* RESPONSIVE - DESKTOP */
    @media (min-width: 1024px) {
        .earnings-container-2025 {
            padding: 2rem;
        }
        
        .earnings-title {
            font-size: 2.25rem;
        }
        
        .hero-balance-card {
            padding: 3rem 2.5rem;
        }
        
        .hero-amount {
            font-size: 4.5rem;
        }
    }
    
    /* REDUCED MOTION */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<div class="earnings-container-2025">
    
    <!-- Header -->
    <header class="earnings-header">
        <h1 class="earnings-title">
            <i class="fas fa-wallet" aria-hidden="true"></i>
            <span>My Earnings</span>
        </h1>
        <p class="earnings-subtitle">Track your balance and manage your withdrawals</p>
    </header>
    
    <!-- Hero Balance Card -->
    <section class="hero-balance-card" role="region" aria-label="Total available balance">
        <div class="hero-icon" aria-hidden="true">
            <i class="fas fa-coins"></i>
        </div>
        <div class="hero-label">Total Available Balance</div>
        <div class="hero-amount" aria-label="Balance amount">
            {{ number_format(
                $user->user_role === 'service_provider'
                    ? ($balance['available'] ?? 0.00)
                    : ($user->pending_affiliate_balance ?? 0.00),
                2
            ) }}<span class="hero-currency">€</span>
        </div>
        <div class="hero-subtitle">Ready to withdraw</div>
    </section>
    
    <!-- Earnings Breakdown -->
    <section class="earnings-grid" role="region" aria-label="Earnings breakdown">
        
        <!-- Affiliate Commission Card -->
        <article class="earnings-card">
            <div class="earnings-card-header">
                <div class="earnings-card-icon warning" aria-hidden="true">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="earnings-card-content">
                    <div class="earnings-card-label">
                        @if($user->user_role === 'service_provider')
                            Affiliate Commission
                        @else
                            Affiliate Balance
                        @endif
                    </div>
                    <div class="earnings-card-value" aria-label="Affiliate earnings">
                        {{ number_format($user->pending_affiliate_balance, 2) }}<span class="earnings-card-currency">€</span>
                    </div>
                </div>
            </div>
            <div class="earnings-card-meta">
                <span class="earnings-badge info">
                    <i class="fas fa-percentage" aria-hidden="true"></i>
                    <span>Commission</span>
                </span>
            </div>
        </article>
        
        <!-- Missions Earnings Card (Only for Service Providers) -->
        @if($user->user_role === 'service_provider')
        <article class="earnings-card">
            <div class="earnings-card-header">
                <div class="earnings-card-icon" aria-hidden="true">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="earnings-card-content">
                    <div class="earnings-card-label">Missions Completed</div>
                    <div class="earnings-card-value" aria-label="Mission earnings">
                        {{ number_format($providerEarnings ?? 0.00, 2) }}<span class="earnings-card-currency">€</span>
                    </div>
                </div>
            </div>
            <div class="earnings-card-meta">
                <span class="earnings-badge success">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>Completed</span>
                </span>
            </div>
        </article>
        @endif
        
    </section>
    
    <!-- Withdraw Section -->
    <section class="withdraw-section" role="region" aria-label="Withdrawal options">
        
        @if($canWithdraw)
            <div class="withdraw-info-box">
                <div class="withdraw-info-icon" aria-hidden="true">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="withdraw-info-title">You're Ready to Withdraw!</div>
                <p class="withdraw-info-text">
                    Your balance meets the minimum threshold. Click below to request a withdrawal of your earnings.
                </p>
            </div>
            
            <form method="POST" action="{{ route('affiliate.withdraw') }}">
                @csrf
                <input type="hidden" name="withdraw_all_balances" value="true">
                <button type="submit" class="withdraw-btn" aria-label="Withdraw all earnings">
                    <i class="fas fa-arrow-circle-down" aria-hidden="true"></i>
                    <span>Withdraw My Earnings</span>
                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                </button>
            </form>
        @else
            <div class="withdraw-info-box">
                <div class="withdraw-info-icon" style="background: var(--color-text-tertiary);" aria-hidden="true">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="withdraw-info-title">Minimum Balance Required</div>
                <p class="withdraw-info-text">
                    You need at least 30€ to request a withdrawal. Keep earning to reach the threshold!
                </p>
            </div>
            
            <button type="button" class="withdraw-btn withdraw-disabled" disabled aria-label="Withdrawal not available">
                <i class="fas fa-ban" aria-hidden="true"></i>
                <span>Withdrawal Unavailable</span>
            </button>
            
            <div class="minimum-notice">
                <p class="minimum-notice-text">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                    <span>Minimum withdrawal amount: 30.00€</span>
                </p>
            </div>
        @endif
        
    </section>
    
    <!-- Empty State (if no earnings at all) -->
    @if(($user->pending_affiliate_balance ?? 0) == 0 && ($user->user_role !== 'service_provider' || ($providerEarnings ?? 0) == 0))
    <aside class="empty-earnings" role="status">
        <div class="empty-earnings-icon" aria-hidden="true">
            <i class="fas fa-piggy-bank"></i>
        </div>
        <h2 class="empty-earnings-title">Start Earning Today</h2>
        <p class="empty-earnings-text">
            Complete missions or refer new users to start building your earnings. Every contribution counts!
        </p>
    </aside>
    @endif
    
</div>

@endsection