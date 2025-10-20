@extends('admin.dashboard.index')

@section('admin-content')
<div class="mx-auto py-8 p-2">
    <h2 class="text-xl font-bold mb-4">Create Fake Requester</h2>

    <form id="createFakeRequesterForm" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        <input type="hidden" name="type" value="requester">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
           <div>
    <label class="block font-semibold mb-1">Full Name (leave blank for random)</label>
    <input name="name" class="border rounded px-3 py-2 w-full">
</div>

            <div>
                <label class="block font-semibold mb-1">How many?</label>
               <select name="count" id="countSelect" class="border rounded px-3 py-2 w-full">
  <option value="1" selected>1</option>
  <option value="5">5</option>
  <option value="20">20</option>
  <option value="50">50</option>
</select>


                <p id="countHint" class="text-xs text-gray-500 mt-1">For 5 or 10, unique emails will be auto-generated.</p>
            </div>

            <div>
                <label class="block font-semibold mb-1">Email (optional, only when count = 1)</label>
                <input name="email" id="emailInput" class="border rounded px-3 py-2 w-full">
            </div>

            <div>
    <label class="block font-semibold mb-1">Gender (leave blank for random)</label>
    <select name="gender" class="border rounded px-3 py-2 w-full">
        <option value="">Random</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
</div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
        <div id="fakeRequesterMsg" class="mt-2 text-sm"></div>
    </form>

    <div class="mt-10">
        <h3 class="text-lg font-semibold mb-3">All Fake Requesters</h3>
       <div class="overflow-x-auto">
  <table class="w-full table-auto border-collapse bg-white rounded shadow mb-4">
    <thead class="bg-gray-50">
      <tr class="text-left">
        <th class="px-4 py-2 w-16">ID</th>
        <th class="px-4 py-2 w-64">Full Name</th>
        <th class="px-4 py-2 w-[28rem]">Email</th>
        <th class="px-4 py-2 w-28">Gender</th>
        <th class="px-4 py-2 w-28">Status</th>
      </tr>
    </thead>

    <tbody class="divide-y divide-gray-100" id="fakeRequestersTable">
      @foreach(\App\Models\User::where('is_fake', true)->where('user_role', 'service_requester')->orderByDesc('id')->get() as $user)
      <tr class="align-middle">
        <td class="px-4 py-2 whitespace-nowrap">{{ $user->id }}</td>
        <td class="px-4 py-2 whitespace-nowrap">{{ $user->name }}</td>
        <td class="px-4 py-2 whitespace-nowrap">{{ $user->email }}</td>
        <td class="px-4 py-2 whitespace-nowrap">{{ $user->gender ?? '-' }}</td>
        <td class="px-4 py-2">
          <span class="inline-flex items-center px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-semibold">
            {{ ucfirst($user->status) }}
          </span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

    </div>
</div>

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

  // Enable email only when count == 1
  function syncEmailState() {
    const count = getCount();
    if (count === 1) {
      emailInput.disabled = false;
      emailInput.placeholder = 'example@domain.com (optional)';
    } else {
      emailInput.disabled = true;
      emailInput.value = '';
      emailInput.placeholder = 'Auto-generated for batches';
    }
  }
  syncEmailState();
  countSelect.addEventListener('change', syncEmailState);

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    msg.textContent = '';
    msg.className = 'mt-2 text-sm';

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
        const errors = data.errors ? Object.values(data.errors).flat().join(' ') : (data.message || 'Failed to create.');
        msg.textContent = errors;
        msg.classList.add('text-red-600');
        return;
      }

      if (data.success) {
        msg.textContent = data.created_count
          ? `Created ${data.created_count} requester(s).`
          : 'Fake requester created!';
        msg.classList.add('text-green-600');

        const users = Array.isArray(data.users)
          ? data.users
          : (data.user ? [data.user] : []);

        users.forEach(u => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td class="px-3 py-2">${u.id ?? '-'}</td>
            <td class="px-3 py-2">${u.name ?? '-'}</td>
            <td class="px-3 py-2">${u.email ?? '-'}</td>
            <td class="px-3 py-2">${u.gender ?? '-'}</td>
            <td class="px-3 py-2">
              <span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-semibold">Active</span>
            </td>
          `;
          tableBody.prepend(tr);
        });

        form.reset();
        syncEmailState();
      } else {
        msg.textContent = data.message || 'Failed to create requester.';
        msg.classList.add('text-red-600');
      }
    } catch (err) {
      console.error(err);
      msg.textContent = 'Network error.';
      msg.classList.add('text-red-600');
    }
  });
})();
</script>

@endsection
