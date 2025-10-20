@include('includes.header')
@include('pages.popup')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
  
  body {
    font-family: 'Inter', sans-serif;
  }
  
  .subtle-animation {
    animation: subtleFloat 8s ease-in-out infinite;
  }
  
  .subtle-animation:nth-child(2) {
    animation-delay: 2s;
  }
  
  .subtle-animation:nth-child(3) {
    animation-delay: 4s;
  }
  
  @keyframes subtleFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-10px) rotate(2deg); }
  }
  
  .enhanced-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.98);
  }
  
  .enhanced-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12);
  }
  
  .map-container {
    transition: all 0.4s ease;
  }
  
  .map-container:hover iframe {
    transform: scale(1.01);
  }
  
  .pulse-subtle {
    animation: pulseSubtle 3s ease-in-out infinite;
  }
  
  @keyframes pulseSubtle {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
  }
  
  .smooth-hover {
    transition: all 0.3s ease;
  }
  
  .smooth-hover:hover {
    transform: translateY(-2px);
  }
</style>

<!-- Enhanced Hero Section with Original Colors -->
<section class="bg-white py-20 px-4 relative overflow-hidden">
  <!-- Subtle Background Elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-20">
    <div class="absolute top-20 right-16 w-24 h-24 bg-blue-100 rounded-full subtle-animation"></div>
    <div class="absolute top-1/3 left-12 w-32 h-32 bg-gray-100 rounded-full subtle-animation"></div>
    <div class="absolute bottom-32 right-1/4 w-20 h-20 bg-blue-50 rounded-full subtle-animation"></div>
  </div>
  
  <div class="max-w-4xl mx-auto text-center relative">
    <!-- Status Indicator -->
    <div class="inline-flex items-center px-4 py-2 bg-blue-50 border border-blue-200 rounded-full text-blue-800 text-sm font-medium mb-8 smooth-hover">
      <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 pulse-subtle"></span>
      Your Global Co-Pilot Platform
    </div>
    
    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-800 mb-4">
      🌍 Who are we at @site?
    </h2>
    
    <h3 class="text-xl md:text-2xl lg:text-3xl font-bold text-gray-800 mb-8 leading-relaxed">
      A platform designed for everyone living, traveling, or investing abroad
    </h3>
    
    <div class="space-y-6 mb-12">
      <p class="text-gray-700 text-base md:text-lg leading-relaxed max-w-3xl mx-auto">
        @site is more than just a website. It's your co-pilot. A human (and digital) partner ready to help you, wherever you are.
      </p>
      <p class="text-gray-800 text-base md:text-lg font-medium max-w-3xl mx-auto">
        Whether you're on vacation, on assignment, in exile, an expat, in transition, or simply on the move… @site is with you everywhere 👋
      </p>
    </div>

    <!-- Refined Map Section -->
    <div class="relative max-w-5xl mx-auto">
      <div class="map-container aspect-[16/10] md:aspect-[16/9] lg:aspect-[16/8] rounded-xl overflow-hidden shadow-xl border border-gray-200">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.639225589593!2d-122.08424908469285!3d37.42199997982525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba02425dad8f%3A0x6c296c66619367e0!2sGoogleplex!5e0!3m2!1sen!2sus!4v1703123456789!5m2!1sen!2sus" 
            class="w-full h-full border-0 transition-transform duration-500"
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Our Location">
        </iframe>
      </div>
    </div>
  </div>
</section>

<!-- Enhanced Identity Section with Original Structure -->
<section class="bg-white py-20 px-4">
  <div class="max-w-6xl mx-auto text-center">
    <!-- Section Header -->
    <div class="mb-16">
      <div class="inline-flex items-center px-6 py-3 bg-gray-50 border border-gray-200 rounded-full text-gray-700 font-medium mb-8 smooth-hover">
        <span class="w-2 h-2 bg-blue-600 rounded-full mr-3 pulse-subtle"></span>
        Why Choose @site?
      </div>
      <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
        Built with Trust and Excellence
      </h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Experience reliable support through our comprehensive verified services
      </p>
    </div>

    <!-- Enhanced Feature Grid with Original Logos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
      <?php
        $features = [
          ['image' => 'verified.png', 'title' => 'Verified identity', 'desc' => 'All providers are verified for your safety and peace of mind.'],
          ['image' => 'legall.png', 'title' => 'Legal security', 'desc' => 'A clear, reliable and fully supervised legal framework.'],
          ['image' => 'digital.png', 'title' => '100% digital', 'desc' => 'Request, book, and manage everything seamlessly from your phone.'],
          ['image' => 'human.png', 'title' => 'Human & responsive', 'desc' => 'Real humans ready to help you quickly and with genuine care.'],
        ];

        foreach ($features as $f) {
          echo '
          <div class="enhanced-card border border-gray-200 p-8 rounded-2xl shadow-sm hover:border-gray-300 flex flex-col items-center text-center space-y-6">
            <div class="w-28 h-28 overflow-hidden rounded-xl bg-gray-50 p-4 flex items-center justify-center">
              <img src="images/' . $f['image'] . '" alt="' . $f['title'] . '" class="w-full h-full object-contain" loading="lazy" />
            </div>
            <div class="space-y-3">
              <h3 class="text-blue-800 font-bold text-lg">' . $f['title'] . '</h3>
              <p class="text-sm text-gray-600 leading-relaxed">' . $f['desc'] . '</p>
            </div>
          </div>';
        }
      ?>
    </div>
  </div>
</section>

<!-- Enhanced SOS Section with Original Red Theme -->
<section class="bg-white py-24 px-6">
  <div class="max-w-5xl mx-auto relative">
    <!-- Subtle background decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-10">
      <div class="absolute top-10 right-10 w-32 h-32 bg-red-100 rounded-full subtle-animation"></div>
      <div class="absolute bottom-10 left-10 w-24 h-24 bg-red-50 rounded-full subtle-animation"></div>
    </div>
    
    <div class="relative bg-red-50 rounded-3xl px-12 py-20 text-center shadow-lg border border-red-100">
      <!-- Status Badge -->
      <div class="inline-flex items-center px-6 py-2 bg-red-100 border border-red-200 text-red-700 rounded-full font-medium text-sm mb-8 smooth-hover">
        <span class="w-2 h-2 bg-red-500 rounded-full mr-3 pulse-subtle"></span>
        Coming Soon
      </div>
      
      <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-red-700 mb-6 leading-tight">
        🎧 S.O.S Emergency Service
      </h2>
      
      <div class="max-w-3xl mx-auto mb-10">
        <p class="text-base md:text-lg text-gray-800 font-medium leading-relaxed mb-6">
          Trouble abroad? You'll be connected by phone with the expert of your choice.
        </p>
        
        <div class="inline-flex items-center px-8 py-4 bg-red-600 text-white rounded-xl font-bold text-lg shadow-md smooth-hover">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          7 days a week, in just seconds
        </div>
      </div>
      
      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <button class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg smooth-hover">
          Get Notified
        </button>
        <button class="px-8 py-3 border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white font-semibold rounded-xl transition-all duration-300 smooth-hover">
          Learn More
        </button>
      </div>
    </div>
  </div>
</section>

@include('includes.footer')