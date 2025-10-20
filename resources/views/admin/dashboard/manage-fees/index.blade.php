@extends('admin.dashboard.index')

@section('Title', 'Manage Fees')

@section('admin-content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100 py-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Service Commission</h1>
                        <p class="mt-3 text-lg text-gray-600 max-w-2xl">Configure and manage commission rates for different user types across your platform</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 relative">
                    <div class="rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 p-5 border border-green-200/50 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-green-800">Success!</p>
                                <p class="text-green-700 mt-1">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white/70 backdrop-blur-sm shadow-xl rounded-2xl border border-gray-200/50 overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-200/50 bg-white/50">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                Commission Configuration
                            </h2>
                        </div>

                        <form action="{{ route('admin.manage-fee.update', $commission) }}" method="POST" class="p-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-8">
                                <!-- Service Requester Fee -->
                                <div class="group">
                                    <label for="requester_fee" class="block text-sm font-semibold text-gray-800 mb-3">
                                        Service Requester Commission
                                    </label>
                                    <div class="relative">
                                        <input type="number" step="0.01" min="0" max="100" 
                                               name="requester_fee" 
                                               id="requester_fee" 
                                               value="{{ old('requester_fee', $commission->requester_fee) }}"
                                               class="block w-full pr-16 pl-4 py-4 text-lg border-2 border-blue-200 rounded-xl" 
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-lg font-medium">%</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Fee charged to users requesting services.
                                    </p>
                                </div>

                                <!-- Service Provider Fee -->
                                <div class="group">
                                    <label for="provider_fee" class="block text-sm font-semibold text-gray-800 mb-3">
                                        Service Provider Commission
                                    </label>
                                    <div class="relative">
                                        <input type="number" step="0.01" min="0" max="100" 
                                               name="provider_fee" 
                                               id="provider_fee" 
                                               value="{{ old('provider_fee', $commission->provider_fee) }}"
                                               class="block w-full pr-16 pl-4 py-4 text-lg border-2 border-blue-200 rounded-xl" 
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-lg font-medium">%</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Fee charged to service providers.
                                    </p>
                                </div>

                                <!-- Organization Fee -->
                                <div class="group">
                                    <label for="org_fee" class="block text-sm font-semibold text-gray-800 mb-3">
                                        Organization Commission
                                    </label>
                                    <div class="relative">
                                        <input type="number" step="0.01" min="0" max="100" 
                                               name="org_fee" 
                                               id="org_fee" 
                                               value="{{ old('org_fee', $commission->org_fee) }}"
                                               class="block w-full pr-16 pl-4 py-4 text-lg border-2 border-blue-200 rounded-xl" 
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-lg font-medium">%</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Fee allocated to organization operations.
                                    </p>
                                </div>

                                <!-- Affiliate Fee -->
                                <div class="group">
                                    <label for="affiliate_fee" class="block text-sm font-semibold text-gray-800 mb-3">
                                        Affiliate Commission
                                    </label>
                                    <div class="relative">
                                        <input type="number" step="0.01" min="0" max="100" 
                                               name="affiliate_fee" 
                                               id="affiliate_fee" 
                                               value="{{ old('affiliate_fee', $commission->affiliate_fee) }}"
                                               class="block w-full pr-16 pl-4 py-4 text-lg border-2 border-blue-200 rounded-xl" 
                                               required>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 text-lg font-medium">%</span>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Fee allocated to affiliate partners
                                    </p>
                                </div>

                                <!-- Description -->
                                <div class="group">
                                    <label for="description" class="block text-sm font-semibold text-gray-800 mb-3">
                                        Description & Notes
                                    </label>
                                    <textarea name="description" id="description" rows="4" 
                                              placeholder="Add any additional notes about these commission rates..."
                                              class="block w-full px-4 py-4 text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50/50 hover:bg-white focus:bg-white resize-none">{{ old('description', $commission->description) }}</textarea>
                                    <p class="mt-2 text-sm text-gray-600">Optional notes for internal reference</p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end mt-10 pt-6 border-t border-gray-200">
                                <button type="submit" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Update Commission Rates
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar Information -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Commission Overview Card -->
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-gray-200/50 shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center mb-4">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                Current Rates
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Requesters</span>
                                    <span class="font-semibold text-blue-600">{{ $commission->requester_fee }}%</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Providers</span>
                                    <span class="font-semibold text-green-600">{{ $commission->provider_fee }}%</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Organization</span>
                                    <span class="font-semibold text-purple-600">{{ $commission->org_fee }}%</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Affiliates</span>
                                    <span class="font-semibold text-orange-600">{{ $commission->affiliate_fee }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Information Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200/50 shadow-sm overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-semibold text-blue-900 mb-3">Commission Guide</h3>
                                    <div class="space-y-3 text-sm text-blue-800">
                                        <div class="flex items-start">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                            <p><strong>Service Requesters:</strong> Fee charged when booking services</p>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                            <p><strong>Service Providers:</strong> Commission on completed services</p>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                            <p><strong>Organizations:</strong> Platform operational fees</p>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-3 mt-1.5 flex-shrink-0"></div>
                                            <p><strong>Affiliates:</strong> Partner referral commissions</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection