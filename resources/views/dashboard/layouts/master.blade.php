<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- Laravel Echo -->
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.js"></script>
    <script src="https://js.stripe.com/basil/stripe.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/country-select-js@1.0.8/dist/countrySelect.min.js"></script>
</head>
    <body class="bg-gray-50 text-gray-800">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
         <div id="google_translate_element" class="hidden"></div>
       
        <script>
            window.Pusher = Pusher;
            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: '{{ env("MIX_PUSHER_APP_KEY") }}',
                cluster: '{{ env("MIX_PUSHER_APP_CLUSTER") }}', 
                forceTLS: true,
                
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                },
                enabledTransports: ['ws', 'wss'],
            });
        </script>
        
        @if (session('success'))
            <script>
                toastr.success('{{ session('success') }}', 'Success');
            </script>
        @endif

        @if (session('error'))
            <script>
                toastr.error('{{ session('error') }}', 'Error');
            </script>
        @endif

        <script>
            const listen = window.Echo.channel(`notify-user-{{ auth()->id() }}`)
                .listen('NotifyUser', (data) => {
                    const navReadElement = document.getElementById('private_messages_notification');
                    navReadElement.classList.remove('hidden');
                    if(navReadElement) {
                        const navValue = navReadElement.dataset.value || "0";
                        navReadElement.dataset.value = parseInt(navValue, 10) + 1;
                        navReadElement.textContent = navReadElement.dataset.value;
                    }
                    toastr.info(data.title, 'New Notification');
                })
                .error((error) => {
                    console.error('Channel subscription error:', error);
                });

        </script>

        @include('includes.header')
        @include('pages.popup')
        @if(session('is_impersonating'))
            <div class="bg-yellow-100 text-gray-800 p-4 flex justify-between items-center">
                <div>
                    <span>You are logged in as <strong>{{ auth()->user()->email }}</strong></span>
                </div>
                <form method="POST" action="{{ route('restore-admin') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400">
                        Go back to Admin Panel
                    </button>
                </form>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar (mobile is absolutely positioned and hidden by default) -->
            @include('dashboard.partials.sidebar')
        
            <!-- Content Area -->
            <main class="flex-1 p-4 pt-20 lg:p-6 lg:pt-6">
                @include('dashboard.banners.kyc-banner')
                @yield('content')
            </main>
        </div>

        @include('dashboard.partials.dashboard-mobile-navbar')
        @yield('scripts')

    </body>
</html>