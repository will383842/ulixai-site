<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('images/faviccon.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Dynamic -->
    <title>{{ $review['name'] }} Review - {{ $review['service'] }} in {{ $review['country'] }} | Ulixai</title>
    <meta name="description" content="Read {{ $review['name'] }}'s experience with Ulixai's {{ $review['service'] }} service in {{ $review['country'] }}. Verified review.">
    
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
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body>

@include('includes.header')

<!-- Breadcrumb -->
<nav class="max-w-5xl mx-auto px-4 py-6" aria-label="Breadcrumb">
    <ol class="flex items-center gap-2 text-sm">
        <li><a href="/" class="text-blue-600 hover:text-blue-700">Home</a></li>
        <li class="text-gray-400">/</li>
        <li><a href="{{ route('reviews.index') }}" class="text-blue-600 hover:text-blue-700">Reviews</a></li>
        <li class="text-gray-400">/</li>
        <li class="text-gray-600">{{ $review['name'] }}</li>
    </ol>
</nav>

<!-- Main Content -->
<article class="max-w-5xl mx-auto px-4 pb-16">
    
    <!-- Back Button -->
    <a href="{{ route('reviews.index') }}" 
       class="inline-flex items-center gap-2 text-blue-600 font-semibold mb-8 hover:text-blue-700 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to All Reviews
    </a>
    
    <!-- Review Card -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8 pb-6 border-b border-gray-200">
            <img 
                src="{{ $review['image'] }}" 
                alt="{{ $review['name'] }}"
                class="w-32 h-32 rounded-full ring-4 ring-blue-100 shadow-xl object-cover"
            />
            
            <div class="flex-1">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                    {{ $review['name'] }}
                </h1>
                
                <div class="flex items-center gap-3 mb-3">
                    <span class="text-3xl">{{ $review['flag'] }}</span>
                    <span class="text-gray-600 text-lg">
                        {{ $review['nationality'] }} • {{ $review['country'] }}
                    </span>
                </div>
                
                <!-- Stars -->
                <div class="flex items-center gap-2 mb-3">
                    <div class="flex text-yellow-400 text-2xl">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <span>★</span>
                        @endfor
                    </div>
                    <span class="text-gray-600 font-semibold">{{ $review['rating'] }}.0/5</span>
                </div>
                
                <!-- Date -->
                <time class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($review['date'])->format('F j, Y') }}
                </time>
            </div>
        </div>
        
        <!-- Service Badge -->
        <div class="mb-8">
            <span class="inline-block bg-blue-100 text-blue-800 border-2 border-blue-200 rounded-full px-6 py-2 text-base font-bold">
                📋 {{ $review['service'] }}
            </span>
        </div>
        
        <!-- Full Review Text -->
        <div class="prose prose-lg max-w-none mb-8">
            <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line">
                {{ $review['fullText'] }}
            </p>
        </div>
        
        <!-- Verified Badge -->
        <div class="pt-6 border-t border-gray-200">
            <div class="inline-flex items-center gap-2 bg-green-50 border-2 border-green-200 rounded-full px-4 py-2">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-green-800 font-semibold text-sm">Verified Customer</span>
            </div>
        </div>
        
    </div>
    
    <!-- CTA -->
    <div class="mt-12 text-center bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-12 text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-xl mb-6 text-blue-100">
            Experience the same quality service that {{ $review['name'] }} enjoyed
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" 
               class="inline-flex items-center justify-center gap-3 bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-bold hover:bg-blue-50 transition-all shadow-2xl">
                <span>Explore Services</span>
                <span class="text-2xl">🌍</span>
            </a>
            
            <a href="https://sos-expat.com" 
               target="_blank"
               rel="noopener"
               class="inline-flex items-center justify-center gap-3 bg-red-500 text-white px-8 py-4 rounded-full text-lg font-bold hover:bg-red-600 transition-all shadow-2xl">
                <span>Get Help Now</span>
                <span class="text-2xl">🆘</span>
            </a>
        </div>
    </div>
    
</article>

@include('includes.footer')

</body>
</html>