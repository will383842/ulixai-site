@extends('admin.dashboard.index')

@section('admin-content')
<div class="mx-auto py-8 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Site Settings</h1>
        <p class="text-gray-600">Manage your site configuration and legal information</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-row gap-4 mb-6">
        <a href="{{ route('admin.faqs.index') }}" class="text-blue-600 hover:underline">Manage FAQ</a>
        <a href="{{ route('admin.terms.index') }}" class="text-blue-600 hover:underline">Manage Terms and Conditions</a>
    </div>

    <form method="POST" action="{{ route('admin.settings') }}" class="space-y-8">
        @csrf
        @method('PATCH')
        
        <!-- Site Configuration Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Site Configuration
                </h2>
                <p class="text-gray-600 text-sm mt-1">Basic site information and branding</p>
            </div>
            <div class="px-6 py-6">
                <div class="space-y-4">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                        <input 
                            type="text" 
                            id="site_name"
                            name="site_name" 
                            value="{{ old('site_name', $settings->site_name ?? '') }}" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                            placeholder="Enter your site name"
                            required
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Legal Information Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Legal Information
                </h2>
                <p class="text-gray-600 text-sm mt-1">Legal notices, disclaimers and compliance information</p>
            </div>
            <div class="px-6 py-6">
                <div>
                    <label for="legal_info" class="block text-sm font-medium text-gray-700 mb-2">Legal Notice Content</label>
                    <p class="text-xs text-gray-500 mb-3">HTML is supported (h1, h2, h3, p, ul, li, strong, em, a, etc.)</p>
                    <textarea 
                        id="legal_info"
                        name="legal_info" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 font-mono text-sm" 
                        rows="16"
                        placeholder="Enter your legal notice content here. You can use HTML formatting (e.g., <h2>Section Title</h2>, <p>Content...</p>, <ul><li>Item</li></ul>, etc.)"
                    >@php
    $legalValue = old('legal_info', $settings->legal_info ?? '');
    if (is_array($legalValue)) {
        $legalValue = json_encode($legalValue, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    echo $legalValue;
@endphp</textarea>
                    <p class="text-xs text-gray-500 mt-2">Tip: Use semantic HTML tags for better structure and SEO</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <button 
                type="button" 
                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium"
                onclick="window.location.reload()"
            >
                Cancel
            </button>
            <button 
                type="submit" 
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection