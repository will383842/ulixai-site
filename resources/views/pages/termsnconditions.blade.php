<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Terms & Conditions - ULIX AI</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .gradient-bg {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
    }
    .section-card {
      transition: all 0.3s ease;
      border-left: 4px solid transparent;
    }
    .section-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      border-left-color: #3b82f6;
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
    .nav-link.active {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      color: white;
      font-weight: 600;
      transform: translateX(8px);
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }
    .breadcrumb {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .floating-toc {
      backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid rgba(59, 130, 246, 0.1);
    }
    .section-number {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      font-weight: 800;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

@include('includes.header')

<!-- Hero Section -->
<section class="gradient-bg relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25px 25px, white 2px, transparent 0); background-size: 50px 50px;"></div>
  </div>
  
  <div class="relative py-20 px-6 text-white text-center">
    <div class="max-w-4xl mx-auto">
      <!-- Breadcrumb Navigation -->
      <nav class="breadcrumb inline-flex items-center space-x-2 text-sm mb-8 px-4 py-2 rounded-full">
        <span class="opacity-75">Home</span>
        <span class="opacity-50">/</span>
        <span class="font-medium">Terms & Conditions</span>
      </nav>
      
      <!-- Hero Content -->
      <div class="text-5xl mb-6">📋</div>
      <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
        Terms & Conditions
      </h1>
      <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto leading-relaxed mb-6">
        Please read these terms carefully. By using ULIX AI, you agree to be bound by these conditions.
      </p>
      <div class="inline-flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2 text-sm">
        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
        Updated May 2025
      </div>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="py-16 px-4 md:px-6">
  <div class="max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-8">

      <!-- Enhanced Sidebar Navigation -->
      <aside class="lg:w-80">
        <div class="sticky top-24">
          <!-- Mobile Toggle Button -->
          <button class="lg:hidden w-full bg-white rounded-xl shadow-lg p-4 mb-4 flex items-center justify-between text-blue-700 font-semibold" onclick="toggleMobileTOC()">
            <span>📋 Table of Contents</span>
            <svg class="w-5 h-5 transform transition-transform" id="toc-arrow" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>

          <!-- Table of Contents -->
          <nav class="floating-toc hidden lg:block rounded-2xl shadow-xl p-6" id="toc-nav">
            <div class="flex items-center mb-6">
              <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white text-lg font-bold mr-3">
                📋
              </div>
              <h3 class="text-lg font-bold text-blue-700">Table of Contents</h3>
            </div>
            
            <ul class="space-y-2 text-sm" id="toc-list">
              <li>
                <a href="#section1" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group active">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">1</span>
                  <span class="font-medium">Accepting the terms</span>
                </a>
              </li>
              <li>
                <a href="#section2" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">2</span>
                  <span class="font-medium">Changes to terms</span>
                </a>
              </li>
              <li>
                <a href="#section3" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">3</span>
                  <span class="font-medium">Using our product</span>
                </a>
              </li>
              <li>
                <a href="#section4" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">4</span>
                  <span class="font-medium">General restrictions</span>
                </a>
              </li>
              <li>
                <a href="#section5" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">5</span>
                  <span class="font-medium">Content policy</span>
                </a>
              </li>
              <li>
                <a href="#section6" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">6</span>
                  <span class="font-medium">Your rights</span>
                </a>
              </li>
              <li>
                <a href="#section7" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">7</span>
                  <span class="font-medium">Copyright policy</span>
                </a>
              </li>
              <li>
                <a href="#section8" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-50 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">8</span>
                  <span class="font-medium">Relationship guidelines</span>
                </a>
              </li>
              <li>
                <a href="#section9" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">9</span>
                  <span class="font-medium">Liability Policy</span>
                </a>
              </li>
              <li>
                <a href="#section10" class="nav-link flex items-center p-3 rounded-xl text-gray-700 hover:text-blue-700 hover:bg-blue-50 transition-all duration-300 group">
                  <span class="section-number text-lg font-bold mr-3 min-w-[24px]">10</span>
                  <span class="font-medium">General legal terms</span>
                </a>
              </li>
            </ul>

            <!-- Progress Indicator -->
            <div class="mt-6 pt-6 border-t border-gray-200">
              <div class="flex items-center text-sm text-gray-500 mb-2">
                <span>Reading Progress</span>
                <div class="flex-1 mx-3 h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300" style="width: 10%" id="progress-bar"></div>
                </div>
                <span id="progress-text">10%</span>
              </div>
            </div>
          </nav>
        </div>
      </aside>

      <!-- Enhanced Terms Content -->
      <main class="flex-1">
        <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12">
          
          <!-- Header Section -->
          <div class="mb-12 pb-8 border-b border-gray-200">
            <div class="flex items-start justify-between mb-6">
              <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Terms of Service</h1>
                <p class="text-gray-500 flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                  </svg>
                  Last updated: May 2025
                </p>
              </div>
              <div class="hidden md:block">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl text-sm font-medium shadow-lg">
                  <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Legal Document
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Summary Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
              <h3 class="text-lg font-semibold text-blue-900 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                Key Points
              </h3>
              <p class="text-blue-800 leading-relaxed">
                By using ULIX AI's platform, you agree to these terms. We provide digital documents and connect you with international service providers. Please read all sections carefully as they outline your rights, responsibilities, and our policies.
              </p>
            </div>
          </div>

          <!-- Terms Sections -->
       <div class="space-y-8">

  @foreach ($sections as $sec)
    @php
      // Zebra backgrounds to match your original pattern
      $zebra = $loop->odd ? 'bg-gray-50' : 'bg-white shadow-sm';
      $last  = $sec['number'] == 10 ? 'mb-16' : '';
      // Replace @site token with app name and allow saved HTML
      $body  = str_replace('@site', config('app.name'), (string)($sec['body'] ?? ''));
    @endphp

    <section id="section{{ $sec['number'] }}" class="section-card {{ $zebra }} rounded-xl p-8 border border-gray-100 {{ $last }}">
      <div class="flex items-start mb-4">
        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
          {{ $sec['number'] }}
        </div>
        <div>
          <h2 class="text-2xl font-bold text-blue-700 mb-2">{{ $sec['title'] }}</h2>
          <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full"></div>
        </div>
      </div>

      <div class="text-gray-700 leading-relaxed text-lg pl-16 prose max-w-none">
        {!! $body !!}
      </div>
    </section>
  @endforeach
</div>


          <!-- Contact Section -->
          {{-- <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white text-center mt-12">
            <div class="text-3xl mb-4">📞</div>
            <h3 class="text-2xl font-bold mb-4">Questions About These Terms?</h3>
            <p class="text-blue-100 mb-6 max-w-2xl mx-auto">
              If you have any questions about these terms or need clarification, please contact our support team.
            </p>
            <button class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors duration-300 shadow-lg">
              Contact Support
            </button>
          </div> --}}

        </div>
      </main>

    </div>
  </div>
</section>

@include('includes.footer')

<script>
  // Mobile TOC Toggle
  function toggleMobileTOC() {
    const nav = document.getElementById('toc-nav');
    const arrow = document.getElementById('toc-arrow');
    nav.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
  }

  // Smooth scrolling and active navigation
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

  // Update active navigation and progress
  function updateActiveSection() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    const scrollPos = window.scrollY + window.innerHeight / 3;
    
    let activeSection = null;
    let sectionIndex = 0;
    
    sections.forEach((section, index) => {
      const rect = section.getBoundingClientRect();
      const sectionTop = rect.top + window.scrollY;
      
      if (scrollPos >= sectionTop) {
        activeSection = section;
        sectionIndex = index;
      }
    });
    
    // Update active nav link
    navLinks.forEach(link => link.classList.remove('active'));
    if (activeSection) {
      const activeLink = document.querySelector(`a[href="#${activeSection.id}"]`);
      if (activeLink) {
        activeLink.classList.add('active');
      }
    }
    
    // Update progress
    const progress = Math.min(((sectionIndex + 1) / sections.length) * 100, 100);
    document.getElementById('progress-bar').style.width = progress + '%';
    document.getElementById('progress-text').textContent = Math.round(progress) + '%';
  }

  // Show mobile TOC on larger screens
  function handleResize() {
    const nav = document.getElementById('toc-nav');
    if (window.innerWidth >= 1024) {
      nav.classList.remove('hidden');
    } else {
      nav.classList.add('hidden');
    }
  }

  window.addEventListener('scroll', updateActiveSection);
  window.addEventListener('resize', handleResize);
  
  // Initial calls
  updateActiveSection();
  handleResize();
</script>

</body>
</html>