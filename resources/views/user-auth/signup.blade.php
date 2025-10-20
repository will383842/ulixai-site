@include('includes.header')
<div class="mt-12">
  <div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-6xl bg-white shadow-2xl rounded-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

      <!-- Left: Signup Form -->
      <div class="p-10 bg-white flex items-center justify-center">
        <div class="w-full max-w-xs">
          <div class="flex justify-between items-center mb-6">
            
          </div>

          <h1 class="text-2xl font-bold text-blue-700 mb-1">Create Account</h1>
          <p class="text-sm text-gray-600 mb-6">Join Ulixai today.</p>
                         <!-- Social Login Buttons -->
          <div class="space-y-3 mb-6">
            <!-- Facebook -->
            <!-- <button class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-md py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
              <img src="https://upload.wikimedia.org/wikipedia/commons/1/1b/Facebook_icon.svg" class="w-5 h-5" alt="Facebook logo">
              Continue with Facebook
            </button> -->
            
            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-md py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
              <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
              Continue with Google
            </a>
          </div>
            @php 
                  $affiliateCode = request()->query('code') ?? null;
            @endphp
          <form id="signupForm" class="space-y-4" autocomplete="off" method="POST" action="{{route('user.signupRegister')}}">
            @csrf
            <div>
              <label class="block text-sm text-gray-700">Full Name</label>
              <input name="name" type="text" required class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="John Doe" />
              <div class="text-xs text-red-600 mt-1" id="error-name"></div>
            </div>

            <div>
              <label class="block text-sm text-gray-700">Email</label>
              <input name="email" type="email" required class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="you@example.com" />
              <div class="text-xs text-red-600 mt-1" id="error-email"></div>
            </div>

            <div>
              <label class="block text-sm text-gray-700">Password</label>
              <input name="password" type="password" required minlength="6" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="••••••••" />
              <div class="text-xs text-red-600 mt-1" id="error-password"></div>
            </div>

            <div>
              <label class="block text-sm text-gray-700">Confirm Password</label>
              <input name="password_confirmation" type="password" required minlength="6" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-600 focus:outline-none" placeholder="••••••••" />
              <div class="text-xs text-red-600 mt-1" id="error-password_confirmation"></div>
            </div>
            <!-- Gender Toggle -->
            <div class="flex justify-center mb-4">
              <div class="flex bg-white border border-blue-500 rounded-full overflow-hidden">
                <input type="radio" name="gender" id="male" value="Male" class="sr-only" required>
                <label for="male"
                  class="cursor-pointer px-6 py-2 text-blue-500 font-semibold transition-all duration-300"
                  onclick="toggleGender('male')">
                  Male
                </label>

                <input type="radio" name="gender" id="female" value="Female" class="sr-only" required>
                <label for="female"
                  class="cursor-pointer px-6 py-2 text-white bg-blue-600 font-semibold transition-all duration-300"
                  onclick="toggleGender('female')">
                  Female
                </label>
              </div>
              <input type="text" name="affiliate_code" value="{{ $affiliateCode }}" class="hidden" />
              <div class="text-xs text-red-600 mt-1" id="error-gender"></div>
            </div>
            <button type="submit" id="signupBtnSubmit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-md">Sign Up</button>
            <div id="signup-success" class="text-green-600 text-sm mt-2 hidden"></div>
            <div id="signup-error" class="text-red-600 text-sm mt-2 hidden"></div>
          </form>
          <p class="text-xs text-center text-gray-600 mt-3">
            Creating an account implies that you have read and accepted the terms
            <a href="#" class="text-blue-500 hover:underline">et conditions of use</a>.
          </p>
          <p class="mt-6 text-xs text-center text-gray-600">
            Already registered? <a href="/login" class="text-blue-600 font-medium hover:underline">Log in here</a>
          </p>
        </div>

      </div>



      <!-- Right: Features -->
      <div class="bg-blue-700 text-white px-10 py-16 flex flex-col justify-center">
        <div class="max-w-md space-y-10">
          <div>
            <h2 class="text-lg font-bold flex items-center gap-3"><i class="fas fa-globe"></i> Global Help</h2>
            <p class="text-sm text-blue-100 mt-2">Support across borders for expats and travelers.</p>
          </div>

          <div>
            <h2 class="text-lg font-bold flex items-center gap-3"><i class="fas fa-lightbulb"></i> Smart Matching</h2>
            <p class="text-sm text-blue-100 mt-2">Get matched with the right help instantly.</p>
          </div>

          <div>
            <h2 class="text-lg font-bold flex items-center gap-3"><i class="fas fa-chart-line"></i> Dashboard</h2>
            <p class="text-sm text-blue-100 mt-2">Manage requests, see progress and connect easily.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="mt-12">
    @include('includes.footer')
  </div>
<script>
function toggleGender(selected) {
  const maleLabel = document.querySelector("label[for='male']");
  const femaleLabel = document.querySelector("label[for='female']");

  if (selected === 'male') {
    maleLabel.classList.add("bg-blue-600", "text-white");
    maleLabel.classList.remove("text-blue-500");
    femaleLabel.classList.remove("bg-blue-600", "text-white");
    femaleLabel.classList.add("text-blue-500");
    document.getElementById('male').checked = true;
    document.getElementById('female').checked = false;
  } else {
    femaleLabel.classList.add("bg-blue-600", "text-white");
    femaleLabel.classList.remove("text-blue-500");
    maleLabel.classList.remove("bg-blue-600", "text-white");
    maleLabel.classList.add("text-blue-500");
    document.getElementById('female').checked = true;
    document.getElementById('male').checked = false;
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('signupForm');
  const signupBtn = document.getElementById('signupBtnSubmit');
  
  form.addEventListener('submit', function (e) {
    const successMsg = document.getElementById('signup-success');
    const errorMsg = document.getElementById('signup-error');
    successMsg.classList.add('hidden');
    errorMsg.classList.add('hidden');
    
    // Clear previous errors
    ['name', 'email', 'password', 'password_confirmation', 'gender'].forEach(f => {
      document.getElementById('error-' + f).textContent = '';
    });

    // Front-end validation
    let valid = true;
    const name = form.elements['name'].value.trim();
    const email = form.elements['email'].value.trim();
    const password = form.elements['password'].value;
    const password_confirmation = form.elements['password_confirmation'].value;
    let gender = '';
    
    if (form.elements['gender'].length) {
      for (const radio of form.elements['gender']) {
        if (radio.checked) gender = radio.value;
      }
    } else {
      gender = form.elements['gender'].value;
    }

    if (!name) {
      document.getElementById('error-name').textContent = 'Full name is required.';
      valid = false;
    }
    if (!email) {
      document.getElementById('error-email').textContent = 'Email is required.';
      valid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
      document.getElementById('error-email').textContent = 'Invalid email address.';
      valid = false;
    }
    if (!password) {
      document.getElementById('error-password').textContent = 'Password is required.';
      valid = false;
    } else if (password.length < 6) {
      document.getElementById('error-password').textContent = 'Password must be at least 6 characters.';
      valid = false;
    }
    if (!password_confirmation) {
      document.getElementById('error-password_confirmation').textContent = 'Please confirm your password.';
      valid = false;
    } else if (password !== password_confirmation) {
      document.getElementById('error-password_confirmation').textContent = 'Passwords do not match.';
      valid = false;
    }
    if (!gender) {
      document.getElementById('error-gender').textContent = 'Gender is required.';
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
      signupBtn.disabled = false;
      return false;
    }
    // Allow form submission - it will redirect to dashboard after successful registration
  });
});
</script>


