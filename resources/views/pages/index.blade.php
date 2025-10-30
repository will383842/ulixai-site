<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <head>
  <title>Abroad Ease Guide - Your Global Companion</title>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MDVV9NX7');</script>
<!-- End Google Tag Manager -->
  <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
</head>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
@import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap');
</style>
  <!-- In the <head> -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  
  <style>
@font-face {
  font-family: 'Inter';
  src: url('font/Inter-Regular.woff2') format('woff2');
  font-weight: 400;
  font-style: normal;
}
/* #languageSelect,
#countrySelect {
    color: white !important;
} */


body {
  font-family: 'Inter', sans-serif;
}
html, body {
  overflow-x: hidden;
}






    
    /* Custom Animations */
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(3deg); }
    }
    
    @keyframes pulse-glow {
      0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
      50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
    }
    
    @keyframes slide-up {
      0% { opacity: 0; transform: translateY(50px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }
    
    @keyframes bounce-in {
      0% { transform: scale(0.3) rotate(-10deg); opacity: 0; }
      50% { transform: scale(1.05) rotate(5deg); }
      70% { transform: scale(0.9) rotate(-2deg); }
      100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    
    @keyframes orbit {
      0% { transform: rotate(0deg) translateX(20px) rotate(0deg); }
      100% { transform: rotate(360deg) translateX(20px) rotate(-360deg); }
    }
    
    @keyframes morph-blob {
      0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
      25% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
      50% { border-radius: 50% 60% 30% 60% / 30% 60% 70% 40%; }
      75% { border-radius: 60% 40% 60% 30% / 70% 30% 60% 70%; }
    }
    
    @keyframes fade-in {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    
    
    .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
    .animate-slide-up { animation: slide-up 0.8s ease-out forwards; }
    .animate-shimmer { animation: shimmer 3s linear infinite; }
    .animate-bounce-in { animation: bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards; }
    .animate-orbit { animation: orbit 8s linear infinite; }
    .animate-morph-blob { animation: morph-blob 6s ease-in-out infinite; }
    .animate-fade-in { animation: fade-in 0.8s ease-out forwards; }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .shimmer-text {
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
      background-size: 200% 100%;
    }
    
    .hover-lift {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .hover-lift:hover {
      transform: translateY(-8px) scale(1.05);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .feature-card {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      position: relative;
      overflow: hidden;
    }
    
    .feature-card:hover {
      transform: translateY(-20px) scale(1.05);
    }
    
    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.6s ease;
    }
    
    .feature-card:hover::before {
      left: 100%;
    }
    
    .gradient-bg {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 30%, #f1f5f9 60%, #e2e8f0 100%);
    }
    
    .mesh-pattern {
      background-image: 
        radial-gradient(circle at 25px 25px, rgba(59, 130, 246, 0.08) 2px, transparent 2px),
        radial-gradient(circle at 75px 75px, rgba(147, 51, 234, 0.06) 2px, transparent 2px);
      background-size: 100px 100px;
    }
    
    .popup-overlay {
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
    }
    
    .category-item:hover .popup-overlay {
      opacity: 1;
      visibility: visible;
    }
  </style>

   <style>
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-slide-up {
            animation: slideUp 0.8s ease-out forwards;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
        }
        
        .center-card {
            background: white ;
            border-radius: 20px;
            padding: 32px;
            color: black;
            text-align: center;
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3);
        }
    </style>


 <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .faq-content.active {
            max-height: 200px;
            animation: slideDown 0.4s ease-out forwards;
        }
        
        .faq-icon {
            transition: transform 0.3s ease;
        }
        
        .faq-toggle.active .faq-icon {
            transform: rotate(135deg);
        }
        
         .floating-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-shape:nth-child(2) { animation-delay: -2s; }
        .floating-shape:nth-child(3) { animation-delay: -4s; } 
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .bg-animated {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .number-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
            margin-right: 12px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
   <style>
        .search-popup {
             background: linear-gradient(135deg, #667eea 0%,rgb(55, 28, 129) 100%); 
        }
        .category-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .category-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

      .fade {
  transition: opacity 0.5s ease-in-out;
  opacity: 1;
}
.fade.out {
  opacity: 0;
}




    </style>

  

</head>

<body class="bg-gray-50 overflow-x-hidden w-full "  >
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MDVV9NX7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('includes.header')
 @include('pages.popup')




<section data-aos="fade-up" class="search-popup min-h-[600px] w-full flex items-center justify-center p-6 bg-blue-700 relative font-inter">
  <!-- Hero Content -->
  <div class="max-w-4xl mx-auto relative z-10">
    <div class="space-y-6 mb-12">
      <h1 class="text-4xl md:text-7xl font-bold mb-6 leading-tight text-white">
        <span>Need help? Want to help?</span><br>
    
      </h1>
    <p class="text-white/90 text-xl md:text-2xl mb-12 font-light leading-relaxed text-center">
   @site connects, expats and service provider worldwide
</p>

    </div>

    <!-- Search Box -->
    <div class="max-w-1xl mx-auto relative">
      <div class="flex items-center rounded-full overflow-hidden shadow-2xl border-2 border-white/20 bg-white/95 backdrop-blur-sm">
        <div class="flex-grow relative">
          <input
            id="searchInput"
             readonly
            type="text"
            placeholder="Search Here"
            class="w-full px-8 py-5 text-lg text-gray-700 bg-transparent focus:outline-none placeholder-gray-500"
            onclick="openHelpPopup()"
            
          />
          <div class="absolute left-6 top-1/2 transform -translate-y-1/2 text-gray-400">
        
          </div>
        </div>
        <button
          id=""
          
          class="w-16 h-16 rounded-full bg-blue-700 hover:bg-blue-800 flex items-center justify-center text-white mr-2 transition-colors"
          aria-label="Search"
        >
          <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
          </svg>
        </button>
      </div>
    </div>
  </div>





  <div class="hidden md:block absolute left-1/2 bottom-0 translate-y-1/2 -translate-x-1/2 z-20 w-full max-w-5xl px-4">
    <div class="bg-white rounded-2xl shadow-2xl py-6 px-6 backdrop-blur-sm border border-gray-100 relative">
        
        <button id="prevBtn" class="absolute left-2 top-1/2 -translate-y-1/2 z-30 bg-blue-600 hover:bg-blue-700 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg transition-all duration-300 opacity-50 hover:opacity-100" onclick="slideCategories('prev')">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="nextBtn" class="absolute right-2 top-1/2 -translate-y-1/2 z-30 bg-blue-600 hover:bg-blue-700 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg transition-all duration-300 opacity-50 hover:opacity-100" onclick="slideCategories('next')">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        <div class="overflow-hidden mx-12">
            <div id="categoryContainer" class="flex transition-transform duration-500 ease-in-out space-x-6">
                @foreach($category as $index => $cat)
                <div class="group relative flex-shrink-0">
                    <div class="flex flex-col items-center space-y-3 p-4 rounded-2xl bg-white hover:bg-gray-50 transition-all duration-300 justify-center cursor-pointer hover:shadow-lg min-w-[120px]">
                        <div class="relative">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center shadow-lg transition-shadow duration-300 pointer-events-none select-none">
                @if($cat->icon_image)
                    <img src="{{ $cat->icon_image }}" 
                        alt="{{ $cat->name }}" 
                        class="w-full h-full object-cover rounded-full">
                @else
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14,6V4H10V6H9A2,2 0 0,0 7,8V19A2,2 0 0,0 9,21H15
                                    A2,2 0 0,0 17,19V8A2,2 0 0,0 15,6H14M12,7
                                    A2,2 0 0,1 14,9A2,2 0 0,1 12,11A2,2 0 0,1 10,9
                                    A2,2 0 0,1 12,7Z"/>
                        </svg>
                    </div>
                @endif
            </div>


                        </div>
                        <span class="text-sm text-gray-800 font-semibold group-hover:text-purple-600 transition-colors text-center">{{$cat->name}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

      
        <div class="flex justify-center mt-4 space-x-2" id="pagination">
        
        </div>
    </div>
  </div>

</section>


 @php
    use App\Models\Country; 
    $countries = Country::where('status', 1)->pluck('country');
    $languages = [
        'English', 'French', 'Spanish', 'Portuguese', 'German', 
        'Italian', 'Arabic', 'Japanese', 'Korean', 'Hindi', 'Turkish'
    ];
@endphp

<div class="mt-0 sm:mt-[100px]">

<section class="max-w-7xl mx-auto px-4 py-8">
  
    <div class="text-center mb-8">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-blue-500 mb-2">
            All your service needs worldwide
        </h1>
    </div>
  
    <div class="flex flex-wrap justify-center items-center gap-4 mb-8 bg-white p-4 rounded-lg shadow-sm">       
    
        <select id="languageSelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white">
            @foreach($languages as $lang)
              <option value="{{ $lang }}" class="text-black">{{ $lang }}</option> <!-- Add class text-white here -->
            @endforeach
        </select>

        <select id="countrySelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white  ">
            @foreach($countries as $country)
              <option value="{{ $country }}"  style="color: black !important;">{{ $country }}</option> <!-- Add class text-white here -->
            @endforeach
        </select>
       
        <select id="categorySelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white">
            <option value="">Select Category</option>
            @foreach($category as $cat)
              <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach  
        </select>

        <select id="subcategorySelect" class="border border-blue-200 rounded-lg px-4 py-2 min-w-[150px] text-blue-900 bg-white hidden">
            <option value="">Select Sub-category</option>
         
        </select>
        
        <button id="filterButton" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-150">
            Filter
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="serviceGrid">
    
        @foreach ($providers as $provider)
            @php
                $avgRating = round($provider->reviews()->avg('rating') ?? 5);
                $reviewCount = $provider->reviews()->count();
                $statuses = json_decode($provider->special_status, true) ?? [];
            @endphp

            <a href="{{ route('provider-details', ['id' => $provider->slug]) }}" 
              class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-gray-200 transition-all duration-300 hover:-translate-y-1 block">
                
          @php
    $src = trim((string)($provider->profile_photo ?? ''));
    $fallback = asset('images/attachment.png');
    $path = $src ? parse_url($src, PHP_URL_PATH) : '';
    $ext  = $path ? strtolower(pathinfo($path, PATHINFO_EXTENSION)) : null;
    $isSvg = $ext === 'svg';
@endphp

<div class="relative aspect-[4/5] sm:aspect-[3/4] md:aspect-[4/5] w-full overflow-hidden min-h-[220px] rounded-xl">
    <img
        src="{{ $src ?: $fallback }}"
        alt="Profile image"
        class="absolute inset-0 w-full h-full {{ $isSvg ? 'object-contain bg-white p-6' : 'object-cover' }}"
        onerror="this.onerror=null;this.src='{{ $fallback }}';"
    />




                                
                    <!-- Gradient Overlay for Better Text Readability -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-black/10"></div>
                    
                    <!-- Country and Service Type -->
                    <div class="absolute top-3 left-3 flex items-center gap-2 flex-wrap">
                        @if($provider->country)
                            <div class="flex items-center bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 shadow-sm">
                                <img src="https://flagcdn.com/w20/{{ strtolower(substr($provider->country, 0, 2)) }}.png" 
                                    alt="{{ $provider->country }} Flag" 
                                    class="w-4 h-3 mr-1.5 rounded-sm"
                                    onerror="this.style.display='none'">
                                <span class="text-xs font-medium text-gray-700">{{ $provider->country }}</span>
                            </div>
                        @else
                            <span class="bg-blue-600/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-medium shadow-sm">
                                Visas
                            </span>
                        @endif
                    </div>

                    <!-- Language Badge -->
                    @if($provider->preferred_language)
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-white/90 backdrop-blur-sm text-gray-800 px-3 py-1.5 rounded-lg text-xs font-medium shadow-sm border border-white/20">
                                {{ $provider->preferred_language }}
                            </span>
                        </div>
                    @endif

                    <!-- Online Status Indicator -->
                    <div class="absolute top-3 right-3">
                        <div class="w-3 h-3 bg-green-400 rounded-full border-2 border-white shadow-sm animate-pulse"></div>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-4 sm:p-5">
                    <!-- Provider Name and Rating -->
                    <div class="flex items-start justify-between mb-3">
                        <div class="min-w-0 flex-1">
                            <h3 class="font-bold text-lg text-gray-900 truncate">
                                {{ $provider->first_name ?? 'Provider' }}
                                @if($provider->last_name)
                                    {{ substr($provider->last_name, 0, 1) }}.
                                @endif
                            </h3>
                            
                            <!-- Rating -->
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 mr-2">
                                    @php
                                        $rating = $provider->reviews()->avg('rating') ?? 5.0;
                                        $fullStars = floor($rating);
                                        $hasHalfStar = $rating - $fullStars >= 0.5;
                                    @endphp
                                    
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @elseif ($i == $fullStars + 1 && $hasHalfStar)
                                            <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20">
                                                <defs>
                                                    <linearGradient id="half-star">
                                                        <stop offset="50%" stop-color="currentColor"/>
                                                        <stop offset="50%" stop-color="#e5e7eb"/>
                                                    </linearGradient>
                                                </defs>
                                                <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-gray-300" viewBox="0 0 20 20">
                                                <path fill="currentColor" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ number_format($rating, 1) }}</span>
                                <span class="text-sm text-gray-500 ml-1">({{ $reviewCount ?? 0 }})</span>
                            </div>
                        </div>
                        
                        <!-- Price or Verified Badge -->
                        <div class="ml-3 flex-shrink-0">
                            <div class="flex items-center bg-green-50 border border-green-200 rounded-lg px-2 py-1">
                                <svg class="w-3 h-3 text-green-600 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-xs font-medium text-green-700">Verified</span>
                            </div>
                        </div>
                    </div>

                    <!-- Operational Countries -->
                    @php 
                        $operationalCountriesRaw = $provider->operational_countries ?? [];
                        if (is_string($operationalCountriesRaw)) {
                            $operationalCountries = json_decode($operationalCountriesRaw, true) ?? [];
                        } else {
                            $operationalCountries = $operationalCountriesRaw;
                        }
                    @endphp

                    @if(!empty($operationalCountries))
                        <div class="mb-4">
                            <p class="text-xs font-medium text-gray-500 mb-2">Operational Countries</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(array_slice($operationalCountries, 0, 3) as $country)
                                    <span class="bg-gray-50 border border-gray-200 text-gray-700 px-2.5 py-1 rounded-md text-xs font-medium">
                                        {{ $country }}
                                    </span>
                                @endforeach
                                @if(count($operationalCountries) > 3)
                                    <span class="bg-blue-50 border border-blue-200 text-blue-700 px-2.5 py-1 rounded-md text-xs font-medium">
                                        +{{ count($operationalCountries) - 3 }} more
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Service Categories/Statuses -->
                    @if(isset($statuses) && !empty($statuses))
                        <div class="pt-3 border-t border-gray-100">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(array_slice($statuses, 0, 2) as $index => $status)
                                    <span class="bg-blue-50 border border-blue-200 text-blue-700 px-2.5 py-1 rounded-md text-xs font-medium">
                                        {{ $index }}
                                    </span>
                                @endforeach
                                @if(count($statuses) > 2)
                                    <span class="bg-gray-50 border border-gray-200 text-gray-600 px-2.5 py-1 rounded-md text-xs font-medium">
                                        +{{ count($statuses) - 2 }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Hover Effect Indicator -->
                <div class="absolute inset-0 border-2 border-transparent group-hover:border-blue-200 rounded-xl transition-colors duration-300 pointer-events-none"></div>
            </a>
        @endforeach

    </div>
</section>





<!-- Remove this spacer if not needed -->
  <!-- <div class="block sm:hidden h-16"></div> -->
  <!-- Enhanced Features Section -->
  <section data-aos="fade-left" class="relative gradient-bg py-24 px-4 overflow-hidden mt-2 ">

    <!-- Decorative Background -->
    <div class="absolute inset-0 overflow-hidden mesh-pattern opacity-40"></div>
    
    <!-- Floating Orbs -->
    <div class="absolute top-20 left-10 w-24 h-24 bg-blue-200/30 animate-morph-blob"></div>
    <div class="absolute top-40 right-20 w-32 h-32 bg-purple-200/20 " style="animation-delay: 2s;"></div>
    <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-blue-100/40 animate-morph-blob" style="animation-delay: 4s;"></div>
    
    <div class="max-w-7xl mx-auto relative z-10">
      <!-- Section Header -->
      <div class="text-center mb-20">
        <div class="inline-block relative">
          <h2 class="text-5xl font-bold text-gray-800 mb-6 animate-slide-up">Why Choose Us</h2>
          <div class="absolute -inset-4 bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-blue-600/20 blur-xl opacity-60 animate-pulse-glow"></div>
        </div>
        <div class="w-40 h-1.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 mx-auto rounded-full animate-slide-up mb-8" style="animation-delay: 0.2s;"></div>
        <p class="text-gray-600 text-xl max-w-2xl mx-auto animate-slide-up" style="animation-delay: 0.4s;">
          Because we are the only platform that centralizes all you abroad needs , all in one place  Verified Providers that you choose yourself and rates that are much lower then traditional solutions 
        </p>
      </div>
      
      <!-- Features Grid -->
      <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- Feature 1: Users -->
        <div class="feature-card bg-white/80 backdrop-blur-sm p-8 rounded-3xl text-center animate-slide-up group border border-gray-100 hover:border-blue-200 transition-all duration-300" style="animation-delay: 0.1s;">
          <div class="relative mb-8">
            <div class="relative w-20 h-20 mx-auto">
              <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center animate-pulse-glow group-hover:scale-110 transition-transform duration-300 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m3 0a4 4 0 016 0m6 0V7a4 4 0 00-4-4H7a4 4 0 00-4 4v7a4 4 0 004 4zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <div class="absolute top-0 left-1/2 w-3 h-3 bg-blue-300 rounded-full animate-orbit"></div>
            </div>
          </div>
          
          <div class="space-y-3">
            <h3 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">5,000+</h3>
            <p class="text-gray-700 font-bold text-lg">Happy Users</p>
            <p class="text-sm text-gray-500 leading-relaxed">Global community of satisfied customers worldwide</p>
          </div>
        </div>

        <!-- Feature 2: Verified -->
        <div class="feature-card bg-white/80 backdrop-blur-sm p-8 rounded-3xl text-center animate-slide-up group border border-gray-100 hover:border-green-200 transition-all duration-300" style="animation-delay: 0.2s;">
          <div class="relative mb-8">
            <div class="relative w-20 h-20 mx-auto">
              <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-700 rounded-2xl flex items-center justify-center animate-pulse-glow group-hover:scale-110 transition-transform duration-300 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
              <div class="absolute top-0 left-1/2 w-3 h-3 bg-green-300 rounded-full animate-orbit" style="animation-delay: 1s;"></div>
            </div>
          </div>
          
          <div class="space-y-3">
            <h3 class="text-3xl font-bold text-green-600">100%</h3>
            <p class="text-gray-700 font-bold text-lg">Verified</p>
            <p class="text-sm text-gray-500 leading-relaxed">All providers thoroughly vetted and certified</p>
          </div>
        </div>

        <!-- Feature 3: Security -->
        <div class="feature-card bg-white/80 backdrop-blur-sm p-8 rounded-3xl text-center animate-slide-up group border border-gray-100 hover:border-yellow-200 transition-all duration-300" style="animation-delay: 0.3s;">
          <div class="relative mb-8">
            <div class="relative w-20 h-20 mx-auto">
              <div class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-orange-700 rounded-2xl flex items-center justify-center animate-pulse-glow group-hover:scale-110 transition-transform duration-300 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <div class="absolute top-0 left-1/2 w-3 h-3 bg-yellow-300 rounded-full animate-orbit" style="animation-delay: 2s;"></div>
            </div>
          </div>
          
          <div class="space-y-3">
            <h3 class="text-3xl font-bold text-yellow-600">SSL</h3>
            <p class="text-gray-700 font-bold text-lg">Secure</p>
            <p class="text-sm text-gray-500 leading-relaxed">256-bit encryption for maximum security</p>
          </div>
        </div>

        <!-- Feature 4: Support -->
        <div class="feature-card bg-white/80 backdrop-blur-sm p-8 rounded-3xl text-center animate-slide-up group border border-gray-100 hover:border-purple-200 transition-all duration-300" style="animation-delay: 0.4s;">
          <div class="relative mb-8">
            <div class="relative w-20 h-20 mx-auto">
              <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-700 rounded-2xl flex items-center justify-center animate-pulse-glow group-hover:scale-110 transition-transform duration-300 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
              </div>
              <div class="absolute top-0 left-1/2 w-3 h-3 bg-purple-300 rounded-full animate-orbit" style="animation-delay: 3s;"></div>
            </div>
          </div>
          
          <div class="space-y-3">
            <h3 class="text-3xl font-bold text-purple-600">24/7</h3>
            <p class="text-gray-700 font-bold text-lg">Service</p>
            <p class="text-sm text-gray-500 leading-relaxed">Around the world</p>
          </div>
        </div>

      </div>
      
      <!-- Bottom CTA -->
      <div class="mt-20 text-center">
        <div class="inline-flex items-center space-x-4 bg-white/80 backdrop-blur-sm px-8 py-4 rounded-2xl border border-gray-100 shadow-lg">
          <div class="flex space-x-2">
            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
            <div class="w-3 h-3 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
          </div>
          <span class="text-gray-700 font-semibold">Trusted by thousands worldwide</span>
        </div>
      </div>
    </div>
  </section>

 <!-- How it works -->
<section data-aos="fade-right" class="bg-blue-50 py-16 px-4">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-gray-900 mb-10">How does it work?</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">

      <!-- Step 1 -->
      <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.1s;">
        <div class="flex justify-center mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Describe your situation</h3>
        <p class="text-gray-600 leading-relaxed">
          Request help for free in 2 minutes
        </p>
      </div>

      <!-- Step 2 -->
      <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="flex justify-center mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-700 rounded-2xl flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Choose between 2 solutions</h3>
        <ul class="text-gray-600 space-y-2 text-left">
          <li class="flex items-start"><span class="text-orange-500 mr-2 mt-1">•</span> One or more service provider see your request for help</li>
          <li class="flex items-start"><span class="text-orange-500 mr-2 mt-1">•</span> And offer you their rates to meet your needs</li>
        </ul>
      </div>

      <!-- Step 3 -->
      <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.3s;">
        <div class="flex justify-center mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">You Choose your Service</h3>
        <ul class="text-gray-600 space-y-2 text-left">
          <li class="flex items-start"><span class="text-purple-500 mr-2 mt-1">✔</span> You choose the service provider you prefer based on their price, review, and skills</li>
        </ul>
      </div>

      <!-- Step 4 -->
      <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.4s;">
        <div class="flex justify-center mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-700 rounded-2xl flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 8l7-4 7 4"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">In Progress</h3>
        <p class="text-gray-600 leading-relaxed">
          The Service Provider carries out the Mission
        </p>
      </div>

      <!-- Step 5 -->
      <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.5s;">
        <div class="flex justify-center mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-2xl flex items-center justify-center">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 21V7"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Review the Work</h3>
        <p class="text-gray-600 leading-relaxed">
          your note and trigger payment to the service provider 
        </p>
      </div>

    </div>
  </div>
</section>


    <!-- Testimonials Section -->
    <section data-aos="fade-zoom-in" class="bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 py-20 px-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                
                <!-- Left Column - Top and Bottom Testimonials -->
                <div class="space-y-8">
                    <!-- Top Left Testimonial -->
                    <div class="testimonial-card animate-slide-up h-[300px]" style="animation-delay: 0.1s;">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User photo" class="w-12 h-12 rounded-full object-cover"/>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">Visa issue at the airport</h3>
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            I was about to board my flight when I realized my visa had errors. Thanks to  @site, I got a personalized file in under 10 minutes and solved everything. What a relief!
                        </p>
                    </div>
                    
                    <!-- Bottom Left Testimonial -->
                    <div class="testimonial-card animate-slide-up h-[300px]" style="animation-delay: 0.4s;">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User photo" class="w-12 h-12 rounded-full object-cover"/>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">Blocked by the local police</h3>
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            I was stuck in a country where no one spoke English.  @site sent me the exact documents to show, and I was able to resolve the situation peacefully.
                        </p>
                    </div>
                </div>
                
                <!-- Center Column - Main Image and Featured Review -->
                <div class="space-y-8">
                    <!-- Center Image -->
                    <div class="flex justify-center animate-slide-up h-[400px]" style="animation-delay: 0.2s;">
                        <div class="w-80 h-150 bg-gradient-to-br from-blue-300 to-blue-500 rounded-2xl shadow-2xl border-4 border-white flex items-center justify-center overflow-hidden">
                            <img src="images/centerReview.png" alt="Woman smiling" class="w-full h-full object-cover"/>
                        </div>
                    </div>
                    
                    <!-- Center Featured Review -->
                    <div class="center-card animate-slide-up h-[300px]" style="animation-delay: 0.5s;">
                        <h3 class="text-2xl font-bold mb-4">Remarquable</h3>
                        <div class="text-yellow-300 text-xl mb-4">★★★★★</div>
                        <p class="text-black/90 leading-relaxed">
                            En moins de 10 minutes, j'ai retrouvé un poids en moins sur les épaules.  @site m'a aidé à trouver toutes les solutions adaptées à ma situation.
                            <br><br>
                            <strong class="text-yellow-700">Un immense soulagement.</strong>
                        </p>
                    </div>
                </div>
                
                <!-- Right Column - Top and Bottom Testimonials -->
                <div class="space-y-8">
                    <!-- Top Right Testimonial -->
                    <div class="testimonial-card animate-slide-up h-[300px]" style="animation-delay: 0.3s;">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="User photo" class="w-12 h-12 rounded-full object-cover"/>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">Mon passeport volé</h3>
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Voler son passeport dans un pays inconnu est un cauchemar.  @site m'a guidé étape par étape pour refaire mes papiers et m'en sortir sans galère.
                        </p>
                    </div>
                    
                    <!-- Bottom Right Testimonial -->
                    <div class="testimonial-card animate-slide-up h-[300px]" style="animation-delay: 0.6s;">
                        <div class="flex items-center space-x-3 mb-4">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="User photo" class="w-12 h-12 rounded-full object-cover"/>
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">Démarches administratives</h3>
                                <div class="text-yellow-400 text-sm">★★★★★</div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Toutes les démarches compliquées pour s'installer à l'étranger sont devenues faciles grâce à  @site. Un vrai changement de vie.
                        </p>
                    </div>
                </div>
                
            </div>
            
        </div>
    </section>



          <!-- Maps Section -->
    @include('pages.ulixai-map')


  <!-- News Section (Desktop only) -->
<section data-aos="fade-zoom-out" class="hidden md:block bg-white py-16 px-4">
  <div class="max-w-7xl mx-auto">
    <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Latest News</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
      
      <!-- News Card 1 -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.1s;">
        <div class="w-full h-48 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-4xl">
          🍺
        </div>
        <div class="p-6">
          <a href="https://blog.ulixai.com/" class="text-blue-700 font-semibold text-lg block hover:underline transition-colors">
            Incredible Secrets for a Globetrotter's Temporary Residency
          </a>
          <p class="text-gray-500 mt-3 text-sm">May 25, 2025</p>
        </div>
      </div>

      <!-- News Card 2 -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-4xl">
          🍂
        </div>
        <div class="p-6">
          <a href="https://blog.ulixai.com/" class="text-blue-700 font-semibold text-lg block hover:underline transition-colors">
            Step-by-Step Guide: Leaving a Country Quickly and Efficiently
          </a>
          <p class="text-gray-500 mt-3 text-sm">May 25, 2025</p>
        </div>
      </div>

      <!-- News Card 3 -->
      <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-slide-up" style="animation-delay: 0.3s;">
        <div class="w-full h-48 bg-gradient-to-br from-yellow-400 to-orange-400 flex items-center justify-center text-4xl">
          🏜️
        </div>
        <div class="p-6">
          <a href="https://blog.ulixai.com/" class="text-blue-700 font-semibold text-lg block hover:underline transition-colors">
            Essential Tip: Avoid Traps with  @site
          </a>
          <p class="text-gray-500 mt-3 text-sm">May 25, 2025</p>
        </div>
      </div>

    </div>
  </div>
</section>


<section  data-aos="fade-flip-lef" t class="relative py-20 px-4 min-h-screen flex items-center bg-white">
  <div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="text-6xl font-black mb-4 text-blue-600">Frequently Asked</h1>
      <h2 class="text-6xl font-black mb-6 text-black">Questions</h2>
      <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
      <p class="text-xl text-gray-700 mt-6 max-w-2xl mx-auto">
        Everything you need to know about our services, answered with clarity and precision.
      </p>
    </div>

    <!-- FAQ Container -->
    <div class="space-y-2" id="faq-container">
        @foreach($faqs as $i => $faq)
        <div class="card-hover glass-effect rounded-2xl overflow-hidden group border border-gray-200 bg-white">
          <button class="w-full flex items-center p-4 text-left font-bold text-black faq-toggle hover:bg-gray-100 transition-all duration-300">
            <div class="number-badge mr-4 text-white">{{ $i + 1 }}</div>
            <span class="flex-1 text-xl">{{ $faq->question }}</span>
            <div class="faq-icon text-3xl text-gray-600 font-light">+</div>
          </button>
          <div class="faq-content px-8 pb-0 text-gray-800">
            <div class="pb-8 pt-4 border-t border-gray-200">
              <p class="text-lg leading-relaxed">
                {{ $faq->answer }}
              </p>
            </div>
          </div>
        </div>
        @endforeach
    </div>
  </div>
</section>



@include('includes.footer')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".faq-toggle").forEach((btn) => {
      btn.addEventListener("click", () => {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector(".faq-icon");

        const isOpen = content.classList.contains("active");

        // Close all other contents
        document.querySelectorAll(".faq-content").forEach((item) => {
          item.style.maxHeight = null;
          item.classList.remove("active");
        });

        // Reset icons
        document.querySelectorAll(".faq-icon").forEach((item) => {
          item.textContent = "+";
        });

        // If it was already open, close and return
        if (isOpen) return;

        // Open current content
        content.classList.add("active");
        content.style.maxHeight = content.scrollHeight + "px"; // dynamically set height
        icon.textContent = "–";
      });
    });
  });
</script>
<script>
  // FAQ Toggle Functionality
  const faqToggles = document.querySelectorAll('.faq-toggle');

  faqToggles.forEach((toggle, index) => {
      toggle.addEventListener('click', () => {
          const content = toggle.nextElementSibling;
          const isActive = toggle.classList.contains('active');

          // Close all other FAQ items
          faqToggles.forEach((otherToggle, otherIndex) => {
              if (otherIndex !== index) {
                  const otherContent = otherToggle.nextElementSibling;
                  otherToggle.classList.remove('active');
                  otherContent.classList.remove('active');
              }
          });

          // Toggle current FAQ item
          if (isActive) {
              toggle.classList.remove('active');
              content.classList.remove('active');
          } else {
              toggle.classList.add('active');
              content.classList.add('active');
          }
      });
  });


</script>

     <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slideDown': 'slideDown 0.3s ease-out',
                        'slideUp': 'slideUp 0.3s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(59, 130, 246, 0.5)' },
                            '100%': { boxShadow: '0 0 40px rgba(59, 130, 246, 0.8)' }
                        },
                        slideDown: {
                            '0%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '1', maxHeight: '200px', transform: 'translateY(0)' },
                            '100%': { opacity: '0', maxHeight: '0', transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
<script>
  function toggleExpatPopup() {
    const popup = document.getElementById("expat-popup");
    popup.classList.toggle("hidden");
  }
</script>

<script>
  function toggleCategoryPopup() {
    const popup = document.getElementById("search-category-popup");
    popup.classList.toggle("hidden");
  }
</script>






<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>


<!-- JS -->
{{-- <script>
  function toggleRefugeePopup() {
    const popup = document.getElementById("refugeePopup");
    popup.classList.toggle("opacity-0");
    popup.classList.toggle("invisible");
    popup.classList.toggle("scale-95");
    popup.classList.toggle("scale-100");
  }

  
  document.addEventListener("click", function (event) {
    const trigger = event.target.closest('[onclick="toggleRefugeePopup()"]');
    const popup = document.getElementById("refugeePopup");
    if (!popup.contains(event.target) && !trigger) {
      popup.classList.add("opacity-0", "invisible", "scale-95");
      popup.classList.remove("scale-100");
    }
  });
</script> --}}

<script>
      // Event listener for category select
      // Event listener for category select
document.getElementById('categorySelect').addEventListener('change', function() {
    var categoryId = this.value;
    var subcategorySelect = document.getElementById('subcategorySelect');
    
    if (categoryId) {
        // Fetch subcategories based on the selected category
        fetch(`/get-subcategories/${categoryId}`)
            .then(response => response.json())
            .then(subcategories => {
                // Populate the subcategory dropdown
                subcategorySelect.innerHTML = '<option value="">Select Sub-category</option>';  // Clear previous options
                
                subcategories.forEach(function(subcategory) {
                    var option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });
                
                // Show the subcategory select
                subcategorySelect.classList.remove('hidden');
            });
    } else {
        // Hide the subcategory dropdown if no category is selected
        subcategorySelect.classList.add('hidden');
    }
});

// Event listener for the "Filter" button to load providers
document.getElementById('filterButton').addEventListener('click', function() {
    var categoryId = document.getElementById('categorySelect').value;
    var subcategoryId = document.getElementById('subcategorySelect').value;
    var language = document.getElementById('languageSelect').value;
    var country = document.getElementById('countrySelect').value;

    // Fetch providers based on selected filters (category, subcategory, country, language)
    fetch(`/get-providers?category_id=${categoryId}&subcategory_id=${subcategoryId}&country=${country}&language=${language}`)
        .then(response => response.json())
        .then(providers => {
            // Render providers in the service grid
            const serviceGrid = document.getElementById('serviceGrid');
            serviceGrid.innerHTML = '';  // Clear previous providers

            if (providers.length > 0) {
                providers.forEach(function(provider) {
                    // Parse special_status if it's a stringified JSON
                    let specialStatus = provider.special_status ? JSON.parse(provider.special_status) : [];

                    const providerCard = document.createElement('div');
                    providerCard.className = 'bg-white rounded-3xl card-hover relative overflow-hidden shadow-xl border border-blue-100';

                    providerCard.innerHTML = `
                      <div class="absolute top-0 right-0 w-24 h-24 bg-blue-100 rounded-bl-3xl opacity-20"></div>
                      ${provider.urgent ? 
                        '<div class="absolute top-4 right-4 w-3 h-3 bg-blue-500 rounded-full pulse-animation"></div>' : ''}
                      <div class="relative z-10">
                        <a href="/provider-details/${provider.id}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow cursor:pointer">
                            <div class="relative aspect-[9/12] w-full">
                                <img src="${provider.profile_photo ?? 'images/attachment.png'}" 
                                    alt="profile" class="absolute inset-0 w-full h-full object-cover">

                                <div class="absolute top-2 left-2 flex items-center flex-wrap">
                                    <img src="https://flagcdn.com/w20/th.png" alt="Thailand Flag" class="w-4 h-3 mr-1">
                                  
                                    <span class="bg-blue-600 text-white px-2 py-1 rounded text-xs">${provider.country ?? 'Visas'}</span>
                                </div>

                                <div class="absolute bottom-2 left-2">
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">${provider.preferred_language ?? 'English'}</span>
                                </div>
                            </div>

                            <div class="p-4">
                                <div class="flex items-center mb-2">
                                    <h3 class="font-semibold text-lg">${provider.first_name ?? '_'}</h3>
                                    <span class="ml-auto text-lg font-semibold">45€/h</span>
                                </div>

                                <p class="text-gray-600 text-sm mb-2">Country service: ${provider.operational_countries}</p>

                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400">
                                        ${[1, 2, 3, 4, 5].map(i => 
                                            i <= provider.avgRating ? 
                                            '<i class="fas fa-star"></i>' : 
                                            '<i class="far fa-star"></i>'
                                        ).join('')}
                                    </div>
                                    <span class="text-sm text-gray-600 ml-2">${provider.avgRating} (${provider.reviewCount} Reviews)</span>
                                </div>

                                <div class="flex gap-2 text-xs text-gray-500">
                                  ${Object.keys(specialStatus).map(statusKey => 
                                      `<span class="bg-gray-100 px-2 py-1 rounded">${statusKey}</span>`
                                  ).join('')}
                                </div>
                            </div>
                        </a>
                      </div>
                    `;
                    serviceGrid.appendChild(providerCard);
                });
            } else {
                serviceGrid.innerHTML = '<p>No providers found.</p>';
            }
        });
});


</script>

<script>
  let providers = [];
  let filterCategory = [];
  let filterCountry = [];
  let filterLanguage = [];
        
        // Country code to flag emoji mapping
        const countryFlags = {
            'US': '🇺🇸', 'UK': '🇬🇧', 'GB': '🇬🇧', 'CA': '🇨🇦', 'AU': '🇦🇺', 
            'DE': '🇩🇪', 'FR': '🇫🇷', 'PK': '🇵🇰', 'IN': '🇮🇳', 'CN': '🇨🇳',
            'JP': '🇯🇵', 'KR': '🇰🇷', 'ES': '🇪🇸', 'IT': '🇮🇹', 'BR': '🇧🇷',
            'MX': '🇲🇽', 'RU': '🇷🇺', 'SA': '🇸🇦', 'AE': '🇦🇪', 'EG': '🇪🇬'
        };

        // Category mapping for better display
        const categoryMapping = {
            'legal': 'Legal Services',
            'translation': 'Translation',
            'consulting': 'Business Consulting',
            'healthcare': 'Healthcare',
            'education': 'Education',
            'technology': 'Technology',
            'finance': 'Finance',
            'marketing': 'Marketing'
        };

        // Language code to name mapping
        const languageNames = {
            'en': 'English', 'es': 'Spanish', 'fr': 'French', 'de': 'German',
            'it': 'Italian', 'pt': 'Portuguese', 'ru': 'Russian', 'zh': 'Chinese',
            'ja': 'Japanese', 'ko': 'Korean', 'ar': 'Arabic', 'ur': 'Urdu',
            'hi': 'Hindi', 'bn': 'Bengali', 'tr': 'Turkish', 'nl': 'Dutch'
        };

        // Generate badge based on provider data
        function generateBadge(provider) {
            const reviewCount = provider.reviews_count || 0;
            const avgRating = provider.average_rating || 0;
            
            if (reviewCount > 100 && avgRating >= 4.8) return 'Diamond';
            if (reviewCount > 50 && avgRating >= 4.5) return 'Expert';
            if (reviewCount > 20 && avgRating >= 4.0) return 'Pro';
            if (provider.special_status && provider.special_status.length > 0) return 'Certified';
            return 'Verified';
        }

        // Get coordinates for country/city (you'll need to implement geocoding)
        function getCoordinates(country, address) {
            // This is a simplified mapping - you should implement proper geocoding
            const countryCoords = {
                'Afghanistan': [33.9391, 67.7100],
                'Albania': [41.1533, 20.1683],
                'Algeria': [28.0339, 1.6596],
                'Andorra': [42.5063, 1.5218],
                'Angola': [-11.2027, 17.8739],
                'Argentina': [-38.4161, -63.6167],
                'Armenia': [40.0691, 45.0382],
                'Australia': [-25.2744, 133.7751],
                'Austria': [47.5162, 14.5501],
                'Azerbaijan': [40.1431, 47.5769],
                'Bahamas': [25.0343, -77.3963],
                'Bahrain': [25.9304, 50.6378],
                'Bangladesh': [23.6850, 90.3563],
                'Barbados': [13.1939, -59.5432],
                'Belarus': [53.7098, 27.9534],
                'Belgium': [50.5039, 4.4699],
                'Belize': [17.1899, -88.4976],
                'Benin': [9.3077, 2.3158],
                'Bhutan': [27.5142, 90.4336],
                'Bolivia': [-16.2902, -63.5887],
                'Bosnia and Herzegovina': [43.9159, 17.6791],
                'Botswana': [-22.3285, 24.6849],
                'Brazil': [-14.2350, -51.9253],
                'Brunei': [4.5353, 114.7277],
                'Bulgaria': [42.7339, 25.4858],
                'Burkina Faso': [12.2383, -1.5616],
                'Burundi': [-3.3731, 29.9189],
                'Cabo Verde': [16.5388, -24.0132],
                'Cambodia': [12.5657, 104.9910],
                'Cameroon': [7.3697, 12.3547],
                'Canada': [56.1304, -106.3468],
                'Central African Republic': [6.6111, 20.9394],
                'Chad': [15.4542, 18.7322],
                'Chile': [-35.6751, -71.5430],
                'China': [35.8617, 104.1954],
                'Colombia': [4.5709, -74.2973],
                'Comoros': [-11.6455, 43.3333],
                'Congo': [-0.2280, 15.8277],
                'Costa Rica': [9.7489, -83.7534],
                'Croatia': [45.1000, 15.2000],
                'Cuba': [21.5218, -77.7812],
                'Cyprus': [35.1264, 33.4299],
                'Czech Republic': [49.8175, 15.4730],
                'Denmark': [56.2639, 9.5018],
                'Djibouti': [11.8251, 42.5903],
                'Dominica': [15.4140, -61.3710],
                'Dominican Republic': [18.7357, -70.1627],
                'Ecuador': [-1.8312, -78.1834],
                'Egypt': [26.0975, 30.0444],
                'El Salvador': [13.7942, -88.8965],
                'Equatorial Guinea': [1.6508, 10.2679],
                'Eritrea': [15.1794, 39.7823],
                'Estonia': [58.5953, 25.0136],
                'Eswatini': [-26.5225, 31.4659],
                'Ethiopia': [9.1450, 40.4897],
                'Fiji': [-16.7784, 179.4144],
                'Finland': [61.9241, 25.7482],
                'France': [46.6034, 1.8883],
                'Gabon': [-0.8037, 11.6094],
                'Gambia': [13.4432, -15.3101],
                'Georgia': [42.3154, 43.3569],
                'Germany': [51.1657, 10.4515],
                'Ghana': [7.9465, -1.0232],
                'Greece': [39.0742, 21.8243],
                'Grenada': [12.1165, -61.6790],
                'Guatemala': [15.7835, -90.2308],
                'Guinea': [9.9456, -9.6966],
                'Guinea-Bissau': [11.8037, -15.1804],
                'Guyana': [4.8604, -58.9302],
                'Haiti': [18.9712, -72.2852],
                'Honduras': [15.2000, -86.2419],
                'Hungary': [47.1625, 19.5033],
                'Iceland': [64.9631, -19.0208],
                'India': [20.5937, 78.9629],
                'Indonesia': [-0.7893, 113.9213],
                'Iran': [32.4279, 53.6880],
                'Iraq': [33.2232, 43.6793],
                'Ireland': [53.4129, -8.2439],
                'Israel': [31.0461, 34.8516],
                'Italy': [41.8719, 12.5674],
                'Jamaica': [18.1096, -77.2975],
                'Japan': [36.2048, 138.2529],
                'Jordan': [30.5852, 36.2384],
                'Kazakhstan': [48.0196, 66.9237],
                'Kenya': [-0.0236, 37.9062],
                'Kiribati': [-3.3704, -168.7340],
                'Kuwait': [29.3117, 47.4818],
                'Kyrgyzstan': [41.2044, 74.7661],
                'Laos': [19.8563, 102.4955],
                'Latvia': [56.8796, 24.6032],
                'Lebanon': [33.8547, 35.8623],
                'Lesotho': [-29.6100, 28.2336],
                'Liberia': [6.4281, -9.4295],
                'Libya': [26.3351, 17.2283],
                'Liechtenstein': [47.1660, 9.5554],
                'Lithuania': [55.1694, 23.8813],
                'Luxembourg': [49.8153, 6.1296],
                'Madagascar': [-18.7669, 46.8691],
                'Malawi': [-13.2543, 34.3015],
                'Malaysia': [4.2105, 101.9758],
                'Maldives': [3.2028, 73.2207],
                'Mali': [17.5707, -3.9962],
                'Malta': [35.9375, 14.3754],
                'Marshall Islands': [7.1315, 171.1845],
                'Mauritania': [21.0079, -10.9408],
                'Mauritius': [-20.3484, 57.5522],
                'Mexico': [23.6345, -102.5528],
                'Micronesia': [7.4256, 150.5508],
                'Moldova': [47.4116, 28.3699],
                'Monaco': [43.7384, 7.4246],
                'Mongolia': [46.8625, 103.8467],
                'Montenegro': [42.7087, 19.3744],
                'Morocco': [31.7917, -7.0926],
                'Mozambique': [-18.6657, 35.5296],
                'Myanmar': [21.9162, 95.9560],
                'Namibia': [-22.9576, 18.4904],
                'Nauru': [-0.5228, 166.9315],
                'Nepal': [28.3949, 84.1240],
                'Netherlands': [52.1326, 5.2913],
                'New Zealand': [-40.9006, 174.8860],
                'Nicaragua': [12.2650, -85.2072],
                'Niger': [17.6078, 8.0817],
                'Nigeria': [9.0820, 8.6753],
                'North Korea': [40.3399, 127.5101],
                'North Macedonia': [41.6086, 21.7453],
                'Norway': [60.4720, 8.4689],
                'Oman': [21.4735, 55.9754],
                'Pakistan': [30.3753, 69.3451],
                'Palau': [7.5150, 134.5825],
                'Palestine': [31.9522, 35.2332],
                'Panama': [8.5380, -80.7821],
                'Papua New Guinea': [-6.3140, 143.9555],
                'Paraguay': [-23.4425, -58.4438],
                'Peru': [-9.1900, -75.0152],
                'Philippines': [12.8797, 121.7740],
                'Poland': [51.9194, 19.1451],
                'Portugal': [39.3999, -8.2245],
                'Qatar': [25.3548, 51.1839],
                'Romania': [45.9432, 24.9668],
                'Russia': [61.5240, 105.3188],
                'Rwanda': [-1.9403, 29.8739],
                'Saint Kitts and Nevis': [17.3578, -62.7830],
                'Saint Lucia': [13.9094, -60.9789],
                'Saint Vincent and the Grenadines': [12.9843, -61.2872],
                'Samoa': [-13.7590, -172.1046],
                'San Marino': [43.9424, 12.4578],
                'Sao Tome and Principe': [0.1864, 6.6131],
                'Saudi Arabia': [23.8859, 45.0792],
                'Senegal': [14.4974, -14.4524],
                'Serbia': [44.0165, 21.0059],
                'Seychelles': [-4.6796, 55.4920],
                'Sierra Leone': [8.4606, -11.7799],
                'Singapore': [1.3521, 103.8198],
                'Slovakia': [48.6690, 19.6990],
                'Slovenia': [46.1512, 14.9955],
                'Solomon Islands': [-9.6457, 160.1562],
                'Somalia': [5.1521, 46.1996],
                'South Africa': [-30.5595, 22.9375],
                'South Korea': [35.9078, 127.7669],
                'South Sudan': [6.8770, 31.3070],
                'Spain': [40.4637, -3.7492],
                'Sri Lanka': [7.8731, 80.7718],
                'Sudan': [12.8628, 30.2176],
                'Suriname': [3.9193, -56.0278],
                'Sweden': [60.1282, 18.6435],
                'Switzerland': [46.8182, 8.2275],
                'Syria': [34.8021, 38.9968],
                'Taiwan': [23.6978, 120.9605],
                'Tajikistan': [38.8610, 71.2761],
                'Tanzania': [-6.3690, 34.8888],
                'Thailand': [15.8700, 100.9925],
                'Timor-Leste': [-8.8742, 125.7275],
                'Togo': [8.6195, 0.8248],
                'Tonga': [-21.1789, -175.1982],
                'Trinidad and Tobago': [10.6918, -61.2225],
                'Tunisia': [33.8869, 9.5375],
                'Turkey': [38.9637, 35.2433],
                'Turkmenistan': [38.9697, 59.5563],
                'Tuvalu': [-7.1095, 177.6493],
                'Uganda': [1.3733, 32.2903],
                'Ukraine': [48.3794, 31.1656],
                'United Arab Emirates': [23.4241, 53.8478],
                'United Kingdom': [55.3781, -3.4360],
                'United States': [39.8283, -98.5795],
                'Uruguay': [-32.5228, -55.7658],
                'Uzbekistan': [41.3775, 64.5853],
                'Vanuatu': [-15.3767, 166.9592],
                'Vatican City': [41.9029, 12.4534],
                'Venezuela': [6.4238, -66.5897],
                'Vietnam': [14.0583, 108.2772],
                'Yemen': [15.5527, 48.5164],
                'Zambia': [-13.1339, 27.8493],
                'Zimbabwe': [-19.0154, 29.1549]
            };
            
            // Add some random offset for better visualization
            const baseCoords = countryCoords[country] || [0, 0];
            return [
                baseCoords[0] + (Math.random() - 0.5) * 5, // Add some random offset
                baseCoords[1] + (Math.random() - 0.5) * 5
            ];
        }

        // Load providers from API
        async function loadProviders() {
            try {
                const response = await fetch('/api/providers/map', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Failed to load providers');
                }
                
                const data = await response.json();
                filterCategory = data.filters.categories;
                filterCountry = data.filters.countries;
                filterLanguage = data.filters.languages;
                // Transform API data to match our map format
                providers = data.data.map(provider => {
                    let coords = [0, 0];
                    if (provider.city_coords) {
                        let cityCoords = provider.city_coords;
                        if (typeof cityCoords === 'string') {
                            try {
                                cityCoords = JSON.parse(cityCoords);
                            } catch (e) {
                                cityCoords = null;
                            }
                        }
                        if (Array.isArray(cityCoords) && cityCoords.length === 2) {
                            coords = [
                                parseFloat(cityCoords[0]) + (Math.random() - 0.5) * 0.1,
                                parseFloat(cityCoords[1]) + (Math.random() - 0.5) * 0.1
                            ];
                        }
                    } else if (provider.country_coords) {
                        let countryCoords = provider.country_coords;
                        if (typeof countryCoords === 'string') {
                            try {
                                countryCoords = JSON.parse(countryCoords);
                            } catch (e) {
                                countryCoords = null;
                            }
                        }
                        if (Array.isArray(countryCoords) && countryCoords.length === 2) {
                            coords = [
                                parseFloat(countryCoords[0]) + (Math.random() - 0.5) * 2,
                                parseFloat(countryCoords[1]) + (Math.random() - 0.5) * 2
                            ];
                        }
                    } else {
                        coords = getCoordinates(provider.country, provider.provider_address);
                    }
                    const spokenLanguages = provider.spoken_language || [];
                    const reviewCount = provider.reviews_count || 0;
                    const avgRating = provider.average_rating || 0;
                    return {
                        id: provider.id,
                        firstName: provider.first_name,
                        lastName: provider.last_name,
                        profession: provider.services_to_offer_category || 'Service Provider',
                        country: provider.country,
                        countryFlag: countryFlags[provider.country] || '🌍',
                        city: extractCity(provider.provider_address),
                        address: provider.provider_address,
                        lat: coords[0],
                        lng: coords[1],
                        photo: provider.profile_photo ||'/images/default-avatar.png',
                        languages: spokenLanguages,
                        languageNames: spokenLanguages.map(lang => languageNames[lang] || lang.toUpperCase()),
                        category: provider.services_to_offer_category || 'general',
                        categoryName: categoryMapping[provider.services_to_offer_category] || provider.services_to_offer_category,
                        badge: generateBadge(provider),
                        rating: avgRating,
                        reviews: reviewCount,
                        slug: provider.slug,
                        description: provider.profile_description,
                        nativeLanguage: provider.native_language,
                        operationalCountries: provider.operational_countries || [],
                        communicationOnline: provider.communication_online,
                        communicationInperson: provider.communication_inperson,
                        specialStatus: provider.special_status || []
                    };
                });
                
                // Initialize map with loaded providers
                addMarkersToMap(providers);
                filteredProviders = [...providers];
                
                // Update filter options based on loaded data
                updateFilterOptions();
                
            } catch (error) {
                console.error('Error loading providers:', error);
                
                // Fallback: Show error message or use sample data
                document.getElementById('map').innerHTML = `
                    <div class="flex items-center justify-center h-full bg-gray-100 rounded-2xl">
                        <div class="text-center">
                            <div class="text-red-500 mb-4">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Unable to load providers</h3>
                            <p class="text-gray-600 mb-4">Please check your connection and try again.</p>
                            <button onclick="loadProviders()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Retry
                            </button>
                        </div>
                    </div>
                `;
            }
        }

        // Extract city from address string
        function extractCity(address) {
            if (!address) return 'Unknown';
            
            // Simple extraction - you might want to improve this
            const parts = address.split(',');
            return parts[0].trim();
        }

        // Update filter options based on available data
        function updateFilterOptions() {
            const countries = [...new Set(filterCountry)];
            const categories = [...new Set(filterCategory)];
            const languages = [...new Set(filterLanguage)];
            
            // Update country filter
            const countrySelect = document.getElementById('countryFilter');
            countrySelect.innerHTML = '<option value="">All Countries</option>';
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country;
                 option.style.color = 'black'; 
                option.textContent = `${countryFlags[country] || '🌍'} ${country}`;
                countrySelect.appendChild(option);
            });
            
            // Update category filter
            const categorySelect = document.getElementById('categoryFilter');
            categorySelect.innerHTML = '<option value="">All Categories</option>';
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.style.color = 'black'; 
                option.textContent = categoryMapping[category] || category;
                categorySelect.appendChild(option);
            });
            
            // Update language filter
            const languageSelect = document.getElementById('languageFilter');
            languageSelect.innerHTML = '<option value="">All Languages</option>';
            languages.forEach(lang => {
                const option = document.createElement('option');
                option.value = lang;
                option.style.color = 'black'; 
                option.textContent = languageNames[lang] || lang.toUpperCase();
                languageSelect.appendChild(option);
            });
        }

        // Initialize map
        const map = L.map('map').setView([30, 0], 2);
        
        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Store markers for filtering
        let markers = [];
        let filteredProviders = [...providers];

        // Create custom marker icon
        function createMarkerIcon(provider) {
            const badgeColors = {
                'Diamond': 'bg-blue-500',
                'Expert': 'bg-purple-500',
                'Pro': 'bg-green-500',
                'Certified': 'bg-yellow-500',
                'Verified': 'bg-red-500',
                'Mentor': 'bg-indigo-500'
            };
            
            const badgeColor = badgeColors[provider.badge] || 'bg-gray-500';
            
            return L.divIcon({
                className: 'custom-marker',
                html: `
                    <div class="relative w-12 h-12 ${badgeColor} rounded-full flex items-center justify-center text-white font-bold shadow-lg border-2 border-white">
                        <img src="${provider.photo}" class="w-10 h-10 rounded-full object-cover" alt="${provider.firstName}">
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                `,
                iconSize: [48, 48],
                iconAnchor: [24, 24]
            });
        }

        // Create popup content
        function createPopupContent(provider) {
            const rating = provider.rating > 0 ? provider.rating.toFixed(1) : 'New';
            const reviewsText = provider.reviews === 0 ? 'No reviews yet' : provider.reviews;
            const ratingDisplay = provider.rating > 0 ? 
                `<div class="flex items-center space-x-1">
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="text-sm font-medium">${rating}</span>
                    <span class="text-sm text-gray-500">(${reviewsText})</span>
                </div>` : 
                `<span class="text-sm text-gray-500">New provider</span>`;

            return `
                <div class="w-80 p-4">
                    <div class="flex items-start space-x-4">
                        <img src="${provider.photo}" 
                             class="w-16 h-16 rounded-full object-cover shadow-lg" 
                             alt="${provider.firstName}"
                            >
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="text-lg font-bold text-gray-900">${provider.firstName} ${provider.lastName}</h3>
                                <span class="text-xl">${provider.countryFlag}</span>
                            </div>
                            <p class="text-blue-600 font-semibold mb-1">${provider.profession}</p>
                            <p class="text-gray-600 text-sm mb-2">${provider.city}, ${provider.country}</p>
                            
                            <div class="flex items-center space-x-4 mb-3">
                                ${ratingDisplay}
                                <div class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                                    ${provider.badge}
                                </div>
                            </div>
                            
                            ${provider.description ? `
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">${provider.description.substring(0, 100)}${provider.description.length > 100 ? '...' : ''}</p>
                            ` : ''}
                            
                            <div class="flex flex-wrap gap-1 mb-3">
                                ${provider.languageNames.map(lang => `
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">${lang}</span>
                                `).join('')}
                            </div>
                            
                            <div class="flex items-center space-x-4 mb-3 text-xs text-gray-500">
                                ${provider.communicationOnline ? '<span class="flex items-center"><span class="w-2 h-2 bg-green-400 rounded-full mr-1"></span>Online</span>' : ''}
                                ${provider.communicationInperson ? '<span class="flex items-center"><span class="w-2 h-2 bg-blue-400 rounded-full mr-1"></span>In-person</span>' : ''}
                            </div>
                            
                            <div class="flex space-x-2">
                                <button onclick="viewProvider('${provider.slug}')" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    View Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Provider action functions
        function viewProvider(providerId) {
            window.open(`/provider/${providerId}`, '_blank');
        }

        function contactProvider(providerId) {
            // window.open(`/contact/${providerId}`, '_blank');
        }

        // Add markers to map
        function addMarkersToMap(providersList) {
            // Clear existing markers
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];
    providersList.forEach(provider => {
        const marker = L.marker([provider.lat, provider.lng], {
            icon: createMarkerIcon(provider)
        }).addTo(map);

        marker.bindPopup(createPopupContent(provider), {
            className: 'custom-popup',
            maxWidth: 350,
            minWidth: 320
        });

        markers.push(marker);
    });

    // Update provider count
    document.getElementById('providerCount').textContent = providersList.length;
    document.getElementById('fetch_providers').value = JSON.stringify(providersList.map(provider => provider.slug));
}

// Filter functionality
function applyFilters() {
    const country = document.getElementById('countryFilter').value;
    const city = document.getElementById('cityFilter').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    const language = document.getElementById('languageFilter').value;

    filteredProviders = providers.filter(provider => {
        return (!country || provider.country === country) &&
                (!city || provider.city.toLowerCase().includes(city)) &&
                (!category || provider.category.includes(category)) &&
                (!language || provider.languages.includes(language));
    });

    addMarkersToMap(filteredProviders);
    updateActiveFilters();
}

// Update active filters display
function updateActiveFilters() {
    const activeFilters = document.getElementById('activeFilters');
    activeFilters.innerHTML = '';

    const filters = [
        { id: 'countryFilter', label: 'Country' },
        { id: 'cityFilter', label: 'City' },
        { id: 'categoryFilter', label: 'Category' },
        { id: 'languageFilter', label: 'Language' }
    ];

    filters.forEach(filter => {
        const element = document.getElementById(filter.id);
        const value = element.value;
        if (value) {
            const chip = document.createElement('div');
            chip.className = 'filter-chip bg-blue-500 text-white px-3 py-1 rounded-full text-sm flex items-center space-x-2';
            chip.innerHTML = `
                <span>${filter.label}: ${value}</span>
                <button class="text-blue-200 hover:text-white" onclick="clearFilter('${filter.id}')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            activeFilters.appendChild(chip);
        }
    });
}

