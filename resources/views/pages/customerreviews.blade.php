<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, user-scalable=yes">
    
    <title>Customer Reviews - Verified Stories from Ulixai Users | 197 Countries</title>
    <meta name="description" content="Read {{ $totalReviews }} authentic reviews from expats and travelers worldwide. Verified customer experiences with Ulixai services across 197 countries. ⭐⭐⭐⭐⭐ 5.0/5 rating.">
    <meta name="keywords" content="ulixai reviews, customer testimonials, expat services reviews, international assistance reviews, verified reviews, travel assistance reviews">
    
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Customer Reviews - Verified Stories from Ulixai Users">
    <meta property="og:description" content="{{ $totalReviews }} authentic reviews from our global community across 197 countries. ⭐⭐⭐⭐⭐ 5.0/5 rating">
    <meta property="og:url" content="https://ulixai.com/customerreviews">
    <meta property="og:image" content="https://ulixai.com/images/og-reviews.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Ulixai">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ulixai">
    <meta name="twitter:title" content="Customer Reviews - Ulixai.com">
    <meta name="twitter:description" content="{{ $totalReviews }} authentic reviews from travelers worldwide. ⭐⭐⭐⭐⭐ 5.0/5">
    <meta name="twitter:image" content="https://ulixai.com/images/og-reviews.jpg">
    
    <!-- Canonical & Pagination -->
    @if($currentPage == 1)
        <link rel="canonical" href="https://ulixai.com/customerreviews">
    @else
        <link rel="canonical" href="https://ulixai.com/customerreviews?page={{ $currentPage }}">
    @endif
    
    @if($currentPage > 1)
        <link rel="prev" href="https://ulixai.com/customerreviews?page={{ $currentPage - 1 }}">
    @endif
    
    @if($currentPage < $totalPages)
        <link rel="next" href="https://ulixai.com/customerreviews?page={{ $currentPage + 1 }}">
    @endif
    
    <!-- DNS Prefetch & Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- SCHEMA.ORG - ORGANIZATION WITH AGGREGATE RATING -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Ulixai",
        "url": "https://ulixai.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://ulixai.com/images/logo.png",
            "width": 250,
            "height": 60
        },
        "description": "Global assistance platform connecting travelers and expats with local service providers across 197 countries",
        "sameAs": [
            "https://www.facebook.com/ulixai",
            "https://www.twitter.com/ulixai",
            "https://www.linkedin.com/company/ulixai",
            "https://www.instagram.com/ulixai"
        ],
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5.0",
            "reviewCount": "{{ $totalReviews }}",
            "bestRating": "5",
            "worstRating": "1",
            "ratingCount": "{{ $totalReviews }}"
        },
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "Global"
        }
    }
    </script>
    
    <!-- SCHEMA.ORG - BREADCRUMBS -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://ulixai.com"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Customer Reviews",
                "item": "https://ulixai.com/customerreviews"
            }
        ]
    }
    </script>
    
    <!-- SCHEMA.ORG - ITEMLIST OF REVIEWS -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($reviews as $index => $review)
            {
                "@type": "Review",
                "position": {{ $index + 1 }},
                "itemReviewed": {
                    "@type": "Service",
                    "name": "{{ $review['service'] }}",
                    "provider": {
                        "@type": "Organization",
                        "name": "Ulixai"
                    },
                    "areaServed": {
                        "@type": "Country",
                        "name": "{{ $review['country'] }}"
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
                "reviewBody": "{{ addslashes($review['shortText']) }}",
                "datePublished": "{{ $review['date'] }}",
                "publisher": {
                    "@type": "Organization",
                    "name": "Ulixai"
                }
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
    
    <!-- SCHEMA.ORG - FAQ PAGE -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "How do customers leave reviews on Ulixai?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "After completing a service with Ulixai, customers receive an invitation to share their experience. This review process ensures that only verified customers who have actually used our services can leave feedback, helping new clients make informed decisions."
                }
            },
            {
                "@type": "Question",
                "name": "Are these customer reviews verified?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes, absolutely! All reviews on this page are from verified Ulixai customers who have completed a service. Reviews with the Early Beta User badge come from platform testers who helped us develop and verify the platform during our local beta phase - these are not real customers but platform testers."
                }
            },
            {
                "@type": "Question",
                "name": "What does the Early Beta User badge mean?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "The Early Beta User badge indicates reviews from platform testers during our local beta phase. These users are not real customers but testers who verified the platform functionality and provided crucial feedback that helped us improve Ulixai before the official launch."
                }
            },
            {
                "@type": "Question",
                "name": "What languages does Ulixai support?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ulixai is a truly multilingual platform supporting all languages worldwide. When a customer posts a request in their native language, service providers who speak the same language can respond and assist them. This ensures seamless communication between customers and providers regardless of the language spoken."
                }
            },
            {
                "@type": "Question",
                "name": "Are all Ulixai reviews displayed on this page?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Not all reviews are displayed on this main page. Each service provider has their own dedicated review page with specific testimonials."
                }
            },
            {
                "@type": "Question",
                "name": "Why should I read customer reviews before using Ulixai?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Reading reviews helps you understand real experiences from other travelers and make informed decisions based on authentic feedback from people who have used Ulixai services worldwide."
                }
            },
            {
                "@type": "Question",
                "name": "How can I filter reviews by country or language?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Use our advanced search bar and filters at the top to find reviews by specific countries, languages, or keywords relevant to your needs."
                }
            },
            {
                "@type": "Question",
                "name": "How many countries does Ulixai cover?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Ulixai provides services across 197 countries worldwide, helping expats and travelers with various assistance needs globally."
                }
            },
            {
                "@type": "Question",
                "name": "Can I read the full customer stories?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes! Simply click on any review card to read the complete customer story with detailed experiences and outcomes."
                }
            }
        ]
    }
    </script>
    
    <!-- SCHEMA.ORG - WEBPAGE -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "Customer Reviews - Ulixai",
        "description": "{{ $totalReviews }} verified customer reviews from travelers and expats worldwide",
        "url": "https://ulixai.com/customerreviews",
        "publisher": {
            "@type": "Organization",
            "name": "Ulixai"
        },
        "inLanguage": "en",
        "isPartOf": {
            "@type": "WebSite",
            "name": "Ulixai",
            "url": "https://ulixai.com"
        }
    }
    </script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --primary-blue: #2563EB;
            --blue-light: #DBEAFE;
            --blue-glow: rgba(37, 99, 235, 0.15);
            --purple: #9333EA;
            --pink: #EC4899;
            --orange: #F59E0B;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            color: #111827;
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #BFDBFE 100%);
            padding: 2.5rem 1rem 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-5%, 5%) scale(1.08); }
        }
        
        .hero-title {
            font-size: clamp(1.75rem, 5vw, 3rem);
            font-weight: 900;
            color: #1F2937;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 2;
            animation: slideDown 0.6s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-subtitle {
            font-size: clamp(0.9rem, 3vw, 1.25rem);
            color: #6B7280;
            margin-bottom: 1.25rem;
            position: relative;
            z-index: 2;
            animation: slideDown 0.6s ease-out 0.1s both;
        }
        
        .reviews-count {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            background: white;
            padding: 0.625rem 1.25rem;
            border-radius: 9999px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
            animation: scaleIn 0.5s ease-out 0.2s both;
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .star-rating {
            display: flex;
            gap: 0.2rem;
        }
        
        .star {
            width: 1.25rem;
            height: 1.25rem;
            fill: #FBBF24;
            animation: starPop 0.4s ease-out calc(var(--i) * 0.1s) both;
        }
        
        @keyframes starPop {
            0%, 50% {
                transform: scale(0) rotate(0deg);
            }
            100% {
                transform: scale(1) rotate(360deg);
            }
        }
        
        .trust-badges {
            display: flex;
            justify-content: center;
            gap: 0.875rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }
        
        .trust-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 0.625rem 1rem;
            border-radius: 9999px;
            color: #374151;
            font-size: 0.8125rem;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            animation: slideUp 0.5s ease-out calc(var(--i) * 0.1s) forwards;
            transition: transform 0.3s, box-shadow 0.3s;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1 !important;
                transform: translateY(0);
            }
        }
        
        .trust-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px -4px rgba(37, 99, 235, 0.2);
        }
        
        .trust-icon {
            width: 1.125rem;
            height: 1.125rem;
            color: #10B981;
        }
        
        .global-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--purple), var(--pink));
            color: white;
            padding: 0.625rem 1rem;
            border-radius: 9999px;
            font-size: 0.8125rem;
            font-weight: 700;
            box-shadow: 0 8px 16px -4px rgba(147, 51, 234, 0.3);
            animation: slideUp 0.5s ease-out 0.5s forwards;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        /* BARRE DE FILTRES - NON STICKY, COMPACTE ET VISIBLE */
        .search-section {
            background: transparent;
            padding: 2rem 1rem;
            position: relative;
            z-index: 10;
        }
        
        .search-frame {
            max-width: 1100px;
            margin: 0 auto;
            background: white;
            border-radius: 1.25rem;
            padding: 1.25rem;
            box-shadow: 
                0 20px 50px -12px rgba(37, 99, 235, 0.2),
                0 8px 20px -8px rgba(37, 99, 235, 0.12),
                0 0 0 2px rgba(37, 99, 235, 0.1);
            border: 2px solid transparent;
            background-image: linear-gradient(white, white), 
                             linear-gradient(135deg, rgba(37, 99, 235, 0.4), rgba(147, 51, 234, 0.4));
            background-origin: border-box;
            background-clip: padding-box, border-box;
            animation: frameAppear 0.6s ease-out;
            position: relative;
        }
        
        .search-frame::before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 1.25rem;
            padding: 2px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.25), rgba(147, 51, 234, 0.25));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            animation: borderGlow 3s ease-in-out infinite;
        }
        
        @keyframes borderGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        
        @keyframes frameAppear {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .search-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }
        
        .search-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 3.5rem 1rem 3.5rem;
            border: 2px solid #E5E7EB;
            border-radius: 1rem;
            font-size: 0.9375rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            background: #F3F4F6;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
            font-weight: 500;
        }
        
        .search-input::placeholder {
            color: #9CA3AF;
            font-weight: 400;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-blue);
            background: white;
            box-shadow: 0 8px 24px -6px rgba(37, 99, 235, 0.25), 0 0 0 4px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }
        
        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.5rem;
            height: 1.5rem;
            color: var(--primary-blue);
            pointer-events: none;
            transition: all 0.3s;
        }
        
        .search-input:focus ~ .search-icon {
            color: var(--purple);
            transform: translateY(-50%) scale(1.15) rotate(15deg);
        }
        
        .clear-search {
            position: absolute;
            right: 1.125rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.875rem;
            height: 1.875rem;
            display: none;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #EF4444, #DC2626);
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            padding: 0;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
        
        .clear-search:hover {
            background: linear-gradient(135deg, #DC2626, #B91C1C);
            transform: translateY(-50%) scale(1.15) rotate(90deg);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }
        
        .clear-search svg {
            width: 0.875rem;
            height: 0.875rem;
            color: white;
        }
        
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: center;
        }
        
        .filter-wrapper {
            position: relative;
        }
        
        .filter-select {
            width: 100%;
            padding: 0.875rem 2.75rem 0.875rem 1rem;
            border: 2px solid #E5E7EB;
            border-radius: 1rem;
            font-size: 0.875rem;
            background: #F3F4F6;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            font-weight: 600;
            appearance: none;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
            color: #374151;
        }
        
        .filter-select:hover {
            border-color: var(--primary-blue);
            background: white;
            box-shadow: 0 4px 12px -2px rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
        }
        
        .filter-select:focus {
            outline: none;
            border-color: var(--primary-blue);
            background: white;
            box-shadow: 0 6px 16px -4px rgba(37, 99, 235, 0.25), 0 0 0 4px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }
        
        .filter-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            color: var(--primary-blue);
            pointer-events: none;
            transition: transform 0.3s;
        }
        
        .filter-select:focus ~ .filter-icon {
            transform: translateY(-50%) rotate(180deg);
        }
        
        .filter-clear {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 1rem 1.75rem;
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: white;
            border: none;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            box-shadow: 0 4px 12px -2px rgba(239, 68, 68, 0.35);
            white-space: nowrap;
        }
        
        .filter-clear:hover {
            background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 20px -4px rgba(239, 68, 68, 0.45);
        }
        
        .filter-clear:active {
            transform: translateY(-1px) scale(1.02);
        }
        
        .filter-clear svg {
            width: 1rem;
            height: 1rem;
        }
        
        .active-filters {
            display: none;
            flex-wrap: wrap;
            gap: 0.625rem;
            margin-top: 1.25rem;
            padding-top: 1.25rem;
            border-top: 2px solid rgba(229, 231, 235, 0.6);
        }
        
        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5625rem 1.125rem;
            background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
            color: #1E40AF;
            border-radius: 9999px;
            font-size: 0.8125rem;
            font-weight: 600;
            animation: tagPop 0.3s ease-out;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.15);
        }
        
        @keyframes tagPop {
            from {
                opacity: 0;
                transform: scale(0.8) translateY(-10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        .filter-tag button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            background: rgba(37, 99, 235, 0.2);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s;
            padding: 0;
        }
        
        .filter-tag button:hover {
            background: rgba(37, 99, 235, 0.3);
            transform: rotate(90deg) scale(1.1);
        }
        
        .filter-tag button svg {
            width: 0.625rem;
            height: 0.625rem;
            color: #1E40AF;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 1.75rem;
            position: relative;
            z-index: 2;
        }
        
        .section-title {
            font-size: clamp(1.375rem, 4vw, 2rem);
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }
        
        .section-subtitle {
            font-size: clamp(0.8125rem, 2vw, 1rem);
            color: #6B7280;
        }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(300px, 100%), 1fr));
            gap: 1.25rem;
            padding: 1.75rem 0 2.5rem;
        }
        
        /* REVIEW CARD - SCHEMA.ORG OPTIMIZED */
        .review-card {
            background: white;
            border-radius: 1.125rem;
            padding: 0;
            position: relative;
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background-clip: padding-box;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(37, 99, 235, 0.08);
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            will-change: transform;
            overflow: hidden;
        }
        
        .review-card > a,
        .review-card-link {
            display: block;
            padding: 1.25rem;
            text-decoration: none;
            color: inherit;
            width: 100%;
        }
        
        .review-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1.125rem;
            padding: 2px;
            background: linear-gradient(135deg, var(--primary-blue), #60A5FA, var(--primary-blue));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        @media (hover: hover) {
            .review-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.2), 0 0 0 1px rgba(37, 99, 235, 0.15), 0 0 30px -5px var(--blue-glow);
            }
            
            .review-card:hover::before {
                opacity: 1;
            }
            
            .review-card:hover .arrow-icon {
                transform: translateX(6px);
            }
        }
        
        .review-card:active {
            transform: scale(0.98);
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.875rem;
            gap: 0.875rem;
        }
        
        .review-author {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            flex: 1;
            min-width: 0;
        }
        
        .author-avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid var(--blue-light);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }
        
        .author-info {
            flex: 1;
            min-width: 0;
        }
        
        .author-name {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.2rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .author-location {
            font-size: 0.8125rem;
            color: #6B7280;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .review-date {
            text-align: right;
            flex-shrink: 0;
        }
        
        .date-main {
            font-size: 0.6875rem;
            font-weight: 600;
            color: #374151;
            white-space: nowrap;
        }
        
        .date-relative {
            font-size: 0.6875rem;
            color: #9CA3AF;
            white-space: nowrap;
        }
        
        .review-destination {
            display: flex;
            align-items: center;
            gap: 0.4375rem;
            margin-bottom: 0.625rem;
            font-size: 0.8125rem;
            color: #6B7280;
        }
        
        .review-stars {
            display: flex;
            align-items: center;
            gap: 0.4375rem;
            margin-bottom: 0.625rem;
        }
        
        .stars {
            display: flex;
            gap: 0.2rem;
        }
        
        .star-small {
            width: 1.125rem;
            height: 1.125rem;
            fill: #FBBF24;
        }
        
        .rating-text {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
        }
        
        .service-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--blue-light), #BFDBFE);
            color: #1E40AF;
            font-size: 0.6875rem;
            font-weight: 600;
            padding: 0.3125rem 0.6875rem;
            border-radius: 9999px;
            margin-bottom: 0.875rem;
        }
        
        .review-text {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 0.875rem;
            font-style: italic;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 0.9375rem;
        }
        
        .review-text.short {
            -webkit-line-clamp: 2;
        }
        
        .review-text.long {
            -webkit-line-clamp: 6;
        }
        
        .read-more-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.4375rem;
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 0.8125rem;
        }
        
        .arrow-icon {
            width: 0.9375rem;
            height: 0.9375rem;
            transition: transform 0.3s ease;
        }
        
        .featured-badge {
            display: inline-block;
            background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
            color: white;
            font-size: 0.625rem;
            font-weight: 700;
            padding: 0.3125rem 0.75rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
            margin-bottom: 0.625rem;
        }
        
        /* FAQ SECTION */
        .faq-section {
            background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
            padding: 3rem 1rem 1.5rem;
        }
        
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .faq-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .faq-title {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 900;
            color: #1F2937;
            margin-bottom: 0.625rem;
        }
        
        .faq-subtitle {
            font-size: clamp(0.9375rem, 2vw, 1.125rem);
            color: #6B7280;
        }
        
        .faq-item {
            background: white;
            border-radius: 1rem;
            margin-bottom: 0.875rem;
            overflow: hidden;
            border: 2px solid #E5E7EB;
            transition: all 0.3s;
        }
        
        .faq-item:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
        }
        
        .faq-question {
            width: 100%;
            padding: 1.25rem;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 0.875rem;
            font-size: 1rem;
            font-weight: 700;
            color: #1F2937;
            font-family: inherit;
            transition: all 0.3s;
        }
        
        .faq-question:hover {
            color: var(--primary-blue);
        }
        
        .faq-icon {
            width: 1.375rem;
            height: 1.375rem;
            flex-shrink: 0;
            transition: transform 0.3s;
            color: var(--primary-blue);
        }
        
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        .faq-answer-content {
            padding: 0 1.25rem 1.25rem;
            color: #4B5563;
            line-height: 1.7;
            font-size: 0.9375rem;
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
        }
        
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 2.5rem 0;
            flex-wrap: wrap;
        }
        
        .pagination-btn {
            padding: 0.6875rem 1.125rem;
            border: 2px solid #E5E7EB;
            border-radius: 0.75rem;
            background: white;
            color: #374151;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
            font-size: 0.9375rem;
        }
        
        @media (hover: hover) {
            .pagination-btn:hover:not(.active):not(:disabled) {
                border-color: var(--primary-blue);
                color: var(--primary-blue);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
            }
        }
        
        .pagination-btn:active:not(:disabled) {
            transform: scale(0.95);
        }
        
        .pagination-btn.active {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }
        
        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .mobile-load-more {
            display: none;
            text-align: center;
            padding: 1.75rem 0;
        }
        
        .load-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
            background: white;
            padding: 0.875rem 1.75rem;
            border-radius: 9999px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            font-weight: 600;
            color: #374151;
            font-size: 0.9375rem;
        }
        
        .spinner {
            width: 1.125rem;
            height: 1.125rem;
            border: 2px solid #E5E7EB;
            border-top-color: var(--primary-blue);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .no-results {
            text-align: center;
            padding: 2.5rem 1rem;
            color: #6B7280;
        }
        
        .no-results-icon {
            width: 3.5rem;
            height: 3.5rem;
            margin: 0 auto 0.875rem;
            color: #9CA3AF;
        }
        
        /* BOUTON PARTAGE */
        #floatingShareBtn {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            background: linear-gradient(135deg, #2563EB 0%, #9333EA 100%);
            color: white;
            font-weight: 800;
            padding: 1rem 1.5rem;
            border-radius: 9999px;
            box-shadow: 
                0 20px 40px -10px rgba(37, 99, 235, 0.5),
                0 0 30px rgba(147, 51, 234, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid white;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            animation: float 3s ease-in-out infinite, pulse-ring 2s ease-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @keyframes pulse-ring {
            0% {
                box-shadow: 
                    0 20px 40px -10px rgba(37, 99, 235, 0.5),
                    0 0 30px rgba(147, 51, 234, 0.3),
                    0 0 0 0 rgba(37, 99, 235, 0.7);
            }
            50% {
                box-shadow: 
                    0 20px 40px -10px rgba(37, 99, 235, 0.5),
                    0 0 30px rgba(147, 51, 234, 0.3),
                    0 0 0 20px rgba(37, 99, 235, 0);
            }
            100% {
                box-shadow: 
                    0 20px 40px -10px rgba(37, 99, 235, 0.5),
                    0 0 30px rgba(147, 51, 234, 0.3),
                    0 0 0 0 rgba(37, 99, 235, 0);
            }
        }
        
        #floatingShareBtn:hover {
            transform: translateY(-5px) scale(1.1);
            background: linear-gradient(135deg, #1D4ED8 0%, #7C3AED 100%);
            box-shadow: 
                0 30px 60px -15px rgba(37, 99, 235, 0.6),
                0 0 50px rgba(147, 51, 234, 0.5);
        }
        
        #floatingShareBtn:active {
            transform: translateY(-2px) scale(1.05);
        }
        
        .share-icon-wrapper {
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: rotate 4s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        #floatingShareBtn:hover .share-icon-wrapper {
            animation: rotate 1s linear infinite;
        }
        
        /* OPTIMISATIONS MOBILE */
        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 1rem 2.5rem;
            }
            
            .trust-badges {
                gap: 0.625rem;
                margin-top: 1.25rem;
            }
            
            .trust-badge {
                font-size: 0.75rem;
                padding: 0.5625rem 0.875rem;
            }
            
            .search-section {
                padding: 1.5rem 0.875rem;
            }
            
            .search-frame {
                padding: 1rem;
                border-radius: 1rem;
            }
            
            .search-input {
                padding: 0.875rem 3rem;
                font-size: 0.875rem;
                border-radius: 1rem;
            }
            
            .search-icon {
                left: 1rem;
                width: 1.25rem;
                height: 1.25rem;
            }
            
            .clear-search {
                right: 1rem;
                width: 1.625rem;
                height: 1.625rem;
            }
            
            .filters-grid {
                grid-template-columns: 1fr;
                gap: 0.875rem;
            }
            
            .filter-select {
                padding: 0.8125rem 2.5rem 0.8125rem 0.9375rem;
                font-size: 0.8125rem;
            }
            
            .filter-clear {
                padding: 0.9375rem 1.5rem;
                font-size: 0.8125rem;
            }
            
            .reviews-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1.5rem 0 2rem;
            }
            
            .review-card {
                border-radius: 1rem;
            }
            
            .review-card > a,
            .review-card-link {
                padding: 1rem;
            }
            
            .author-avatar {
                width: 2.75rem;
                height: 2.75rem;
            }
            
            .faq-section {
                padding: 2.5rem 1rem 1.25rem;
            }
            
            .faq-question {
                font-size: 0.9375rem;
                padding: 1.125rem;
            }
            
            .faq-answer-content {
                padding: 0 1.125rem 1.125rem;
                font-size: 0.875rem;
            }
            
            .pagination-container {
                display: none;
            }
            
            .mobile-load-more {
                display: block;
            }
            
            #floatingShareBtn {
                bottom: 1.25rem;
                right: 1.25rem;
                padding: 0.875rem 1.25rem;
                font-size: 0.875rem;
            }
            
            .share-icon-wrapper {
                width: 1.75rem;
                height: 1.75rem;
            }
        }
        
        @media (max-width: 480px) {
            .hero-section {
                padding: 1.75rem 0.875rem 2.25rem;
            }
            
            .hero-title {
                font-size: 1.625rem;
            }
            
            .reviews-count {
                padding: 0.5625rem 1.125rem;
                gap: 0.5rem;
            }
            
            .star {
                width: 1.125rem;
                height: 1.125rem;
            }
            
            .search-section {
                padding: 1.25rem 0.75rem;
            }
            
            .search-frame {
                padding: 0.875rem;
            }
            
            .search-input {
                padding: 0.8125rem 2.75rem;
                font-size: 0.8125rem;
            }
            
            .review-header {
                gap: 0.75rem;
            }
            
            .author-avatar {
                width: 2.5rem;
                height: 2.5rem;
                border-width: 2px;
            }
            
            .author-name {
                font-size: 0.9375rem;
            }
            
            .author-location {
                font-size: 0.75rem;
            }
            
            #floatingShareBtn {
                bottom: 1rem;
                right: 1rem;
                padding: 0.75rem 1rem;
                font-size: 0.8125rem;
            }
        }
        
        /* PERFORMANCE OPTIMIZATIONS */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* GPU ACCELERATION */
        .review-card,
        .search-frame,
        .trust-badge,
        .filter-select,
        #floatingShareBtn {
            transform: translateZ(0);
            backface-visibility: hidden;
            perspective: 1000px;
        }
    </style>
