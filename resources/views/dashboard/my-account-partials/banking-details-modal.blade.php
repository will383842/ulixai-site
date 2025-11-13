<div id="bankingDetailsModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity"></div>

        <div class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl">
            <!-- Header Section with Gradient -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="rounded-lg bg-white/20 p-2">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Banking Information</h3>
                            <p class="text-sm text-blue-100">Secure your withdrawals and payments</p>
                        </div>
                    </div>
                    <button type="button" onclick="hideBankingModal()" class="rounded-lg bg-white/20 p-2 hover:bg-white/30 transition-colors">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-4">
                <div class="rounded-lg bg-blue-50 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Please ensure all banking details are accurate. Incorrect information may delay your payments.
                            </p>
                        </div>
                    </div>
                </div>

                <form id="bankingDetailsForm" class="space-y-5">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <!-- Account Holder Name -->
                        <div class="col-span-2">
                            <label for="bankAccountHolder" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Account Holder Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" id="bankAccountHolder" name="bank_account_holder" required 
                                    class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-11 pr-4 text-gray-900 placeholder-gray-400 transition-all focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 sm:text-sm"
                                    placeholder="John Doe" value="{{ old('bank_account_holder', $user->bank_account_holder) }}">
                                <span class="error-message hidden text-xs text-red-600 mt-1"></span>
                            </div>
                        </div>

                        <!-- IBAN -->
                        <div class="col-span-2">
                            <label for="bankAccountIban" class="block text-sm font-medium text-gray-700 mb-1.5">
                                IBAN <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <input type="text" id="bankAccountIban" name="bank_account_iban" required 
                                    class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-11 pr-4 text-gray-900 placeholder-gray-400 transition-all focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 sm:text-sm uppercase tracking-wider"
                                    placeholder="GB29 NWBK 6016 1331 9268 19"
                                    maxlength="34" value="{{ old('bank_account_iban', $user->bank_account_iban) }}">
                                <span class="error-message hidden text-xs text-red-600 mt-1"></span>
                            </div>
                            <p class="mt-1.5 text-xs text-gray-500">International Bank Account Number (up to 34 characters)</p>
                        </div>

                        <!-- SWIFT/BIC Code -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="bankSwiftBic" class="block text-sm font-medium text-gray-700 mb-1.5">
                                SWIFT/BIC Code <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <input type="text" id="bankSwiftBic" name="bank_swift_bic" required 
                                    class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-11 pr-4 text-gray-900 placeholder-gray-400 transition-all focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 sm:text-sm uppercase tracking-wider"
                                    placeholder="NWBKGB2L"
                                    maxlength="11" value="{{ old('bank_swift_bic', $user->bank_swift_bic) }}">
                                <span class="error-message hidden text-xs text-red-600 mt-1"></span>
                            </div>
                        </div>

                        <!-- Bank Name -->
                        <div class="col-span-2 sm:col-span-1">
                            <label for="bankName" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Bank Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <input type="text" id="bankName" name="bank_name" required 
                                    class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-11 pr-4 text-gray-900 placeholder-gray-400 transition-all focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 sm:text-sm"
                                    placeholder="National Westminster Bank" value="{{ old('bank_name', $user->bank_name) }}">
                                <span class="error-message hidden text-xs text-red-600 mt-1"></span>
                            </div>
                        </div>

                        <!-- Account Country -->
                        <div class="col-span-2">
                            <label for="accountCountry" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Account Country <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <select id="accountCountry" name="account_country" required 
                                    class="block w-full appearance-none rounded-lg border border-gray-300 bg-white py-2.5 pl-11 pr-10 text-gray-900 transition-all focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 sm:text-sm">
                                    <option value="">Select your bank's country</option>
                                    @foreach(\App\Models\Country::where('status', true)->get() as $country)
                                        <option value="{{ $country->short_name }}" {{ $country->short_name == old('account_country', $user->account_country) ? 'selected' : '' }}>{{ $country->country }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                                <span class="error-message hidden text-xs text-red-600 mt-1"></span>
                            </div>
                        </div>

                        <!-- Banking Consent - ✅ AJOUTÉ -->
                        <div class="col-span-2 mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <label class="flex items-start cursor-pointer">
                                <input type="checkbox" name="consent_banking" id="consent_banking" required 
                                       class="mt-1 mr-3 w-4 h-4 text-blue-600 focus:ring-blue-500">
                                <span class="text-xs text-gray-700 leading-relaxed">
                                    <strong>I authorize Ulixai</strong> to securely store my banking information for payment processing. 
                                    Data is encrypted and complies with international standards 
                                    <span class="inline-block bg-white px-2 py-0.5 rounded text-[10px] font-mono">
                                        GDPR · CCPA · LGPD
                                    </span>
                                    <br>
                                    <span class="text-gray-500 mt-1 inline-block">
                                        You can request data deletion anytime via 
                                        <a href="/privacy-policy" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                            Privacy Settings
                                        </a>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="hideBankingModal()" 
                        class="rounded-lg bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="button" onclick="saveBankingDetails()" 
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Details
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#bankingDetailsModal input:focus,
#bankingDetailsModal select:focus {
    border-color: #3b82f6;
}

