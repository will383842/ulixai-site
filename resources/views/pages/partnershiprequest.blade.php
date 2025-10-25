
  <title>Become a Partner</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />

  <style>
    .gradient-text {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8, #1e40af);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .glass-effect {
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .gradient-border {
      background: linear-gradient(135deg, #3b82f6, #1d4ed8);
      padding: 2px;
      border-radius: 1rem;
    }
    
    .gradient-border-content {
      background: white;
      border-radius: calc(1rem - 2px);
    }
    
    .enhanced-card {
      position: relative;
      background: white;
      border-radius: 1rem;
      padding: 1rem 1.25rem;
      border: 2px solid transparent;
      background-clip: padding-box;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .enhanced-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg, #3b82f6, #1d4ed8, #2563eb, #1e40af);
      background-size: 400% 400%;
      animation: gradientFlow 8s ease infinite;
      z-index: -1;
      border-radius: 1rem;
    }

    .enhanced-card::after {
      content: '';
      position: absolute;
      top: 2px;
      left: 2px;
      right: 2px;
      bottom: 2px;
      background: white;
      border-radius: calc(1rem - 2px);
      z-index: -1;
    }

    .enhanced-card:hover {
      transform: translateY(-4px) scale(1.02);
      box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
    }

    .enhanced-card:hover::before {
      animation-duration: 2s;
    }

    @keyframes gradientFlow {
      0% {
        background-position: 0% 50%;
      }
      25% {
        background-position: 100% 50%;
      }
      50% {
        background-position: 100% 100%;
      }
      75% {
        background-position: 0% 100%;
      }
      100% {
        background-position: 0% 50%;
      }
    }
    
    .floating-animation {
      animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    .pulse-glow {
      animation: pulseGlow 3s ease-in-out infinite;
    }
    
    @keyframes pulseGlow {
      0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
      }
      50% {
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.6);
      }
    }
    
    .sparkle {
      position: relative;
      overflow: hidden;
    }
    
    .sparkle::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(59, 130, 246, 0.1), transparent);
      animation: sparkle 3s infinite;
    }
    
    @keyframes sparkle {
      0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
      100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }
    
    .icon-bounce {
      animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
      0%, 20%, 53%, 80%, 100% {
        transform: translateY(0);
      }
      40%, 43% {
        transform: translateY(-8px);
      }
      70% {
        transform: translateY(-4px);
      }
      90% {
        transform: translateY(-2px);
      }
    }
    
    .stagger-animation {
      animation: fadeInUp 0.8s ease-out forwards;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
 </style>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">

 @include('includes.header')
    @include('pages.popup')

<!-- Hero Section -->
<section class="relative py-20 px-6 text-center overflow-hidden">
  <!-- Background decorative elements -->
  <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%233b82f6" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-40"></div>
  
  <div class="relative max-w-5xl mx-auto">
    <!-- Welcome Badge -->
    <div class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-100 to-indigo-100 border-2 border-blue-200 rounded-full px-6 py-3 mb-8 sparkle">
      <span class="text-3xl icon-bounce">👋</span>
      <span class="text-blue-800 font-bold text-lg">Welcome to Partnership Opportunities</span>
    </div>
    
    <!-- Main Heading -->
    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
      <span class="gradient-text">Hello and welcome!</span>
    </h1>
    
    <!-- Subheading -->
    <div class="space-y-4 mb-8">
      <p class="text-xl text-gray-700 flex items-center justify-center gap-2">
        Thank you for your interest 
        <span class="text-3xl floating-animation">✨</span>
      </p>
      
      <div class="max-w-3xl mx-auto">
        <p class="text-lg text-gray-600 leading-relaxed mb-4">
         @site supports everyone living abroad, regardless of their language or country of origin.
        </p>
        
        <div class="inline-flex items-center gap-3 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-2xl px-6 py-3">
          <span class="text-2xl">💡</span>
          <span class="text-gray-800 font-semibold text-lg">
            We believe in partnerships that are human, simple and impactful
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Partnership Types Section -->
<section class="py-16 px-6">
  <div class="max-w-6xl mx-auto">
    <div class="gradient-border glass-effect">
      <div class="gradient-border-content p-8 md:p-12">
        <!-- Section Header -->
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-blue-800 mb-4">
            You might be<span class="text-blue-500">...</span>
          </h2>
          <div class="w-20 h-1 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto rounded-full"></div>
        </div>
        
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6">
          <!-- Card 1: Business -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.1s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                🏙️
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Business</h3>
                <p class="text-gray-600 text-sm">Local or international business</p>
              </div>
            </div>
          </div>
          
          <!-- Card 2: Brand -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.2s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                🏪
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Retail & Startup</h3>
                <p class="text-gray-600 text-sm">Brand, retailer or startup</p>
              </div>
            </div>
          </div>
          
          <!-- Card 3: Community -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.3s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                💬
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Communities</h3>
                <p class="text-gray-600 text-sm">Social media & Discord communities</p>
              </div>
            </div>
          </div>
          
          <!-- Card 4: NGO -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.4s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                🧡
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Non-Profit</h3>
                <p class="text-gray-600 text-sm">NGO, nonprofit or grassroots initiative</p>
              </div>
            </div>
          </div>
          
          <!-- Card 5: Government -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.5s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                🏛️
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Public Sector</h3>
                <p class="text-gray-600 text-sm">Municipality or public institution</p>
              </div>
            </div>
          </div>
          
          <!-- Card 6: Media -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.6s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                📰
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Media</h3>
                <p class="text-gray-600 text-sm">Media outlet, platform or website</p>
              </div>
            </div>
          </div>
          
          <!-- Card 7: Creator -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.7s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                📱
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Content Creator</h3>
                <p class="text-gray-600 text-sm">Content creator or influencer</p>
              </div>
            </div>
          </div>
          
          <!-- Card 8: Tech -->
          <div class="enhanced-card stagger-animation" style="animation-delay: 0.8s;">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-teal-600 rounded-xl flex items-center justify-center text-2xl shadow-lg">
                🧑‍💻
              </div>
              <div>
                <h3 class="font-semibold text-gray-800 text-lg">Tech & Innovation</h3>
                <p class="text-gray-600 text-sm">Incubator, student network or coworking</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 px-6">
  <div class="max-w-4xl mx-auto text-center">
    <div class="gradient-border">
      <div class="gradient-border-content p-8 md:p-12">
        <!-- Connection Message -->
        <div class="mb-8">
          <div class="inline-flex items-center gap-3 mb-6">
            <span class="text-4xl floating-animation">🤝</span>
            <h3 class="text-2xl md:text-3xl font-bold text-blue-800">Let's Connect</h3>
          </div>
          
          <p class="text-xl text-gray-700 leading-relaxed max-w-3xl mx-auto">
            If you'd like to take action and support those far from home, 
            <br class="hidden md:block">
            we'd be happy to connect with you
          </p>
        </div>
        
        <!-- CTA Button -->
        <div class="mb-8">
          <a href="/partnershiprequest" class="group inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 pulse-glow">
            <span class="text-xl group-hover:animate-bounce">➕</span>
            <span class="text-lg">Suggest a Partnership</span>
            <div class="w-2 h-2 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </a>
        </div>
        
        <!-- Response Time Info -->
        <div class="inline-flex items-center gap-3 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl px-6 py-3">
          <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
          <span class="text-green-800 font-semibold">Response within 72h</span>
          <span class="text-green-700">•</span>
          <span class="text-green-700">Simple, human and friendly contact</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Benefits Preview Section -->
<section class="py-16 px-6 bg-gradient-to-r from-blue-50 to-indigo-50">
  <div class="max-w-6xl mx-auto text-center">
    <h3 class="text-3xl font-bold text-blue-800 mb-8">Why Partner with @site?</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Benefit 1 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-4 mx-auto floating-animation">
          🌍
        </div>
        <h4 class="text-xl font-bold text-blue-800 mb-3">Global Impact</h4>
        <p class="text-gray-600">Help millions of people navigating life abroad with trusted local partnerships.</p>
      </div>
      
      <!-- Benefit 2 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2" style="animation-delay: 0.2s;">
        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center text-3xl mb-4 mx-auto floating-animation">
          📈
        </div>
        <h4 class="text-xl font-bold text-blue-800 mb-3">Growth Opportunity</h4>
        <p class="text-gray-600">Expand your reach to international communities and expat markets.</p>
      </div>
      
      <!-- Benefit 3 -->
      <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2" style="animation-delay: 0.4s;">
        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-3xl mb-4 mx-auto floating-animation">
          🤝
        </div>
        <h4 class="text-xl font-bold text-blue-800 mb-3">Meaningful Collaboration</h4>
        <p class="text-gray-600">Join a mission-driven platform focused on human connection and support.</p>
      </div>
    </div>
  </div>
</section>

<div class="mb-20"></div>

 @include('includes.footer')

<script>
  // Add scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, observerOptions);
  
  // Initialize animations for cards
  document.querySelectorAll('.stagger-animation').forEach((el, index) => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = `opacity 0.8s ease ${index * 0.1}s, transform 0.8s ease ${index * 0.1}s`;
    observer.observe(el);
  });
  
  // Add hover sound effect (optional)
  document.querySelectorAll('.enhanced-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      // Optional: Add subtle sound effect or haptic feedback
    });
  });
  
  // Smooth scroll for internal links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
</script>

</body>
</html>