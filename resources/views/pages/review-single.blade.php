<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0, user-scalable=yes">
    
    <!-- DYNAMIC SEO META TAGS -->
    <title>{{ $review['name'] }} Review - {{ $review['service'] }} in {{ $review['country'] }} | Ulixai Customer Story</title>
    <meta name="description" content="Read {{ $review['name'] }}'s verified review about {{ $review['service'] }} in {{ $review['country'] }}. ⭐ {{ $review['rating'] }}/5 rating. Real customer experience with Ulixai services.">
    <meta name="keywords" content="{{ strtolower($review['name']) }} review, {{ strtolower($review['service']) }} {{ strtolower($review['country']) }}, ulixai {{ strtolower($review['country']) }} reviews, {{ strtolower($review['service']) }} testimonial, verified customer review">
    
    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $review['name'] }}'s Review - {{ $review['service'] }} in {{ $review['country'] }}">
    <meta property="og:description" content="{{ $review['shortText'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $review['image'] }}">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="600">
    <meta property="og:site_name" content="Ulixai">
    <meta property="og:locale" content="en_US">
    <meta property="article:published_time" content="{{ $review['date'] }}T00:00:00Z">
    <meta property="article:author" content="{{ $review['name'] }}">
    <meta property="article:tag" content="{{ $review['service'] }}">
    <meta property="article:tag" content="{{ $review['country'] }}">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ulixai">
    <meta name="twitter:title" content="{{ $review['name'] }}'s Review - {{ $review['service'] }}">
    <meta name="twitter:description" content="{{ Str::limit($review['shortText'], 150) }}">
    <meta name="twitter:image" content="{{ $review['image'] }}">
    <meta name="twitter:creator" content="@ulixai">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- DNS Prefetch & Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://i.pravatar.cc">
    <link rel="dns-prefetch" href="https://ui-avatars.com">
    
    <!-- Fonts with font-display: swap to prevent FOUT layout shift -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- SCHEMA.ORG - INDIVIDUAL REVIEW -->
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
                "url": "https://ulixai.com",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://ulixai.com/images/logo.png",
                    "width": 250,
                    "height": 60
                }
            },
            "areaServed": {
                "@type": "Country",
                "name": "{{ $review['country'] }}"
            },
            "description": "{{ $review['service'] }} service provided by Ulixai in {{ $review['country'] }}"
        },
        "author": {
            "@type": "Person",
            "name": "{{ $review['name'] }}",
            "nationality": "{{ $review['nationality'] }}",
            "image": "{{ $review['image'] }}"
        },
        "reviewRating": {
            "@type": "Rating",
            "ratingValue": "{{ $review['rating'] }}",
            "bestRating": "5",
            "worstRating": "1"
        },
        "reviewBody": "{{ addslashes($review['fullText']) }}",
        "datePublished": "{{ $review['date'] }}T00:00:00Z",
        "publisher": {
            "@type": "Organization",
            "name": "Ulixai",
            "url": "https://ulixai.com"
        },
        "inLanguage": "{{ $review['language'] ?? 'English' }}",
        "url": "{{ url()->current() }}"
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
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $review['name'] }}'s Review",
                "item": "{{ url()->current() }}"
            }
        ]
    }
    </script>
    
    <!-- SCHEMA.ORG - WEBPAGE -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "{{ $review['name'] }}'s Review - {{ $review['service'] }} in {{ $review['country'] }}",
        "description": "{{ $review['shortText'] }}",
        "url": "{{ url()->current() }}",
        "datePublished": "{{ $review['date'] }}T00:00:00Z",
        "inLanguage": "en",
        "primaryImageOfPage": {
            "@type": "ImageObject",
            "url": "{{ $review['image'] }}",
            "width": 600,
            "height": 600
        },
        "publisher": {
            "@type": "Organization",
            "name": "Ulixai"
        },
        "isPartOf": {
            "@type": "WebSite",
            "name": "Ulixai",
            "url": "https://ulixai.com"
        }
    }
    </script>
    
    <?php
    // DYNAMIC FAQ GENERATION BASED ON REVIEW CONTEXT
    $serviceLower = strtolower($review['service']);
    $countryLower = strtolower($review['country']);
    $languageLower = strtolower($review['language'] ?? 'English');
    
    $dynamicFaqs = [
        [
            'question' => "How did {$review['name']} use Ulixai for {$review['service']} in {$review['country']}?",
            'answer' => "{$review['name']}, a {$review['nationality']} customer, used Ulixai's platform to find verified {$review['service']} providers in {$review['country']}. They posted their request and received proposals from multiple qualified service providers, allowing them to compare options and choose the best fit for their needs."
        ],
        [
            'question' => "Is this review from {$review['name']} verified?",
            'answer' => isset($review['is_early_beta']) && $review['is_early_beta'] 
                ? "This review is from an Early Beta User who tested Ulixai's platform during the development phase. While not a paying customer, {$review['name']} provided authentic feedback based on real testing of the platform's {$review['service']} features in {$review['country']}."
                : "Yes, absolutely! This review from {$review['name']} is from a verified Ulixai customer who actually completed a {$review['service']} transaction through our platform in {$review['country']}. We only publish authentic testimonials from real users."
        ],
        [
            'question' => "What rating did {$review['name']} give for {$review['service']} in {$review['country']}?",
            'answer' => "{$review['name']} gave Ulixai a {$review['rating']} out of 5 stars for their {$review['service']} experience in {$review['country']}. This rating reflects their satisfaction with both the service provider they found through Ulixai and the platform's ease of use."
        ],
        [
            'question' => "Can I find {$review['service']} providers in {$review['country']} through Ulixai?",
            'answer' => "Yes! Ulixai connects you with verified {$review['service']} providers in {$review['country']}. Like {$review['name']}, you can post your request and receive proposals from multiple qualified professionals. Our platform supports communication in {$review['language']} and many other languages for seamless interaction."
        ],
        [
            'question' => "Does Ulixai support {$review['language']} for {$review['service']} requests?",
            'answer' => "Yes! Ulixai is a multilingual platform that supports {$review['language']} along with all other major languages worldwide. When you post a {$review['service']} request in {$review['language']}, providers who speak your language can respond and assist you, ensuring clear communication throughout the process."
        ],
        [
            'question' => "How long did it take {$review['name']} to find help through Ulixai?",
            'answer' => "Based on {$review['name']}'s experience with {$review['service']} in {$review['country']}, most customers receive their first proposals within 24-48 hours of posting a request. The Ulixai platform is designed for quick responses, allowing you to compare providers and make informed decisions efficiently."
        ],
        [
            'question' => "Are there other reviews for {$review['service']} in {$review['country']}?",
            'answer' => "Yes! You can find more customer reviews for {$review['service']} and other services in {$review['country']} on our main reviews page. Each verified provider on Ulixai also has their own dedicated review page with specific testimonials from past clients."
        ],
        [
            'question' => "What makes {$review['name']}'s review trustworthy?",
            'answer' => isset($review['is_early_beta']) && $review['is_early_beta']
                ? "{$review['name']}'s review comes from a platform beta tester who helped verify Ulixai's functionality for {$review['service']} services. While marked as 'Early Beta User', their feedback is based on genuine testing experiences with the platform's features and workflow in {$review['country']}."
                : "{$review['name']}'s review is trustworthy because it comes from a verified Ulixai transaction. We only publish reviews from customers who actually completed services through our platform. {$review['name']} used Ulixai to find and work with a {$review['service']} provider in {$review['country']}, and this review reflects their genuine experience."
        ],
        [
            'question' => "Can I contact {$review['service']} providers in {$review['country']} before paying?",
            'answer' => "Absolutely! Just like {$review['name']} did, you can message multiple {$review['service']} providers in {$review['country']} through Ulixai's secure platform before making any payment. This allows you to ask questions, compare approaches, and choose the provider that best fits your needs and budget."
        ]
    ];
    ?>
    
    <!-- SCHEMA.ORG - DYNAMIC FAQ PAGE -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            @foreach($dynamicFaqs as $index => $faq)
            {
                "@type": "Question",
                "name": "{{ $faq['question'] }}",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ addslashes($faq['answer']) }}"
                }
            }{{ $index < count($dynamicFaqs) - 1 ? ',' : '' }}
            @endforeach
        ]
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
        
        /* BREADCRUMB NAVIGATION */
        .breadcrumb-nav {
            background: white;
            padding: 1rem 0;
            border-bottom: 1px solid #E5E7EB;
        }
        
        .breadcrumb-list {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            font-size: 0.875rem;
        }
        
        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .breadcrumb-link {
            color: #6B7280;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .breadcrumb-link:hover {
            color: var(--primary-blue);
        }
        
        .breadcrumb-separator {
            color: #9CA3AF;
            font-size: 0.75rem;
        }
        
        .breadcrumb-current {
            color: #111827;
            font-weight: 600;
        }
        
        /* HERO SECTION */
        .review-hero {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #BFDBFE 100%);
            padding: 2.5rem 1rem;
            position: relative;
            overflow: hidden;
            min-height: 300px;
        }
        
        .review-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        /* RETARD ANIMATION: Commence après le chargement */
        @keyframes pulse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-5%, 5%) scale(1.08); }
        }
        
        body.loaded .review-hero::before {
            animation: pulse 15s ease-in-out infinite;
        }
        
        .review-hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9375rem;
            margin-bottom: 1.5rem;
            padding: 0.625rem 1.25rem;
            background: white;
            border-radius: 9999px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        .back-button:hover {
            transform: translateX(-4px);
            box-shadow: 0 8px 12px -2px rgba(37, 99, 235, 0.2);
        }
        
        .back-icon {
            width: 1.125rem;
            height: 1.125rem;
            transition: transform 0.3s;
        }
        
        .back-button:hover .back-icon {
            transform: translateX(-3px);
        }
        
        .review-header-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 20px 50px -12px rgba(37, 99, 235, 0.15);
            border: 2px solid rgba(37, 99, 235, 0.1);
        }
        
        .review-meta-top {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        /* OPTIMISATION CLS: Dimensions fixes + aspect-ratio */
        .author-avatar-large {
            width: 5rem;
            height: 5rem;
            aspect-ratio: 1;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--blue-light);
            box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.15);
            flex-shrink: 0;
            contain-intrinsic-size: 5rem;
        }
        
        .review-meta-info {
            flex: 1;
            min-width: 0;
        }
        
        .review-title {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.75rem;
            line-height: 1.2;
            min-height: 2rem;
        }
        
        .review-subtitle {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem;
            color: #6B7280;
            font-size: 1rem;
            margin-bottom: 1rem;
            min-height: 1.5rem;
        }
        
        .review-subtitle-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            min-height: 1.5rem;
        }
        
        .review-subtitle-icon {
            width: 1.125rem;
            height: 1.125rem;
            color: var(--primary-blue);
            flex-shrink: 0;
        }
        
        .review-rating-large {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            min-height: 1.5rem;
        }
        
        .stars-large {
            display: flex;
            gap: 0.25rem;
            min-height: 1.5rem;
        }
        
        .star-large {
            width: 1.5rem;
            height: 1.5rem;
            fill: #FBBF24;
            flex-shrink: 0;
        }
        
        .rating-text-large {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1F2937;
            white-space: nowrap;
        }
        
        .review-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.25rem;
            min-height: 2.5rem;
        }
        
        .review-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.025em;
            white-space: nowrap;
            flex-shrink: 0;
        }
        
        .badge-service {
            background: linear-gradient(135deg, var(--blue-light), #BFDBFE);
            color: #1E40AF;
        }
        
        .badge-verified {
            background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
            color: #065F46;
        }
        
        .badge-beta {
            background: linear-gradient(135deg, #FBBF24, #F59E0B);
            color: white;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        }
        
        .badge-language {
            background: linear-gradient(135deg, #E9D5FF, #D8B4FE);
            color: #6B21A8;
        }
        
        /* MAIN CONTENT */
        .review-content-section {
            padding: 3rem 0;
        }
        
        .review-content-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .review-content-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 10px 30px -8px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            min-height: 400px;
        }
        
        .content-section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-height: 2rem;
        }
        
        .title-icon {
            width: 1.75rem;
            height: 1.75rem;
            color: var(--primary-blue);
            flex-shrink: 0;
        }
        
        .review-full-text {
            color: #374151;
            font-size: 1.0625rem;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
            min-height: 200px;
        }
        
        .review-full-text::first-letter {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            float: left;
            line-height: 1;
            margin-right: 0.5rem;
            margin-top: 0.25rem;
        }
        
        /* SHARE SECTION */
        .share-review-section {
            background: linear-gradient(135deg, #F0F9FF, #E0F2FE);
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
            border: 2px solid rgba(37, 99, 235, 0.2);
            min-height: 280px;
        }
        
        .share-title {
            font-size: 1.375rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.75rem;
            min-height: 1.75rem;
        }
        
        .share-subtitle {
            color: #6B7280;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            min-height: 1.5rem;
        }
        
        .share-buttons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
            min-height: 100px;
        }
        
        .share-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem;
            border-radius: 1rem;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.875rem;
            transition: all 0.3s;
            border: 2px solid transparent;
            min-height: 100px;
        }
        
        .share-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.2);
        }
        
        .share-btn-icon {
            font-size: 2rem;
        }
        
        .share-btn-whatsapp {
            background: linear-gradient(135deg, #DCF8C6, #25D366);
            color: #128C7E;
        }
        
        .share-btn-whatsapp:hover {
            background: #25D366;
            color: white;
        }
        
        .share-btn-facebook {
            background: linear-gradient(135deg, #E7F3FF, #1877F2);
            color: #1877F2;
        }
        
        .share-btn-facebook:hover {
            background: #1877F2;
            color: white;
        }
        
        .share-btn-twitter {
            background: linear-gradient(135deg, #E8F5FD, #1DA1F2);
            color: #1DA1F2;
        }
        
        .share-btn-twitter:hover {
            background: #1DA1F2;
            color: white;
        }
        
        .share-btn-linkedin {
            background: linear-gradient(135deg, #E1F5FE, #0077B5);
            color: #0077B5;
        }
        
        .share-btn-linkedin:hover {
            background: #0077B5;
            color: white;
        }
        
        .share-btn-copy {
            background: linear-gradient(135deg, #F3E8FF, #9333EA);
            color: #9333EA;
            border: none;
            cursor: pointer;
        }
        
        .share-btn-copy:hover {
            background: #9333EA;
            color: white;
        }
        
        /* FAQ SECTION */
        .faq-section {
            background: linear-gradient(135deg, #F9FAFB 0%, #F3F4F6 100%);
            padding: 3rem 1rem;
            margin-top: 2rem;
            min-height: 400px;
        }
        
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .faq-header {
            text-align: center;
            margin-bottom: 2.5rem;
            min-height: 100px;
        }
        
        .faq-title {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 900;
            color: #1F2937;
            margin-bottom: 0.625rem;
            min-height: 2rem;
        }
        
        .faq-subtitle {
            font-size: clamp(0.9375rem, 2vw, 1.125rem);
            color: #6B7280;
            min-height: 1.5rem;
        }
        
        .faq-item {
            background: white;
            border-radius: 1rem;
            margin-bottom: 0.875rem;
            overflow: hidden;
            border: 2px solid #E5E7EB;
            transition: all 0.3s;
            min-height: 60px;
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
            min-height: 60px;
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
            max-height: 800px;
        }
        
        /* RELATED REVIEWS */
        .related-reviews-section {
            padding: 3rem 0;
            background: white;
            min-height: 400px;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 2rem;
            min-height: 100px;
        }
        
        .section-title {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.5rem;
            min-height: 2rem;
        }
        
        .section-subtitle {
            font-size: clamp(0.9375rem, 2vw, 1.125rem);
            color: #6B7280;
            min-height: 1.5rem;
        }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(300px, 100%), 1fr));
            gap: 1.25rem;
            auto-rows: 1fr;
        }
        
        /* REVIEW CARD */
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
            will-change: transform;
            overflow: hidden;
            min-height: 350px;
        }
        
        .review-card-link {
            display: block;
            padding: 1.25rem;
            text-decoration: none;
            color: inherit;
            height: 100%;
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
            pointer-events: none;
        }
        
        @media (hover: hover) {
            .review-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.2), 0 0 0 1px rgba(37, 99, 235, 0.15);
            }
            
            .review-card:hover::before {
                opacity: 1;
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
            min-height: 60px;
        }
        
        .review-author {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            flex: 1;
            min-width: 0;
        }
        
        /* OPTIMISATION CLS: Dimensions + aspect-ratio */
        .author-avatar {
            width: 3rem;
            height: 3rem;
            aspect-ratio: 1;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid var(--blue-light);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
            contain-intrinsic-size: 3rem;
        }
        
        .author-info {
            flex: 1;
            min-width: 0;
            min-height: 50px;
        }
        
        .author-name {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.2rem;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 1.3rem;
        }
        
        .author-location {
            font-size: 0.8125rem;
            color: #6B7280;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 1.2rem;
        }
        
        .review-date {
            text-align: right;
            flex-shrink: 0;
            min-height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .date-main {
            font-size: 0.6875rem;
            font-weight: 600;
            color: #374151;
            white-space: nowrap;
            min-height: 1rem;
        }
        
        .review-destination {
            display: flex;
            align-items: center;
            gap: 0.4375rem;
            margin-bottom: 0.625rem;
            font-size: 0.8125rem;
            color: #6B7280;
            min-height: 1.5rem;
        }
        
        .review-stars {
            display: flex;
            align-items: center;
            gap: 0.4375rem;
            margin-bottom: 0.625rem;
            min-height: 1.5rem;
        }
        
        .stars {
            display: flex;
            gap: 0.2rem;
            min-height: 1.125rem;
        }
        
        .star-small {
            width: 1.125rem;
            height: 1.125rem;
            fill: #FBBF24;
            flex-shrink: 0;
        }
        
        .rating-text {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            white-space: nowrap;
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
            white-space: nowrap;
        }
        
        .review-text {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 0.875rem;
            font-style: italic;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 0.9375rem;
            min-height: 60px;
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
            flex-shrink: 0;
        }
        
        .review-card:hover .arrow-icon {
            transform: translateX(4px);
        }
        
        /* FLOATING SHARE BUTTON */
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
            box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.5), 0 0 30px rgba(147, 51, 234, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid white;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            opacity: 0;
            animation: floatIn 0.6s ease-out 0.5s forwards;
        }
        
        /* RETARD ANIMATION: Bouton flottant apparaît après chargement */
        @keyframes floatIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        body.loaded #floatingShareBtn {
            animation: floatIn 0.6s ease-out 0.5s forwards, float 3s ease-in-out 1.1s infinite;
        }
        
        #floatingShareBtn:hover {
            transform: translateY(-5px) scale(1.1);
            background: linear-gradient(135deg, #1D4ED8 0%, #7C3AED 100%);
            box-shadow: 0 30px 60px -15px rgba(37, 99, 235, 0.6), 0 0 50px rgba(147, 51, 234, 0.5);
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
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .review-hero {
                padding: 2rem 1rem;
                min-height: 250px;
            }
            
            .review-header-card {
                padding: 1.5rem;
            }
            
            .review-meta-top {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 1.25rem;
            }
            
            .author-avatar-large {
                width: 4rem;
                height: 4rem;
            }
            
            .review-title {
                font-size: 1.5rem;
            }
            
            .review-subtitle {
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }
            
            .review-content-card {
                padding: 1.5rem;
                min-height: 300px;
            }
            
            .review-full-text {
                font-size: 1rem;
            }
            
            .share-review-section {
                padding: 1.5rem;
                min-height: 250px;
            }
            
            .share-buttons-grid {
                grid-template-columns: repeat(2, 1fr);
                min-height: 80px;
            }
            
            .faq-section {
                padding: 2rem 1rem;
                min-height: 300px;
            }
            
            .faq-question {
                font-size: 0.9375rem;
                padding: 1.125rem;
            }
            
            .reviews-grid {
                grid-template-columns: 1fr;
            }
            
            #floatingShareBtn {
                bottom: 1.25rem;
                right: 1.25rem;
                padding: 0.875rem 1.25rem;
                font-size: 0.875rem;
            }
        }
        
        @media (max-width: 480px) {
            .review-hero {
                padding: 1.75rem 0.875rem;
                min-height: 200px;
            }
            
            .back-button {
                font-size: 0.875rem;
                padding: 0.5625rem 1rem;
            }
            
            .review-header-card {
                padding: 1.25rem;
            }
            
            .author-avatar-large {
                width: 3.5rem;
                height: 3.5rem;
            }
            
            .review-title {
                font-size: 1.375rem;
            }
            
            .review-badges {
                gap: 0.5rem;
                min-height: 2rem;
            }
            
            .review-badge {
                font-size: 0.75rem;
                padding: 0.4375rem 0.875rem;
            }
            
            .review-content-card {
                padding: 1.25rem;
                border-radius: 1.25rem;
                min-height: 250px;
            }
            
            .content-section-title {
                font-size: 1.25rem;
            }
            
            .share-buttons-grid {
                gap: 0.75rem;
                grid-template-columns: repeat(2, 1fr);
            }
            
            .share-btn {
                padding: 0.875rem;
                font-size: 0.8125rem;
            }
            
            .share-btn-icon {
                font-size: 1.75rem;
            }
            
            #floatingShareBtn {
                bottom: 1rem;
                right: 1rem;
                padding: 0.75rem 1rem;
                font-size: 0.8125rem;
            }
            
            .share-icon-wrapper {
                width: 1.75rem;
                height: 1.75rem;
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
        .review-header-card,
        .review-content-card,
        .share-review-section,
        #floatingShareBtn {
            transform: translateZ(0);
            backface-visibility: hidden;
            perspective: 1000px;
        }
    </style>
