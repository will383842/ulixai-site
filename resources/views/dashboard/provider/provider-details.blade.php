{{-- Provider Details Page - V7.1 FINAL - Socialmediacard correctement positionné --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $provider->profile_description }}">
    <title>Provider Detail</title>

    <!-- TAILWIND CDN - NÉCESSAIRE pour les includes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <style>
        /* CLASSES ULTRA-SPÉCIFIQUES POUR ÉVITER TOUS LES CONFLITS */
        
        /* Wrapper principal - NE PAS toucher au body */
        .provider-profile-page-wrapper {
            background: linear-gradient(145deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            padding: 1rem;
        }

        .provider-profile-main-container {
            max-width: 72rem;
            margin: 2rem auto 0;
        }

        .provider-profile-flex-layout {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        @media (min-width: 1024px) {
            .provider-profile-flex-layout {
                flex-direction: row;
            }
        }

        /* SIDEBAR */
        .provider-profile-sidebar {
            flex: 1;
            min-width: 0;
        }

        .provider-profile-sidebar-card {
            background: linear-gradient(145deg, #ffffff 0%, #fafbff 100%);
            border-radius: 28px;
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.16);
        }

        .provider-profile-sidebar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #0066FF 0%, #00D9FF 33%, #7C3AED 66%, #EC4899 100%);
            background-size: 300% 100%;
            animation: provider-gradient-flow 6s ease infinite;
        }

        @keyframes provider-gradient-flow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .provider-profile-image-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 1.5rem;
        }

        .provider-profile-image-wrapper::before {
            content: '';
            position: absolute;
            inset: -10px;
            background: conic-gradient(from 0deg, #0066FF, #00D9FF, #7C3AED, #EC4899, #FF1744, #0066FF);
            border-radius: 50%;
            animation: provider-spin-gradient 6s linear infinite;
        }

        @keyframes provider-spin-gradient {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .provider-profile-image {
            position: relative;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid white;
            overflow: hidden;
            background: white;
            box-shadow: 0 12px 32px rgba(0, 102, 255, 0.3);
            z-index: 1;
            cursor: pointer;
        }

        .provider-profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .provider-profile-image:hover img {
            transform: scale(1.1);
        }

        .provider-profile-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            background: linear-gradient(135deg, #00E676 0%, #00C853 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 700;
            margin-top: 1rem;
            box-shadow: 0 6px 20px rgba(0, 230, 118, 0.4);
        }

        .provider-profile-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.625rem;
            margin-top: 1.25rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: #0066FF;
        }

        .provider-profile-rating i {
            color: #FFD700;
            font-size: 1.75rem;
        }

        .provider-profile-member-since {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 3px solid #E2E8F0;
        }

        .provider-profile-service-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            min-height: 48px;
            padding: 1.125rem 1.25rem;
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            border-radius: 16px;
            border: 2.5px solid #3385FF;
            margin: 0.875rem 0;
            transition: all 0.3s;
            cursor: pointer;
        }

        .provider-profile-service-item:hover {
            transform: translateX(4px);
        }

        .provider-profile-service-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0066FF 0%, #00D9FF 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .provider-profile-btn-cta {
            width: 100%;
            min-height: 56px;
            background: linear-gradient(135deg, #FF1744 0%, #D50000 100%);
            color: white;
            font-weight: 800;
            font-size: 1.125rem;
            border-radius: 18px;
            border: none;
            cursor: pointer;
            margin-top: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s;
        }

        .provider-profile-btn-cta:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 32px rgba(255, 23, 68, 0.4);
        }

        /* CONTENT */
        .provider-profile-content {
            flex: 2;
            min-width: 0;
        }

        .provider-profile-content-card {
            background: white;
            border-radius: 28px;
            padding: 1.75rem;
            position: relative;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.16);
        }

        .provider-profile-content-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, #0066FF 0%, #7C3AED 50%, #EC4899 100%);
            border-radius: 28px 28px 0 0;
        }

        .provider-profile-name {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #0066FF 0%, #7C3AED 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
        }

        .provider-profile-description-box {
            background: linear-gradient(135deg, #F8FAFC 0%, #F1F5F9 100%);
            border-radius: 20px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border: 2.5px solid #E2E8F0;
        }

        .provider-profile-status-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 2.5px solid #E2E8F0;
            margin-bottom: 1.5rem;
        }

        .provider-profile-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border-radius: 14px;
            border: 2.5px solid #FFB300;
            font-weight: 700;
            font-size: 0.875rem;
            color: #78350F;
            margin: 0.5rem 0.5rem 0 0;
        }

        /* FILTER SECTION */
        .provider-profile-filter-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding: 1.25rem;
            background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
            border-radius: 20px;
            border: 2.5px solid #0066FF;
        }

        .provider-profile-filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .provider-profile-filter-label {
            font-weight: 700;
            color: #1E293B;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .provider-profile-filter-dropdown-wrapper {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .provider-profile-filter-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 48px;
            padding: 0 1.25rem;
            background: white;
            border: 2.5px solid #0066FF;
            border-radius: 14px;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #0066FF;
            cursor: pointer;
            transition: all 0.3s;
        }

        .provider-profile-filter-btn:hover {
            background: #0066FF;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 102, 255, 0.3);
        }

        .provider-profile-filter-dropdown {
            position: absolute;
            top: calc(100% + 0.75rem);
            left: 0;
            right: 0;
            background: white;
            border: 2.5px solid #0066FF;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            z-index: 100;
            overflow: hidden;
            display: none;
        }

        .provider-profile-filter-dropdown.show {
            display: block;
            animation: provider-slideDown 0.3s ease;
        }

        @keyframes provider-slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .provider-profile-filter-dropdown button {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            width: 100%;
            min-height: 48px;
            padding: 0 1.25rem;
            background: white;
            border: none;
            font-size: 0.9375rem;
            font-weight: 600;
            color: #334155;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
        }

        .provider-profile-filter-dropdown button:hover {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #0066FF;
        }

        .provider-profile-filter-dropdown button i {
            width: 20px;
            text-align: center;
        }

        .provider-profile-results-count {
            padding: 0.625rem 1.125rem;
            background: linear-gradient(135deg, #0066FF 0%, #00D9FF 100%);
            color: white;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.875rem;
            box-shadow: 0 6px 16px rgba(0, 102, 255, 0.35);
            white-space: nowrap;
        }

        .provider-profile-review-card {
            display: flex;
            gap: 1rem;
            background: white;
            border: 2.5px solid #E2E8F0;
            border-radius: 20px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .provider-profile-review-card:hover {
            border-color: #0066FF;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 102, 255, 0.15);
        }

        .provider-profile-review-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 2px solid #3385FF;
            flex-shrink: 0;
            object-fit: cover;
        }

        .provider-profile-star-yellow {
            color: #FFD700;
        }

        /* STYLES POUR POPUP - SCOPÉS */
        .provider-profile-page-wrapper .star {
            cursor: pointer;
            font-size: 1.5rem;
            color: #d1d5db;
        }
        
        .provider-profile-page-wrapper .loader {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #0066FF;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: provider-spin 1s linear infinite;
        }
        
        @keyframes provider-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .provider-profile-page-wrapper .social-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #fff;
            font-size: 1.25rem;
            transition: transform 0.2s;
            box-shadow: 0 2px 8px 0 rgba(59, 130, 246, 0.07);
            border: none;
            outline: none;
        }
        
        .provider-profile-page-wrapper .social-btn:hover {
            transform: scale(1.13) rotate(-6deg);
            box-shadow: 0 4px 16px 0 rgba(59, 130, 246, 0.18);
            filter: brightness(1.08);
        }
        
        .provider-profile-page-wrapper .photo-upload-box {
            min-width: 140px;
            min-height: 140px;
        }
        
        .provider-profile-page-wrapper .group:hover .border-blue-200 {
            border-color: #2563eb !important;
        }
        
        .provider-profile-page-wrapper .urgency-btn.selected {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
        
        .provider-profile-page-wrapper .urgency-btn.selected .urgency-radio {
            background: #fff;
            border: 2px solid #fff;
            box-shadow: 0 0 0 4px #2563eb;
        }
        
        .provider-profile-page-wrapper .urgency-btn .urgency-radio {
            border: 2px solid #2563eb;
        }
        
        .provider-profile-page-wrapper .lang-btn.selected,
        .provider-profile-page-wrapper .lang-btn:active {
            background: #1e40af !important;
            color: #fff !important;
            border-color: #1e40af !important;
        }

        .provider-profile-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            backdrop-filter: blur(8px);
        }

        .provider-profile-modal.show {
            display: flex;
        }

        .provider-profile-modal-content {
            position: relative;
            animation: provider-zoomIn 0.3s ease;
        }

        @keyframes provider-zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .provider-profile-modal-close {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .provider-profile-modal-close:hover {
            background: #FF1744;
            color: white;
            transform: rotate(90deg);
        }

        .provider-profile-modal-image {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid white;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .provider-profile-no-results {
            text-align: center;
            padding: 3rem 1rem;
            color: #94A3B8;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .provider-profile-spacer {
            padding-bottom: 3rem;
        }

        @media (max-width: 640px) {
            .provider-profile-name {
                font-size: 1.5rem;
            }
            .provider-profile-page-wrapper {
                padding: 0.5rem;
            }
            .provider-profile-sidebar-card,
            .provider-profile-content-card {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}', 'Error');
        </script>
    @endif

    @include('includes.header')
    @include('pages.popup')

    @php
        $reviews = \App\Models\ProviderReview::where('provider_id', $provider->id ?? 0)->with('user')->latest()->get();
        $reviewCount = $reviews->count();
        $avgRating = $reviewCount ? round($reviews->avg('rating'), 2) : 5;
        $isProviderSelf = (auth()->check() && $provider->user_id == auth()->id());
        $shareUrl = route('provider.profile', ['slug' => $provider->slug]);
    @endphp

    <div class="provider-profile-page-wrapper">
        
        <!-- SOCIAL MEDIA CARD - UN SEUL INCLUDE, DANS LE WRAPPER POUR LE BON BACKGROUND -->
        @include('pages.socialmediacard')
        
        <div class="provider-profile-main-container">
            <div class="provider-profile-flex-layout">
                
                <!-- SIDEBAR -->
                <div class="provider-profile-sidebar">
                    <div class="provider-profile-sidebar-card">
                        <div style="text-align: center;">
                            <div class="provider-profile-image-wrapper">
                                <button id="profileImgBtn" class="provider-profile-image" style="border: none; background: none; padding: 0;">
                                    @if(isset($provider) && $provider->profile_photo)
                                        <img src="{{ asset($provider->profile_photo) }}" alt="Profile">
                                    @else
                                        <img src="https://i.pravatar.cc/300?img=3" alt="Profile">
                                    @endif
                                </button>
                            </div>
                            
                            <div class="provider-profile-verified-badge">
                                <i class="fas fa-check-circle"></i>
                                <span>Profile verified</span>
                            </div>
                            
                            <div class="provider-profile-rating">
                                <i class="fas fa-star"></i>
                                <span>{{ number_format($avgRating, 1) }} / 5</span>
                            </div>
                        </div>
                        
                        <div class="provider-profile-member-since">
                            @if(isset($provider) && $provider->user && $provider->user->created_at)
                                ULYSSE SINCE {{ strtoupper($provider->user->created_at->diffForHumans(null, true)) }}
                            @else
                                ULYSSE SINCE 3 MONTHS
                            @endif
                        </div>
                        
                        @php
                            $services = $provider->services_to_offer ? json_decode($provider->services_to_offer, true) : [];
                        @endphp

                        @if(is_array($services) && count($services) > 0)
                            @foreach($services as $service)
                                @php
                                    $category = \App\Models\Category::find($service);
                                @endphp
                                @if($category)
                                    <div class="provider-profile-service-item">
                                        <div class="provider-profile-service-icon"><i class="fas fa-briefcase"></i></div>
                                        <span style="font-weight: 700; color: #1E293B;">{{ $category->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="provider-profile-service-item">
                                <div class="provider-profile-service-icon"><i class="fas fa-briefcase"></i></div>
                                <span style="font-weight: 700; color: #94A3B8;">No services listed</span>
                            </div>
                        @endif
                        
                        <button onclick="openHelpPopup()" class="provider-profile-btn-cta">
                            <i class="fas fa-paper-plane"></i>
                            Suggest A Mission
                        </button>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="provider-profile-content">
                    <div class="provider-profile-content-card">
                        
                        <h1 class="provider-profile-name">
                            {{ isset($provider) ? ($provider->first_name . ' ' . $provider->last_name) : 'NAME' }}
                        </h1>
                        <p style="color: #64748B; margin-bottom: 1.5rem; font-weight: 600;">
                            NUMBER OF SERVICES PROVIDED: {{ isset($provider) && isset($provider->services_to_offer) ? (is_array($services) ? count($services) : 1) : 0 }}
                        </p>
                        
                        <div class="provider-profile-description-box">
                            <p style="color: #334155; line-height: 1.75;">
                                {{ $provider->profile_description ?? 'A few words presentation of the Ulysse...' }}
                            </p>
                        </div>
                        
                        <div class="provider-profile-status-section">
                            <p style="font-weight: 700; color: #1E293B; margin-bottom: 1rem;">Special Status</p>
                            <div>
                                @php
                                    $specialStatus = $provider->special_status ?? [];
                                    if (is_string($specialStatus)) {
                                        $decoded = json_decode($specialStatus, true);
                                        $specialStatus = is_array($decoded) ? $decoded : [];
                                    }
                                @endphp
                                @if($specialStatus && count($specialStatus) > 0)
                                    @foreach($specialStatus as $status => $val)
                                        @if($val)
                                        <div class="provider-profile-status-badge">
                                            <i class="fas fa-certificate"></i>
                                            <span>{{ $status }}</span>
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="provider-profile-status-badge">
                                        <i class="fas fa-certificate"></i>
                                        <span>No special status</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- FILTER SECTION -->
                        <div class="provider-profile-filter-section">
                            <div class="provider-profile-filter-header">
                                <span class="provider-profile-filter-label">
                                    <i class="fas fa-filter"></i>
                                    Filter by:
                                </span>
                                
                                <div class="provider-profile-filter-dropdown-wrapper">
                                    <button id="filter-dropdown-btn" onclick="toggleDropdown()" class="provider-profile-filter-btn">
                                        <span id="selected-filter">All Reviews</span>
                                        <i class="fas fa-chevron-down" id="dropdown-arrow"></i>
                                    </button>
                                    
                                    <div id="filter-dropdown" class="provider-profile-filter-dropdown">
                                        <button onclick="selectFilter('all', 'All Reviews')">
                                            <i class="fas fa-list"></i>
                                            All Reviews
                                        </button>
                                        <button onclick="selectFilter('newest', 'Newest First')">
                                            <i class="fas fa-clock"></i>
                                            Newest First
                                        </button>
                                        <button onclick="selectFilter('oldest', 'Oldest First')">
                                            <i class="fas fa-history"></i>
                                            Oldest First
                                        </button>
                                        <button onclick="selectFilter('high_rating', 'High Rating (4-5 ⭐)')">
                                            <i class="fas fa-star"></i>
                                            High Rating (4-5 ⭐)
                                        </button>
                                        <button onclick="selectFilter('low_rating', 'Low Rating (1-3 ⭐)')">
                                            <i class="fas fa-star-half-alt"></i>
                                            Low Rating (1-3 ⭐)
                                        </button>
                                    </div>
                                </div>

                                <span id="results-count" class="provider-profile-results-count">Showing {{ count($reviews) }} reviews</span>
                            </div>
                        </div>

                        <h3 style="font-weight: 800; color: #1E293B; margin-bottom: 1rem;">
                            <i class="fas fa-comments" style="color: #0066FF; margin-right: 0.5rem;"></i>
                            Client Reviews
                        </h3>
                        
                        <!-- REVIEWS CONTAINER -->
                        <div id="reviews-container">
                            @forelse($reviews as $review)
                            <div class="provider-profile-review-card review-item" 
                                data-rating="{{ $review->rating }}" 
                                data-date="{{ $review->created_at->timestamp }}">
                                @if($review->user && $review->user->profile_photo)
                                    <img src="{{ asset($review->user->profile_photo) }}" alt="User" class="provider-profile-review-avatar">
                                @else
                                    <img src="{{ asset('images/helpexpat.png') }}" alt="User" class="provider-profile-review-avatar">
                                @endif
                                <div style="flex: 1;">
                                    <div style="font-weight: 800; color: #0066FF; margin-bottom: 0.5rem;">
                                        {{ $review->user->name ?? 'User' }}
                                        <span style="color: #94A3B8; font-size: 0.8125rem; margin-left: 0.5rem;">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div style="color: #FFD700; margin: 0.5rem 0;">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'provider-profile-star-yellow' : '' }}" style="{{ $i > $review->rating ? 'color: #D1D5DB;' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <p style="color: #475569; line-height: 1.65;">
                                        {{ $review->comment }}
                                    </p>
                                </div>
                            </div>
                            @empty
                            <div class="provider-profile-no-results" id="no-reviews-message">
                                <i class="fas fa-comment-slash" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                                No reviews yet.
                            </div>
                            @endforelse
                        </div>

                        <!-- NO RESULTS MESSAGE -->
                        <div id="no-results-message" class="provider-profile-no-results" style="display: none;">
                            <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                            No reviews match the selected filter.
                        </div>

                        <!-- SPACER -->
                        <div class="provider-profile-spacer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR ENLARGED PROFILE IMAGE -->
    <div id="profileImgModal" class="provider-profile-modal">
        <div class="provider-profile-modal-content">
            <button id="closeProfileImgModal" class="provider-profile-modal-close">
                <i class="fas fa-times" style="font-size: 1.25rem;"></i>
            </button>
            @if(isset($provider) && $provider->profile_photo)
                <img src="{{ asset($provider->profile_photo) }}" alt="Profile Large" class="provider-profile-modal-image">
            @else
                <img src="https://i.pravatar.cc/300?img=3" alt="Profile Large" class="provider-profile-modal-image">
            @endif
        </div>
    </div>

    <script>
        // PROFILE IMAGE MODAL
        document.getElementById('profileImgBtn').addEventListener('click', function() {
            document.getElementById('profileImgModal').classList.add('show');
        });

        document.getElementById('closeProfileImgModal').addEventListener('click', function() {
            document.getElementById('profileImgModal').classList.remove('show');
        });

        document.getElementById('profileImgModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });

        // FILTER DROPDOWN
        function toggleDropdown() {
            const dropdown = document.getElementById('filter-dropdown');
            const arrow = document.getElementById('dropdown-arrow');
            
            dropdown.classList.toggle('show');
            arrow.style.transform = dropdown.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
        }

        function selectFilter(filterType, filterLabel) {
            document.getElementById('selected-filter').textContent = filterLabel;
            document.getElementById('filter-dropdown').classList.remove('show');
            document.getElementById('dropdown-arrow').style.transform = 'rotate(0deg)';
            
            filterReviews(filterType);
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('filter-dropdown');
            const button = document.getElementById('filter-dropdown-btn');
            
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.remove('show');
                document.getElementById('dropdown-arrow').style.transform = 'rotate(0deg)';
            }
        });

        function filterReviews(filterType) {
            const reviewItems = document.querySelectorAll('.review-item');
            const resultsCount = document.getElementById('results-count');
            const noResultsMessage = document.getElementById('no-results-message');
            const noReviewsMessage = document.getElementById('no-reviews-message');
            
            let visibleCount = 0;
            const reviewsArray = Array.from(reviewItems);
            
            switch(filterType) {
                case 'all':
                    reviewItems.forEach(item => {
                        item.style.display = 'flex';
                        visibleCount++;
                    });
                    break;
                    
                case 'newest':
                    reviewsArray.sort((a, b) => 
                        parseInt(b.dataset.date) - parseInt(a.dataset.date)
                    );
                    reorderAndShow(reviewsArray);
                    visibleCount = reviewsArray.length;
                    break;
                    
                case 'oldest':
                    reviewsArray.sort((a, b) => 
                        parseInt(a.dataset.date) - parseInt(b.dataset.date)
                    );
                    reorderAndShow(reviewsArray);
                    visibleCount = reviewsArray.length;
                    break;
                    
                case 'high_rating':
                    reviewItems.forEach(item => {
                        const rating = parseInt(item.dataset.rating);
                        if (rating >= 4) {
                            item.style.display = 'flex';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    break;
                    
                case 'low_rating':
                    reviewItems.forEach(item => {
                        const rating = parseInt(item.dataset.rating);
                        if (rating <= 3) {
                            item.style.display = 'flex';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    break;
            }
            
            resultsCount.textContent = `Showing ${visibleCount} reviews`;
            
            if (visibleCount === 0) {
                noResultsMessage.style.display = 'block';
                if (noReviewsMessage) {
                    noReviewsMessage.style.display = 'none';
                }
            } else {
                noResultsMessage.style.display = 'none';
                if (noReviewsMessage) {
                    noReviewsMessage.style.display = 'none';
                }
            }
        }

        function reorderAndShow(sortedArray) {
            const container = document.getElementById('reviews-container');
            
            sortedArray.forEach(item => {
                container.removeChild(item);
            });
            
            sortedArray.forEach(item => {
                item.style.display = 'flex';
                container.appendChild(item);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const initialCount = document.querySelectorAll('.review-item').length;
            document.getElementById('results-count').textContent = `Showing ${initialCount} reviews`;
        });

        // STARS HANDLER FOR POPUP
        const stars = document.querySelectorAll('.star');
        
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const currentRating = this.getAttribute('data-index');
                stars.forEach(s => {
                    s.classList.remove('provider-profile-star-yellow');
                    if (s.getAttribute('data-index') <= currentRating) {
                        s.classList.add('provider-profile-star-yellow');
                    }
                });
            });

            star.addEventListener('mouseleave', function() {
                stars.forEach(s => s.classList.remove('provider-profile-star-yellow'));
                const selectedRating = document.querySelector('input[name="rating"]:checked');
                if (selectedRating) {
                    stars.forEach(s => {
                        if (s.getAttribute('data-index') <= selectedRating.value) {
                            s.classList.add('provider-profile-star-yellow');
                        }
                    });
                }
            });

            star.addEventListener('click', function() {
                const selectedRating = this.getAttribute('data-index');
                const ratingInput = document.querySelector('input[name="rating"][value="' + selectedRating + '"]');
                if (ratingInput) {
                    ratingInput.checked = true;
                }
            });
        });
    </script>
</body>
</html>