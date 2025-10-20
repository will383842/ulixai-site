<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
    <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr + JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <title>Recruitment</title>
    <link rel="icon" type="image/png" sizes="64x64" href="images/faviccon.png" />
</head>
<style>
  /* force readable options across browsers */
  #country,
  #country option {
    color: #111827 !important;          /* Tailwind gray-900 */
  }
  #country option {
    background-color: #ffffff !important;
  }
  /* make the placeholder look muted */
  #country option[disabled][selected] {
    color: #6b7280 !important;          /* gray-500 */
  }
</style>

<body class="bg-white text-gray-800">
 @include('includes.header')
    @include('pages.popup')

 @include('pages.socialmediacard')


  <section class="py-16 px-6 max-w-4xl mx-auto">
    <h2 class="text-3xl font-bold text-blue-800 mb-8 text-center">🚀 Join the @site Adventure</h2>
    <p class="text-gray-700 max-w-2xl mx-auto mb-16 text-center">
      Are you a freelancer or independent worker? Want to work on a meaningful project, from anywhere, with a cool team? 🌍
    </p>

    <div class="space-y-12">
      <!-- Block 1 -->
      <div class="flex flex-col md:flex-row border border-blue-200 rounded-xl overflow-hidden shadow-md bg-white">
        <img src="images/whyulix.png" alt="Why Ulixai" class="w-full md:w-1/2 object-cover">
        <div class="p-6 md:w-1/2 flex flex-col justify-center">
          <h3 class="text-lg font-bold text-blue-700 mb-4">Why @site? ✨</h3>
          <ul class="list-disc list-inside space-y-2">
            <li>Total flexibility: work when you want, from wherever you want</li>
            <li>A real project to help people far from their home country</li>
            <li>A friendly atmosphere, no unnecessary stress</li>
            <li>Fair and transparent pay</li>
            <li>A true team: human, dynamic and always listening</li>
          </ul>
        </div>
      </div>

      <!-- Block 2 -->
      <div class="flex flex-col md:flex-row border border-blue-200 rounded-xl overflow-hidden shadow-md bg-white">
        <div class="p-6 md:w-1/2 flex flex-col justify-center order-2 md:order-1">
          <h3 class="text-lg font-bold text-blue-700 mb-4">The @site Mindset 🧠</h3>
          <ul class="list-disc list-inside space-y-2">
            <li>We love motivated, curious and independent people</li>
            <li>You can ask questions, suggest ideas</li>
            <li>We take our work seriously — but not ourselves</li>
            <li>You grow with us, at your own pace</li>
            <li>No heavy hierarchy — just openness and honesty</li>
          </ul>
        </div>
        <img src="images/ulixmindset.png" alt="Ulixai Mindset" class="w-full md:w-1/2 object-cover order-1 md:order-2">
      </div>

      <!-- Block 3 -->
      <div class="flex flex-col md:flex-row border border-blue-200 rounded-xl overflow-hidden shadow-md bg-white">
        <img src="images/maybe.png" alt="Maybe You Are" class="w-full md:w-1/2 object-cover">
        <div class="p-6 md:w-1/2 flex flex-col justify-center">
          <h3 class="text-lg font-bold text-blue-700 mb-4">And maybe you are… 🔍</h3>
          <ul class="list-disc list-inside space-y-2">
            <li>A developer, designer, translator, coach, assistant or trainer</li>
            <li>...or simply someone motivated, reliable, kind and enthusiastic!</li>
            <li>No matter your background — if you have heart, you belong here 💙</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Roles Section -->
 <section class="bg-white py-10 px-6 max-w-6xl mx-auto text-center">
  <h2 class="text-3xl font-bold text-blue-800 mb-10">🎯 @site Opportunities</h2>

  <div id="rolesGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-left">
    <!-- dynamic cards will be injected here -->
  </div>

  <div id="rolesEmpty" class="hidden text-gray-500 mt-6">No roles available right now.</div>
</section>

<script>
(() => {
  const grid  = document.getElementById('rolesGrid');
  const empty = document.getElementById('rolesEmpty');

  const esc = s => String(s ?? '').replace(/[&<>"']/g, m => (
    {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]
  ));

  async function loadPublicRoles() {
    // If your routes are inside an admin group, use route('admin.roles.json') here:
    const url = "{{ route('admin.roles.json') }}?per_page=100";
    const res = await fetch(url, { headers: { Accept: 'application/json' } });

    if (!res.ok) {
      console.error('Failed to load roles', res.status);
      grid.innerHTML = '';
      empty.classList.remove('hidden');
      return;
    }

    const { data = [] } = await res.json();
    // show only active roles to the public
    const items = data.filter(r => !!r.is_active);

    if (!items.length) {
      grid.innerHTML = '';
      empty.classList.remove('hidden');
      return;
    }
    empty.classList.add('hidden');

    grid.innerHTML = items.map(r => {
      const title = `${r.emoji ? esc(r.emoji) + ' ' : ''}${esc(r.title)}`;
      const tagline = esc(r.short_tagline);
      const accent = esc(r.accent_class || 'text-blue-700');

      // keep your existing openModal(title) behavior
      return `
        <div class="bg-white rounded-xl p-5 shadow border cursor-pointer hover:shadow-md transition"
             onclick="openModal('${title.replace(/'/g, "\\'")}')"
             data-role-id="${r.id}">
          <h3 class="${accent} font-semibold mb-1">${title}</h3>
          <p class="text-gray-600 text-sm">${tagline}</p>
        </div>
      `;
    }).join('');
  }

  loadPublicRoles();
})();
</script>


