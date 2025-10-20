@extends('dashboard.layouts.master')

@section('title', 'Personal Info')

@section('content')

  <!-- Page Layout -->
  <div class="flex flex-col lg:flex-row min-h-screen">

    <!-- Main Content -->
    <div class="flex-1 p-4 sm:p-6 lg:p-10 space-y-10">

      <!-- Wallet Overview -->
      <div class="flex flex-wrap gap-4 justify-center sm:justify-start">
        <div class="bg-yellow-300 text-black px-4 py-2 rounded-full text-sm font-medium flex items-center gap-2">
          Total Referral earnings <span class="font-bold text-lg">{{ number_format($user->pending_affiliate_balance, 2) ?? 0.00}} €</span>
        </div>
      </div>

      <!-- Personal Info Card -->
      <div class="bg-white rounded-2xl shadow-md p-6 sm:p-8 max-w-6xl mx-auto">
        <h2 class="text-blue-900 font-bold text-lg mb-6">MY PERSONAL INFORMATION</h2>

        <form id="personalInfoForm" class="space-y-8">
          @csrf
          <!-- Basic Info Fields -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="text-sm text-gray-600 block mb-1">Name</label>
              <input type="text" name="name" value="{{$user->name ?? ''}}" class="w-full border border-blue-300 rounded-full px-4 py-2" required>
            </div>
            <div>
              <label class="text-sm text-gray-600 block mb-1">Date of Birth</label>
              <input type="date" name="dob" value="{{ $user->dob ?? ''}}" class="w-full border border-blue-300 rounded-full px-4 py-2">
            </div>
            <div>
              <label class="text-sm text-gray-600 block mb-1">Gender</label>
              <select name="gender" class="w-full border border-blue-300 rounded-full px-4 py-2">
                <option value="">Select Gender</option>
                <option value="Male" {{ ($user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ ($user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <div>
              <label class="text-sm text-gray-600 block mb-1">Address</label>
              <input type="text" name="address" value="{{$user->address ?? ''}}" class="w-full border border-blue-300 rounded-full px-4 py-2">
            </div>
            
            <div>
              <label class="text-sm text-gray-600 block mb-1">Nationality</label>
              <select name="country" class="w-full border border-blue-300 rounded-full px-4 py-2">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                  <option value="{{ $country->country }}" {{ ($user->country ?? '') == $country->country ? 'selected' : '' }}>{{ $country->country }}</option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="text-sm text-gray-600 block mb-1">Native Language</label>
              <select name="preferred_language" class="w-full border border-blue-300 rounded-full px-4 py-2">
                <option value="">Select Language</option>
                @foreach($languages as $language)
                  <option value="{{ $language }}" {{ ($user->preferred_language ?? '') == $language ? 'selected' : '' }}>{{ $language }}</option>
                @endforeach
              </select>
            </div>

            @if($user->user_role === 'service_provider')
            <div>
              <label class="text-sm text-gray-600 block mb-1">Provider Native Language</label>
              <select name="provider_native_language" class="w-full border border-blue-300 rounded-full px-4 py-2">
                <option value="">Select Native Language</option>
                @foreach($languages as $language)
                  <option value="{{ $language }}" {{ ($provider->native_language ?? '') == $language ? 'selected' : '' }}>{{ $language }}</option>
                @endforeach
              </select>
            </div>

            <!-- Full Width Field for Spoken Languages -->
            <div class="md:col-span-2">
              <label class="text-sm text-gray-600 block mb-1">What languages do you speak?</label>
              <select name="spoken_languages[]" multiple class="w-full border border-blue-300 rounded-lg px-4 py-2" style="height: 120px;">
              @php
                $spokenLanguages = is_array($provider->spoken_language ?? []) ? $provider->spoken_language : json_decode($provider->spoken_language ?? '[]', true);
              @endphp  
              @foreach($languages as $language)
                  
                  <option value="{{ $language }}" {{ in_array($language, $spokenLanguages) ? 'selected' : '' }}>{{ $language }}</option>
                @endforeach
              </select>
              <small class="text-gray-500">Hold Ctrl/Cmd to select multiple languages</small>
            </div>
            @else
            <!-- Full Width Field for Regular Users -->
            <div class="md:col-span-2">
              <label class="text-sm text-gray-600 block mb-1">What languages do you speak?</label>
              <input type="text" name="spoken_languages_text" class="w-full border border-blue-300 rounded-full px-4 py-2" placeholder="e.g., English, Spanish, French">
            </div>
            @endif
          </div>

          <!-- Editable Fields -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="text-sm text-gray-600 block mb-1">WhatsApp Number</label>
              <div class="flex flex-col sm:flex-row gap-3">
                <input type="tel" name="whatsapp_number" value="{{ $user->phone_number ?? '' }}" class="w-full border border-blue-300 rounded-full px-4 py-2">
                <button type="button" class="edit-field-btn bg-yellow-400 text-black font-semibold px-4 py-2 rounded-full text-sm hover:bg-yellow-500" data-field="whatsapp_number">
                  Edit
                </button>
              </div>
            </div>

            <div>
              <label class="text-sm text-gray-600 block mb-1">Email</label>
              <div class="flex flex-col sm:flex-row gap-3">
                <input type="email" name="email" value="{{$user->email ?? 'example@gmail.com'}}" class="w-full border border-blue-300 rounded-full px-4 py-2" readonly>
                <button type="button" class="edit-field-btn bg-yellow-400 text-black font-semibold px-4 py-2 rounded-full text-sm hover:bg-yellow-500" data-field="email">
                  Edit
                </button>
              </div>
            </div>
          </div>
            <input type="hidden" name="user_id" value="{{$user->id}}">
          <!-- Submit Button -->
          <div class="flex justify-center mt-8">
            <button type="submit" class="bg-blue-600 text-white font-semibold px-8 py-3 rounded-full text-sm hover:bg-blue-700 transition-colors">
              Update Information
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Success/Error Messages -->
  <div id="message-container" class="fixed top-4 right-4 z-50"></div>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
    document.getElementById('personalInfoForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      
      // Show loading state
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.textContent = 'Updating...';
      submitBtn.disabled = true;
      
      fetch('/account/update-personal-info', {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showMessage('Personal information updated successfully!', 'success');
        } else {
          showMessage(data.message || 'An error occurred while updating information.', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showMessage('An error occurred while updating information.', 'error');
      })
      .finally(() => {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
      });
    });

    // Handle edit field buttons
    document.querySelectorAll('.edit-field-btn').forEach(button => {
      button.addEventListener('click', function() {
        const user = {{$user->id}};
        const fieldName = this.getAttribute('data-field');
        const input = document.querySelector(`input[name="${fieldName}"]`);
        
        if (input.hasAttribute('readonly')) {
          input.removeAttribute('readonly');
          input.focus();
          this.textContent = 'Save';
          this.classList.remove('bg-yellow-400', 'hover:bg-yellow-500');
          this.classList.add('bg-green-400', 'hover:bg-green-500');
        } else {
          // Save the field
          const formData = new FormData();
          formData.append(fieldName, input.value);
          formData.append('_token', document.querySelector('input[name="_token"]').value);
          
          fetch('/account/update-field', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              input.setAttribute('readonly', 'true');
              this.textContent = 'Edit';
              this.classList.remove('bg-green-400', 'hover:bg-green-500');
              this.classList.add('bg-yellow-400', 'hover:bg-yellow-500');
              showMessage(`${fieldName.replace('_', ' ')} updated successfully!`, 'success');
            } else {
              showMessage(data.message || 'Failed to update field.', 'error');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            showMessage('An error occurred while updating the field.', 'error');
          });
        }
      });
    });

    function showMessage(message, type) {
      const messageContainer = document.getElementById('message-container');
      const messageDiv = document.createElement('div');
      messageDiv.className = `p-4 rounded-lg shadow-lg mb-4 ${type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'}`;
      messageDiv.textContent = message;
      
      messageContainer.appendChild(messageDiv);
      
      setTimeout(() => {
        messageDiv.remove();
      }, 5000);
    }
  });
  </script>

@endsection