// Clear individual filter
function clearFilter(filterId) {
    document.getElementById(filterId).value = '';
    applyFilters();
}

// Event listeners for filters
document.getElementById('countryFilter').addEventListener('change', applyFilters);
document.getElementById('cityFilter').addEventListener('input', applyFilters);
document.getElementById('categoryFilter').addEventListener('change', applyFilters);
document.getElementById('languageFilter').addEventListener('change', applyFilters);

// Reset view button
document.getElementById('resetView').addEventListener('click', () => {
    map.setView([30, 0], 2);
});

// Fullscreen button
document.getElementById('fullscreen').addEventListener('click', () => {
    const mapContainer = document.getElementById('map');
    if (mapContainer.requestFullscreen) {
        mapContainer.requestFullscreen();
    }
});

// Initialize map with all providers
loadProviders();

// Adjust map size on window resize
window.addEventListener('resize', () => {
    map.invalidateSize();
});
</script>

<script>
  let currentSlide = 0;
  const itemsPerSlide = 5; // Number of items visible at once
  const totalCategories = {{count($category)}};
  const totalSlides = Math.max(1, totalCategories - itemsPerSlide + 1);
  const containerWidth = 120 + 24; // item width + gap

  function slideCategories(direction) {
      const container = document.getElementById('categoryContainer');
      
      if (direction === 'next' && currentSlide < totalSlides - 1) {
          currentSlide++;
      } else if (direction === 'prev' && currentSlide > 0) {
          currentSlide--;
      }
      
      const translateX = currentSlide * containerWidth;
      container.style.transform = `translateX(-${translateX}px)`;
      
      updatePagination();
      updateArrows();
  }

  function updateArrows() {
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      
      // Hide/show arrows based on current slide
      prevBtn.style.opacity = currentSlide === 0 ? '0.3' : '0.7';
      nextBtn.style.opacity = currentSlide >= totalSlides - 1 ? '0.3' : '0.7';
      
      prevBtn.style.pointerEvents = currentSlide === 0 ? 'none' : 'auto';
      nextBtn.style.pointerEvents = currentSlide >= totalSlides - 1 ? 'none' : 'auto';
  }

  function updatePagination() {
      const pagination = document.getElementById('pagination');
      
      // Only show pagination if there are more categories than can fit
      if (totalCategories <= itemsPerSlide) {
          pagination.style.display = 'none';
          return;
      }
      
      pagination.innerHTML = '';
      const totalDots = Math.ceil(totalSlides / 5); // Reduce number of dots
      
      for (let i = 0; i < totalDots; i++) {
          const dot = document.createElement('button');
          dot.className = `w-2 h-2 rounded-full transition-all duration-300 ${
              Math.floor(currentSlide / 5) === i ? 'bg-blue-600' : 'bg-gray-300 hover:bg-gray-400'
          }`;
          dot.onclick = () => goToSlide(i * 5);
          pagination.appendChild(dot);
      }
  }

  function goToSlide(slideIndex) {
      currentSlide = Math.min(slideIndex, totalSlides - 1);
      const container = document.getElementById('categoryContainer');
      const translateX = currentSlide * containerWidth;
      container.style.transform = `translateX(-${translateX}px)`;
      
      updatePagination();
      updateArrows();
  }

  // Initialize on page load
  document.addEventListener('DOMContentLoaded', function() {
      updatePagination();
      updateArrows();
      
      // Auto-hide arrows if all categories fit in one view
      if (totalCategories <= itemsPerSlide) {
          document.getElementById('prevBtn').style.display = 'none';
          document.getElementById('nextBtn').style.display = 'none';
          document.getElementById('pagination').style.display = 'none';
      }
  });

  // Optional: Add keyboard navigation
  document.addEventListener('keydown', function(e) {
      if (e.key === 'ArrowLeft') {
          slideCategories('prev');
      } else if (e.key === 'ArrowRight') {
          slideCategories('next');
      }
  });

  // Optional: Add touch/swipe support
  let startX = 0;
  let endX = 0;

  document.getElementById('categoryContainer').addEventListener('touchstart', function(e) {
      startX = e.touches[0].clientX;
  });

  document.getElementById('categoryContainer').addEventListener('touchend', function(e) {
      endX = e.changedTouches[0].clientX;
      handleSwipe();
  });

  function handleSwipe() {
      const threshold = 50; // Minimum swipe distance
      const diff = startX - endX;
      
      if (Math.abs(diff) > threshold) {
          if (diff > 0) {
              slideCategories('next'); // Swipe left - go to next
          } else {
              slideCategories('prev'); // Swipe right - go to previous
          }
      }
  }
</script>



</body>
</html>