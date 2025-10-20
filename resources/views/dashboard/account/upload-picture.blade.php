@extends('dashboard.layouts.master')
@section('title', 'Upload Profile')
@section('content')
<div class="flex justify-center items-start min-h-screen p-6 bg-gradient-to-br from-white to-blue-50">

  <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-8 max-w-xl w-full text-center space-y-6">

    <h2 class="text-blue-900 font-bold text-lg sm:text-xl">MY PROFILE PICTURE</h2>
    <p class="text-sm text-blue-600">Take a photo of yourself, preferably on a white background</p>

    @if(session('success'))
      <div class="text-green-600">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="text-red-600">{{ session('error') }}</div>
    @endif

    <form method="POST" enctype="multipart/form-data" id="photoForm" class="space-y-4">
      @csrf
      <div class="border-2 border-blue-400 rounded-xl p-4 flex flex-col items-center gap-2">

        <img id="preview" class="w-28 h-28 object-cover rounded-full border mb-2" 
            src="{{ $user->serviceProvider->profile_photo ? asset($user->serviceProvider->profile_photo) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" 
            alt="preview">

        <label for="profile_picture" class="cursor-pointer border border-blue-400 text-blue-500 px-4 py-1 rounded-full text-sm hover:bg-blue-50 transition">
          Upload photo
        </label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="hidden">
        
        <button type="button" id="submitButton" class="text-blue-600 underline font-semibold text-sm hover:text-blue-800">
          I validate
        </button>
      </div>
    </form>

  </div>
</div>
@endsection

@section('scripts')
<script>

document.getElementById('profile_picture').addEventListener('change', function (e) {
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    document.getElementById('preview').src = e.target.result;
  };
  reader.readAsDataURL(file);
});
document.getElementById('submitButton').addEventListener('click', function () {
  const fileInput = document.getElementById('profile_picture');
  const file = fileInput.files[0];
  if (!file) {
    toastr.error('Please select a photo to upload.', 'Error');
    return;
  }

  const formData = new FormData();
  formData.append('profile_picture', file);
  formData.append('_token', '{{ csrf_token() }}');

  fetch('{{ route('provider.profile.photo.ajax') }}', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      document.getElementById('preview').src = data.path; // Update preview with the new image
      toastr.success('Profile photo updated!', 'Success');
    } else {
      toastr.error('Failed to update profile photo!', 'Error');
    }
  })
  .catch(err => {
    console.error(err);
    toastr.error('Failed to update profile photo!', 'Error');
  });
});
</script>
@endsection
