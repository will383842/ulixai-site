
  <title>Trust N Security</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />

<body class="bg-white">
 @include('includes.header')
    @include('pages.popup')

  <section class="py-16 px-6 text-center max-w-7xl mx-auto">
    <!-- Header -->
    <h2 class="text-2xl md:text-3xl font-bold text-blue-800 mb-2">
      🔒 Trust & Security
    </h2>
    <p class="text-gray-600 max-w-3xl mx-auto mb-10">
      At @site, every request is handled securely, every provider is verified, and every exchange is protected.
    </p>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-left">
      <!-- Item 1 -->
      <div class="bg-blue-50 p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2">🧑‍💼 Verified Identity</h3>
        <p class="text-gray-700 text-sm">
          All service providers are verified , with identity , experience and reputation checks
        </p>
      </div>

      <!-- Item 2 -->
      <div class="bg-blue-50 p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2">📜 Legal Security</h3>
        <p class="text-gray-700 text-sm">
          A clear and transparent legal framework that complies with the laws of the country concerned.
        </p>
      </div>

      <!-- Item 3 -->
      <div class="bg-blue-50 p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2">🔐 Secure Payments</h3>
        <p class="text-gray-700 text-sm">
          All transactions go through certified platforms. @site never stores your banking data.
        </p>
      </div>

      <!-- Item 4 -->
      <div class="bg-blue-50 p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2">🛡️ Data Protection</h3>
        <p class="text-gray-700 text-sm">
          Your personal data is protected under GDPR and international privacy standards. You stay in control.
        </p>
      </div>

      <!-- Item 5 -->
      <div class="bg-blue-50 p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2">⭐ Transparent Reviews</h3>
        <p class="text-gray-700 text-sm">
          Only users who have completed a real request can leave a review or rating.
        </p>
      </div>

      <!-- Item 6 -->
      <div class="bg-blue-50 p-6 rounded-xl shadow-sm border">
        <h3 class="text-lg font-bold text-blue-700 mb-2 flex items-center gap-2">📞 Human Support</h3>
        <p class="text-gray-700 text-sm">
          Our team is here to help you—fast. Whether it’s a question, a dispute, or an emergency, you’re never alone.
        </p>
      </div>
    </div>
  </section>

   @include('includes.footer')
</body>
</html>