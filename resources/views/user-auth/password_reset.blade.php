<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-white font-sans">
  @include('includes.header')
  <main class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-16">
    <div class="w-full max-w-md bg-white p-8 space-y-6 border border-gray-200 rounded-xl shadow-lg">
      <div class="flex justify-center">
        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
          <i class="fas fa-lock text-2xl text-gray-500"></i>
        </div>
      </div>
      <h2 class="text-center text-2xl font-semibold text-gray-900">Reset your password</h2>
      <p class="text-center text-gray-600">Enter your new password below.</p>

      @if($errors->any())
        <div class="text-red-600 text-center text-sm">
          {{ $errors->first() }}
        </div>
      @endif

      <form id="resetPasswordForm" action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
          <input type="password" id="password" name="password" required minlength="6"
                 class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                 placeholder="Enter new password">
        </div>
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                 class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                 placeholder="Confirm new password">
          <div id="password-match-error" class="text-xs text-red-600 mt-1 hidden"></div>
        </div>
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-md transition">
          Reset Password
        </button>
      </form>
      <div class="text-center">
        <a href="/login" class="text-sm text-gray-600 hover:text-blue-600 flex items-center justify-center">
          <i class="fas fa-arrow-left mr-1"></i>
          Back to log in
        </a>
      </div>
    </div>
  </main>
  @include('includes.footer')
  <script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
      var pwd = document.getElementById('password').value;
      var pwd2 = document.getElementById('password_confirmation').value;
      var errorDiv = document.getElementById('password-match-error');
      if (pwd !== pwd2) {
        errorDiv.textContent = "Passwords do not match.";
        errorDiv.classList.remove('hidden');
        e.preventDefault();
        return false;
      } else {
        errorDiv.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