</head>

<body>

@include('includes.header')
@include('wizards.requester.steps.popup_request_help')

<!-- FLOATING SHARE BUTTON - Premium design avec animation retardée -->
<button id="floatingShareBtn" onclick="openSharePanel()" class="fixed bottom-6 right-6 z-50 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold px-5 py-3.5 sm:px-6 sm:py-4 rounded-full shadow-2xl transition-all duration-300 transform hover:scale-110 flex items-center gap-2.5 sm:gap-3 group animate-pulse hover:animate-none" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share this review and spread the word">
    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
    </svg>
    <span class="hidden sm:inline text-sm sm:text-base">Share</span>
    <span class="sm:hidden text-sm">Share</span>
    <span class="ml-1" aria-hidden="true">📢</span>
</button>

<!-- SHARE OVERLAY - Backdrop pour fermer le panel -->
<div id="shareOverlay" onclick="closeSharePanel()" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-300" aria-hidden="true"></div>

<!-- SHARE PANEL - Panel latéral avec boutons sociaux -->
<aside id="sharePanel" class="fixed top-0 right-0 h-full w-full sm:w-96 bg-white shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 overflow-y-auto" style="overscroll-behavior: contain;" role="dialog" aria-labelledby="share-panel-title" aria-modal="true">
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-5 sm:p-6 sticky top-0 z-10">
        <div class="flex items-center justify-between mb-3 sm:mb-4">
            <h2 id="share-panel-title" class="text-white font-bold text-lg sm:text-xl flex items-center gap-2">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                </svg>
                Share Review
            </h2>
            <button onclick="closeSharePanel()" class="text-white/80 hover:text-white transition-colors p-1" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Close share panel">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 text-white">
            <p class="text-sm font-semibold mb-1">📖 Review Link</p>
            <p class="text-xs opacity-90 mb-3">Share this review with your friends and network</p>
            <a href="javascript:void(0)" onclick="copyReviewLink()" class="block w-full bg-white text-blue-600 font-bold py-2 px-4 rounded-lg text-center hover:bg-blue-50 transition-colors text-xs sm:text-sm" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Copy review link">
                📋 Copy Link
            </a>
        </div>
    </div>

    <div class="p-5 sm:p-6">
        <h3 class="font-bold text-gray-900 mb-3 sm:mb-4 flex items-center gap-2 text-base sm:text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            Share Now
        </h3>

        <div class="grid grid-cols-2 gap-2.5 sm:gap-3" role="list">
            
            <a id="shareWhatsAppPanel" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 active:from-green-600 active:to-green-700 rounded-xl p-3.5 sm:p-4 border-2 border-green-200 hover:border-green-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share on WhatsApp" role="listitem">
                <i class="fab fa-whatsapp text-3xl sm:text-4xl text-green-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-green-700 group-hover:text-white uppercase tracking-wide transition-colors">WhatsApp</span>
            </a>

            <a id="shareMessengerPanel" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-400 hover:to-blue-500 active:from-blue-500 active:to-blue-600 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200 hover:border-blue-400 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share on Messenger" role="listitem">
                <i class="fab fa-facebook-messenger text-3xl sm:text-4xl text-blue-500 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-blue-600 group-hover:text-white uppercase tracking-wide transition-colors">Messenger</span>
            </a>

            <a id="shareFacebookPanel" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 active:from-blue-600 active:to-blue-700 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200 hover:border-blue-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share on Facebook" role="listitem">
                <i class="fab fa-facebook text-3xl sm:text-4xl text-blue-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">Facebook</span>
            </a>

            <a id="shareTwitterPanel" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-800 hover:to-black active:from-black active:to-gray-900 rounded-xl p-3.5 sm:p-4 border-2 border-gray-200 hover:border-gray-800 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share on Twitter" role="listitem">
                <i class="fab fa-x-twitter text-3xl sm:text-4xl text-gray-800 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-gray-700 group-hover:text-white uppercase tracking-wide transition-colors">Twitter</span>
            </a>

            <a id="shareLinkedInPanel" href="#" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 active:from-blue-700 active:to-blue-800 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200 hover:border-blue-600 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share on LinkedIn" role="listitem">
                <i class="fab fa-linkedin text-3xl sm:text-4xl text-blue-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-blue-700 group-hover:text-white uppercase tracking-wide transition-colors">LinkedIn</span>
            </a>

            <a id="shareEmailPanel" href="#" class="bg-gradient-to-br from-red-50 to-red-100 hover:from-red-500 hover:to-red-600 active:from-red-600 active:to-red-700 rounded-xl p-3.5 sm:p-4 border-2 border-red-200 hover:border-red-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share via Email" role="listitem">
                <i class="fas fa-envelope text-3xl sm:text-4xl text-red-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-red-700 group-hover:text-white uppercase tracking-wide transition-colors">Email</span>
            </a>

            <button id="copyBtnPanel" class="bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 active:from-purple-600 active:to-purple-700 rounded-xl p-3.5 sm:p-4 border-2 border-purple-200 hover:border-purple-500 flex flex-col items-center gap-1.5 sm:gap-2 transition-all duration-200 group" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Copy review link" role="listitem">
                <i class="fas fa-link text-3xl sm:text-4xl text-purple-600 group-hover:text-white transition-colors" aria-hidden="true"></i>
                <span class="text-xs sm:text-sm font-bold text-purple-700 group-hover:text-white uppercase tracking-wide transition-colors">Copy</span>
            </button>

        </div>

        <div class="mt-5 sm:mt-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-3.5 sm:p-4 border-2 border-blue-200">
            <div class="flex items-center gap-2.5 sm:gap-3 text-blue-700">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                </svg>
                <div class="flex-1">
                    <p class="font-bold text-sm">
                        Spread the word! 📢
                    </p>
                    <p class="text-xs text-blue-600 mt-1">Share {{ $review['name'] }}'s experience</p>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- SUCCESS POPUP - Confirmation après partage -->
