@extends('admin.dashboard.index')

@section('admin-content')
<div class="admin-content">
    <!-- Breadcrumbs -->
    <nav class="admin-breadcrumbs">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <a href="{{ route('admin.fake-content-generation') }}">Fake Data</a>
        <span class="admin-breadcrumbs-separator">/</span>
        <span class="admin-breadcrumbs-current">Créer Demandeur</span>
    </nav>

    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Créer un demandeur de test</h1>
        <p class="page-subtitle">Ajoutez un nouveau demandeur pour les tests</p>
    </div>

    <div class="admin-card mb-8">
        <form id="createFakeRequesterForm" class="p-6">
            @csrf
            <input type="hidden" name="type" value="requester">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Nom complet (laisser vide pour aléatoire)</label>
                    <input name="name" class="form-input">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Combien ?</label>
                    <select name="count" id="countSelect" class="form-input">
                        <option value="1" selected>1</option>
                        <option value="5">5</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Pour 5+, les emails seront auto-générés.</p>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Email (optionnel, seulement si count = 1)</label>
                    <input name="email" id="emailInput" class="form-input">
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">Genre (laisser vide pour aléatoire)</label>
                    <select name="gender" class="form-input">
                        <option value="">Aléatoire</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                        <option value="other">Autre</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="btn btn-primary">Créer</button>
            </div>
            <div id="fakeRequesterMsg" class="mt-3 text-sm"></div>
        </form>
    </div>

    <div class="admin-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-900">Tous les demandeurs de test</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom complet</th>
                        <th>Email</th>
                        <th>Genre</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody id="fakeRequestersTable">
                    @foreach(\App\Models\User::where('is_fake', true)->where('user_role', 'service_requester')->orderByDesc('id')->get() as $user)
                    <tr>
                        <td class="text-sm font-medium text-gray-900">{{ $user->id }}</td>
                        <td class="text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="text-sm text-gray-500">{{ $user->gender ?? '-' }}</td>
                        <td><span class="badge-primary">{{ ucfirst($user->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
  const form       = document.getElementById('createFakeRequesterForm');
  const msg        = document.getElementById('fakeRequesterMsg');
  const tableBody  = document.getElementById('fakeRequestersTable');
  const countSelect= document.getElementById('countSelect');
  const emailInput = document.getElementById('emailInput');

  const allowedCounts = new Set([1, 5, 20, 50]);

  function getCount() {
    const n = parseInt((countSelect?.value ?? '1'), 10);
    return allowedCounts.has(n) ? n : 1;
  }

  function syncEmailState() {
    const count = getCount();
    if (count === 1) {
      emailInput.disabled = false;
      emailInput.placeholder = 'example@domain.com (optionnel)';
    } else {
      emailInput.disabled = true;
      emailInput.value = '';
      emailInput.placeholder = 'Auto-généré pour les lots';
    }
  }
  syncEmailState();
  countSelect.addEventListener('change', syncEmailState);

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    msg.textContent = '';
    msg.className = 'mt-3 text-sm';

    const payload = {
      type: 'requester',
      name: form.name.value,
      email: emailInput.disabled ? null : form.email.value,
      gender: form.gender.value,
      count: getCount()
    };

    try {
      const res = await fetch("{{ route('admin.fake-content.create') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
      });

      const data = await res.json();

      if (!res.ok) {
        const errors = data.errors ? Object.values(data.errors).flat().join(' ') : (data.message || 'Échec de la création.');
        msg.textContent = errors;
        msg.classList.add('text-red-600');
        return;
      }

      if (data.success) {
        msg.textContent = data.created_count
          ? `${data.created_count} demandeur(s) créé(s).`
          : 'Demandeur de test créé !';
        msg.classList.add('text-green-600');

        const users = Array.isArray(data.users)
          ? data.users
          : (data.user ? [data.user] : []);

        users.forEach(u => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td class="text-sm font-medium text-gray-900">${u.id ?? '-'}</td>
            <td class="text-sm text-gray-900">${u.name ?? '-'}</td>
            <td class="text-sm text-gray-500">${u.email ?? '-'}</td>
            <td class="text-sm text-gray-500">${u.gender ?? '-'}</td>
            <td><span class="badge-primary">Actif</span></td>
          `;
          tableBody.prepend(tr);
        });

        form.reset();
        syncEmailState();
      } else {
        msg.textContent = data.message || 'Échec de la création.';
        msg.classList.add('text-red-600');
      }
    } catch (err) {
      console.error(err);
      msg.textContent = 'Erreur réseau.';
      msg.classList.add('text-red-600');
    }
  });
})();
</script>
@endpush
@endsection
