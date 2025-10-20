<!-- Customer Reviews Page -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Customer Reviews</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    @keyframes floatReverse {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(10px); }
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
    
    .float-card:nth-child(odd) {
      animation: float 4s ease-in-out infinite;
      animation-delay: 0s;
    }
    
    .float-card:nth-child(even) {
      animation: floatReverse 4s ease-in-out infinite;
      animation-delay: 1s;
    }
    
    .float-card:nth-child(3n) {
      animation-delay: 2s;
    }
    
    .review-card {
      transition: all 0.3s ease;
      animation: fadeInUp 0.6s ease-out;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .review-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .profile-img {
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
    
    .review-card:hover .profile-img {
      transform: scale(1.05);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }
    
    .stars {
      filter: drop-shadow(0 2px 4px rgba(255, 193, 7, 0.3));
    }
    
    .review-text {
      position: relative;
    }
    
    .review-text::before {
      content: '"';
      position: absolute;
      top: -10px;
      left: -5px;
      font-size: 2rem;
      color: rgba(0, 0, 0, 0.1);
      font-family: serif;
    }
    
    .review-text::after {
      content: '"';
      position: absolute;
      bottom: -15px;
      right: 0px;
      font-size: 2rem;
      color: rgba(0, 0, 0, 0.1);
      font-family: serif;
    }
    
    .section-header {
      animation: fadeInUp 0.8s ease-out;
    }
    
    .row-1 .review-card {
      animation-delay: 0.2s;
    }
    
    .row-1 .review-card:nth-child(2) {
      animation-delay: 0.4s;
    }
    
    .row-1 .review-card:nth-child(3) {
      animation-delay: 0.6s;
    }
    
    .row-2 .review-card {
      animation-delay: 0.8s;
    }
    
    .row-2 .review-card:nth-child(2) {
      animation-delay: 1s;
    }
    
    .row-2 .review-card:nth-child(3) {
      animation-delay: 1.2s;
    }
  </style>
</head>
<body class="bg-white text-gray-800">
  @include('includes.header')
  @include('pages.popup')

<section class="py-20 px-4 text-center relative overflow-hidden">
  <!-- Background decorative elements -->
  <div class="absolute top-10 left-10 w-20 h-20 bg-blue-100 rounded-full opacity-30 blur-xl"></div>
  <div class="absolute bottom-20 right-10 w-32 h-32 bg-pink-100 rounded-full opacity-30 blur-xl"></div>
  <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-purple-100 rounded-full opacity-20 blur-lg"></div>
  
  <div class="section-header">
    <h2 class="text-4xl font-bold text-blue-900 mb-6 relative">
      💬 What Customers are Saying
      <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full"></div>
    </h2>
    <p class="text-gray-600 max-w-2xl mx-auto mb-16 text-lg leading-relaxed">
      Thousands trust @site abroad. Here's what they're saying about their incredible experiences.
    </p>
  </div>

  <!-- ROW 1 -->
  <div class="row-1 flex flex-wrap justify-center gap-8 mb-12">
    <div class="review-card float-card bg-gradient-to-br from-blue-50 to-blue-100 rounded-3xl shadow-lg hover:shadow-2xl p-8 w-[320px] relative group border border-blue-200">
      <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-3xl"></div>
      <div class="relative z-10">
        <div class="mb-6">
          <img src="https://i.pravatar.cc/100?img=1" alt="Mateo Levi" class="profile-img w-20 h-20 rounded-full mx-auto mb-4 ring-4 ring-blue-200/50" />
          <h4 class="font-bold text-gray-900 mb-1 text-xl">Mateo Levi</h4>
          <div class="w-12 h-0.5 bg-blue-300 mx-auto mb-4"></div>
        </div>
        <p class="review-text text-gray-700 mb-6 leading-relaxed text-base font-medium">The UI is intuitive and user-friendly. Even for someone like me who's not tech-savvy!</p>
        <div class="stars text-yellow-400 text-xl flex justify-center gap-1">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
      </div>
    </div>

    <div class="review-card float-card bg-gradient-to-br from-pink-50 to-pink-100 rounded-3xl shadow-lg hover:shadow-2xl p-8 w-[320px] relative group border border-pink-200">
      <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-3xl"></div>
      <div class="relative z-10">
        <div class="mb-6">
          <img src="https://i.pravatar.cc/100?img=47" alt="Olivia Emma" class="profile-img w-20 h-20 rounded-full mx-auto mb-4 ring-4 ring-pink-200/50" />
          <h4 class="font-bold text-gray-900 mb-1 text-xl">Olivia Emma</h4>
          <div class="w-12 h-0.5 bg-pink-300 mx-auto mb-4"></div>
        </div>
        <p class="review-text text-gray-700 mb-6 leading-relaxed text-base font-medium">The team exceeded design expectations beautifully. Absolutely stunning results!</p>
        <div class="stars text-yellow-400 text-xl flex justify-center gap-1">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
      </div>
    </div>

    <div class="review-card float-card bg-gradient-to-br from-purple-50 to-purple-100 rounded-3xl shadow-lg hover:shadow-2xl p-8 w-[320px] relative group border border-purple-200">
      <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-3xl"></div>
      <div class="relative z-10">
        <div class="mb-6">
          <img src="https://i.pravatar.cc/100?img=3" alt="David" class="profile-img w-20 h-20 rounded-full mx-auto mb-4 ring-4 ring-purple-200/50" />
          <h4 class="font-bold text-gray-900 mb-1 text-xl">David</h4>
          <div class="w-12 h-0.5 bg-purple-300 mx-auto mb-4"></div>
        </div>
        <p class="review-text text-gray-700 mb-6 leading-relaxed text-base font-medium">The variety of styles and effects was amazing. Creative freedom at its best!</p>
        <div class="stars text-yellow-400 text-xl flex justify-center gap-1">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ROW 2 -->
  <div class="row-2 flex flex-wrap justify-center gap-8">
    <div class="review-card float-card bg-gradient-to-br from-green-50 to-green-100 rounded-3xl shadow-lg hover:shadow-2xl p-8 w-[320px] relative group border border-green-200">
      <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-3xl"></div>
      <div class="relative z-10">
        <div class="mb-6">
          <img src="https://i.pravatar.cc/100?img=12" alt="James Elijah" class="profile-img w-20 h-20 rounded-full mx-auto mb-4 ring-4 ring-green-200/50" />
          <h4 class="font-bold text-gray-900 mb-1 text-xl">James Elijah</h4>
          <div class="w-12 h-0.5 bg-green-300 mx-auto mb-4"></div>
        </div>
        <p class="review-text text-gray-700 mb-6 leading-relaxed text-base font-medium">Artistic brilliance that's a game-changer. Revolutionary platform!</p>
        <div class="stars text-yellow-400 text-xl flex justify-center gap-1">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
      </div>
    </div>

    <div class="review-card float-card bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-3xl shadow-lg hover:shadow-2xl p-8 w-[320px] relative group border border-indigo-200">
      <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-3xl"></div>
      <div class="relative z-10">
        <div class="mb-6">
          <img src="https://i.pravatar.cc/100?img=5" alt="Audrey" class="profile-img w-20 h-20 rounded-full mx-auto mb-4 ring-4 ring-indigo-200/50" />
          <h4 class="font-bold text-gray-900 mb-1 text-xl">Audrey</h4>
          <div class="w-12 h-0.5 bg-indigo-300 mx-auto mb-4"></div>
        </div>
        <p class="review-text text-gray-700 mb-6 leading-relaxed text-base font-medium">Customization made expression effortless. Perfect tools for creativity!</p>
        <div class="stars text-yellow-400 text-xl flex justify-center gap-1">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
      </div>
    </div>

    <div class="review-card float-card bg-gradient-to-br from-orange-50 to-orange-100 rounded-3xl shadow-lg hover:shadow-2xl p-8 w-[320px] relative group border border-orange-200">
      <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent rounded-3xl"></div>
      <div class="relative z-10">
        <div class="mb-6">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Estelle" class="profile-img w-20 h-20 rounded-full mx-auto mb-4 ring-4 ring-orange-200/50" />
          <h4 class="font-bold text-gray-900 mb-1 text-xl">Estelle</h4>
          <div class="w-12 h-0.5 bg-orange-300 mx-auto mb-4"></div>
        </div>
        <p class="review-text text-gray-700 mb-6 leading-relaxed text-base font-medium">Loved comparing options and reviews. Made decision-making so easy!</p>
        <div class="stars text-yellow-400 text-xl flex justify-center gap-1">
          <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
        </div>
      </div>
    </div>
  </div>
</section>

  @include('includes.footer')
</body>
</html>