<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title>Customer Reviews - Real Stories from Ulixai Users | 197 Countries</title>
    <meta name="description" content="Read authentic reviews from expats and travelers worldwide who used Ulixai services. Real success stories from 197 countries.">
    <meta name="keywords" content="ulixai reviews, customer testimonials, expat services reviews, international assistance reviews">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ulixai.com/customerreviews">
    <meta property="og:title" content="Customer Reviews - Ulixai.com">
    <meta property="og:description" content="Authentic reviews from our global community">
    <meta property="og:image" content="https://ulixai.com/images/og-reviews.jpg">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://ulixai.com/customerreviews">
    <meta property="twitter:title" content="Customer Reviews - Ulixai.com">
    <meta property="twitter:description" content="Authentic reviews from our global community">
    
    <!-- Canonical -->
    <link rel="canonical" href="https://ulixai.com/customerreviews">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: #f9fafb;
            color: #111827;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #BFDBFE 100%);
            padding: 4rem 1rem;
            text-align: center;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 1rem;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: #6B7280;
            margin-bottom: 1.5rem;
        }
        
        .reviews-count {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .star-rating {
            display: flex;
            gap: 0.25rem;
        }
        
        .star {
            width: 1.5rem;
            height: 1.5rem;
            fill: #FBBF24;
        }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            padding: 3rem 0;
        }
        
        .review-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .review-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
            gap: 1rem;
        }
        
        .review-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }
        
        .author-avatar {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #DBEAFE;
        }
        
        .author-info {
            flex: 1;
        }
        
        .author-name {
            font-size: 1.125rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.25rem;
        }
        
        .author-location {
            font-size: 0.875rem;
            color: #6B7280;
        }
        
        .review-date {
            text-align: right;
            flex-shrink: 0;
        }
        
        .date-main {
            font-size: 0.75rem;
            font-weight: 600;
            color: #374151;
        }
        
        .date-relative {
            font-size: 0.75rem;
            color: #9CA3AF;
        }
        
        .review-destination {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            font-size: 0.875rem;
            color: #6B7280;
        }
        
        .review-stars {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }
        
        .stars {
            display: flex;
            gap: 0.25rem;
        }
        
        .star-small {
            width: 1.25rem;
            height: 1.25rem;
            fill: #FBBF24;
        }
        
        .rating-text {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
        }
        
        .service-badge {
            display: inline-block;
            background: #DBEAFE;
            color: #1E40AF;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            margin-bottom: 1rem;
        }
        
        .review-text {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 1rem;
            font-style: italic;
        }
        
        .read-more-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #2563EB;
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .read-more-link:hover {
            color: #1D4ED8;
        }
        
        .arrow-icon {
            width: 1rem;
            height: 1rem;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.125rem;
            }
            
            .reviews-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
    </style>
</head>

<body>

@include('includes.header')
@include('pages.popup')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Customer Reviews</h1>
        <p class="hero-subtitle">Real stories from our global community</p>
        
        <div class="reviews-count">
            <div class="star-rating">
                @for($i = 0; $i < 5; $i++)
                    <svg class="star" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                @endfor
            </div>
            <span style="color: #374151; font-weight: 600;">{{ count($allReviews) }} Reviews</span>
        </div>
    </div>
</section>

<!-- Reviews Grid -->
<section style="padding: 3rem 0;">
    <div class="container">
        <div class="reviews-grid">
            @foreach($allReviews as $review)
                <article class="review-card">
                    <!-- Header -->
                    <div class="review-header">
                        <div class="review-author">
                            <img 
                                src="{{ $review['image'] }}" 
                                alt="{{ $review['name'] }}" 
                                class="author-avatar"
                            />
                            <div class="author-info">
                                <h3 class="author-name">{{ $review['name'] }}</h3>
                                <p class="author-location">
                                    <span style="font-size: 1.125rem;">{{ $review['flag'] }}</span> 
                                    {{ $review['nationality'] }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="review-date">
                            <div class="date-main">
                                {{ \Carbon\Carbon::parse($review['date'])->format('M d, Y') }}
                            </div>
                            <div class="date-relative">
                                {{ \Carbon\Carbon::parse($review['date'])->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Destination -->
                    <div class="review-destination">
                        <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $review['country'] }}</span>
                    </div>
                    
                    <!-- Stars -->
                    <div class="review-stars">
                        <div class="stars">
                            @for($i = 0; $i < $review['rating']; $i++)
                                <svg class="star-small" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="rating-text">({{ $review['rating'] }}/5)</span>
                    </div>
                    
                    <!-- Service Badge -->
                    <span class="service-badge">{{ $review['service'] }}</span>
                    
                    <!-- Review Text -->
                    <p class="review-text">"{{ $review['shortText'] }}"</p>
                    
                    <!-- Read More Link -->
                    <a href="{{ route('review.show', $review['slug']) }}" class="read-more-link">
                        <span>Read full story</span>
                        <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>

@include('includes.footer')

</body>
</html>