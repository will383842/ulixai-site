<div id="cancelRequestPopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center relative">
            <button onclick="closeCancelRequestPopup()" class="absolute top-2 right-3 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <h2 class="text-xl font-bold text-blue-800 mb-3">Why do you want to cancel this ad?</h2>
            <form id="cancelRequestForm" class="space-y-4 text-left">
                <div>
                    <label class="block text-sm font-semibold mb-2">Select a reason</label>
                    <select id="cancelReasonSelect" class="w-full border rounded-lg px-3 py-2 mb-2" required>
                        <option value="">-- Please choose --</option>
                        <option>I made a mistake in the information provided.</option>
                        <option>My situation has changed, I no longer need the service.</option>
                        <option>I found a solution elsewhere.</option>
                        <option>The timing is too short to organize this mission.</option>
                        <option>My budget is not sufficient for the type of service I need.</option>
                        <option>I didn't receive any relevant proposals.</option>
                        <option>The available providers do not match my criteria.</option>
                        <option>I've decided to postpone this request.</option>
                        <option>I submitted this request just to test the platform.</option>
                        <option value="other">Other reason (please specify below)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Other reason (please specify):</label>
                    <textarea id="cancelOtherReason" class="w-full border rounded-lg px-3 py-2" maxlength="300" placeholder="Free text field"></textarea>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <button type="button" onclick="closeCancelRequestPopup()" class="text-blue-700 underline font-semibold text-xs">I keep my add online</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full px-4 py-2 text-xs transition">
                        I CANCEL
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cancel Success Popup Modal -->
    <div id="cancelSuccessPopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
        <div class="bg-white rounded-2xl shadow-xl max-w-xs w-full p-8 text-center relative">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-green-400 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-blue-800 mb-2">Thank you!</h3>
                <div class="text-blue-800 font-semibold">Your ad has been successfully deleted.</div>
            </div>
        </div>
    </div>

    <!-- Loading Popup Modal -->
    <div id="loadingPopup" class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center px-2 hidden">
        <div class="bg-white rounded-2xl shadow-xl max-w-xs w-full p-8 text-center relative">
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mb-4"></div>
                <h3 class="text-lg font-bold text-blue-800 mb-2">Canceling...</h3>
                <div class="text-blue-800 font-semibold">Please wait while we process your request.</div>
            </div>
        </div>
    </div>

    <script>
        let currentMissionId = null;

        function openCancelRequestPopup(missionId) {
            currentMissionId = missionId;
            document.getElementById('cancelRequestPopup').classList.remove('hidden');
        }

        function closeCancelRequestPopup() {
            document.getElementById('cancelRequestPopup').classList.add('hidden');
            currentMissionId = null;
        }

        function openCancelSuccessPopup() {
            document.getElementById('cancelSuccessPopup').classList.remove('hidden');
            // Auto-close after 3 seconds
            setTimeout(function() {
                closeCancelSuccessPopup();
            }, 3000);
        }

        function closeCancelSuccessPopup() {
            document.getElementById('cancelSuccessPopup').classList.add('hidden');
        }

        function openLoadingPopup() {
            document.getElementById('loadingPopup').classList.remove('hidden');
        }

        function closeLoadingPopup() {
            document.getElementById('loadingPopup').classList.add('hidden');
        }

        // Handle form submission and mission deletion
        document.getElementById('cancelRequestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const reason = document.getElementById('cancelReasonSelect').value;
            const otherReason = document.getElementById('cancelOtherReason').value;
            
            if (!reason) {
                alert('Please select a reason for canceling.');
                return;
            }
            
            if (reason === 'other' && !otherReason.trim()) {
                alert('Please specify the other reason.');
                return;
            }
            
            document.getElementById('cancelRequestPopup').classList.add('hidden');
            openLoadingPopup();
            
            deleteMission(currentMissionId, reason, otherReason);
        });

        async function deleteMission(missionId, reason, description) {
            try {
                const response = await fetch(`/api/mission/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        mission_id: missionId,
                        reason: reason,
                        description: reason === 'other' ? otherReason : null,
                        cancelled_by: 'requester',
                        cancelled_on: new Date().toISOString()
                    })
                });

                if (response.ok) {
                    currentMissionId = null;
                    closeLoadingPopup();
                    openCancelSuccessPopup();
                    
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                } else {
                    throw new Error('Failed to cancel mission');
                }
            } catch (error) {
                console.error('Error canceling mission:', error);
                closeLoadingPopup();
                alert('An error occurred while canceling the mission. Please try again.');
            }
        }

        // Close success popup on click outside or after timeout
        document.getElementById('cancelSuccessPopup').addEventListener('click', function(e) {
            if (e.target === this) closeCancelSuccessPopup();
        });
    </script>