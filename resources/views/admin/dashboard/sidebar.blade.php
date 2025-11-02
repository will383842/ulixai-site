<aside class="w-64 bg-white border-r border-gray-100 shadow-sm flex-shrink-0 min-h-screen overflow-y-auto">
    <!-- Header Section -->
    <div class="px-6 py-8 border-b border-gray-100 hidden">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">Admin Panel</h2>
                <p class="text-xs text-gray-500 mt-0.5">Management Console</p>
            </div>
        </div>
    </div>

    <!-- Navigation Section -->
    <nav class="px-4 py-6">

        <div class="space-y-1 mb-8">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
                @if(request()->routeIs('admin.dashboard'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <a href="{{ route('admin.users') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                Users
                @if(request()->routeIs('admin.users'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <!-- Missions -->
            <a href="{{ route('admin.missions') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.missions') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.missions') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Missions
                @if(request()->routeIs('admin.missions'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <!-- Disputed Missions -->
            <a href="{{ route('admin.disputes') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.disputes') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.disputes') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                Disputed Missions
                @if(request()->routeIs('admin.disputes'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
                <span class="ml-auto">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        {{ \App\Models\Mission::where('status', 'disputed')->count() }}
                    </span>
                </span>
            </a>

            @if(auth()->guard('admin')->user()->hasAdminRole('super_admin'))
                <a href="{{ route('admin.fake-content-generation') }}"
                   class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.fake-content-generation') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.fake-content-generation') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    FCG Dashboard
                    @if(request()->routeIs('admin.fake-content-generation'))
                        <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                    @endif
                    <span class="ml-auto">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Super
                        </span>
                    </span>
                </a>
            @endif

            <a href="{{ route('admin.messages') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.messages*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.messages*') ? 'text-gray-900' : 'text-gray-400 group-hover:text-gray-500' }}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 8h10M7 12h6m-6 4h10M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Messages reçus
                @if(request()->routeIs('admin.messages*'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <!-- FIX: balise <a> correcte -->
            <a href="{{ route('admin.transactions') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.transactions') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.transactions') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Transactions
                @if(request()->routeIs('admin.transactions'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <!-- Categories (Super Admin) -->
            @if(auth()->guard('admin')->user()->hasAdminRole('super_admin'))
                <a href="{{ route('admin.categories.index') }}"
                   class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.categories.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.categories.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Manage Categories
                    @if(request()->routeIs('admin.categories.index'))
                        <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                    @endif
                    <span class="ml-auto">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Super
                        </span>
                    </span>
                </a>
            @endif

            <!-- Countries (Super Admin) -->
            @if(auth()->guard('admin')->user()->hasAdminRole('super_admin'))
                <a href="{{ route('admin.countries.index') }}"
                   class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.countries.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.countries.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Manage Countries
                    @if(request()->routeIs('admin.countries.index'))
                        <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                    @endif
                    <span class="ml-auto">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Super
                        </span>
                    </span>
                </a>
            @endif

            <!-- Service Fees (Super Admin) -->
            @if(auth()->guard('admin')->user()->hasAdminRole('super_admin'))
                <a href="{{ route('admin.manage-fee.index') }}"
                   class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.manage-fee.index') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.manage-fee.index') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Manage Service Fees
                    @if(request()->routeIs('admin.manage-fee.index'))
                        <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                    @endif
                    <span class="ml-auto">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Super
                        </span>
                    </span>
                </a>
            @endif

            <!-- Report a Bug -->
            <a href="{{ route('admin.bug-reports') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.bug-reports') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.bug-reports') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414 1.414A8 8 0 015.636 18.364l-1.414-1.414A10 10 0 1018.364 5.636z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/>
                </svg>
                Bug Reports
                @if(request()->routeIs('admin.bug-reports'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            {{-- DEPRECATED (migrated to Messages reçus)
            <a href="{{ route('admin.applications') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.applications') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.applications') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h2a2 2 0 012 2v14l-4-4H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                </svg>
                Applications
                @if(request()->routeIs('admin.applications'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
            --}}

            {{-- DEPRECATED (migrated to Messages reçus)
            <a href="{{ route('admin.partnerships') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.partnerships') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.partnerships') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 11-5.656-5.656l1.172-1.172"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10.172 13.828a4 4 0 005.656 0l3-3a4 4 0 10-5.656-5.656l-1.172 1.172"/>
                </svg>
                PartnerShips
                @if(request()->routeIs('admin.partnerships'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
            --}}

            <a href="{{ route('admin.affiliationss') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.affiliationss') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.affiliationss') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 0 1 9.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Affiliations
                @if(request()->routeIs('admin.affiliationss'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            {{-- DEPRECATED (migrated to Messages reçus)
            <a href="{{ route('admin.press') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.press') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.press') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h2V3h10v2h2a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h5m-5 4h8" />
                </svg>
                Press
                @if(request()->routeIs('admin.press'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
            --}}

        </div>

        <!-- Site Dynamics -->
        <div class="space-y-1 mb-8">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">@site Dynamics</p>

            <a href="{{ route('admin.badges') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.badges') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.badges') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                Badges
                @if(request()->routeIs('admin.badges'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <a href="{{ route('admin.reputation-points') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reputation-points') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.reputation-points') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                Leaderboard
                @if(request()->routeIs('admin.reputation-points'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
        </div>

        <!-- System -->
        <div class="space-y-1">
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">System</p>

            @if(auth()->guard('admin')->user()->hasAdminRole('super_admin'))
                <a href="{{ route('admin.roles-permissions') }}"
                   class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.roles-permissions') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.roles-permissions') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Roles & Permissions
                    @if(request()->routeIs('admin.roles-permissions'))
                        <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                    @endif
                    <span class="ml-auto">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Super
                        </span>
                    </span>
                </a>
            @endif

            <a href="{{ route('admin.settings') }}"
               class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.settings') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
                @if(request()->routeIs('admin.settings'))
                    <div class="ml-auto w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
        </div>
    </nav>
</aside>
