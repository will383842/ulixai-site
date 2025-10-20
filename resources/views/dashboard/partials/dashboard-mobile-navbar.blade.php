<!-- Bottom Navigation Bar - Mobile Only -->
<div class="lg:hidden fixed bottom-0 left-0 w-full bg-white border-t border-gray-300 z-50">
  <div class="flex justify-around items-center py-2">

    <!-- Services -->
    <a href="{{ route('user.service.requests') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-600 text-xs">
      <i class="fas fa-briefcase text-lg"></i>
      <span>Services</span>
    </a>

    <!-- Job -->
    <a href="{{ route('user.joblist') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-600 text-xs">
      <i class="fas fa-file-alt text-lg"></i>
      <span>Job</span>
    </a>

    <!-- Payments -->
    <a href="{{ route('user.payments') }}" class="flex flex-col items-center text-gray-700 hover:text-blue-600 text-xs">
      <i class="fas fa-credit-card text-lg"></i>
      <span>Payments</span>   
    </a>

    <!-- Message with badge -->
    <a href="{{ route('user.conversation') }}" class="relative flex flex-col items-center text-gray-700 hover:text-blue-600 text-xs">
      <i class="fas fa-comment-dots text-lg"></i>
      <span>Message</span>
      <span class="absolute top-0 right-0 -mt-1 -mr-2 bg-red-500 text-white text-xs font-bold px-1.5 rounded-full">3</span>
    </a>

  </div>
</div>