#bankingDetailsModal input.error,
#bankingDetailsModal select.error {
    border-color: #ef4444;
}

#bankingDetailsModal .error-message.show {
    display: block;
}
</style>

<script>
function showBankingModal() {
    document.getElementById('bankingDetailsModal').classList.remove('hidden');
}

function hideBankingModal() {
    document.getElementById('bankingDetailsModal').classList.add('hidden');
    clearFormErrors();
}

function clearFormErrors() {
    const form = document.getElementById('bankingDetailsForm');
    const inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        input.classList.remove('error');
        const errorMsg = input.parentElement.querySelector('.error-message');
        if (errorMsg) {
            errorMsg.classList.remove('show');
            errorMsg.classList.add('hidden');
        }
    });
}

function validateForm() {
    let isValid = true;
    const form = document.getElementById('bankingDetailsForm');
    
    // Clear previous errors
    clearFormErrors();
    
    // Account Holder Name
    const accountHolder = document.getElementById('bankAccountHolder');
    if (!accountHolder.value.trim()) {
        showError(accountHolder, 'Account holder name is required');
        isValid = false;
    } else if (accountHolder.value.trim().length < 3) {
        showError(accountHolder, 'Name must be at least 3 characters');
        isValid = false;
    }
    
    // IBAN validation
    const iban = document.getElementById('bankAccountIban');
    const ibanValue = iban.value.replace(/\s/g, '');
    if (!ibanValue) {
        showError(iban, 'IBAN is required');
        isValid = false;
    } else if (ibanValue.length < 15 || ibanValue.length > 34) {
        showError(iban, 'IBAN must be between 15-34 characters');
        isValid = false;
    }
    
    // SWIFT/BIC validation
    const swift = document.getElementById('bankSwiftBic');
    const swiftValue = swift.value.trim();
    if (!swiftValue) {
        showError(swift, 'SWIFT/BIC code is required');
        isValid = false;
    } else if (swiftValue.length < 8 || swiftValue.length > 11) {
        showError(swift, 'SWIFT/BIC must be 8 or 11 characters');
        isValid = false;
    }
    
    // Bank Name
    const bankName = document.getElementById('bankName');
    if (!bankName.value.trim()) {
        showError(bankName, 'Bank name is required');
        isValid = false;
    }
    
    // Country
    const country = document.getElementById('accountCountry');
    if (!country.value) {
        showError(country, 'Please select a country');
        isValid = false;
    }
    
    return isValid;
}

function showError(input, message) {
    input.classList.add('error');
    const errorMsg = input.parentElement.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.textContent = message;
        errorMsg.classList.remove('hidden');
        errorMsg.classList.add('show');
    }
}

function saveBankingDetails() {
    // ✅ AJOUT DE LA VÉRIFICATION DU CONSENTEMENT
    const consentCheckbox = document.getElementById('consent_banking');
    if (!consentCheckbox || !consentCheckbox.checked) {
        toastr.error('Please accept the consent terms to continue');
        return;
    }

    if (!validateForm()) {
        return;
    }
    
    const form = document.getElementById('bankingDetailsForm');
    const formData = new FormData(form);

    fetch('/user/banking-details', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success('Banking details saved successfully');
            hideBankingModal();
            setTimeout(() => location.reload(), 1500);
        } else {
            toastr.error(data.message || 'Error saving banking details');
        }
    })
    .catch(error => {
        toastr.error('Error saving banking details');
        console.error('Error:', error);
    });
}

// Auto-format IBAN input
document.addEventListener('DOMContentLoaded', function() {
    const ibanInput = document.getElementById('bankAccountIban');
    if (ibanInput) {
        ibanInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '').toUpperCase();
            e.target.value = value;
        });
    }
    
    const swiftInput = document.getElementById('bankSwiftBic');
    if (swiftInput) {
        swiftInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    }
});
</script>