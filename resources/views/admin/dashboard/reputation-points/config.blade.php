@extends('admin.dashboard.index')
@section('admin-content')

<div class="mx-auto py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Reputation Points Management</h1>
        <p class="text-gray-600">Configure point values for different user actions and achievements</p>
    </div>

    <!-- Success/Error Messages -->
    <div id="pointsFormSuccess" class="hidden mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-green-800 font-medium"></span>
        </div>
    </div>

    <div id="pointsFormError" class="hidden mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <span class="text-red-800 font-medium"></span>
        </div>
    </div>

    <!-- Main Form Container -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <form id="editPointsForm">
            @csrf
            
            <!-- Positive Actions Section -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Positive Actions</h2>
                    <span class="ml-2 text-sm text-gray-500">(Points Added)</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $positiveActions = [
                            'mission_with_review' => ['label' => 'Mission with Review',  'description' => 'Completed mission with client review'],
                            'five_star_review' => ['label' => '5-Star Review',  'description' => 'Received excellent rating'],
                            'four_star_review' => ['label' => '4-Star Review',  'description' => 'Received good rating'],
                            'response_24h' => ['label' => 'Quick Response (24h)',  'description' => 'Responded within 24 hours'],
                            'profile_complete' => ['label' => 'Complete Profile',  'description' => 'Fully completed user profile'],
                            'active_3_months' => ['label' => '3 Months Active',  'description' => 'Consistently active for 3 months'],
                            'active_12_months' => ['label' => '12 Months Active',  'description' => 'Consistently active for 1 year'],
                            'no_disputes' => ['label' => 'No Disputes',  'description' => 'Clean record with no disputes'],
                            'client_recommendations' => ['label' => 'Client Recommendations', 'description' => 'Received client recommendations']
                        ];
                    @endphp

                    @foreach($positiveActions as $field => $config)
                        <div class="bg-green-50 rounded-lg p-4 border border-green-100">
                            <div class="items-center mb-2">
                                <label class="font-medium text-gray-900">{{ $config['label'] }}</label>
                            </div>
                            <p class="text-xs text-gray-600 mb-3">{{ $config['description'] }}</p>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-600 font-semibold">+</span>
                                <input type="number" 
                                       name="{{ $field }}" 
                                       value="{{ $reputationPointConfig->$field ?? 0 }}"
                                       class="w-full pl-8 pr-3 py-2 border border-green-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-sm"
                                       min="0"
                                       required>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Negative Actions Section -->
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">Negative Actions</h2>
                    <span class="ml-2 text-sm text-gray-500">(Points Deducted)</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $negativeActions = [
                            'client_abuse_report' => ['label' => 'Client Abuse Report',  'description' => 'Reported for inappropriate behavior'],
                            'dispute_refund' => ['label' => 'Dispute & Refund', 'description' => 'Dispute resulted in refund'],
                            'provider_canceled' => ['label' => 'Provider Canceled',  'description' => 'Service provider canceled mission'],
                            'no_reply_5_requests' => ['label' => 'No Reply (5 Requests)', 'description' => 'Failed to respond to 5 requests']
                        ];
                    @endphp

                    @foreach($negativeActions as $field => $config)
                        <div class="bg-red-50 rounded-lg p-4 border border-red-100">
                            <div class="items-center mb-2">
                                <label class="font-medium text-gray-900">{{ $config['label'] }}</label>
                            </div>
                            <p class="text-xs text-gray-600 mb-3">{{ $config['description'] }}</p>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-red-600 font-semibold">-</span>
                                <input type="number" 
                                       name="{{ $field }}" 
                                       value="{{ abs($reputationPointConfig->$field ?? 0) }}"
                                       class="w-full pl-8 pr-3 py-2 border border-red-200 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                                       min="0"
                                       required>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Changes are applied immediately to all users
                    </span>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" 
                            id="resetForm"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Reset
                    </button>
                    
                    <button type="submit" 
                            id="saveButton"
                            class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Save Changes</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Quick Stats Preview -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Positive Actions</p>
                    <p class="text-2xl font-semibold text-gray-900" id="totalPositive">{{ count($positiveActions) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Negative Actions</p>
                    <p class="text-2xl font-semibold text-gray-900" id="totalNegative">{{ count($negativeActions) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Last Updated</p>
                    <p class="text-2xl font-semibold text-gray-900" id="lastUpdated">Just now</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced form handling with loading states and better UX
document.getElementById('editPointsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const saveButton = document.getElementById('saveButton');
    const originalText = saveButton.innerHTML;
    const successDiv = document.getElementById('pointsFormSuccess');
    const errorDiv = document.getElementById('pointsFormError');
    
    // Hide previous messages
    successDiv.classList.add('hidden');
    errorDiv.classList.add('hidden');
    
    // Show loading state
    saveButton.disabled = true;
    saveButton.innerHTML = `
        <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Saving...
    `;
    
    const form = e.target;
    const formData = new FormData(form);
    const jsonData = Object.fromEntries(formData);
    
    fetch('{{ route("admin.adjust-reputation-points") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(jsonData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            successDiv.querySelector('span').textContent = data.message || 'Reputation points updated successfully!';
            successDiv.classList.remove('hidden');
            
            // Update last updated time
            document.getElementById('lastUpdated').textContent = new Date().toLocaleTimeString();
            
            // Scroll to success message
            successDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            throw new Error(data.message || 'An error occurred');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        errorDiv.querySelector('span').textContent = error.message || 'Failed to update reputation points. Please try again.';
        errorDiv.classList.remove('hidden');
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    })
    .finally(() => {
        // Restore button state
        saveButton.disabled = false;
        saveButton.innerHTML = originalText;
    });
});

// Reset form functionality
document.getElementById('resetForm').addEventListener('click', function() {
    if (confirm('Are you sure you want to reset all values? This will reload the original values.')) {
        location.reload();
    }
});

// Add some visual feedback for form interactions
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', function() {
        // Add subtle animation on change
        this.style.transform = 'scale(1.02)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);
    });
});
</script>

<style>
/* Custom animations and transitions */
input[type="number"] {
    transition: all 0.15s ease-in-out;
}

input[type="number"]:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.bg-green-50:hover {
    background-color: rgb(240 253 244);
}

.bg-red-50:hover {
    background-color: rgb(254 242 242);
}
</style>
@endsection