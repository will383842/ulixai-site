<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>How Does it Work</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
</head>
<body class = "bg-white">

 @include('includes.header')
     @include('pages.popup')
<div class = "mb-10"></div>

<section class="bg-white py-20 px-6 max-w-6xl mx-auto">
  <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">🚀 How does it work?</h2>
  <p class="text-center text-gray-600 mb-16">Two simple ways to get help abroad — based on your preferences, needs or urgency</p>

  <!-- Responsive Timeline -->
  <div class="relative flex flex-col md:grid md:grid-cols-2 gap-12">
    <!-- Step 1 -->
    <div class="md:col-start-1 md:col-end-2 md:pr-6">
      <div class="flex justify-center md:justify-end">
        <div class="max-w-sm w-full px-6 py-4 border border-blue-800 rounded-xl shadow bg-white">
          <div class="flex items-center justify-end mb-1">
            <div class="text-white bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mr-2">1</div>
            <h3 class="text-blue-800 font-semibold text-base">choose the category of your need</h3>
          </div>
          <p class="text-sm text-gray-600">With the simple click choose the category of your need.</p>
        </div>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="md:col-start-2 md:col-end-3 md:pl-6">
      <div class="flex justify-center md:justify-start">
        <div class="max-w-sm w-full px-6 py-4 border border-blue-800 rounded-xl shadow bg-white">
          <div class="flex items-center justify-start mb-1">
            <div class="text-white bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mr-2">2</div>
            <h3 class="text-blue-800 font-semibold text-base">Submit your request online</h3>
          </div>
          <p class="text-sm text-gray-600">Provide details of your needs in less than 2 minutes to help service providers understand your needs.</p>
        </div>
      </div>
    </div>

    <!-- Step 3 -->
    <div class="md:col-start-1 md:col-end-2 md:pr-6">
      <div class="flex justify-center md:justify-end">
        <div class="max-w-sm w-full px-6 py-4 border border-blue-800 rounded-xl shadow bg-white">
          <div class="flex items-center justify-end mb-1">
            <div class="text-white bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mr-2">3</div>
            <h3 class="text-blue-800 font-semibold text-base">Service provider rate proposals</h3>
          </div>
          <p class="text-sm text-gray-600">Service provider will ask you a question (if necessary) and provide you with the pricing proposal to fulfill your request.</p>
        </div>
      </div>
    </div>

    <!-- Step 4 -->
    <div class="md:col-start-2 md:col-end-3 md:pl-6">
      <div class="flex justify-center md:justify-start">
        <div class="max-w-sm w-full px-6 py-4 border border-blue-800 rounded-xl shadow bg-white">
          <div class="flex items-center justify-start mb-1">
            <div class="text-white bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mr-2">4</div>
            <h3 class="text-blue-800 font-semibold text-base">Choose your provider</h3>
          </div>
          <p class="text-sm text-gray-600">Choose the service provider you prefer based on the price they offer, their skills and their reviews.</p>
        </div>
      </div>
    </div>

    <!-- Step 5 -->
    <div class="md:col-start-1 md:col-end-2 md:pr-6">
      <div class="flex justify-center md:justify-end">
        <div class="max-w-sm w-full px-6 py-4 border border-blue-800 rounded-xl shadow bg-white">
          <div class="flex items-center justify-end mb-1">
            <div class="text-white bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mr-2">5</div>
            <h3 class="text-blue-800 font-semibold text-base">Make a prepayment for the service</h3>
          </div>
          <p class="text-sm text-gray-600">You make a prepayment for the service. Your money is secured on the @site platform via our financial partners.</p>
        </div>
      </div>
    </div>

    <!-- Step 6 -->
    <div class="md:col-start-2 md:col-end-3 md:pl-6">
      <div class="flex justify-center md:justify-start">
        <div class="max-w-sm w-full px-6 py-4 border border-blue-800 rounded-xl shadow bg-white">
          <div class="flex items-center justify-start mb-1">
            <div class="text-white bg-blue-700 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold mr-2">6</div>
            <h3 class="text-blue-800 font-semibold text-base">When service is completed</h3>
          </div>
          <p class="text-sm text-gray-600">You notify us to pay the service provider when the job is completed. You provide a rating and feedback to your service provider.</p>
        </div>
      </div>
    </div>
  </div>
</section>







<section class="bg-white py-16 px-6 text-center max-w-6xl mx-auto">
  <!-- <p class="uppercase text-gray-400 font-semibold tracking-widest mb-2">OR</p> -->
  <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-12">
    🧠 Choose your service provider yourself
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl p-6 shadow-md border text-center">
      <div class="text-3xl mb-3">🌍</div>
      <h3 class="text-lg font-bold text-blue-700 mb-2">Spoken language</h3>
      <p class="text-gray-600 text-sm">
        You are connected with professionals who speak your language — thanks to our smart matching system tailored to your needs.
      </p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border text-center">
      <div class="text-3xl mb-3">⭐</div>
      <h3 class="text-lg font-bold text-blue-700 mb-2">Reviews & ratings</h3>
      <p class="text-gray-600 text-sm">
        Check stars and feedback from other users before making your choice.
      </p>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-md border text-center">
      <div class="text-3xl mb-3">⏱️</div>
      <h3 class="text-lg font-bold text-blue-700 mb-2">Responsiveness</h3>
      <p class="text-gray-600 text-sm">
        You can see how fast each provider typically replies (often in under an hour).
      </p>
    </div>
  </div>
</section>



  @include('includes.footer')
</body>
</html>