<!-- Modal -->
<div id="popupModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg w-full max-w-md p-6 relative shadow-lg">
    <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl font-bold">&times;</button>
    <h2 id="modalTitle" class="text-xl font-bold text-blue-800 text-center mb-4">
      Apply for: [Title]
    </h2>

    <div id="formContent">
      <form class="space-y-3" id="applicationForm">
        {{-- hidden role title set by JS --}}
        <input type="hidden" name="role_title" id="role_title"/>
        
 
<select name="country" id="country"
        class="w-full border border-gray-300 rounded px-3 py-2 bg-white text-gray-900" required>
  <option value="" disabled selected style="color:#6b7280">Select your country</option>
  @foreach ($allCountries as $country)
    <option  style="color:#111827;">
        {{ $country->country }}
    </option>
  @endforeach
</select>



        <input type="text" name="first_name"
               value="{{ Auth::check() ? Str::of(Auth::user()->name)->before(' ') : '' }}"
               placeholder="First name" class="w-full border border-gray-300 rounded px-3 py-2"/>

        <input type="text" name="last_name"
               value="{{ Auth::check() ? Str::of(Auth::user()->name)->after(' ') : '' }}"
               placeholder="Last name" class="w-full border border-gray-300 rounded px-3 py-2"/>

        <input type="text" name="phone" placeholder="Phone number (+33...)"
               class="w-full border border-gray-300 rounded px-3 py-2"/>

        <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
               placeholder="Email address" class="w-full border border-gray-300 rounded px-3 py-2" required/>

        <textarea name="message" placeholder="Your message"
                  class="w-full border border-gray-300 rounded px-3 py-2 h-24"></textarea>

        <input type="file" name="cv" class="w-full border border-gray-300 rounded px-3 py-2"/>

        <button type="submit" id="submitBtn"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded">
          Submit my application
        </button>
        <p class="text-center text-gray-500 text-xs">We will respond within 7 days.</p>
        <div id="formErrors" class="text-red-600 text-sm mt-2 hidden"></div>
      </form>
    </div>

    <div id="successMessage" class="hidden text-center text-green-600 font-semibold">
      <p>Your message has been sent successfully!</p>
    </div>
  </div>
</div>


@include('includes.footer')

<script>
  function openModal(title) {
    document.getElementById('popupModal').classList.remove('hidden');
    document.getElementById('modalTitle').innerText = 'Apply For : ' + title;
  }

  function closeModal() {
    document.getElementById('popupModal').classList.add('hidden');
  }

  document.getElementById('applicationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent actual form submission

    // Hide form content
    document.getElementById('formContent').classList.add('hidden');

    // Show success message
    document.getElementById('successMessage').classList.remove('hidden');
  });
</script>
<script>
document.getElementById("copyLinkBtn").addEventListener("click", function () {
    const link = document.getElementById("affiliateLink").value;
    navigator.clipboard.writeText(link).then(() => {
        toastr.success("Affiliate link copied to clipboard!");
    }).catch(() => {
        toastr.error("Failed to copy link!");
    });
});
</script>
<script>
  // open/close
  function openModal(roleTitle) {
    document.getElementById('modalTitle').textContent = 'Apply For : ' + roleTitle;
    document.getElementById('role_title').value = roleTitle;
    document.getElementById('popupModal').classList.remove('hidden');
  }
  function closeModal() {
    document.getElementById('popupModal').classList.add('hidden');
  }

  const form = document.getElementById('applicationForm');
  const submitBtn = document.getElementById('submitBtn');
  const successBox = document.getElementById('successMessage');
  const errorsBox = document.getElementById('formErrors');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    errorsBox.classList.add('hidden');
    errorsBox.innerHTML = '';

    const fd = new FormData(form);
    // CSRF
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    submitBtn.disabled = true;
    submitBtn.textContent = 'Submitting...';

    try {
      const res = await fetch("{{ route('recruit.apply') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
        body: fd
      });

      if (res.status === 422) {
        const data = await res.json();
        const list = Object.values(data.errors)
          .map(arr => `<li>${arr.join('<br>')}</li>`).join('');
        errorsBox.innerHTML = `<ul class="list-disc pl-4">${list}</ul>`;
        errorsBox.classList.remove('hidden');
      } else if (res.ok) {
        form.reset();
        document.getElementById('country').selectedIndex = 0;
        successBox.classList.remove('hidden');
        // optionally auto-close after a moment
        setTimeout(() => { successBox.classList.add('hidden'); closeModal(); }, 1500);
      } else {
        errorsBox.textContent = 'Unexpected error. Please try again.';
        errorsBox.classList.remove('hidden');
      }
    } catch (err) {
      errorsBox.textContent = 'Network error. Please try again.';
      errorsBox.classList.remove('hidden');
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Submit my application';
    }
  });
</script>


</body>
</html>