
  <title>Login - ULIX AI</title>
      <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
 
<body class="bg-gray-100">
 @include('includes.header')
  @include('pages.popup')
<div class="min-h-screen flex items-center justify-center px-4">
  <div class="w-full max-w-xl bg-white shadow-2xl rounded-2xl overflow-hidden">
    
    <!-- Login Form -->
    <div class="p-10 bg-white flex items-center justify-center">
      <div class="w-full">
        <h1 class="text-2xl font-bold text-blue-700 mb-1 justify-center text-center">Welcome!</h1>
        <p class="text-sm text-gray-600 mb-6 text-center">Log in with your email and password.</p>

        <div class="space-y-3 mb-6">
          <!-- Facebook -->
          <!-- <button class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-md py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
            <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Facebook_icon.svg" class="w-5 h-5" alt="Facebook logo">
            Continue with Facebook
          </button> -->

          <!-- Google -->
          <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-md py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
            Continue with Google
          </a>
        </div>

        <form class="space-y-4" method="POST" action="{{ route('user.login') }}">
          @csrf
          <div>
            <label class="block text-sm text-gray-700">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="you@example.com" />
          </div>

          <div>
            <label class="block text-sm text-gray-700">Password</label>
            <input name="password" type="password" required class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="••••••••" />
            <div class="text-right mt-1">
              <a href="/forgot-password" class="text-xs text-blue-600 hover:underline">Forgot password?</a>
            </div>
          </div>

          <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-md">Login</button>
        </form>
        {{-- Toast messages --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('toast_success'))
                toastr.success("{{ session('toast_success') }}");
            @endif
            @if(session('toast_error'))
                toastr.error("{{ session('toast_error') }}");
            @endif
        });
        </script>

        <p class="mt-6 text-xs text-center text-gray-600">
          Don’t have an account? 
          <a href="javascript:void(0)" onclick="openSignupPopup()" class="text-blue-600 font-medium hover:underline">
            Start Free Trial
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

   @include('includes.footer')

  <script>
  function openSignupPopup() {
    document.getElementById('signupPopup').classList.remove('hidden');
  }

  function closeSignupPopup() {
    document.getElementById('signupPopup').classList.add('hidden');
  }
</script>


</body>
</html>