@include('includes.header')
<div class="min-h-screen flex items-center justify-center bg-blue-50 px-4">
  <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 space-y-8">
    <div class="text-center">
      <img src="/images/headerlogo.png" alt="ULIXAI Logo" class="mx-auto w-16 h-16 mb-4" />
      <h2 class="text-2xl font-bold text-blue-900 mb-2">Verify Your Email</h2>
      <p class="text-blue-700 mb-4">Enter the 6-digit code sent to your email address.</p>
    </div>
    <form id="verifyOtpForm" class="space-y-4">
      <input type="email" id="verify_email" name="email" required placeholder="Your email" class="w-full border border-blue-300 rounded-full px-4 py-3 text-blue-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600" />
      <input type="text" id="verify_otp" name="otp" maxlength="6" required placeholder="Enter OTP" class="w-full border border-blue-300 rounded-full px-4 py-3 text-blue-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 tracking-widest text-center text-lg" />
      <div id="otp_error" class="text-red-600 text-sm hidden"></div>
      <button type="submit" id="verifyBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-full transition">Verify</button>
    </form>
    <div class="flex justify-between items-center mt-4">
      <button id="resendOtpBtn" class="text-blue-600 hover:underline font-medium">Resend OTP</button>
      <button id="cancelOtpBtn" class="text-gray-500 hover:text-blue-600 font-medium">Cancel</button>
    </div>
    <div id="otp_success" class="text-green-600 text-center text-sm mt-2 hidden"></div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('verifyOtpForm');
  const verifyBtn = document.getElementById('verifyBtn');
  const resendBtn = document.getElementById('resendOtpBtn');
  const cancelBtn = document.getElementById('cancelOtpBtn');
  const otpError = document.getElementById('otp_error');
  const otpSuccess = document.getElementById('otp_success');
  const emailInput = document.getElementById('verify_email');
  const otpInput = document.getElementById('verify_otp');

  // Optionally prefill email if available
  const user = @json($user ?? []);

  if (user && user.email && emailInput) {
    emailInput.value = user.email;
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    otpError.classList.add('hidden');
    otpSuccess.classList.add('hidden');
    verifyBtn.disabled = true;

    const email = emailInput.value.trim();
    const otp = otpInput.value.trim();

    if (!email || !otp || otp.length !== 6) {
      otpError.textContent = "Please enter your email and the 6-digit code.";
      otpError.classList.remove('hidden');
      verifyBtn.disabled = false;
      return;
    }

    fetch('/verify-email-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email, otp })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        otpSuccess.textContent = data.message || "Email verified successfully!";
        otpSuccess.classList.remove('hidden');
        otpError.classList.add('hidden');
        setTimeout(() => { window.location.href = '/dashboard'; }, 1500);
      } else {
        otpError.textContent = data.message || "Invalid code. Please try again.";
        otpError.classList.remove('hidden');
        otpSuccess.classList.add('hidden');
      }
    })
    .catch(() => {
      otpError.textContent = "Verification failed. Please try again.";
      otpError.classList.remove('hidden');
      otpSuccess.classList.add('hidden');
    })
    .finally(() => {
      verifyBtn.disabled = false;
    });
  });

  resendBtn.addEventListener('click', function () {
    otpError.classList.add('hidden');
    otpSuccess.classList.add('hidden');
    const email = emailInput.value.trim();
    if (!email) {
      otpError.textContent = "Please enter your email to resend OTP.";
      otpError.classList.remove('hidden');
      return;
    }
    resendBtn.disabled = true;
    fetch('/resend-email-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        otpSuccess.textContent = data.message || "OTP resent successfully!";
        otpSuccess.classList.remove('hidden');
        otpError.classList.add('hidden');
      } else {
        otpError.textContent = data.message || "Failed to resend OTP.";
        otpError.classList.remove('hidden');
        otpSuccess.classList.add('hidden');
      }
    })
    .catch(() => {
      otpError.textContent = "Failed to resend OTP. Please try again.";
      otpError.classList.remove('hidden');
      otpSuccess.classList.add('hidden');
    })
    .finally(() => {
      resendBtn.disabled = false;
    });
  });

  cancelBtn.addEventListener('click', function () {
    window.location.href = '/';
  });
});
</script>
