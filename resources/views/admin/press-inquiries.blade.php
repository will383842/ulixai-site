@extends('admin.dashboard.index')

@section('admin-content')
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold mb-6">📰 Messages Presse</h1>

  <div class="flex gap-3 mb-4">
    <select id="filterStatus" class="border rounded px-3 py-2">
      <option value="">Tous statuts</option>
      <option value="pending">pending</option>
      <option value="read">read</option>
      <option value="responded">responded</option>
      <option value="archived">archived</option>
    </select>
    <input id="search" class="border rounded px-3 py-2" placeholder="Recherche (media, nom, email, message)…">
    <button onclick="loadInquiries()" class="bg-blue-600 text-white px-4 py-2 rounded">Recharger</button>
  </div>

  <div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full">
      <thead>
        <tr class="bg-gray-50 text-left text-sm">
          <th class="p-3">Date</th>
          <th class="p-3">Media</th>
          <th class="p-3">Nom</th>
          <th class="p-3">Email</th>
          <th class="p-3">Message</th>
          <th class="p-3">Statut</th>
          <th class="p-3"></th>
        </tr>
      </thead>
      <tbody id="rows"></tbody>
    </table>
  </div>

  <div class="flex justify-between items-center mt-4">
    <button id="prev" class="px-3 py-2 border rounded" disabled>Précédent</button>
    <span id="meta" class="text-sm text-gray-600"></span>
    <button id="next" class="px-3 py-2 border rounded" disabled>Suivant</button>
  </div>
</div>

<script>
let nextUrl = null, prevUrl = null;

async function loadInquiries(url = null) {
  const params = new URLSearchParams();
  const status = document.getElementById('filterStatus').value;
  const search = document.getElementById('search').value.trim();
  if (status) params.set('status', status);
  if (search) params.set('search', search);

  const endpoint = url ?? ('/admin/press/inquiries/list' + (params.toString() ? ('?' + params.toString()) : ''));
  const res = await fetch(endpoint, { headers: { 'Accept': 'application/json' }});
  if (!res.ok) {
    console.error('HTTP error', res.status);
    return;
  }
  const data = await res.json();

  const tbody = document.getElementById('rows');
  tbody.innerHTML = '';

  (data.data || []).forEach(row => {
    const tr = document.createElement('tr');
    tr.className = 'border-t align-top';
    tr.innerHTML = `
      <td class="p-3 text-sm whitespace-nowrap">${new Date(row.created_at).toLocaleString()}</td>
      <td class="p-3 text-sm">${esc(row.media_name ?? '')}</td>
      <td class="p-3 text-sm">${esc(row.full_name ?? '')}</td>
      <td class="p-3 text-sm"><a class="text-blue-600" href="mailto:${att(row.email)}">${esc(row.email)}</a></td>
      <td class="p-3 text-sm max-w-[420px]">
        <div class="truncate" title="${att(row.message ?? '')}">${esc((row.message ?? '').slice(0, 200))}</div>
      </td>
      <td class="p-3 text-sm">${esc(row.status ?? '')}</td>
      <td class="p-3 text-sm text-right">
        ${row.status === 'pending'
          ? `<button onclick="markAsRead(${row.id})" class="px-2 py-1 border rounded">Marquer lu</button>`
          : ''
        }
      </td>
    `;
    tbody.appendChild(tr);
  });

  document.getElementById('meta').textContent =
    `Page ${data.current_page} / ${data.last_page} • ${data.total} messages`;

  nextUrl = data.next_page_url;
  prevUrl = data.prev_page_url;
  document.getElementById('next').disabled = !nextUrl;
  document.getElementById('prev').disabled = !prevUrl;
}

async function markAsRead(id) {
  const csrf = document.querySelector('meta[name="csrf-token"]').content;
  await fetch(`/admin/press/inquiries/${id}/read`, {
    method: 'PATCH',
    headers: { 'X-CSRF-TOKEN': csrf }
  });
  loadInquiries();
}

document.getElementById('next').onclick = () => loadInquiries(nextUrl);
document.getElementById('prev').onclick = () => loadInquiries(prevUrl);
document.getElementById('search').addEventListener('keyup', (e) => {
  if (e.key === 'Enter') loadInquiries();
});

function esc(s){ return (s??'').replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }
function att(s){ return (s??'').replace(/"/g,'&quot;'); }

document.addEventListener('DOMContentLoaded', () => loadInquiries());
</script>
@endsection
