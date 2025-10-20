@extends('dashboard.layouts.master')

@section('title', 'Affiliations')

@section('content') 

  <!-- Main Form -->
  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-sm">
      <h2 class="text-lg font-bold text-green-700 mb-6 flex items-center justify-center gap-2">
        💸 Request a Payment via Wise
      </h2>

      <form id="paymentForm">
        <input type="text" placeholder="Enter your full name" class="w-full mb-3 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" required />

        <select class="w-full mb-3 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" required>
          <option value="" disabled selected>Select your country</option>
          <option>Pakistan</option>
          <option>India</option>
          <option>USA</option>
          <option>UK</option>
          <!-- Add more countries as needed -->
        </select>

        <input type="text" placeholder="e.g. Bangkok Bank, BDO, Attijariwafa..." class="w-full mb-3 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" required />
        <input type="text" placeholder="Enter your local account number" class="w-full mb-3 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" required />
        <input type="text" placeholder="e.g. BKKBTHBK for Bangkok Bank" class="w-full mb-3 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" required />

        <select class="w-full mb-3 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" required>
          <option value="" disabled selected>Choose currency</option>
          <option>EUR</option>
          <option>USD</option>
          <option>PKR</option>
          <option>INR</option>
          <!-- Add more currencies as needed -->
        </select>

        <input type="number" placeholder="Minimum 30 EUR" class="w-full mb-5 border rounded px-4 py-2 transition duration-200 hover:border-blue-400 focus:border-blue-600" min="30" required />

        <button type="submit" id="showPopup" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full w-full transition duration-200 hover:scale-105 hover:shadow-lg">
          I confirm my payment
        </button>
      </form>
    </div>
  </div>

  <!-- Popup Modal -->
  <div id="popupModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl shadow-lg text-center max-w-xs w-full">
      <div class="text-green-600 text-2xl mb-2">✅</div>
      <h3 class="text-blue-600 text-lg font-bold mb-2">Payment Request Confirmed</h3>
      <p class="text-sm mb-1">Your payment request has been successfully received.</p>
      <p class="text-sm mb-1">It will be processed via <strong>Wise</strong> within 3 to 5 business days.</p>
      <p class="text-sm mb-4">You’ll receive a confirmation email once the transfer is completed.</p>
      <button onclick="document.getElementById('popupModal').classList.add('hidden')"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-full transition duration-200 hover:scale-105 hover:shadow-lg">
        ← Back to my dashboard
      </button>
    </div>
  </div>

  <!-- Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("paymentForm").addEventListener("submit", function (e) {
        e.preventDefault();
        document.getElementById("popupModal").classList.remove("hidden");
      });
    });
  </script>

  @endsection