<div id="shareSuccessPopup" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4" role="dialog" aria-labelledby="success-popup-title" aria-modal="true">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-5 sm:p-6 transform transition-all scale-95 opacity-0" id="popupContent">
        <div class="text-center mb-3 sm:mb-4">
            <div class="inline-block bg-gradient-to-br from-blue-400 to-purple-500 rounded-full p-3 sm:p-4 mb-2 sm:mb-3 animate-bounce">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                </svg>
            </div>
            <h3 id="success-popup-title" class="text-xl sm:text-2xl font-bold text-gray-900 mb-1.5 sm:mb-2">Thanks for sharing! 🙏</h3>
            <p class="text-gray-600 text-sm">Help {{ $review['name'] }} reach more people</p>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-3.5 sm:p-4 mb-3 sm:mb-4 border-2 border-blue-200">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-600">Sharing helps:</span>
                <span class="text-lg sm:text-xl font-bold text-blue-600">✨</span>
            </div>
            <p class="text-xs text-gray-600 leading-relaxed">Every share helps other expats discover this review and make informed decisions. Thank you for being awesome!</p>
        </div>
        <div class="space-y-2">
            <button onclick="shareAgain()" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 active:from-blue-700 active:to-purple-800 text-white font-bold py-2.5 sm:py-3 px-5 sm:px-6 rounded-xl transition-all transform hover:scale-105 active:scale-95 shadow-lg text-sm sm:text-base" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Share again">
                Share Again 📢
            </button>
            <button onclick="closeSharePopup()" class="w-full bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-700 font-medium py-2 sm:py-2 px-5 sm:px-6 rounded-xl transition-all text-sm sm:text-base" style="touch-action: manipulation; -webkit-tap-highlight-color: transparent;" aria-label="Close success popup">
                Close
            </button>
        </div>
    </div>
</div>

<!-- HIDDEN INPUT FOR SHARE URL -->
<input type="text" id="reviewShareUrl" value="{{ url()->current() }}" hidden aria-hidden="true">

<main>
    <!-- BREADCRUMB NAVIGATION -->
    <nav class="breadcrumb-nav" aria-label="Breadcrumb">
        <div class="container">
            <ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ url('/') }}" class="breadcrumb-link" itemprop="item">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1">
                    <span class="breadcrumb-separator" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ url('/customerreviews') }}" class="breadcrumb-link" itemprop="item">
                        <span itemprop="name">Customer Reviews</span>
                    </a>
                    <meta itemprop="position" content="2">
                    <span class="breadcrumb-separator" aria-hidden="true">›</span>
                </li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span class="breadcrumb-current" itemprop="name">{{ $review['name'] }}'s Review</span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="review-hero">
        <div class="container">
            <div class="review-hero-content">
                <a href="{{ url('/customerreviews') }}" class="back-button" aria-label="Back to all reviews">
                    <svg class="back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Back to Reviews</span>
                </a>
                
                <article class="review-header-card" itemscope itemtype="https://schema.org/Review">
                    <div class="review-meta-top">
                        <img 
                            src="{{ $review['image'] }}" 
                            alt="Profile picture of {{ $review['name'] }}, {{ $review['nationality'] }} customer" 
                            class="author-avatar-large"
                            itemprop="image"
                            loading="eager"
                            width="80"
                            height="80"
                        />
                        
                        <div class="review-meta-info">
                            <h1 class="review-title" itemprop="name">
                                {{ $review['name'] }}'s Experience with {{ $review['service'] }}
                            </h1>
                            
                            <div class="review-subtitle">
                                <div class="review-subtitle-item">
                                    <svg class="review-subtitle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                        <span itemprop="name">{{ $review['name'] }}</span> 
                                        <meta itemprop="nationality" content="{{ $review['nationality'] }}">
                                        ({{ $review['nationality'] }})
                                    </span>
                                </div>
                                
                                <div class="review-subtitle-item">
                                    <svg class="review-subtitle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>{{ $review['country'] }}</span>
                                </div>
                                
                                <div class="review-subtitle-item">
                                    <svg class="review-subtitle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <time datetime="{{ $review['date'] }}" itemprop="datePublished">
                                        {{ \Carbon\Carbon::parse($review['date'])->format('F d, Y') }}
                                    </time>
                                </div>
                            </div>
                            
                            <div class="review-rating-large" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                <div class="stars-large" role="img" aria-label="{{ $review['rating'] }} out of 5 stars">
                                    @for($i = 0; $i < $review['rating']; $i++)
                                        <svg class="star-large" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="rating-text-large">
                                    <span itemprop="ratingValue">{{ $review['rating'] }}</span>/<span itemprop="bestRating">5</span>
                                </span>
                                <meta itemprop="worstRating" content="1">
                            </div>
                        </div>
                    </div>
                    
                    <div class="review-badges">
                        <span class="review-badge badge-service" itemprop="itemReviewed" itemscope itemtype="https://schema.org/Service">
                            <svg style="width: 1rem; height: 1rem;" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                            <span itemprop="name">{{ $review['service'] }}</span>
                            <meta itemprop="provider" content="Ulixai">
                        </span>
                        
                        @if(isset($review['is_early_beta']) && $review['is_early_beta'])
                            <span class="review-badge badge-beta">
                                <svg style="width: 1rem; height: 1rem;" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                EARLY BETA USER
                            </span>
                        @else
                            <span class="review-badge badge-verified">
                                <svg style="width: 1rem; height: 1rem;" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                VERIFIED CUSTOMER
                            </span>
                        @endif
                        
                        <span class="review-badge badge-language">
                            <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                            </svg>
                            {{ $review['language'] ?? 'English' }}
                        </span>
                    </div>
                    
                    <!-- SCHEMA.ORG METADATA -->
                    <meta itemprop="reviewBody" content="{{ $review['fullText'] }}">
                    <meta itemprop="inLanguage" content="{{ $review['language'] ?? 'English' }}">
                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" style="display: none;">
                        <span itemprop="name">Ulixai</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <section class="review-content-section">
        <div class="container">
            <div class="review-content-wrapper">
                <div class="review-content-card">
                    <h2 class="content-section-title">
                        <svg class="title-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        Full Customer Story
                    </h2>
                    <div class="review-full-text">{{ $review['fullText'] }}</div>
                </div>
                
                <!-- SHARE SECTION - Invitation pour utiliser le bouton flottant -->
                <div class="share-review-section">
                    <h2 class="share-title">Loved This Review?</h2>
                    <p class="share-subtitle">Help others discover {{ $review['name'] }}'s story by sharing it!</p>
                    
                    <div style="margin-top: 1.5rem; padding: 1.5rem; background: linear-gradient(135deg, #F0F9FF, #E0F2FE); border-radius: 1.5rem; border: 2px solid rgba(37, 99, 235, 0.2); text-align: center;">
                        <p style="color: #1F2937; font-size: 1.125rem; font-weight: 700; margin-bottom: 0.75rem;">👉 Use the Share button below</p>
                        <p style="color: #6B7280; font-size: 0.9375rem; line-height: 1.6;">Click the floating <strong>Share</strong> button on your screen to share this review across WhatsApp, Facebook, Twitter, LinkedIn and more!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DYNAMIC FAQ SECTION -->
    <section class="faq-section">
        <div class="container">
            <div class="faq-container">
                <div class="faq-header">
                    <h2 class="faq-title">Frequently Asked Questions</h2>
                    <p class="faq-subtitle">Everything about {{ $review['name'] }}'s experience</p>
                </div>

                @foreach($dynamicFaqs as $faq)
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)" aria-expanded="false">
                        <span>{{ $faq['question'] }}</span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">{{ $faq['answer'] }}</div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- RELATED REVIEWS -->
    <?php
    // Get related reviews (same service or country)
    $allReviews = array_merge(
        isset($featuredReviews) ? $featuredReviews : [],
        isset($userReviews) ? $userReviews : []
    );
    
    $relatedReviews = collect($allReviews)
        ->filter(function($r) use ($review) {
            return $r['slug'] !== $review['slug'] && 
                   ($r['service'] === $review['service'] || 
                    $r['country'] === $review['country']);
        })
        ->take(3)
        ->values()
        ->all();
    ?>
    
    @if(count($relatedReviews) > 0)
    <section class="related-reviews-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Related Customer Reviews</h2>
                <p class="section-subtitle">More experiences from {{ $review['country'] }} and {{ $review['service'] }}</p>
            </div>
            
            <div class="reviews-grid">
                @foreach($relatedReviews as $relatedReview)
                    <article class="review-card">
                        <a href="{{ route('review.show', $relatedReview['slug']) }}" 
                           class="review-card-link"
                           aria-label="Read review from {{ $relatedReview['name'] }}">
                            
                            <div class="review-header">
                                <div class="review-author">
                                    <img 
                                        src="{{ $relatedReview['image'] }}" 
                                        alt="Profile picture of {{ $relatedReview['name'] }}" 
                                        class="author-avatar"
                                        loading="lazy"
                                        width="48"
                                        height="48"
                                    />
                                    <div class="author-info">
                                        <h3 class="author-name">{{ $relatedReview['name'] }}</h3>
                                        <p class="author-location">{{ $relatedReview['nationality'] }}</p>
                                    </div>
                                </div>
                                
                                <div class="review-date">
                                    <time datetime="{{ $relatedReview['date'] }}" class="date-main">
                                        {{ \Carbon\Carbon::parse($relatedReview['date'])->format('M d, Y') }}
                                    </time>
                                </div>
                            </div>
                            
                            <div class="review-destination">
                                <svg style="width: 0.9375rem; height: 0.9375rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $relatedReview['country'] }}</span>
                            </div>
                            
                            <div class="review-stars">
                                <div class="stars" role="img" aria-label="{{ $relatedReview['rating'] }} out of 5 stars">
                                    @for($i = 0; $i < $relatedReview['rating']; $i++)
                                        <svg class="star-small" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="rating-text">({{ $relatedReview['rating'] }}/5)</span>
                            </div>
                            
                            <span class="service-badge">{{ $relatedReview['service'] }}</span>
                            
                            <p class="review-text">"{{ $relatedReview['shortText'] }}"</p>
                            
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
            
            <div style="text-align: center; margin-top: 2rem;">
                <a 
                    href="{{ url('/customerreviews') }}" 
                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2rem; background: linear-gradient(135deg, var(--primary-blue), #60A5FA); color: white; text-decoration: none; border-radius: 9999px; font-weight: 700; box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.3); transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 35px -7px rgba(37, 99, 235, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px -5px rgba(37, 99, 235, 0.3)'"
                    aria-label="View all customer reviews"
                >
                    <span>View All Reviews</span>
                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
</main>

<script>
(() => {
    'use strict';
    
    // Marquer la page comme chargée pour activer les animations
    window.addEventListener('load', () => {
        document.body.classList.add('loaded');
    });
    
    // SYSTEM: Panel lateral share
    window.openSharePanel = function() {
        const panel = document.getElementById('sharePanel');
        const overlay = document.getElementById('shareOverlay');
        const floatingBtn = document.getElementById('floatingShareBtn');
        
        if (overlay) {
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
        }
        if (panel) {
            panel.classList.remove('translate-x-full');
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
        }
        if (overlay) {
            overlay.classList.remove('opacity-100');
            setTimeout(() => overlay.classList.add('hidden'), 300);
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
            }, 200);
        }
    };
    
    window.shareAgain = function() {
        closeSharePopup();
        setTimeout(() => openSharePanel(), 300);
    };
    
    function getShareUrl() {
        const input = document.getElementById('reviewShareUrl');
        if (!input) return window.location.href;
        
        let shareUrl = input.value;
        try {
            const urlObj = new URL(shareUrl, window.location.origin);
            urlObj.searchParams.set('utm_source', 'social_share');
            urlObj.searchParams.set('utm_medium', 'share');
            urlObj.searchParams.set('utm_campaign', 'review');
            shareUrl = urlObj.toString();
        } catch (e) {
            console.error('UTM error:', e);
        }
        return shareUrl;
    }
    
    window.copyReviewLink = function() {
        const shareUrl = getShareUrl();
        navigator.clipboard.writeText(shareUrl).then(() => {
            closeSharePanel();
            showShareSuccessPopup();
        }).catch(() => {
            alert('Failed to copy link');
        });
    };
    
    const finalUrl = getShareUrl();
    const enc = encodeURIComponent(finalUrl);
    
    const reviewName = "{{ addslashes($review['name']) }}";
    const reviewService = "{{ addslashes($review['service']) }}";
    const reviewCountry = "{{ addslashes($review['country']) }}";
    const reviewText = "{{ addslashes(substr($review['shortText'], 0, 120)) }}";
    
    const viralText = encodeURIComponent(`✨ Check out {{ addslashes($review['name']) }}'s review about {{ addslashes($review['service']) }} in {{ addslashes($review['country']) }}\n\n⭐ Rating: {{ $review['rating'] }}/5\n\n"${reviewText}"\n\n👉 Read full review:`);
    const subject = encodeURIComponent(`📖 {{ addslashes($review['name']) }}'s {{ addslashes($review['service']) }} Review`);
    const emailBody = encodeURIComponent(`Hi!\n\nI found a great review about {{ addslashes($review['service']) }} in {{ addslashes($review['country']) }}:\n\n---\n\n{{ addslashes($review['name']) }} ({{ $review['rating'] }}/5 stars):\n"${reviewText}"\n\n---\n\nRead the full review:\n${finalUrl}`);
    
    const socialLinks = {
        shareWhatsAppPanel: `https://api.whatsapp.com/send?text=${viralText}%20${enc}`,
        shareMessengerPanel: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
        shareFacebookPanel: `https://www.facebook.com/sharer/sharer.php?u=${enc}`,
        shareTwitterPanel: `https://twitter.com/intent/tweet?url=${enc}&text=${viralText}`,
        shareLinkedInPanel: `https://www.linkedin.com/sharing/share-offsite/?url=${enc}`,
        shareEmailPanel: `mailto:?subject=${subject}&body=${emailBody}`
    };
    
    Object.entries(socialLinks).forEach(([id, href]) => {
        const link = document.getElementById(id);
        if (link) {
            link.href = href;
        }
    });
    
    const copyBtn = document.getElementById('copyBtnPanel');
    if (copyBtn) {
        copyBtn.addEventListener('click', function(e) {
            e.preventDefault();
            copyReviewLink();
        });
    }
    
    const shareButtons = document.querySelectorAll('a[id^="share"]');
    shareButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            setTimeout(() => {
                closeSharePanel();
                showShareSuccessPopup();
            }, 800);
        });
    });
    
    const popup = document.getElementById('shareSuccessPopup');
    if (popup) {
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                closeSharePopup();
            }
        });
    }
    
    // FAQ TOGGLE
    window.toggleFaq = function(button) {
        const faqItem = button.parentElement;
        const isActive = faqItem.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-item').forEach(item => {
            item.classList.remove('active');
            const btn = item.querySelector('.faq-question');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        });
        
        // Toggle current item if it wasn't active
        if (!isActive) {
            faqItem.classList.add('active');
            button.setAttribute('aria-expanded', 'true');
        }
    };
    
    // Make review cards clickable
    document.querySelectorAll('.review-card').forEach(card => {
        const link = card.querySelector('a[href]');
        if (link) {
            card.style.cursor = 'pointer';
            
            card.addEventListener('click', function(e) {
                if (e.target.tagName === 'A' || e.target.closest('a')) {
                    return;
                }
                
                if (e.ctrlKey || e.metaKey) {
                    window.open(link.href, '_blank');
                } else {
                    window.location.href = link.href;
                }
            });
        }
    });
    
    // Performance: Lazy load images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px'
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
})();
</script>

@include('includes.footer')

{{-- Floating Bug Report Button --}}
@include('components.floating-bug-report')

</body>
</html>