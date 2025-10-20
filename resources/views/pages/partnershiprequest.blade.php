<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Partnership Request</title>
</head>
<body>


 @include('includes.header')




<section class="max-w-lg mx-auto px-6 py-16 bg-white border border-blue-200 rounded-xl shadow-md mt-10 mb-10">
  <h2 class="text-2xl font-bold text-blue-700 text-center mb-6">
    📝 Partnership Request
  </h2>
  <div id="partnershipForm">
    <form class="space-y-4 partnership-request-form " onsubmit="submitForm(event)">
      @csrf
      <!-- Entity Name -->
      <input  type="text" value="{{ Auth::check() ? Auth::user()->name : '' }}" name="first_name" required  placeholder="Entity name (Required)" class="w-full bg-gray-200 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Full Name -->
      <input type="text" value="{{ Auth::check() ? Auth::user()->name : '' }}" name="last_name" required     placeholder="Your full name (Required)" class="w-full bg-gray-200 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Phone Number -->
      <input type="text" name="phone" value="{{ Auth::check() ? Auth::user()->serviceProvider->phone_number : '' }}" placeholder="Phone number (with country code)" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Country of Activity -->
      <input type="text" name="country" value="{{ Auth::check() ? Auth::user()->serviceProvider->country : '' }}" placeholder="Country of activity" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Sector of Activity -->
      <input type="text" name="sector_of_activity" placeholder="Sector of activity" class="w-full bg-gray-200 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Languages Spoken -->
      <input type="text" name="language_spoken" value="{{ Auth::check() ? Auth::user()->serviceProvider->preferred_language : '' }}" placeholder="Languages spoken" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Preferred Time -->
      <input type="text" name="preferred_time" placeholder="Preferred time for a reply" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Type of Partnership -->
      <select id="partnership_type" name="partnership_type" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700">
        <option disabled selected>— Choose an option —</option>
        <option value="Content Collaboration">Content Collaboration</option>
        <option value="Distribution Partner">Distribution Partner</option>
        <option value="Sponsorship">Sponsorship</option>
      </select>

      <!-- How did you hear -->
      <input type="text" name="how_heard_about" placeholder="How did you hear about Ulixai?" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />

      <!-- Motivation -->
      <textarea rows="3" name="motivation" placeholder="What motivates you to collaborate?" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>

      <!-- Submit Button -->
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full">
        ✅ Submit my partnership request
      </button>
    </form>
  </div>

  <!-- Thank You Message -->
  <div id="thankYouMessage" class="hidden text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/44/44386.png" alt="Globe" class="w-12 h-12 mx-auto mb-2" />
    <h3 class="text-xl font-bold text-blue-800">Thank you for your request!</h3>
    <p class="text-gray-700">We have received it and will get back to you <strong>within 24 hours.</strong></p>
    <p class="text-sm text-gray-600 mt-2">See you soon on this exciting <strong>Ulixai</strong> journey 🌍</p>
  </div>
</section>
























@include('includes.footer')





<script>
  function submitForm(event) {
    event.preventDefault();

    const formData = new FormData(document.querySelector(".partnership-request-form"));

    fetch("{{ route('partnership.store') }}", {
      method: "POST",
      body: formData,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
      },
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Hide the form and show the thank you message
        document.getElementById('partnershipForm').classList.add('hidden');
        document.getElementById('thankYouMessage').classList.remove('hidden');
      } else {
        alert("Something went wrong, please try again.");
      }
    })
    .catch(error => {
      console.error("Error:", error);
      alert("An error occurred. Please try again.");
    });
  }
</script>

</body>
</html>