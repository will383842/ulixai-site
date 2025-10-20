@csrf
<div id="step15" class="hidden space-y-6">
  <h2 class="text-blue-900 font-bold text-xl">YOU SHOULD HAVE RECEIVED A CODE BY MAIL...</h2>
  <p class="text-sm text-blue-500">Remember to check your spams or junk folders</p>
  <input id="otp_input" type="text" placeholder="Enter the code received by email HERE" class="w-full border border-blue-300 rounded-full px-4 py-2" maxlength="6" />
  <div id="otp_error" class="text-red-600 text-sm hidden"></div>
  <div class="flex justify-between items-center">
    <button id="backToStep14" class="text-blue-600 font-medium"> Back</button>
    <button id="nextStep15" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
  </div>
  <div class="w-full h-2  rounded-full overflow-hidden"></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const nextStepBtn = document.getElementById('nextStep15');
  const otpInput = document.getElementById('otp_input');
  const otpError = document.getElementById('otp_error');
  const closePopupBtn = document.getElementById('closePopup');
  let otpVerified = false;

  // Prevent closing the popup if not verified
  if (closePopupBtn) {
    closePopupBtn.addEventListener('click', function(e) {
      if (!otpVerified) {
        e.stopPropagation();
        otpError.classList.remove('hidden');
        otpError.textContent = "You must verify your email before closing.";
      }
    });
  }

  nextStepBtn?.addEventListener('click', function (e) {
    e.preventDefault();
    otpError.classList.add('hidden');
    nextStepBtn.disabled = true;
    nextStepBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
    
    const otp = otpInput.value.trim();
    const expats = JSON.parse(localStorage.getItem('expats')) || {};
    const email = expats.email;

    if (!otp || otp.length !== 6) {
      otpError.textContent = "Please enter the 6-digit code.";
      otpError.classList.remove('hidden');
      return;
    }

    nextStepBtn.disabled = true;
    const token = document.querySelector('input[name="_token"]').value;
    
    fetch('/verify-email-otp', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email, otp, _token: token }),
      credentials: 'same-origin' // 👈 important for Laravel
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        otpVerified = true;
        otpError.classList.add('hidden');
        // Clear expats data after verification
        localStorage.removeItem('expats');
        // Move to next step
        document.getElementById('step15').classList.add('hidden');
        document.getElementById('step16').classList.remove('hidden');
      } else {
        otpVerified = false;
        otpError.textContent = data.message || "Invalid code. Please try again.";
        otpError.classList.remove('hidden');
      }
    })
    .catch(() => {
      otpVerified = false;
      otpError.textContent = "Verification failed. Please try again.";
      otpError.classList.remove('hidden');
    })
    .finally(() => {
      nextStepBtn.disabled = false;
      nextStepBtn.innerHTML = 'Next';
    });
  });

  // Prevent closing popup with ESC if not verified
  document.addEventListener('keydown', function (e) {
    if (e.key === "Escape" && !otpVerified) {
      e.preventDefault();
      otpError.classList.remove('hidden');
      otpError.textContent = "You must verify your email before closing.";
    }
  });
});
</script>