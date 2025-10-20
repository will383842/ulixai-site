<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found | ULIXAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-tr from-blue-50 to-white min-h-screen flex items-center justify-center">
    <div class="max-w-lg w-full bg-white rounded-2xl shadow-2xl p-10 flex flex-col items-center">
        <div class="mb-6">
            <i class="fas fa-exclamation-triangle text-yellow-400 text-6xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-blue-700 mb-2">404 - Page Not Found</h1>
        <p class="text-gray-600 text-center mb-6">Sorry, the page you are looking for does not exist.<br>
        Please check the URL or use the button below to return to your dashboard.</p>
        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow transition">
            Go to Dashboard
        </a>
    </div>
</body>
</html>
