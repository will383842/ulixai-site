<aside class="w-64 bg-white border-r border-gray-100 shadow-sm flex-shrink-0 min-h-screen overflow-y-auto" role="navigation" aria-label="Admin sidebar">
    <nav class="px-4 py-6 space-y-8">
        <div>
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Overview</p>
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.messages') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.messages*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.messages*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h6m-6 4h10M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Messages reçus
            </a>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Operations</p>
            <a href="{{ route('admin.users') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.users*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-1a6 6 0 00-9-5.197M9 10a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Users
            </a>
            <a href="{{ route('admin.missions') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.missions*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.missions*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h8M7 15h10"/>
                </svg>
                Missions
            </a>
            <a href="{{ route('admin.disputes') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.disputes') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.disputes') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 005.656 0L21 10l-6.172-6.172a4 4 0 00-5.656 0L3 10l6.172 6.172z"/>
                </svg>
                Litiges
            </a>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Finance</p>
            <a href="{{ route('admin.accounting.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.accounting.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.accounting.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 12v4"/>
                </svg>
                Comptabilité
            </a>
            <a href="{{ route('admin.transactions') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.transactions*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.transactions*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2h10a2 2 0 002-2v-2m3-4h-6"/>
                </svg>
                Transactions
            </a>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Growth & SEO</p>
            <a href="{{ route('admin.seo.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.seo.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.seo.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3a1 1 0 011 1v16M4 12h16"/>
                </svg>
                SEO & Analytics
            </a>
            <a href="{{ route('admin.press') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.press*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.press*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h2V3h10v2h2a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h5m-5 4h8"/>
                </svg>
                Press
            </a>
        </div>

        <div>
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Content & Catalog</p>
            <a href="{{ route('admin.categories.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.categories.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.categories.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16"/>
                </svg>
                Categories
            </a>
            @if(auth()->guard('admin')->user() && method_exists(auth()->guard('admin')->user(), 'hasAdminRole') && auth()->guard('admin')->user()->hasAdminRole('super_admin'))
            <a href="{{ route('admin.countries.index') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.countries.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.countries.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                </svg>
                Manage Countries
            </a>
            @endif
        </div>

        <div>
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Settings & Security</p>
            <a href="{{ route('admin.roles-permissions') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.roles-permissions') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.roles-permissions') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 16v-2m8-6h2M2 12H4m13.657-7.657l1.414 1.414M4.929 19.071l1.414-1.414M19.071 19.071l-1.414-1.414M6.343 6.343L4.929 4.929"/>
                </svg>
                Roles & Permissions
            </a>
            <a href="{{ route('admin.settings') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.settings*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.settings*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 12v4"/>
                </svg>
                Settings
            </a>
            <a href="{{ route('admin.bug-reports') }}" class="group flex items-center px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.bug-reports') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.bug-reports') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.73 21a2 2 0 01-3.46 0L3 9l9-7 9 7-8.27 12z"/>
                </svg>
                Bug Reports
            </a>
        </div>
    </nav>
</aside>
