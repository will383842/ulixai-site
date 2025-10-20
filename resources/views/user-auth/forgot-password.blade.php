<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Forgot Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body class="bg-white font-sans">
  @include('includes.header')

  <main class="min-h-[calc(100vh-200px)] flex items-center justify-center px-4 py-16">
    <div class="w-full max-w-md bg-white p-8 space-y-6 border border-gray-200 rounded-xl shadow-lg">
      <div class="flex justify-center">
        <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
          <i class="fas fa-fingerprint text-2xl text-gray-500"></i>
        </div>
      </div>
      <h2 class="text-center text-2xl font-semibold text-gray-900">Forgot password?</h2>
      <p class="text-center text-gray-600">No worries, we’ll send you reset instructions.</p>

      @if(session('status'))
        <div class="text-green-600 text-center text-sm">{{ session('status') }}</div>
      @endif
      @if($errors->any())
        <div class="text-red-600 text-center text-sm">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required placeholder="Enter your email"
                 class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                 value="{{ old('email') }}">
        </div>
        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-md transition">
          Reset password
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
</body>
</html>
