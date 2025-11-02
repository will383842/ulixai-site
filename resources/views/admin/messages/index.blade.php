@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<div class="px-6 py-6">
  <h1 class="text-3xl font-bold mb-6">📥 Messages reçus</h1>

  <!-- Tabs -->
  <div class="mb-4 flex gap-2" id="tabs">
    <button data-type="all" class="px-3 py-2 rounded border bg-gray-900 text-white">Général</button>
    <button data-type="press" class="px-3 py-2 rounded border bg-white">Presse</button>
    <button data-type="reportbug" class="px-3 py-2 rounded border bg-white">Report bug</button>
    <button data-type="partner" class="px-3 py-2 rounded border bg-white">Partner</button>
    <button data-type="recruitment" class="px-3 py-2 rounded border bg-white">Recrutement</button>
  </div>

  <!-- Filters -->
  <div class="mb-4 flex flex-wrap gap-2 items-center">
      <select id="filterStatus" class="border rounded px-2 py-2">
          <option value="all">Tous les statuts</option>
          <option value="unread">Non lus</option>
          <option value="read">Lus</option>
          <option value="unprocessed">À traiter</option>
          <option value="processed">Traités</option>
      </select>
      <input type="text" placeholder="Recherche..." id="search" class="border rounded px-2 py-2 w-64"/>
      <select id="sort" class="border rounded px-2 py-2">
          <option value="created_at">Date</option>
          <option value="name">Nom</option>
          <option value="email">Email</option>
          <option value="native_status">Statut natif</option>
      </select>
      <select id="direction" class="border rounded px-2 py-2">
          <option value="desc">↓</option>
          <option value="asc">↑</option>
      </select>
  </div>

  <!-- Table -->
  <div class="bg-white border rounded overflow-hidden">
    <table class="min-w-full text-sm">
      <thead class="bg-gray-50 text-left">
        <tr>
          <th class="p-3">Type</th>
          <th class="p-3">Nom</th>
          <th class="p-3">Email</th>
          <th class="p-3">Message</th>
          <th class="p-3">Statut</th>
          <th class="p-3">Date</th>
          <th class="p-3">Lu</th>
          <th class="p-3">Traité</th>
        </tr>
      </thead>
      <tbody id="rows">
        <tr><td colspan="8" class="p-6 text-center text-gray-500">Chargement…</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="mt-3 flex items-center gap-2" id="pager" hidden>
    <button class="px-3 py-1 border rounded" id="prev">Préc.</button>
    <span id="pageLabel">1 / 1</span>
    <button class="px-3 py-1 border rounded" id="next">Suiv.</button>
  </div>
</div>

<script>
(() => {
  const state = {
    type: 'all',
    status: 'all',
    search: '',
    sort: 'created_at',
    direction: 'desc',
    page: 1,
    per_page: 20,
    total_pages: 1
  };

  const rowsEl = document.getElementById('rows');
  const pager = document.getElementById('pager');
  const pageLabel = document.getElementById('pageLabel');

  function qs(id){ return document.getElementById(id); }
  function csrf(){ return document.querySelector('meta[name="csrf-token"]').content; }

  function bindFilters(){
    qs('filterStatus').onchange = () => { state.status = qs('filterStatus').value; state.page=1; fetchList(); };
    qs('sort').onchange = () => { state.sort = qs('sort').value; state.page=1; fetchList(); };
    qs('direction').onchange = () => { state.direction = qs('direction').value; state.page=1; fetchList(); };
    let t;
    qs('search').oninput = () => { clearTimeout(t); t = setTimeout(() => { state.search = qs('search').value; state.page=1; fetchList(); }, 300); };

    document.getElementById('tabs').querySelectorAll('button').forEach(btn => {
      btn.onclick = () => {
        document.getElementById('tabs').querySelectorAll('button').forEach(b => b.className = 'px-3 py-2 rounded border bg-white');
        btn.className = 'px-3 py-2 rounded border bg-gray-900 text-white';
        state.type = btn.getAttribute('data-type');
        state.page = 1;
        fetchList();
      };
    });

    document.getElementById('prev').onclick = () => { if (state.page>1){ state.page--; fetchList(); } };
    document.getElementById('next').onclick = () => { if (state.page<state.total_pages){ state.page++; fetchList(); } };
  }

  function fetchList(){
    rowsEl.innerHTML = '<tr><td colspan="8" class="p-6 text-center text-gray-500">Chargement…</td></tr>';
    const params = new URLSearchParams({
      type: state.type, status: state.status, search: state.search,
      sort: state.sort, direction: state.direction, page: state.page, per_page: state.per_page
    });
    fetch('{{ route('admin.messages.list') }}?' + params.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(r => r.json())
      .then(renderList)
      .catch(() => { rowsEl.innerHTML = '<tr><td colspan="8" class="p-6 text-center text-red-600">Erreur de chargement</td></tr>'; });
  }

  function renderList(res){
    const data = res.data || [];
    const pag = res.pagination || { total:0, page:1, pages:1 };
    state.total_pages = pag.pages;
    pageLabel.textContent = pag.page + ' / ' + pag.pages;
    pager.hidden = !(pag.pages > 1);

    if (!data.length){
      rowsEl.innerHTML = '<tr><td colspan="8" class="p-6 text-center text-gray-500">Aucun message</td></tr>';
      return;
    }
    const label = { press:'Presse', reportbug:'Report bug', partner:'Partner', recruitment:'Recrutement' };
    rowsEl.innerHTML = data.map(row => `
      <tr class="border-t">
        <td class="p-3">${label[row.type] || row.type}</td>
        <td class="p-3">${escapeHtml(row.name || '—')}</td>
        <td class="p-3">${row.email ? `<a href="mailto:${encodeURIComponent(row.email)}" class="text-blue-600">${escapeHtml(row.email)}</a>` : '—'}</td>
        <td class="p-3 max-w-xl truncate" title="${escapeHtml(row.message || '')}">${escapeHtml((row.message || '').slice(0, 120))}${(row.message||'').length>120?'…':''}</td>
        <td class="p-3">${escapeHtml(row.native_status || '—')}</td>
        <td class="p-3">${new Date(row.created_at).toLocaleString()}</td>
        <td class="p-3"><input type="checkbox" ${row.is_read ? 'checked' : ''} onchange="toggleStatus('${row.type}', ${row.id}, 'is_read', this.checked)"></td>
        <td class="p-3"><input type="checkbox" ${row.is_processed ? 'checked' : ''} onchange="toggleStatus('${row.type}', ${row.id}, 'is_processed', this.checked)"></td>
      </tr>
    `).join('');
  }

  window.toggleStatus = function(type, id, field, value){
    const fd = new FormData();
    fd.append('type', type);
    fd.append('id', id);
    if (field==='is_read') fd.append('is_read', value ? 1 : 0);
    if (field==='is_processed') fd.append('is_processed', value ? 1 : 0);

    fetch('{{ route('admin.messages.read') }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrf() },
      body: fd
    }).catch(() => {});
  };

  function escapeHtml(str){
    return String(str).replace(/[&<>"']/g, s => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[s]));
  }

  bindFilters();
  fetchList();
})();
</script>
@endsection
