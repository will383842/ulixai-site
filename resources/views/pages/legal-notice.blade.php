<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Legal Notice - ULIX AI</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
    }
    .section-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .section-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .nav-link {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
      transition: left 0.5s;
    }
    .nav-link:hover::before {
      left: 100%;
    }
    .breadcrumb {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

@include('includes.header')

@php
    $settings = \App\Models\SiteSetting::first();
    $legal = $settings->legal_info ?? [];
@endphp

<!-- Hero Section with Enhanced Design -->
<section class="gradient-bg relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25px 25px, white 2px, transparent 0); background-size: 50px 50px;"></div>
  </div>
  
  <div class="relative py-24 px-6 text-white text-center">
    <div class="max-w-4xl mx-auto">
      <!-- Breadcrumb Navigation -->
      <nav class="breadcrumb inline-flex items-center space-x-2 text-sm mb-8 px-4 py-2 rounded-full">
        <span class="opacity-75">Home</span>
        <span class="opacity-50">/</span>
        <span class="font-medium">Legal Notice</span>
      </nav>
      
      <!-- Hero Content -->
      <div class="text-6xl mb-6 animate-pulse">📜</div>
      <h1 class="text-5xl font-bold mb-4 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
        Legal Notice
      </h1>
      <p class="text-xl opacity-90 max-w-2xl mx-auto leading-relaxed">
        Understand your rights, responsibilities, and how we handle legal matters at {{ $settings->site_name ?? 'ULIX AI' }}.
      </p>
      
      <!-- Scroll Indicator -->
      <div class="mt-12">
        <div class="inline-flex items-center justify-center w-10 h-10 rounded-full border-2 border-white border-opacity-30 animate-bounce">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Main Content with Enhanced Layout -->
<section class="py-20 px-6 relative">
  <!-- Background Elements -->
  <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-blue-50 to-transparent opacity-50"></div>
  
  <div class="max-w-7xl mx-auto relative">
    <div class="flex flex-col lg:flex-row gap-12">

      <!-- Enhanced Sidebar Navigation -->
      <aside class="lg:w-1/3 xl:w-1/4">
        <div class="sticky top-28">
          <nav class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 backdrop-blur-sm">
            <div class="flex items-center mb-6">
              <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white text-sm font-bold mr-3">
                📋
              </div>
              <h3 class="text-xl font-bold text-blue-700">Contents</h3>
            </div>
            
            <ul class="space-y-3">
              <li>
                <a href="#publisher" class="nav-link flex items-center p-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="text-lg mr-3 group-hover:scale-110 transition-transform">📇</span>
                  <span class="font-medium">Publisher Information</span>
                </a>
              </li>
              <li>
                <a href="#ip" class="nav-link flex items-center p-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="text-lg mr-3 group-hover:scale-110 transition-transform">🧠</span>
                  <span class="font-medium">Intellectual Property</span>
                </a>
              </li>
              <li>
                <a href="#liability" class="nav-link flex items-center p-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="text-lg mr-3 group-hover:scale-110 transition-transform">⚖️</span>
                  <span class="font-medium">Liability Disclaimer</span>
                </a>
              </li>
              <li>
                <a href="#privacy" class="nav-link flex items-center p-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="text-lg mr-3 group-hover:scale-110 transition-transform">🔒</span>
                  <span class="font-medium">Privacy & Data Protection</span>
                </a>
              </li>
              <li>
                <a href="#law" class="nav-link flex items-center p-3 rounded-lg text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="text-lg mr-3 group-hover:scale-110 transition-transform">📚</span>
                  <span class="font-medium">Governing Law</span>
                </a>
              </li>
            </ul>
            
            <!-- Progress Indicator -->
            <div class="mt-8 pt-6 border-t border-gray-200">
              <div class="flex items-center text-sm text-gray-500 mb-2">
                <span>Reading Progress</span>
                <div class="flex-1 mx-3 h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300" style="width: 0%" id="progress-bar"></div>
                </div>
                <span id="progress-text">0%</span>
              </div>
            </div>
          </nav>
        </div>
      </aside>

      <!-- Enhanced Legal Content -->
      <div class="flex-1 space-y-12">
        
        <!-- Section 1: Publisher Information -->
        <div id="publisher" class="section-card bg-white p-10 rounded-3xl shadow-lg border border-gray-100" data-aos="fade-up" data-aos-delay="100">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mr-6 shadow-lg">
              📇
            </div>
            <div>
              <h2 class="text-3xl font-bold text-blue-700 mb-2">Publisher Information</h2>
              <p class="text-gray-500">Details about our company and legal entity</p>
            </div>
          </div>
          <div class="prose prose-lg text-gray-700 leading-relaxed">
              <p class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-500">
                  @php
                      $publisher = $legal['publisher'] ?? '';
                  @endphp

                  @if($publisher != strip_tags($publisher))
                      {{-- contains HTML, render raw --}}
                      {!! $publisher !!}
                  @else
                      {{-- plain text, escaped --}}
                      {{ $publisher }}
                  @endif
              </p>
          </div>

        </div>

        <!-- Section 2: Intellectual Property -->
        <div id="ip" class="section-card bg-white p-10 rounded-3xl shadow-lg border border-gray-100" data-aos="fade-up" data-aos-delay="200">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mr-6 shadow-lg">
              🧠
            </div>
            <div>
              <h2 class="text-3xl font-bold text-blue-700 mb-2">Intellectual Property</h2>
              <p class="text-gray-500">Our approach to intellectual property rights and usage</p>
            </div>
          </div>
          <div class="prose prose-lg text-gray-700 leading-relaxed">
            <p class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-500">
              @php
                  $ip = $legal['ip'] ?? '';
              @endphp

              @if($ip != strip_tags($ip))
                  {!! $ip !!}
              @else
                  {{-- plain text, escaped --}}
                  {{ $ip }}
              @endif
            </p>
          </div>
        </div>

        <!-- Section 3: Liability Disclaimer -->
        <div id="liability" class="section-card bg-white p-10 rounded-3xl shadow-lg border border-gray-100" data-aos="fade-up" data-aos-delay="300">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mr-6 shadow-lg">
              ⚖️
            </div>
            <div>
              <h2 class="text-3xl font-bold text-blue-700 mb-2">Liability Disclaimer</h2>
              <p class="text-gray-500">Important information about liability and responsibilities</p>
            </div>
          </div>
          <div class="prose prose-lg text-gray-700 leading-relaxed">
            <p class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-500">
              @php
                  $liability = $legal['liability'] ?? '';
              @endphp

              @if($liability != strip_tags($liability))
                  {!! $liability !!}
              @else
                  {{ $liability }}
              @endif
            </p>
          </div>
        </div>

        <!-- Section 4: Privacy and Data Protection -->
        <div id="privacy" class="section-card bg-white p-10 rounded-3xl shadow-lg border border-gray-100" data-aos="fade-up" data-aos-delay="400">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mr-6 shadow-lg">
              🔒
            </div>
            <div>
              <h2 class="text-3xl font-bold text-blue-700 mb-2">Privacy and Data Protection</h2>
              <p class="text-gray-500">How we handle your personal information and data</p>
            </div>
          </div>
          <div class="prose prose-lg text-gray-700 leading-relaxed">
            <p class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-500">
              @php
                  $privacy = $legal['privacy'] ?? '';
              @endphp

              @if($privacy != strip_tags($privacy))
                  {!! $privacy !!}
              @else
                  {{ $privacy }}
              @endif
            </p>
          </div>
        </div>

        <!-- Section 5: Governing Law -->
        <div id="law" class="section-card bg-white p-10 rounded-3xl shadow-lg border border-gray-100" data-aos="fade-up" data-aos-delay="500">
          <div class="flex items-start mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mr-6 shadow-lg">
              📚
            </div>
            <div>
              <h2 class="text-3xl font-bold text-blue-700 mb-2">Governing Law</h2>
              <p class="text-gray-500">Legal jurisdiction and applicable laws</p>
            </div>
          </div>
          <div class="prose prose-lg text-gray-700 leading-relaxed">
            <p class="bg-blue-50 p-6 rounded-xl border-l-4 border-blue-500">
              @php
                  $law = $legal['law'] ?? '';
              @endphp

              @if($law != strip_tags($law))
                  {!! $law !!}
              @else
                  {{ $law }}
              @endif
            </p>
          </div>
        </div>

        <!-- Contact Section -->
        {{-- <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-10 rounded-3xl text-white shadow-lg" data-aos="fade-up" data-aos-delay="600">
          <div class="text-center">
            <div class="text-4xl mb-4">📞</div>
            <h3 class="text-2xl font-bold mb-4">Have Questions?</h3>
            <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
              If you have any questions about these legal terms or need clarification on any point, please don't hesitate to contact our legal team.
            </p>
            <button class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors duration-300 shadow-lg">
              Contact Legal Team
            </button>
          </div>
        </div> --}}

      </div>
    </div>
  </div>
</section>

@include('includes.footer')

<!-- AOS Animation Script -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true,
    easing: 'ease-out-cubic'
  });

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Reading progress indicator
  function updateProgress() {
    const sections = document.querySelectorAll('[id]');
    const scrollPos = window.scrollY + window.innerHeight / 2;
    let currentSection = 0;
    
    sections.forEach((section, index) => {
      const rect = section.getBoundingClientRect();
      const sectionTop = rect.top + window.scrollY;
      
      if (scrollPos >= sectionTop) {
        currentSection = index + 1;
      }
    });
    
    const progress = Math.min((currentSection / sections.length) * 100, 100);
    document.getElementById('progress-bar').style.width = progress + '%';
    document.getElementById('progress-text').textContent = Math.round(progress) + '%';
  }

  window.addEventListener('scroll', updateProgress);
  updateProgress(); // Initial call
</script>

</body>
</html>