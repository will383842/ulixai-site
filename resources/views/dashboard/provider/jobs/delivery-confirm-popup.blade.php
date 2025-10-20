<!-- Delivery Confirmation Popup (Step 1) -->
<div id="deliveryConfirmPopup" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 text-center relative">
        <button onclick="closeDeliveryConfirmPopup()" class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
        <div class="flex flex-col items-center mb-4">
        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-2">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <rect x="5" y="7" width="14" height="10" rx="2" fill="#fff" stroke="#3B82F6"/>
            <rect x="7" y="5" width="10" height="4" rx="2" fill="#3B82F6"/>
            </svg>
        </div>
        <h2 class="text-lg font-bold text-blue-900 mb-2 flex items-center justify-center gap-2">
            <span><img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1f4e6.svg" class="w-6 h-6 inline" alt="box" /></span>
            Do you confirm that your mission is completed and delivered?
        </h2>
        <p id="message" class="text-gray-700 mb-4 hidden">Your service requester has just received your delivery confirmation.</p>
        </div>
        <div class="flex flex-col gap-3 items-center">
        <button onclick="sendDelivery()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full px-8 py-2 text-base flex items-center justify-center gap-2 transition">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><rect x="5" y="9" width="10" height="6" rx="2"/><rect x="7" y="5" width="6" height="4" rx="2"/></svg>
            YES
        </button>
        <button onclick="closeDeliveryConfirmPopup()" class="border border-blue-400 text-blue-600 rounded-full px-8 py-2 font-semibold bg-white hover:bg-blue-50 transition text-base">
            &larr; Back
        </button>
        </div>
    </div>
</div>

<!-- Delivery Sent Popup (Step 2) -->
<div id="deliverySentPopup" class="fixed inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 text-center relative">
        <button onclick="closeDeliverySentPopup()" class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
        <div class="flex flex-col items-center mb-4">
        <div class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center mb-2">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/>
            <circle cx="12" cy="12" r="10"/>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-blue-900 mb-2 flex items-center justify-center gap-2">
            <span><svg class="w-6 h-6 inline" fill="none" stroke="#3B82F6" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg></span>
            Your delivery confirmation has been sent! <span class="ml-1">📬</span>
        </h2>
        <p class="text-gray-700 mb-4">Your service requester has just been notified. They will now be asked to validate the delivery.</p>
        </div>
        <a href="/dashboardindex" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full px-8 py-2 text-base flex items-center justify-center gap-2 transition">
        Go back to my dashboard
        </a>
    </div>
</div>

<script>
    // Delivery confirmation popups
    let currentMissionId = null;
    function openDeliveryConfirmPopup(missionId) {
        currentMissionId = missionId;
        document.getElementById('deliveryConfirmPopup').classList.remove('hidden');
    }
    function closeDeliveryConfirmPopup() {
        document.getElementById('deliveryConfirmPopup').classList.add('hidden');
    }
    function sendDelivery() {
        const missionId = currentMissionId;
        fetch('/api/provider/jobs/confirm-delivery', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ mission_id: missionId })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) {
            document.getElementById('message').classList.remove('hidden');
            location.reload();
            } else {
            alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

    function closeDeliverySentPopup() {
        document.getElementById('deliverySentPopup').classList.add('hidden');
    }
</script>