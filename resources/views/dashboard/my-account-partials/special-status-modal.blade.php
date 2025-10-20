<!-- Special Status Modal -->
<div id="specialStatusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-2 sm:p-4">
  <div class="bg-white rounded-2xl p-4 sm:p-6 w-full max-w-xs sm:max-w-xl shadow-2xl relative max-h-[90vh] overflow-y-auto">
    <button id="closeSpecialStatusModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl transition-colors">&times;</button>
    
    <h2 class="font-bold mb-4 text-lg sm:text-xl text-gray-800">Do you have a special status?</h2>
    
    <div class="space-y-3 mb-6">
      

      @php
          $special_status = json_decode($provider->special_status, true) ?? [];
          $statuses = \App\Models\SpecialStatus::pluck('stitle')->toArray();
      @endphp

      @foreach ($statuses as $status)
          @php
              $selected = $special_status[$status] ?? null; // true for Yes, false for No, null for unset
          @endphp
          <div class="flex flex-col sm:flex-row items-center justify-between border border-gray-200 rounded-xl px-4 py-3 special-status-item hover:border-gray-300 transition-colors">
              <div class="flex items-center space-x-3 mb-2 sm:mb-0">
                  <div class="w-4 h-4 rounded-full bg-blue-300"></div>
                  <span class="text-sm text-gray-700">{{ $status }}</span>
              </div>
              <div class="flex space-x-2">
                  <button type="button"
                      class="toggle-btn yes-btn bg-white border px-4 py-1 text-sm rounded-full transition-colors
                          {{ $selected === true ? 'border-blue-500 text-blue-700 font-semibold bg-blue-50' : 'border-gray-300 text-gray-600 hover:border-blue-400 hover:text-blue-600' }}"
                      data-status="{{ $status }}" data-value="yes">
                      Yes
                  </button>
                  <button type="button"
                      class="toggle-btn no-btn bg-white border px-4 py-1 text-sm rounded-full transition-colors
                          {{ $selected === false ? 'border-blue-500 text-blue-700 font-semibold bg-blue-50' : 'border-gray-300 text-gray-600 hover:border-blue-400 hover:text-blue-600' }}"
                      data-status="{{ $status }}" data-value="no">
                      No
                  </button>
              </div>
          </div>
      @endforeach
      <div class="flex justify-end mt-4">
          <button id="saveSpecialStatusBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full transition-colors shadow-md hover:shadow-lg">
              Save Special Status
          </button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const statusData = @json($special_status);
    let selections = {...statusData};

    document.querySelectorAll('.special-status-item').forEach(item => {
         const yesBtn = item.querySelector('.yes-btn');
          const noBtn = item.querySelector('.no-btn');
          if (!yesBtn || !noBtn) return;

          const status = yesBtn.getAttribute('data-status');

        yesBtn.addEventListener('click', function () {
            selections[status] = true;
            yesBtn.classList.add('border-blue-500', 'text-blue-700', 'font-semibold', 'bg-blue-50');
            yesBtn.classList.remove('border-gray-300', 'text-gray-600');
            noBtn.classList.remove('border-blue-500', 'text-blue-700', 'font-semibold', 'bg-blue-50');
            noBtn.classList.add('border-gray-300', 'text-gray-600');
        });

        noBtn.addEventListener('click', function () {
            selections[status] = false;
            noBtn.classList.add('border-blue-500', 'text-blue-700', 'font-semibold', 'bg-blue-50');
            noBtn.classList.remove('border-gray-300', 'text-gray-600');
            yesBtn.classList.remove('border-blue-500', 'text-blue-700', 'font-semibold', 'bg-blue-50');
            yesBtn.classList.add('border-gray-300', 'text-gray-600');
        });
    });

 
    document.getElementById('saveSpecialStatusBtn')?.addEventListener('click', function () {
        fetch('/account/provider/special-status/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ special_status: selections })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
              document.getElementById('specialStatusModal').classList.add('hidden');
              toastr.success('Special statuses saved successfully!', 'Success');
            }
        });
    });
});
</script>

