@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<form id="termsForm" class="max-w-5xl mx-auto">
  <!-- Terms & Conditions -->
  <div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
      <h2 class="text-xl font-semibold text-gray-800 flex items-center">
        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
        Terms & Conditions
      </h2>
      <p class="text-gray-600 text-sm mt-1">Edit the section content. Titles/order are fixed.</p>
    </div>

    <div class="px-6 py-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" id="termsGrid">
        <!-- JS injects 10 textareas here -->
      </div>
    </div>
  </div>

  <!-- Actions -->
  <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
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
  const grid = document.getElementById('termsGrid');
  const form = document.getElementById('termsForm');
  const cancelBtn = document.getElementById('cancelBtn');
  const saveBtn = document.getElementById('saveBtn');
  const saveMsg = document.getElementById('saveMsg');

  // fixed titles/order/slugs; UI shows *only body* textareas
  const MAP = [
    {number:1,  title:'Accepting the terms',     slug:'accepting-the-terms'},
    {number:2,  title:'Changes to terms',        slug:'changes-to-terms'},
    {number:3,  title:'Using our product',       slug:'using-our-product'},
    {number:4,  title:'General restrictions',    slug:'general-restrictions'},
    {number:5,  title:'Content policy',          slug:'content-policy'},
    {number:6,  title:'Your rights',             slug:'your-rights'},
    {number:7,  title:'Copyright policy',        slug:'copyright-policy'},
    {number:8,  title:'Relationship guidelines', slug:'relationship-guidelines'},
    {number:9,  title:'Liability Policy',        slug:'liability-policy'},
    {number:10, title:'General legal terms',     slug:'general-legal-terms'},
  ];

  // render 10 textareas
  MAP.forEach(item => {
    const wrap = document.createElement('div');
    wrap.className = 'col-span-1';
    wrap.innerHTML = `
      <label for="${item.slug}" class="block text-sm font-medium text-gray-700 mb-2">
        ${item.number}. ${item.title}
      </label>
      <textarea id="${item.slug}" name="${item.slug}"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
        rows="4" placeholder="Write ${item.title.toLowerCase()}..."></textarea>
    `;
    grid.appendChild(wrap);
  });

  // load existing bodies (controller fetch seeds defaults if missing)
  async function load() {
    saveMsg.textContent = 'Loading...';
    try {
      const res = await fetch(`{{ route('admin.terms.fetch') }}`);
      const data = await res.json();
      if (!data.success) throw new Error('fetch failed');

      const bySlug = {};
      (data.sections || []).forEach(s => bySlug[s.slug] = s);

      MAP.forEach(m => {
        const ta = document.getElementById(m.slug);
        const row = bySlug[m.slug];
        m.id = row?.id ?? null;                 // keep ID to update
        ta.value = typeof row?.body === 'string' ? row.body : '';
      });

      saveMsg.textContent = '';
    } catch (e) {
      console.error(e);
      saveMsg.textContent = 'Error loading.';
    }
  }

  // save all bodies (batch POST). UI only shows body, but we send fixed title/number.
  async function saveAll(e) {
    e.preventDefault();
    saveBtn.disabled = true;
    saveMsg.textContent = 'Saving...';

    const payloads = MAP.map(m => ({
      id: m.id ?? null,
      number: m.number,
      title: m.title,
      body: document.getElementById(m.slug).value || '',
      is_active: 1,
      version: null,
      effective_date: null,
    }));

    try {
      const results = await Promise.all(payloads.map(p =>
        fetch(`{{ route('admin.terms.store') }}`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json'
          },
          body: JSON.stringify(p)
        }).then(r => r.json())
      ));

      // update IDs after creation
      results.forEach((res, i) => {
        if (res?.success && res.section) MAP[i].id = res.section.id;
      });

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
