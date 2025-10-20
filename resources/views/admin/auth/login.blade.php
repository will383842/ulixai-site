<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - ULIXAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl overflow-hidden">
            <div class="p-10">
                <h1 class="text-2xl font-bold text-blue-700 mb-1 text-center">Admin Login</h1>
                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-700">Email</label>
                        <input name="email" type="email" required class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="admin@example.com" />
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700">Password</label>
                        <input name="password" type="password" required class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="••••••••" />
                    </div>
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-md">Login</button>
                </form>
                @if(session('toast_error'))
                    <div class="mt-4 text-red-600 text-center text-sm">{{ session('toast_error') }}</div>
                @endif
                @if(session('toast_success'))
                    <div class="mt-4 text-green-600 text-center text-sm">{{ session('toast_success') }}</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
