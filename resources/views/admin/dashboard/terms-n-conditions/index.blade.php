@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<form id="termsForm" class="max-w-4xl mx-auto">
  <!-- Terms & Conditions - ONE BIG TEXT -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-xl font-semibold text-gray-800 flex items-center">
        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
        Terms & Conditions
      </h2>
      <p class="text-gray-600 text-sm mt-1">Edit the complete terms and conditions text below.</p>
    </div>

    <div class="px-6 py-6">
      <!-- ONE BIG TEXTAREA FOR ALL CONTENT -->
      <div>
        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
          Complete Terms & Conditions
        </label>
        <textarea id="content" name="content"
          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 font-mono text-sm"
          rows="25" placeholder="Write your complete terms and conditions here..."></textarea>
        <p class="text-xs text-gray-500 mt-2">💡 Tip: You can use HTML formatting like &lt;h2&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;p&gt;, etc.</p>
      </div>
    </div>
  </div>

  <!-- Actions -->
  <div class="flex justify-end space-x-4 pt-6">
    <button type="button" id="cancelBtn"
            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
      Cancel
    </button>
    <button type="submit" id="saveBtn"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      Save Settings
    </button>
    <span id="saveMsg" class="self-center text-sm text-gray-500"></span>
  </div>
</form>

<script>
(() => {
  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
  const form = document.getElementById('termsForm');
  const cancelBtn = document.getElementById('cancelBtn');
  const saveBtn = document.getElementById('saveBtn');
  const saveMsg = document.getElementById('saveMsg');
  const contentField = document.getElementById('content');

  let sectionId = null; // Keep track of the record ID

  // Load existing content
  async function load() {
    saveMsg.textContent = 'Loading...';
    try {
      const res = await fetch(`{{ route('admin.terms.fetch') }}`);
      const data = await res.json();
      if (!data.success) throw new Error('fetch failed');

      // Get the first section (or create one if it doesn't exist)
      const section = (data.sections || [])[0];
      sectionId = section?.id ?? null;
      contentField.value = typeof section?.body === 'string' ? section.body : '';

      saveMsg.textContent = '';
    } catch (e) {
      console.error(e);
      saveMsg.textContent = 'Error loading.';
    }
  }

  // Save the big text
  async function saveAll(e) {
    e.preventDefault();
    saveBtn.disabled = true;
    saveMsg.textContent = 'Saving...';

    const payload = {
      id: sectionId ?? null,
      number: 1,
      title: 'Terms and Conditions',
      body: contentField.value || '',
      is_active: 1,
      slug: 'terms-and-conditions',
      version: null,
      effective_date: null,
    };

    try {
      const res = await fetch(`{{ route('admin.terms.store') }}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      }).then(r => r.json());

      if (res?.success && res.section) {
        sectionId = res.section.id;
      }

      saveMsg.textContent = 'Saved ✓';
      setTimeout(()=> saveMsg.textContent = '', 1500);
    } catch (e) {
      console.error(e);
      saveMsg.textContent = 'Save failed';
    } finally {
      saveBtn.disabled = false;
    }
  }

  function cancel() {
    load();
  }

  form.addEventListener('submit', saveAll);
  cancelBtn.addEventListener('click', cancel);
  load();
})();
</script>
@endsection