<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ $review['name'] }} Review - {{ $review['service'] }} in {{ $review['country'] }} | Ulixai</title>
    <meta name="description" content="Read {{ $review['name'] }}'s experience with Ulixai's {{ $review['service'] }} service in {{ $review['country'] }}. Verified customer review with {{ $review['rating'] }}-star rating.">
    
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $review['name'] }} Review - {{ $review['service'] }}">
    <meta property="og:description" content="{{ $review['shortText'] }}">
    <meta property="og:image" content="{{ $review['image'] }}">
    
    <link rel="canonical" href="https://ulixai.com/review/{{ $review['slug'] }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Review",
        "itemReviewed": {
            "@type": "Service",
            "name": "{{ $review['service'] }}",
            "provider": {
                "@type": "Organization",
                "name": "Ulixai",
                "url": "https://ulixai.com"
            }
        },
        "author": {
            "@type": "Person",
            "name": "{{ $review['name'] }}",
            "nationality": "{{ $review['nationality'] }}"
        },
        "reviewRating": {
            "@type": "Rating",
            "ratingValue": "{{ $review['rating'] }}",
            "bestRating": "5",
            "worstRating": "1"
        },
        "datePublished": "{{ $review['date'] }}",
        "reviewBody": "{{ strip_tags($review['fullText']) }}"
    }
    </script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        }
        
        .breadcrumb-nav {
            max-width: 80rem;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }
        
        .breadcrumb-list {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            list-style: none;
        }
        
        .breadcrumb-link {
            color: #2563EB;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .breadcrumb-link:hover {
            color: #1D4ED8;
        }
        
        .breadcrumb-separator {
            color: #9CA3AF;
        }
        
        .breadcrumb-current {
            color: #6B7280;
        }
        
        .main-content {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1rem 4rem;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #2563EB;
            font-weight: 600;
            margin-bottom: 2rem;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.75rem 1.25rem;
            border-radius: 9999px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .back-button:hover {
            background: #EFF6FF;
            transform: translateX(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .back-icon {
            width: 1.25rem;
            height: 1.25rem;
        }
        
        .review-card {
            background: white;
            border-radius: 1.5rem;
            padding: 3rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            position: relative;
            border: 2px solid transparent;
        }
        
        .review-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.5rem;
            padding: 2px;
            background: linear-gradient(135deg, #2563EB, #60A5FA, #2563EB);
            -webkit-mask: 
                linear-gradient(#fff 0 0) content-box, 
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0.5;
        }
        
        .featured-badge-single {
            position: absolute;
            top: 2rem;
            right: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
            color: white;
            font-size: 0.875rem;
            font-weight: 700;
            padding: 0.625rem 1.25rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
            z-index: 10;
        }
        
        .featured-badge-single svg {
            width: 1rem;
            height: 1rem;
        }
        
        .review-header {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid #E5E7EB;
        }
        
        .author-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .author-avatar {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #DBEAFE;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .author-details {
            flex: 1;
        }
        
        .author-name {
            font-size: 2.25rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 0.75rem;
        }
        
        .author-location {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.125rem;
            color: #6B7280;
            margin-bottom: 0.75rem;
        }
        
        .flag {
            font-size: 1.875rem;
        }
        
        .rating-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        
        .stars {
            display: flex;
            gap: 0.25rem;
            color: #FBBF24;
            font-size: 1.5rem;
        }
        
        .rating-text {
            color: #6B7280;
            font-weight: 600;
        }
        
        .review-date {
            font-size: 0.875rem;
            color: #9CA3AF;
        }
        
        .service-badge {
            display: inline-block;
            background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
            color: #1E40AF;
            font-size: 1rem;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            margin-bottom: 2rem;
            border: 2px solid #93C5FD;
        }
        
        .review-content {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #374151;
            margin-bottom: 2rem;
            white-space: pre-line;
        }
        
        .verified-section {
            padding-top: 2rem;
            border-top: 2px solid #E5E7EB;
        }
        
        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #D1FAE5;
            border: 2px solid #6EE7B7;
            border-radius: 9999px;
            padding: 0.75rem 1.5rem;
        }
        
        .verified-icon {
            width: 1.25rem;
            height: 1.25rem;
            color: #059669;
        }
        
        .verified-text {
            color: #065F46;
            font-weight: 700;
            font-size: 0.875rem;
        }
        
        .cta-section {
            margin-top: 3rem;
            background: linear-gradient(135deg, #2563EB 0%, #4F46E5 100%);
            border-radius: 1.5rem;
            padding: 3rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-5%, 5%) scale(1.05); }
        }
        
        .cta-title {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }
        
        .cta-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            color: #BFDBFE;
            position: relative;
            z-index: 2;
        }
        
        .cta-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        
        .cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-size: 1.125rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .cta-btn-primary {
            background: white;
            color: #2563EB;
        }
        
        .cta-btn-primary:hover {
            background: #EFF6FF;
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .cta-btn-secondary {
            background: #DC2626;
            color: white;
        }
        
        .cta-btn-secondary:hover {
            background: #B91C1C;
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(220, 38, 38, 0.4);
        }
        
        .emoji {
            font-size: 1.5rem;
        }
        
        @media (min-width: 640px) {
            .cta-buttons {
                flex-direction: row;
                justify-content: center;
            }
        }
        
        @media (max-width: 768px) {
            .review-card {
                padding: 2rem 1.5rem;
            }
            
            .author-section {
                flex-direction: column;
                text-align: center;
            }
            
            .author-name {
                font-size: 1.875rem;
            }
            
            .cta-title {
                font-size: 1.875rem;
            }
            
            .cta-subtitle {
                font-size: 1.125rem;
            }
        }
    </style>
</head>

<body>

@include('includes.header')

<nav class="breadcrumb-nav" aria-label="Breadcrumb">
    <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="/" class="breadcrumb-link" itemprop="item">
                <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
        </li>
        <li class="breadcrumb-separator">/</li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="{{ route('reviews.index') }}" class="breadcrumb-link" itemprop="item">
                <span itemprop="name">Reviews</span>
            </a>
            <meta itemprop="position" content="2" />
        </li>
        <li class="breadcrumb-separator">/</li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-current">
            <span itemprop="name">{{ $review['name'] }}</span>
            <meta itemprop="position" content="3" />
        </li>
    </ol>
</nav>

<article class="main-content" itemscope itemtype="https://schema.org/Review">
    
    <a href="{{ route('reviews.index') }}" class="back-button">
        <svg class="back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to All Reviews
    </a>
    
    <div class="review-card">
        
        {{-- ✨ BADGE FEATURED SI APPLICABLE --}}
        @if(isset($review['is_featured']) && $review['is_featured'])
            <div class="featured-badge-single">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span>Early Beta User</span>
            </div>
        @endif
        
        <header class="review-header">
            <div class="author-section" itemprop="author" itemscope itemtype="https://schema.org/Person">
                <img 
                    src="{{ $review['image'] }}" 
                    alt="{{ $review['name'] }}"
                    class="author-avatar"
                    itemprop="image"
                />
                
                <div class="author-details">
                    <h1 class="author-name" itemprop="name">
                        {{ $review['name'] }}
                    </h1>
                    
                    <div class="author-location">
                        <span class="flag">{{ $review['flag'] }}</span>
                        <span itemprop="nationality">{{ $review['nationality'] }}</span>
                        <span>•</span>
                        <span>{{ $review['country'] }}</span>
                    </div>
                    
                    <div class="rating-section" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                        <div class="stars">
                            @for($i = 0; $i < $review['rating']; $i++)
                                <span>★</span>
                            @endfor
                        </div>
                        <span class="rating-text">
                            <span itemprop="ratingValue">{{ $review['rating'] }}</span>.<span itemprop="bestRating" content="5">0</span>/5
                        </span>
                        <meta itemprop="worstRating" content="1">
                    </div>
                    
                    <time class="review-date" datetime="{{ $review['date'] }}" itemprop="datePublished">
                        {{ \Carbon\Carbon::parse($review['date'])->format('F j, Y') }}
                    </time>
                </div>
            </div>
        </header>
        
        <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Service">
            <span class="service-badge">
                📋 <span itemprop="name">{{ $review['service'] }}</span>
            </span>
            <meta itemprop="provider" content="Ulixai">
        </div>
        
        <div class="review-content" itemprop="reviewBody">
            {{ $review['fullText'] }}
        </div>
        
        <div class="verified-section">
            <div class="verified-badge">
                <svg class="verified-icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="verified-text">Verified Customer</span>
            </div>
        </div>
        
    </div>
    
    <div class="cta-section">
        <h2 class="cta-title">Ready to Get Started?</h2>
        <p class="cta-subtitle">
            Experience the same quality service that {{ $review['name'] }} enjoyed
        </p>
        
        <div class="cta-buttons">
            <a href="/" class="cta-btn cta-btn-primary">
                <span>Explore Services</span>
                <span class="emoji">🌍</span>
            </a>
            
            <a href="https://sos-expat.com" 
               target="_blank"
               rel="noopener noreferrer"
               class="cta-btn cta-btn-secondary">
                <span>Get Help Now</span>
                <span class="emoji">🆘</span>
            </a>
        </div>
    </div>
    
</article>

@include('includes.footer')

</body>
</html>