<!-- Regular User Section -->
<div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl shadow-lg px-6 py-6 max-w-6xl mx-auto border border-gray-200">
  <h2 class="text-lg font-bold text-gray-800">My Account</h2>
  <p class="text-gray-600 text-sm mt-1">Manage your personal information and account settings.</p>
</div>

<!-- Personal Information Section for Regular Users -->
<div class="bg-white rounded-2xl shadow-lg px-4 sm:px-6 py-8 space-y-6 max-w-6xl mx-auto border border-gray-100">
  <h3 class="text-gray-800 font-bold text-lg sm:text-xl text-center sm:text-left">
    Account Settings
  </h3>

  <!-- Single Personal Info Card -->
  <div class="flex justify-center">
    <a href="{{ route('personal-info') }}" class="group bg-white border-2 border-gray-200 hover:border-blue-400 rounded-xl px-8 py-8 text-center font-semibold text-base transition-all duration-300 hover:shadow-md max-w-md w-full">
      <div class="flex flex-col items-center space-y-3">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </div>
        <div class="text-gray-700 group-hover:text-blue-600">Personal Information</div>
        <div class="text-sm text-gray-500">Update your profile details</div>
      </div>
    </a>
  </div>
</div>