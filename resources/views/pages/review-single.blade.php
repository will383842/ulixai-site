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
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
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
        
        @keyframes pulse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-5%, 5%) scale(1.08); }
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
        
        .author-avatar-large {
            width: 5rem;
            height: 5rem;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--blue-light);
            box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.15);
            flex-shrink: 0;
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
        }
        
        .review-subtitle {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem;
            color: #6B7280;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        
        .review-subtitle-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }
        
        .review-subtitle-icon {
            width: 1.125rem;
            height: 1.125rem;
            color: var(--primary-blue);
        }
        
        .review-rating-large {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }
        
        .stars-large {
            display: flex;
            gap: 0.25rem;
        }
        
        .star-large {
            width: 1.5rem;
            height: 1.5rem;
            fill: #FBBF24;
        }
        
        .rating-text-large {
            font-size: 1.125rem;
            font-weight: 700;
            color: #1F2937;
        }
        
        .review-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.25rem;
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
        }
        
        .content-section-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .title-icon {
            width: 1.75rem;
            height: 1.75rem;
            color: var(--primary-blue);
        }
        
        .review-full-text {
            color: #374151;
            font-size: 1.0625rem;
            line-height: 1.8;
            white-space: pre-wrap;
            word-wrap: break-word;
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
        }
        
        .share-title {
            font-size: 1.375rem;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.75rem;
        }
        
        .share-subtitle {
            color: #6B7280;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }
        
        .share-buttons-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
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
            font-size: clamp(1.5rem, 4vw, 2rem);
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
            max-height: 800px;
        }
        
        /* RELATED REVIEWS */
        .related-reviews-section {
            padding: 3rem 0;
            background: white;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: clamp(1.5rem, 4vw, 2rem);
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 0.5rem;
        }
        
        .section-subtitle {
            font-size: clamp(0.9375rem, 2vw, 1.125rem);
            color: #6B7280;
        }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(min(300px, 100%), 1fr));
            gap: 1.25rem;
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
        }
        
        .review-card-link {
            display: block;
            padding: 1.25rem;
            text-decoration: none;
            color: inherit;
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
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-size: 0.9375rem;
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
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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
            }
            
            .review-full-text {
                font-size: 1rem;
            }
            
            .share-review-section {
                padding: 1.5rem;
            }
            
            .share-buttons-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .faq-section {
                padding: 2rem 1rem;
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
            }
            
            .review-badge {
                font-size: 0.75rem;
                padding: 0.4375rem 0.875rem;
            }
            
            .review-content-card {
                padding: 1.25rem;
                border-radius: 1.25rem;
            }
            
            .content-section-title {
                font-size: 1.25rem;
            }
            
            .share-buttons-grid {
                gap: 0.75rem;
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
@include('pages.popup')

<!-- FLOATING SHARE BUTTON -->
<button id="floatingShareBtn" onclick="shareReview()" aria-label="Share this review">
    <div class="share-icon-wrapper">
        <svg style="width: 1.125rem; height: 1.125rem;" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
        </svg>
    </div>
    <span>SHARE</span>
</button>

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
                
                <!-- SHARE SECTION -->
                <div class="share-review-section">
                    <h2 class="share-title">Found This Review Helpful?</h2>
                    <p class="share-subtitle">Share {{ $review['name'] }}'s story with others who might need {{ $review['service'] }} help!</p>
                    
                    <div class="share-buttons-grid">
                        <a 
                            href="#" 
                            id="shareWhatsApp"
                            class="share-btn share-btn-whatsapp" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            aria-label="Share on WhatsApp"
                        >
                            <i class="fab fa-whatsapp share-btn-icon" aria-hidden="true"></i>
                            <span>WhatsApp</span>
                        </a>
                        
                        <a 
                            href="#" 
                            id="shareFacebook"
                            class="share-btn share-btn-facebook" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            aria-label="Share on Facebook"
                        >
                            <i class="fab fa-facebook share-btn-icon" aria-hidden="true"></i>
                            <span>Facebook</span>
                        </a>
                        
                        <a 
                            href="#" 
                            id="shareTwitter"
                            class="share-btn share-btn-twitter" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            aria-label="Share on Twitter"
                        >
                            <i class="fab fa-x-twitter share-btn-icon" aria-hidden="true"></i>
                            <span>Twitter</span>
                        </a>
                        
                        <a 
                            href="#" 
                            id="shareLinkedIn"
                            class="share-btn share-btn-linkedin" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            aria-label="Share on LinkedIn"
                        >
                            <i class="fab fa-linkedin share-btn-icon" aria-hidden="true"></i>
                            <span>LinkedIn</span>
                        </a>
                        
                        <button 
                            id="copyLinkBtn"
                            class="share-btn share-btn-copy"
                            aria-label="Copy link to clipboard"
                        >
                            <i class="fas fa-link share-btn-icon" aria-hidden="true"></i>
                            <span>Copy Link</span>
                        </button>
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
    
    // FAQ TOGGLE
    window.toggleFaq = function(button) {
        const faqItem = button.parentElement;
        const isActive = faqItem.classList.contains('active');
        const wasExpanded = button.getAttribute('aria-expanded') === 'true';
        
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
    
    // SHARE FUNCTIONALITY
    const shareUrl = document.getElementById('reviewShareUrl')?.value || window.location.href;
    const reviewTitle = "{{ addslashes($review['name']) }}'s {{ addslashes($review['service']) }} Review";
    const reviewText = "{{ addslashes(Str::limit($review['shortText'], 100)) }}";
    
    const shareData = {
        title: reviewTitle,
        text: `Check out ${reviewTitle} on Ulixai: ${reviewText}`,
        url: shareUrl
    };
    
    // Native share for mobile
    window.shareReview = async function() {
        if (navigator.share) {
            try {
                await navigator.share(shareData);
            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('Share failed:', err);
                }
            }
        }
    };
    
    // Social share links
    const encodedUrl = encodeURIComponent(shareUrl);
    const encodedText = encodeURIComponent(shareData.text);
    const encodedTitle = encodeURIComponent(shareData.title);
    
    const shareLinks = {
        shareWhatsApp: `https://api.whatsapp.com/send?text=${encodedText}%20${encodedUrl}`,
        shareFacebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
        shareTwitter: `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodedText}`,
        shareLinkedIn: `https://www.linkedin.com/sharing/share-offsite/?url=${encodedUrl}`
    };
    
    // Set share links
    Object.entries(shareLinks).forEach(([id, href]) => {
        const link = document.getElementById(id);
        if (link) link.href = href;
    });
    
    // Copy link functionality
    const copyBtn = document.getElementById('copyLinkBtn');
    if (copyBtn) {
        copyBtn.addEventListener('click', async function(e) {
            e.preventDefault();
            
            try {
                if (navigator.clipboard) {
                    await navigator.clipboard.writeText(shareUrl);
                } else {
                    // Fallback for older browsers
                    const textarea = document.createElement('textarea');
                    textarea.value = shareUrl;
                    textarea.style.position = 'fixed';
                    textarea.style.opacity = '0';
                    document.body.appendChild(textarea);
                    textarea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textarea);
                }
                
                // Visual feedback
                const originalHTML = copyBtn.innerHTML;
                copyBtn.style.background = 'linear-gradient(135deg, #10B981, #059669)';
                copyBtn.innerHTML = `
                    <i class="fas fa-check share-btn-icon" aria-hidden="true"></i>
                    <span>Copied!</span>
                `;
                copyBtn.setAttribute('aria-label', 'Link copied to clipboard');
                
                setTimeout(() => {
                    copyBtn.style.background = '';
                    copyBtn.innerHTML = originalHTML;
                    copyBtn.setAttribute('aria-label', 'Copy link to clipboard');
                }, 2000);
                
            } catch (err) {
                console.error('Copy failed:', err);
                alert('Failed to copy link. Please copy manually: ' + shareUrl);
            }
        });
    }
    
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

</body>
</html>