</head>

<body>

@include('includes.header')
@include('pages.popup')

<button id="floatingShareBtn" onclick="openSharePanel()" 
    aria-label="Share customer reviews">
    <div class="share-icon-wrapper">
        <svg style="width: 1.125rem; height: 1.125rem;" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
        </svg>
    </div>
    <span style="font-size: 0.9375rem; letter-spacing: 0.025em;">SHARE 🚀</span>
</button>

<div id="shareOverlay" onclick="closeSharePanel()" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" aria-hidden="true"></div>

<div id="sharePanel" role="dialog" aria-labelledby="sharePanelTitle" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 overflow-y-auto" style="overscroll-behavior: contain;">
    
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-5 sm:p-6 sticky top-0 z-10">
        <div class="flex items-center justify-between mb-3 sm:mb-4">
            <h2 id="sharePanelTitle" class="text-white font-bold text-lg sm:text-xl flex items-center gap-2">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                </svg>
                Share Reviews
            </h2>
            <button onclick="closeSharePanel()" aria-label="Close share panel" class="text-white/80 hover:text-white transition-colors p-1" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-white text-sm">
            <p class="font-semibold mb-2">🌟 Share Customer Stories!</p>
            <p class="text-xs opacity-90">Help others discover Ulixai services</p>
        </div>
    </div>

    <div class="p-5 sm:p-6">
        <h3 class="font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2 text-base sm:text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            Share Now
        </h3>

        <nav aria-label="Social media sharing options">
            <div class="grid grid-cols-2 gap-2.5 sm:gap-3">
                
                <a id="shareWhatsAppSlide" href="#" target="_blank" rel="noopener noreferrer" aria-label="Share on WhatsApp" class="bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 active:from-green-600 active:to-green-700 rounded-xl p-3.5 sm:p-4 border-2 border-green-200 hover:border-green-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fab fa-whatsapp text-3xl sm:text-4xl text-green-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-green-700 group-hover:text-white uppercase tracking-wide transition-colors">WhatsApp</span>
                </a>

                <a id="shareMessengerSlide" href="#" target="_blank" rel="noopener noreferrer" aria-label="Share on Messenger" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-400 hover:to-blue-500 active:from-blue-500 active:to-blue-600 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200 hover:border-blue-400 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fab fa-facebook-messenger text-3xl sm:text-4xl text-blue-500 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-blue-600 group-hover:text-white uppercase tracking-wide transition-colors">Messenger</span>
                </a>

                <a id="shareFacebookSlide" href="#" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 active:from-blue-600 active:to-blue-700 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200 hover:border-blue-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fab fa-facebook text-3xl sm:text-4xl text-blue-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">Facebook</span>
                </a>

                <a id="shareTwitterSlide" href="#" target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter" class="bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-800 hover:to-black active:from-black active:to-gray-900 rounded-xl p-3.5 sm:p-4 border-2 border-gray-200 hover:border-gray-800 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fab fa-x-twitter text-3xl sm:text-4xl text-gray-800 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-gray-700 group-hover:text-white uppercase tracking-wide transition-colors">Twitter</span>
                </a>

                <a id="shareLinkedInSlide" href="#" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 active:from-blue-700 active:to-blue-800 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200 hover:border-blue-600 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fab fa-linkedin text-3xl sm:text-4xl text-blue-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">LinkedIn</span>
                </a>

                <a id="shareEmailSlide" href="#" aria-label="Share via Email" class="bg-gradient-to-br from-red-50 to-red-100 hover:from-red-500 hover:to-red-600 active:from-red-600 active:to-red-700 rounded-xl p-3.5 sm:p-4 border-2 border-red-200 hover:border-red-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fas fa-envelope text-3xl sm:text-4xl text-red-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-red-700 group-hover:text-white uppercase tracking-wide transition-colors">Email</span>
                </a>

                <button id="copyBtnSlide" aria-label="Copy link to clipboard" class="bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 active:from-purple-600 active:to-purple-700 rounded-xl p-3.5 sm:p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                    <i class="fas fa-link text-3xl sm:text-4xl text-purple-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-purple-700 group-hover:text-white uppercase tracking-wide transition-colors">Copy</span>
                </button>

            </div>
        </nav>

        <div class="mt-5 sm:mt-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200">
            <div class="flex items-center gap-2.5 sm:gap-3 text-blue-700">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                <div class="flex-1">
                    <p class="font-bold text-sm">Help others discover us!</p>
                    <p class="text-xs text-blue-600 mt-1">Every share helps travelers worldwide</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="shareSuccessPopup" role="dialog" aria-labelledby="successPopupTitle" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-5 sm:p-6 transform transition-all scale-95 opacity-0" id="popupContent">
        <div class="text-center mb-3 sm:mb-4">
            <div class="inline-block bg-gradient-to-br from-blue-500 to-purple-600 rounded-full p-3 sm:p-4 mb-2 sm:mb-3 animate-bounce">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <h3 id="successPopupTitle" class="text-xl sm:text-2xl font-bold text-gray-900 mb-1.5 sm:mb-2">Thank You! 🎉</h3>
            <p class="text-gray-600 text-sm">Your help means the world!</p>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-3.5 sm:p-4 mb-3 sm:mb-4 border-2 border-blue-200">
            <p class="text-sm text-gray-700 text-center">
                💡 Every share helps travelers find the help they need!
            </p>
        </div>
        <div class="space-y-2">
            <button onclick="shareAgain()" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 active:from-blue-700 active:to-purple-800 text-white font-bold py-2.5 sm:py-3 px-5 sm:px-6 rounded-xl transition-all transform hover:scale-105 active:scale-95 shadow-lg text-sm sm:text-base" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                Share Again 🚀
            </button>
            <button onclick="closeSharePopup()" class="w-full bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 font-medium py-2 sm:py-2 px-5 sm:px-6 rounded-xl transition-all text-sm sm:text-base" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;">
                Close
            </button>
        </div>
    </div>
