@extends('admin.dashboard.index')

@section('admin-content')
<script>
  window.ROUTES = {
    list:  @json(route('admin.roles.json')),   // ✅ add this
    store: @json(route('admin.roles.store')),  // POST /admin/roles
    base:  @json(url('admin/roles'))           // PATCH/DELETE /admin/roles/{id}
  };
</script>



<div class="p-6">
    

    {{-- =================== ROLES (ADMIN) PANEL — INLINE =================== --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base md:text-lg font-semibold">🧩 Manage Roles</h3>

       
        </div>

        {{-- Create / Edit form --}}
        <form id="roleForm" class="bg-white shadow rounded-lg p-4 grid grid-cols-1 md:grid-cols-6 gap-3 mb-4">
            @csrf
            <input type="hidden" name="id" id="roleId">

            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                <input name="title" id="roleTitle" class="w-full border rounded-md px-3 py-2" placeholder="e.g. Growth Marketer" required>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Emoji</label>
                <input name="emoji" id="roleEmoji" class="w-full border rounded-md px-3 py-2" placeholder="🎥">
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-600 mb-1">Short tagline</label>
                <input name="short_tagline" id="roleTagline" class="w-full border rounded-md px-3 py-2" placeholder="Write multilingual content..." required>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Accent class</label>
                <select name="accent_class" id="roleAccent" class="w-full border rounded-md px-3 py-2">
                    <option>text-blue-700</option>
                    <option>text-pink-600</option>
                    <option>text-indigo-600</option>
                    <option>text-purple-600</option>
                    <option>text-gray-800</option>
                    <option>text-orange-600</option>
                    <option>text-green-600</option>
                    <option>text-blue-900</option>
                    <option>text-indigo-900</option>
                </select>
            </div>

            <div class="flex items-center gap-3 md:col-span-6">
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" id="roleActive" checked>
                    Active
                </label>
                <div class="ml-auto flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
                    <button type="button" id="roleResetBtn" class="px-4 py-2 bg-gray-100 text-gray-800 rounded-md">Clear</button>
                </div>
            </div>
        </form>

        {{-- Roles list --}}
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-medium">ID</th>
                        <th class="px-4 py-3 font-medium">Emoji</th>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Tagline</th>
                        <th class="px-4 py-3 font-medium">Accent</th>
                        <th class="px-4 py-3 font-medium">Active</th>
                        <th class="px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody id="rolesBody"></tbody>
            </table>
        </div>

        <div class="flex items-center justify-between mt-3">
            <div class="text-xs text-gray-500" id="rolesMeta"></div>
            <div class="flex gap-2">
                <button id="rolesPrev" class="px-3 py-1.5 text-sm rounded-md border bg-white hover:bg-gray-50">Prev</button>
                <button id="rolesNext" class="px-3 py-1.5 text-sm rounded-md border bg-white hover:bg-gray-50">Next</button>
            </div>
        </div>
    </div>
    {{-- =================== /ROLES PANEL =================== --}}
 <h2 class="text-lg font-semibold mb-4">📄 Applications</h2>
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
       
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-4 py-3 font-medium">Date</th>
                    <th class="px-4 py-3 font-medium">Role Title</th>
                    <th class="px-4 py-3 font-medium">Applicant</th>
                    <th class="px-4 py-3 font-medium">Country</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Phone</th>
                    <th class="px-4 py-3 font-medium">Message</th>
                    <th class="px-4 py-3 font-medium">Resume</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr class="border-b hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-3 text-gray-700">{{ $app->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $app->role_title }}</td>
                    <td class="px-4 py-3">{{ $app->first_name }} {{ $app->last_name }}</td>
                    <td class="px-4 py-3">{{ $app->country }}</td>
                    <td class="px-4 py-3">
                        <a href="mailto:{{ $app->email }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $app->email }}
                        </a>
                    </td>
                    <td class="px-4 py-3">{{ $app->phone }}</td>
                    <td class="px-4 py-3" title="{{ $app->message }}">{{ Str::limit($app->message, 50) }}</td>
                    <td class="px-4 py-3">
                        @if($app->cv_path)
                            <button onclick="openCvModal('{{ route('admin.applications.cv', $app) }}')"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded-md hover:bg-blue-100 transition-colors duration-200 border border-blue-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                CV
                            </button>
                        @else
                            <span class="inline-flex items-center px-3 py-1.5 bg-gray-50 text-gray-500 text-xs font-medium rounded-md border">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                No CV
                            </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.applications.update-status', $app) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()" 
                                    class="text-xs font-medium rounded-full px-3 py-1 border-0 cursor-pointer focus:ring-2 focus:ring-offset-2 transition-all duration-200
                                    {{ $app->status == 'new' ? 'bg-yellow-100 text-yellow-800 focus:ring-yellow-500' : '' }}
                                    {{ $app->status == 'reviewing' ? 'bg-blue-100 text-blue-800 focus:ring-blue-500' : '' }}
                                    {{ $app->status == 'rejected' ? 'bg-red-100 text-red-800 focus:ring-red-500' : '' }}
                                    {{ $app->status == 'hired' ? 'bg-green-100 text-green-800 focus:ring-green-500' : '' }}">
                                <option value="new" {{ $app->status=='new'?'selected':'' }}> New</option>
                                <option value="reviewing" {{ $app->status=='reviewing'?'selected':'' }}> Reviewing</option>
                                <option value="rejected" {{ $app->status=='rejected'?'selected':'' }}> Rejected</option>
                                <option value="hired" {{ $app->status=='hired'?'selected':'' }}> Hired</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.applications.destroy', $app) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 text-xs font-medium rounded-md hover:bg-red-100 transition-colors duration-200 border border-red-200 focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $applications->links() }}
    </div>

    <!-- Enhanced CV Modal -->
    <div id="cvModal" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-5xl h-5/6 rounded-xl shadow-2xl overflow-hidden animate-fade-in">
            <div class="flex justify-between items-center px-6 py-4 bg-gray-50 border-b">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Resume Preview
                </h3>
                <button onclick="closeCvModal()" 
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-200 rounded-full p-2 transition-colors duration-200 text-2xl font-light">
                    ×
                </button>
            </div>
            <div class="relative h-full">
                <iframe id="cvFrame" src="" class="w-full h-full bg-gray-100"></iframe>
                <div id="cvLoader" class="absolute inset-0 bg-white flex items-center justify-center">
                    <div class="flex items-center space-x-2">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <span class="text-gray-600">Loading resume...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body{ overflow-x: hidden; }
    @keyframes fade-in { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    .animate-fade-in { animation: fade-in 0.2s ease-out; }
    .status-select { appearance: none; min-width: 120px; }
    .status-select:focus { outline: none; }
    .status-new { background-color:#fef3c7;color:#92400e;border-color:#fde68a; }
    .status-reviewing { background-color:#dbeafe;color:#1e40af;border-color:#bfdbfe; }
    .status-rejected { background-color:#fee2e2;color:#dc2626;border-color:#fecaca; }
    .status-hired { background-color:#dcfce7;color:#16a34a;border-color:#bbf7d0; }
</style>

{{-- ========= ROLES PANEL SCRIPTS ========= --}}
<script>
(() => {
  // --- ROUTES fallback (remove if you already set these above) ---
  if (!window.ROUTES) {
    window.ROUTES = {
      list:  @json(route('admin.roles.json')),
      store: @json(route('admin.roles.store')),
      base:  @json(url('admin/roles')),
    };
  }

  const token = document.querySelector('meta[name="csrf-token"]')?.content;
  if (!token) console.warn('CSRF meta tag missing');

  const esc = s => String(s ?? '').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));

  let page = 1, lastPage = 1, q = '';

  const rolesBody = document.getElementById('rolesBody');
  const rolesMeta = document.getElementById('rolesMeta');     // may be null
  const rolesPrev = document.getElementById('rolesPrev');     // may be null
  const rolesNext = document.getElementById('rolesNext');     // may be null

  const searchInp = document.getElementById('rolesSearch');   // may be null
  const searchBtn = document.getElementById('rolesSearchBtn');// may be null
  const resetBtn  = document.getElementById('rolesResetBtn'); // may be null

  const form      = document.getElementById('roleForm');      // required if inline edit
  const fId       = document.getElementById('roleId');
  const fTitle    = document.getElementById('roleTitle');
  const fEmoji    = document.getElementById('roleEmoji');
  const fTagline  = document.getElementById('roleTagline');
  const fAccent   = document.getElementById('roleAccent');
  const fActive   = document.getElementById('roleActive');
  const formReset = document.getElementById('roleResetBtn');

  function setLoading() {
    rolesBody.innerHTML = `<tr><td colspan="7" class="px-4 py-6 text-gray-500">Loading…</td></tr>`;
    if (rolesMeta) rolesMeta.textContent = '';
  }

  async function loadRoles() {
    setLoading();
    const url = `${ROUTES.list}?page=${page}&per_page=12${q ? `&q=${encodeURIComponent(q)}` : ''}`;
    try {
      const res = await fetch(url, { headers: { 'Accept': 'application/json' }, credentials: 'same-origin' });
      if (!res.ok) throw new Error(await res.text());
      const json = await res.json();
      drawRoles(json.data || []);
      const meta = json.meta || {};
      lastPage = meta.last_page ?? 1;

      if (rolesMeta) rolesMeta.textContent = `Page ${meta.current_page ?? page} of ${lastPage} · ${meta.total ?? 0} total`;
      if (rolesPrev) rolesPrev.disabled = (page <= 1);
      if (rolesNext) rolesNext.disabled = (page >= lastPage);
    } catch (e) {
    
      ;
      if (rolesMeta) rolesMeta.textContent = '';
    }
  }

  function drawRoles(items) {
    if (!items.length) {
      rolesBody.innerHTML = `<tr><td colspan="7" class="px-4 py-6 text-gray-500">No roles found.</td></tr>`;
      return;
    }
    rolesBody.innerHTML = items.map(r => `
      <tr class="border-b hover:bg-gray-50" data-id="${r.id}">
        <td class="px-4 py-3">${r.id}</td>
        <td class="px-4 py-3">${esc(r.emoji ?? '')}</td>
        <td class="px-4 py-3"><span class="${esc(r.accent_class ?? 'text-blue-700')} font-medium">${esc(r.title ?? '')}</span></td>
        <td class="px-4 py-3">${esc(r.short_tagline ?? '')}</td>
        <td class="px-4 py-3">${esc(r.accent_class ?? '')}</td>
        <td class="px-4 py-3">
          <label class="inline-flex items-center gap-2">
            <input type="checkbox" ${r.is_active ? 'checked' : ''} data-id="${r.id}" class="role-toggle">
            <span class="text-xs">${r.is_active ? 'Yes' : 'No'}</span>
          </label>
        </td>
        <td class="px-4 py-3">
          <button class="text-blue-600 hover:underline role-edit" data-id="${r.id}">Edit</button>
          <button class="text-red-600 hover:underline ml-3 role-delete" data-id="${r.id}">Delete</button>
        </td>
      </tr>
    `).join('');
  }

  // delegated events for toggles & actions
  rolesBody.addEventListener('change', async (e) => {
    if (!e.target.classList.contains('role-toggle')) return;
    const id = e.target.getAttribute('data-id');
    const active = e.target.checked;
    try {
      const res = await fetch(`${ROUTES.base}/${id}`, {
        method: 'PATCH',
        headers: {
          'X-CSRF-TOKEN': token,
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ is_active: !!active }),
        credentials: 'same-origin',
      });
      if (!res.ok) throw new Error(await res.text());
      const label = e.target.closest('label')?.querySelector('span');
      if (label) label.textContent = active ? 'Yes' : 'No';
    } catch (err) {
      alert('Failed to update status');
      await loadRoles();
    }
  });

  rolesBody.addEventListener('click', async (e) => {
    const id = e.target.getAttribute('data-id');
    if (!id) return;

    // Edit → fill the inline form
    if (e.target.classList.contains('role-edit')) {
      const row = rolesBody.querySelector(`tr[data-id="${id}"]`);
      if (!row || !form) return;
      fId.value       = id;
      fEmoji.value    = row.children[1].textContent.trim();
      fTitle.value    = row.children[2].innerText.trim();
      fTagline.value  = row.children[3].textContent.trim();
      const accentVal = row.children[4].textContent.trim();

      // ensure select has the value; if not, add it as an option but keep UI consistent
      if (![...fAccent.options].some(o => o.value === accentVal)) {
        const opt = document.createElement('option');
        opt.value = accentVal;
        opt.textContent = accentVal || 'text-blue-700';
        fAccent.appendChild(opt);
      }
      fAccent.value   = accentVal || 'text-blue-700';
      fActive.checked = row.querySelector('input[type="checkbox"]').checked;
      fTitle.focus();
    }

    // Delete
    if (e.target.classList.contains('role-delete')) {
      if (!confirm('Delete this role?')) return;
      try {
        const res = await fetch(`${ROUTES.base}/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
          },
          credentials: 'same-origin',
        });
        if (!res.ok) throw new Error(await res.text());

        // If we removed the last row on this page, step back a page
        if (rolesBody.children.length <= 1 && page > 1) page--;
        await loadRoles();
      } catch (err) {
        alert('Failed to delete');
      }
    }
  });

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      const payload = {
        title: fTitle.value,
        emoji: fEmoji.value || null,
        short_tagline: fTagline.value,
        accent_class: fAccent.value,
        is_active: !!fActive.checked,
      };

      const isUpdate = !!fId.value;
      const url = isUpdate ? `${ROUTES.base}/${fId.value}` : ROUTES.store;
      const method = isUpdate ? 'PATCH' : 'POST';

      try {
        const res = await fetch(url, {
          method,
          headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(payload),
          credentials: 'same-origin',
        });

        if (res.status === 422) {
          const j = await res.json();
          const messages = Object.values(j.errors || {}).flat().join('\n');
          alert(messages || 'Validation failed');
          return;
        }
        if (!res.ok) throw new Error(await res.text());

        clearRoleForm();
        await loadRoles();
      } catch (err) {
        console.error('Save failed:', err);
        alert('Save failed');
      }
    });
  }

  function clearRoleForm() {
    if (!form) return;
    fId.value = '';
    fTitle.value = '';
    fEmoji.value = '';
    fTagline.value = '';
    fAccent.value = 'text-blue-700';
    fActive.checked = true;
  }

  if (formReset) formReset.addEventListener('click', clearRoleForm);

  // Search / pagination buttons are optional; guard if missing
  if (searchBtn && searchInp) searchBtn.addEventListener('click', () => { q = searchInp.value.trim(); page = 1; loadRoles(); });
  if (resetBtn && searchInp)  resetBtn.addEventListener('click', () => { q = ''; searchInp.value=''; page = 1; loadRoles(); });
  if (rolesPrev) rolesPrev.addEventListener('click', () => { if (page > 1) { page--; loadRoles(); } });
  if (rolesNext) rolesNext.addEventListener('click', () => { if (page < lastPage) { page++; loadRoles(); } });

  // Press Enter in search to trigger search
  if (searchInp) searchInp.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') { e.preventDefault(); q = searchInp.value.trim(); page = 1; loadRoles(); }
  });

  // initial fetch
  loadRoles();

  // expose reload for other scripts
  window.reloadRolesTable = loadRoles;
})();
</script>

{{-- ========= CV MODAL FUNCTIONS ========= --}}
<script>
function openCvModal(url) {
  const cvModal = document.getElementById('cvModal');
  const cvFrame = document.getElementById('cvFrame');
  const cvLoader = document.getElementById('cvLoader');

  if (cvModal && cvFrame) {
    cvModal.classList.remove('hidden');
    if (cvLoader) cvLoader.style.display = 'flex';
    cvFrame.src = url;
    cvFrame.onload = () => {
      if (cvLoader) cvLoader.style.display = 'none';
    };
  }
}

function closeCvModal() {
  const cvModal = document.getElementById('cvModal');
  const cvFrame = document.getElementById('cvFrame');

  if (cvModal) {
    cvModal.classList.add('hidden');
    if (cvFrame) cvFrame.src = '';
  }
}

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeCvModal();
});

// Close modal on backdrop click
document.getElementById('cvModal')?.addEventListener('click', (e) => {
  if (e.target.id === 'cvModal') closeCvModal();
});
</script>

@endsection