</div>

<input type="text" id="reviewsShareLink" value="{{ url()->current() }}" hidden aria-hidden="true">

<main>
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Customer Reviews</h1>
            <p class="hero-subtitle">Real experiences from our global community</p>
            
            <div class="reviews-count">
                <div class="star-rating" role="img" aria-label="5 out of 5 stars">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="star" viewBox="0 0 20 20" aria-hidden="true" style="--i: {{ $i }}">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                    @endfor
                </div>
                <span style="color: #374151; font-weight: 600;">{{ $totalReviews }} Reviews</span>
            </div>
            
            <div class="trust-badges">
                <div class="trust-badge" style="--i: 0">
                    <svg class="trust-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>197 Countries</span>
                </div>
                <div class="global-badge">
                    <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                    <span>Multilingual Platform</span>
                </div>
            </div>
        </div>
    </section>

    <!-- BARRE DE FILTRES -->
    <section class="search-section">
        <div class="container">
            <div class="search-frame">
                <div class="search-wrapper">
                    <div class="search-input-container">
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="Search by name, country, or keyword..."
                            aria-label="Search reviews"
                            class="search-input"
                        />
                        <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <button class="clear-search" id="clearSearch" aria-label="Clear search">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="filters-grid">
                    <div class="filter-wrapper">
                        <select id="countryFilter" aria-label="Filter by country" class="filter-select">
                            <option value="">🌍 All Countries</option>
                            <option value="france">🇫🇷 France</option>
                            <option value="usa">🇺🇸 United States</option>
                            <option value="uk">🇬🇧 United Kingdom</option>
                            <option value="germany">🇩🇪 Germany</option>
                            <option value="spain">🇪🇸 Spain</option>
                            <option value="italy">🇮🇹 Italy</option>
                            <option value="japan">🇯🇵 Japan</option>
                            <option value="china">🇨🇳 China</option>
                            <option value="brazil">🇧🇷 Brazil</option>
                            <option value="canada">🇨🇦 Canada</option>
                            <option value="australia">🇦🇺 Australia</option>
                            <option value="india">🇮🇳 India</option>
                            <option value="mexico">🇲🇽 Mexico</option>
                            <option value="netherlands">🇳🇱 Netherlands</option>
                            <option value="sweden">🇸🇪 Sweden</option>
                        </select>
                        <svg class="filter-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    
                    <div class="filter-wrapper">
                        <select id="languageFilter" aria-label="Filter by language" class="filter-select">
                            <option value="">💬 All Languages</option>
                            <option value="english">English</option>
                            <option value="french">Français</option>
                            <option value="spanish">Español</option>
                            <option value="german">Deutsch</option>
                            <option value="italian">Italiano</option>
                            <option value="portuguese">Português</option>
                            <option value="chinese">中文</option>
                            <option value="japanese">日本語</option>
                            <option value="arabic">العربية</option>
                            <option value="russian">Русский</option>
                        </select>
                        <svg class="filter-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                    
                    <button id="clearFilters" class="filter-clear">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Clear Filters
                    </button>
                </div>
                
                <div class="active-filters" id="activeFilters"></div>
            </div>
        </div>
    </section>

    <section style="padding: 1.75rem 0 2.5rem;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">What Our Customers Say</h2>
                <p class="section-subtitle">Real experiences from travelers worldwide</p>
            </div>
            
            <!-- REVIEWS GRID WITH PERFECT SCHEMA.ORG MARKUP -->
            <div class="reviews-grid" id="reviewsGrid">
                @foreach($reviews as $review)
                    <article 
                       class="review-card" 
                       itemscope 
                       itemtype="https://schema.org/Review"
                       data-name="{{ strtolower($review['name']) }}"
                       data-country="{{ strtolower($review['country']) }}"
                       data-nationality="{{ strtolower($review['nationality']) }}"
                       data-service="{{ strtolower($review['service']) }}"
                       data-text="{{ strtolower($review['shortText']) }}"
                       data-language="{{ strtolower($review['language'] ?? 'english') }}">
                        
                        <!-- SCHEMA: ItemReviewed -->
                        <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Service" style="display: none;">
                            <span itemprop="name">{{ $review['service'] }}</span>
                            <div itemprop="provider" itemscope itemtype="https://schema.org/Organization">
                                <span itemprop="name">Ulixai</span>
                            </div>
                            <div itemprop="areaServed" itemscope itemtype="https://schema.org/Country">
                                <span itemprop="name">{{ $review['country'] }}</span>
                            </div>
                        </div>
                        
                        <!-- SCHEMA: Author -->
                        <div itemprop="author" itemscope itemtype="https://schema.org/Person" style="display: none;">
                            <span itemprop="name">{{ $review['name'] }}</span>
                            <span itemprop="nationality">{{ $review['nationality'] }}</span>
                        </div>
                        
                        <!-- SCHEMA: ReviewRating -->
                        <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating" style="display: none;">
                            <meta itemprop="ratingValue" content="{{ $review['rating'] }}">
                            <meta itemprop="bestRating" content="5">
                            <meta itemprop="worstRating" content="1">
                        </div>
                        
                        <!-- SCHEMA: ReviewBody & DatePublished -->
                        <meta itemprop="reviewBody" content="{{ $review['shortText'] }}">
                        <meta itemprop="datePublished" content="{{ $review['date'] }}">
                        
                        <!-- SCHEMA: Publisher -->
                        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" style="display: none;">
                            <span itemprop="name">Ulixai</span>
                        </div>
                        
                        <a href="{{ route('review.show', $review['slug']) }}" 
                           aria-label="Read full review from {{ $review['name'] }}"
                           class="review-card-link">
                            
                            <div class="review-header">
                                <div class="review-author">
                                    <img 
                                        src="{{ $review['image'] }}" 
                                        alt="Profile picture of {{ $review['name'] }}" 
                                        class="author-avatar"
                                        loading="lazy"
                                        width="48"
                                        height="48"
                                    />
                                    <div class="author-info">
                                        <h3 class="author-name">{{ $review['name'] }}</h3>
                                        <p class="author-location">
                                            <span style="font-size: 1rem;" aria-hidden="true">{{ $review['flag'] }}</span> 
                                            {{ $review['nationality'] }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="review-date">
                                    <time datetime="{{ $review['date'] }}" class="date-main">
                                        {{ \Carbon\Carbon::parse($review['date'])->format('M d, Y') }}
                                    </time>
                                    <div class="date-relative">
                                        {{ \Carbon\Carbon::parse($review['date'])->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="review-destination">
                                <svg style="width: 0.9375rem; height: 0.9375rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $review['country'] }}</span>
                            </div>
                            
                            <div class="review-stars">
                                <div class="stars" role="img" aria-label="{{ $review['rating'] }} out of 5 stars">
                                    @for($i = 0; $i < $review['rating']; $i++)
                                        <svg class="star-small" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="rating-text">({{ $review['rating'] }}/5)</span>
                            </div>
                            
                            <span class="service-badge">{{ $review['service'] }}</span>
                            
                            @if(isset($review['is_featured']) && $review['is_featured'])
                                <span class="featured-badge">Early Beta User</span>
                            @endif
                            
                            <p class="review-text {{ strlen($review['shortText']) < 100 ? 'short' : (strlen($review['shortText']) > 200 ? 'long' : '') }}">"{{ $review['shortText'] }}"</p>
                            
                            <span class="read-more-indicator">
                                <span>Read full story</span>
                                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </a>
                    </article>
                @endforeach
            </div>
            
            <div id="noResults" class="no-results" style="display: none;">
                <svg class="no-results-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 style="font-size: 1.375rem; font-weight: 700; margin-bottom: 0.5rem;">No reviews found</h3>
                <p style="font-size: 0.9375rem;">Try adjusting your search or filters</p>
            </div>
            
            @if($totalPages > 1)
            <nav class="pagination-container" aria-label="Pagination navigation">
                @if($currentPage > 1)
                    <a href="?page={{ $currentPage - 1 }}" class="pagination-btn" aria-label="Go to previous page">
                        <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                @else
                    <button class="pagination-btn" disabled aria-label="Previous page unavailable">
                        <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                @endif
                
                @for($i = 1; $i <= $totalPages; $i++)
                    @if($i == $currentPage)
                        <span class="pagination-btn active" aria-current="page" aria-label="Current page, page {{ $i }}">{{ $i }}</span>
                    @else
                        <a href="?page={{ $i }}" class="pagination-btn" aria-label="Go to page {{ $i }}">{{ $i }}</a>
                    @endif
                @endfor
                
                @if($currentPage < $totalPages)
                    <a href="?page={{ $currentPage + 1 }}" class="pagination-btn" aria-label="Go to next page">
                        <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <button class="pagination-btn" disabled aria-label="Next page unavailable">
                        <svg style="width: 1.125rem; height: 1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                @endif
            </nav>
            @endif
            
            @if($currentPage < $totalPages)
            <div class="mobile-load-more" id="mobileLoadMore" role="status" aria-live="polite">
                <div class="load-indicator">
                    <div class="spinner" aria-hidden="true"></div>
                    <span>Loading more reviews...</span>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
        <div class="container">
            <div class="faq-container">
                <div class="faq-header">
                    <h2 class="faq-title">Frequently Asked Questions</h2>
                    <p class="faq-subtitle">Everything you need to know about customer reviews</p>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How do customers leave reviews on Ulixai?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            After completing a service with Ulixai, customers receive an invitation to share their experience. This review process ensures that only verified customers who have actually used our services can leave feedback, helping new clients make informed decisions by reading authentic testimonials from travelers worldwide.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Are these customer reviews verified?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes, absolutely! All reviews on this page are from verified Ulixai customers who have completed a service. We only publish authentic testimonials from real users to ensure transparency. Reviews with the "Early Beta User" badge come from platform testers during our local beta phase—these are not real customers but testers who verified the platform functionality and provided crucial feedback that helped us improve Ulixai before the official launch.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>What does the "Early Beta User" badge mean?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            The "Early Beta User" badge indicates reviews from platform testers during our local beta phase. <strong>These users are not real customers but testers</strong> who helped us test the platform functionality, verify its proper operation, and provide essential feedback that shaped Ulixai before the official launch. Their reviews reflect real testing experiences with the platform.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>What languages does Ulixai support?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Ulixai is a truly multilingual platform supporting all languages worldwide. When a customer posts a request in their native language, service providers who speak the same language can respond and assist them. This ensures seamless communication between customers and providers regardless of the language spoken, making Ulixai accessible to travelers and expats everywhere.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Are all Ulixai reviews displayed on this page?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Not all reviews are displayed on this main page. Each service provider has their own dedicated review page with specific testimonials. This page showcases a selection of verified customer testimonials from across our platform to give you an overview of user experiences.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Why should I read customer reviews before using Ulixai?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Reading reviews helps you understand real experiences from other travelers and make informed decisions based on authentic feedback. Our customers share stories about how Ulixai helped them in various countries and situations, providing valuable insights for your specific needs and peace of mind before using our services.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How can I filter reviews by country or language?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Use our advanced search bar and filters at the top of the reviews section. You can search by keywords, select specific countries from the dropdown menu, or filter by language to find reviews most relevant to your destination and needs.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>How many countries does Ulixai cover?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Ulixai provides services across 197 countries worldwide, helping expats and travelers with various assistance needs globally. Our extensive multilingual network of service providers ensures reliable support wherever you are in the world.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I read the full customer stories?</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes! Simply click on any review card to read the complete customer story with detailed experiences, challenges faced, and outcomes. Each full story provides comprehensive insights into the customer's journey and how Ulixai services helped them.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<script>
(() => {
    'use strict';
    
    // SHARE PANEL
    window.openSharePanel = function() {
        const panel = document.getElementById('sharePanel');
        const overlay = document.getElementById('shareOverlay');
        const floatingBtn = document.getElementById('floatingShareBtn');
        
        if (overlay) {
            overlay.classList.remove('hidden');
            overlay.setAttribute('aria-hidden', 'false');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
        }
        if (panel) {
            panel.classList.remove('translate-x-full');
            panel.setAttribute('aria-hidden', 'false');
        }
        if (floatingBtn) {
            floatingBtn.style.display = 'none';
        }
        document.body.style.overflow = 'hidden';
    };
    
    window.closeSharePanel = function() {
        const panel = document.getElementById('sharePanel');
        const overlay = document.getElementById('shareOverlay');
        const floatingBtn = document.getElementById('floatingShareBtn');
        
        if (panel) {
            panel.classList.add('translate-x-full');
            panel.setAttribute('aria-hidden', 'true');
        }
        if (overlay) {
            overlay.classList.remove('opacity-100');
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.setAttribute('aria-hidden', 'true');
            }, 300);
        }
        if (floatingBtn) {
            setTimeout(() => floatingBtn.style.display = 'flex', 300);
        }
        document.body.style.overflow = '';
    };
    
    window.showShareSuccessPopup = function() {
        const popup = document.getElementById('shareSuccessPopup');
        const content = document.getElementById('popupContent');
        if (popup && content) {
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            popup.setAttribute('aria-hidden', 'false');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
    };
    
    window.closeSharePopup = function() {
        const popup = document.getElementById('shareSuccessPopup');
        const content = document.getElementById('popupContent');
        if (popup && content) {
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                popup.classList.remove('flex');
                popup.classList.add('hidden');
                popup.setAttribute('aria-hidden', 'true');
            }, 200);
        }
    };
    
    window.shareAgain = function() {
        closeSharePopup();
        setTimeout(() => openSharePanel(), 300);
    };
    
    const finalUrl = document.getElementById('reviewsShareLink')?.value || window.location.href;
    const enc = encodeURIComponent(finalUrl);
    
    const viralText = encodeURIComponent(`🌟 Check out these amazing customer reviews from Ulixai!\n\n✅ Real experiences\n✅ Verified customers\n✅ 197 countries\n\nRead their stories:`);
    const subject = encodeURIComponent("🌟 Customer Reviews - Ulixai.com");
    const viralEmailBody = encodeURIComponent(`Hey! 👋\n\nI found some inspiring customer stories from Ulixai that you might find interesting:\n\n${finalUrl}\n\nReal experiences from:\n✅ Verified customers worldwide\n✅ Services across 197 countries\n✅ Authentic testimonials\n\nCheck them out!`);
    
    const socialLinks = {
        shareWhatsAppSlide: `https://api.whatsapp.com/send?text=${viralText}%20${enc}`,
        shareMessengerSlide: `https://www.facebook.com/dialog/send?link=${enc}&app_id=YOUR_APP_ID&redirect_uri=${enc}`,
        shareFacebookSlide: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
        shareTwitterSlide: `https://twitter.com/intent/tweet?url=${enc}&text=${viralText}`,
        shareLinkedInSlide: `https://www.linkedin.com/sharing/share-offsite/?url=${enc}`,
        shareEmailSlide: `mailto:?subject=${subject}&body=${viralEmailBody}`
    };
    
    Object.entries(socialLinks).forEach(([id, href]) => {
        const link = document.getElementById(id);
        if (link) link.href = href;
    });
    
    const copyBtn = document.getElementById('copyBtnSlide');
    if (copyBtn) {
        copyBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (!navigator.clipboard) {
                const textarea = document.createElement('textarea');
                textarea.value = finalUrl;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    showCopySuccess();
                } catch (err) {
                    console.error('Copy failed:', err);
                }
                document.body.removeChild(textarea);
                return;
            }
            
            navigator.clipboard.writeText(finalUrl).then(() => {
                showCopySuccess();
            }).catch((err) => {
                console.error('Copy failed:', err);
            });
            
            function showCopySuccess() {
                const originalHTML = copyBtn.innerHTML;
                
                copyBtn.className = 'bg-green-500 rounded-xl p-3.5 sm:p-4 border-2 border-green-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200';
                copyBtn.innerHTML = `
                    <i class="fas fa-check text-3xl sm:text-4xl text-white" aria-hidden="true"></i>
                    <span class="text-xs sm:text-sm font-bold text-white uppercase tracking-wide">Copied!</span>
                `;
                copyBtn.setAttribute('aria-label', 'Link copied to clipboard');
                
                setTimeout(() => {
                    closeSharePanel();
                    showShareSuccessPopup();
                }, 800);
                
                setTimeout(() => {
                    copyBtn.className = 'bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 active:from-purple-600 active:to-purple-700 rounded-xl p-3.5 sm:p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group';
                    copyBtn.innerHTML = originalHTML;
                    copyBtn.setAttribute('aria-label', 'Copy link to clipboard');
                }, 1500);
            }
        });
    }

    // RECHERCHE ET FILTRES
    const searchInput = document.getElementById('searchInput');
    const countryFilter = document.getElementById('countryFilter');
    const languageFilter = document.getElementById('languageFilter');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const clearSearchBtn = document.getElementById('clearSearch');
    const reviewCards = document.querySelectorAll('.review-card');
    const noResults = document.getElementById('noResults');
    const activeFiltersContainer = document.getElementById('activeFilters');

    // MAKE ENTIRE REVIEW CARDS CLICKABLE
    reviewCards.forEach(card => {
        const link = card.querySelector('a[href]');
        if (link) {
            // Make the whole card clickable
            card.style.cursor = 'pointer';
            
            card.addEventListener('click', function(e) {
                // Don't interfere if clicking on an actual link or button
                if (e.target.tagName === 'A' || e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                    return;
                }
                
                // Navigate to the link
                if (e.ctrlKey || e.metaKey) {
                    // Open in new tab if Ctrl/Cmd is pressed
                    window.open(link.href, '_blank');
                } else {
                    // Normal navigation
                    window.location.href = link.href;
                }
            });
            
            // Also make sure the link itself is clickable
            link.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent double navigation
            });
        }
    });

    function filterReviews() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCountry = countryFilter.value.toLowerCase();
        const selectedLanguage = languageFilter.value.toLowerCase();
        
        let visibleCount = 0;
        
        reviewCards.forEach(card => {
            const name = card.dataset.name || '';
            const country = card.dataset.country || '';
            const nationality = card.dataset.nationality || '';
            const service = card.dataset.service || '';
            const text = card.dataset.text || '';
            const language = card.dataset.language || 'english';
            
            const matchesSearch = !searchTerm || 
                name.includes(searchTerm) || 
                country.includes(searchTerm) || 
                nationality.includes(searchTerm) || 
                service.includes(searchTerm) || 
                text.includes(searchTerm);
            
            const matchesCountry = !selectedCountry || 
                country.includes(selectedCountry) || 
                nationality.includes(selectedCountry);
            
            const matchesLanguage = !selectedLanguage || 
                language.includes(selectedLanguage);
            
            if (matchesSearch && matchesCountry && matchesLanguage) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        if (noResults) {
            noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        }
        
        const hasActiveFilters = searchTerm || selectedCountry || selectedLanguage;
        if (clearFiltersBtn) {
            clearFiltersBtn.style.display = hasActiveFilters ? 'inline-flex' : 'none';
        }
        
        if (clearSearchBtn) {
            clearSearchBtn.style.display = searchTerm ? 'flex' : 'none';
        }
        
        updateActiveFilters();
    }

    function updateActiveFilters() {
        if (!activeFiltersContainer) return;
        
        const searchTerm = searchInput.value.trim();
        const selectedCountry = countryFilter.value;
        const selectedLanguage = languageFilter.value;
        
        const hasFilters = searchTerm || selectedCountry || selectedLanguage;
        
        if (!hasFilters) {
            activeFiltersContainer.style.display = 'none';
            activeFiltersContainer.innerHTML = '';
            return;
        }
        
        activeFiltersContainer.style.display = 'flex';
        activeFiltersContainer.innerHTML = '';
        
        if (searchTerm) {
            const tag = document.createElement('div');
            tag.className = 'filter-tag';
            tag.innerHTML = `
                <span>Search: "${searchTerm}"</span>
                <button onclick="clearSearchFilter()" aria-label="Remove search filter">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            activeFiltersContainer.appendChild(tag);
        }
        
        if (selectedCountry) {
            const countryText = countryFilter.options[countryFilter.selectedIndex].text;
            const tag = document.createElement('div');
            tag.className = 'filter-tag';
            tag.innerHTML = `
                <span>${countryText}</span>
                <button onclick="clearCountryFilter()" aria-label="Remove country filter">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            activeFiltersContainer.appendChild(tag);
        }
        
        if (selectedLanguage) {
            const langText = languageFilter.options[languageFilter.selectedIndex].text;
            const tag = document.createElement('div');
            tag.className = 'filter-tag';
            tag.innerHTML = `
                <span>${langText}</span>
                <button onclick="clearLanguageFilter()" aria-label="Remove language filter">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            activeFiltersContainer.appendChild(tag);
        }
    }
    
    window.clearSearchFilter = function() {
        if (searchInput) searchInput.value = '';
        filterReviews();
    };
    
    window.clearCountryFilter = function() {
        if (countryFilter) countryFilter.value = '';
        filterReviews();
    };
    
    window.clearLanguageFilter = function() {
        if (languageFilter) languageFilter.value = '';
        filterReviews();
    };

    if (searchInput) {
        searchInput.addEventListener('input', filterReviews);
    }
    
    if (countryFilter) {
        countryFilter.addEventListener('change', filterReviews);
    }
    
    if (languageFilter) {
        languageFilter.addEventListener('change', filterReviews);
    }
    
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (countryFilter) countryFilter.value = '';
            if (languageFilter) languageFilter.value = '';
            filterReviews();
        });
    }
    
    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            filterReviews();
        });
    }

    // FAQ TOGGLE
    window.toggleFaq = function(button) {
        const faqItem = button.parentElement;
        const isActive = faqItem.classList.contains('active');
        
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
        });
        
        if (!isActive) {
            faqItem.classList.add('active');
        }
    };

    // INFINITE SCROLL MOBILE
    if (window.innerWidth <= 768) {
        let currentPage = {{ $currentPage }};
        const totalPages = {{ $totalPages }};
        let isLoading = false;
        
        const loadMoreObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !isLoading && currentPage < totalPages) {
                    isLoading = true;
                    currentPage++;
                    
                    fetch(`?page=${currentPage}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newReviews = doc.querySelectorAll('.review-card');
                        const grid = document.getElementById('reviewsGrid');
                        
                        newReviews.forEach(review => {
                            grid.appendChild(review);
                        });
                        
                        if (currentPage >= totalPages) {
                            const loadMore = document.getElementById('mobileLoadMore');
                            if (loadMore) loadMore.remove();
                        }
                        
                        isLoading = false;
                    })
                    .catch(() => {
                        isLoading = false;
                    });
                }
            });
        }, {
            rootMargin: '200px'
        });
        
        const loadMoreElement = document.getElementById('mobileLoadMore');
        if (loadMoreElement) {
            loadMoreObserver.observe(loadMoreElement);
        }
    }
})();
</script>

@include('includes.footer')

</body>
</html>