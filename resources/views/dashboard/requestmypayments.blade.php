<body class="bg-gray-100 text-gray-800 font-sans">

<?php include('../includes/header.php'); ?>
 <?php include('../popup.php'); ?>

<div class="flex flex-col lg:flex-row min-h-screen">

  <!-- Sidebar -->
  <div class="w-full lg:w-1/5 bg-white shadow-lg">
    <?php include('sidebardash.php'); ?>
  </div>

  <!-- Main Content -->
  <div class="flex-1 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md border">

      <!-- Title -->
      <h2 class="text-lg font-bold text-green-700 mb-6 flex items-center gap-2">
        💸 Request a Payment via Wise
      </h2>

      <!-- Payment Form -->
      <form action="#" method="POST" class="space-y-5">

        <!-- Full Name -->
        <div>
          <label class="block text-sm font-medium mb-1">Full Name</label>
          <input type="text" name="full_name" placeholder="Enter your full name"
                 class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
        </div>

        <!-- Country -->
        <div>
          <label class="block text-sm font-medium mb-1">Country of your Bank</label>
          <select name="country" class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
            <option value="">Select your country</option>
            <option value="fr">France</option>
            <option value="pk">Pakistan</option>
            <option value="de">Germany</option>
            <option value="us">USA</option>
            <!-- Add more as needed -->
          </select>
        </div>

        <!-- Bank Name -->
        <div>
          <label class="block text-sm font-medium mb-1">Local Bank Name</label>
          <input type="text" name="bank_name" placeholder="e.g. Bangkok Bank, BDO, Attijariwafa..."
                 class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
        </div>

        <!-- Account Number -->
        <div>
          <label class="block text-sm font-medium mb-1">Bank Account Number</label>
          <input type="text" name="account_number" placeholder="Enter your local account number"
                 class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
        </div>

        <!-- SWIFT/BIC -->
        <div>
          <label class="block text-sm font-medium mb-1">SWIFT/BIC Code</label>
          <input type="text" name="swift_code" placeholder="e.g. BKKBTHBK for Bangkok Bank"
                 class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
          <p class="text-xs text-gray-500 mt-1">This helps us send your payment securely via Wise.</p>
        </div>

        <!-- Currency -->
        <div>
          <label class="block text-sm font-medium mb-1">Currency to receive</label>
          <select name="currency" class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
            <option value="">Choose currency</option>
            <option value="eur">EUR</option>
            <option value="usd">USD</option>
            <option value="gbp">GBP</option>
            <!-- Add more as needed -->
          </select>
        </div>

        <!-- Amount -->
        <div>
          <label class="block text-sm font-medium mb-1">Requested Amount</label>
          <input type="number" min="30" name="amount" placeholder="Minimum 30 EUR"
                 class="w-full border rounded-lg px-4 py-2 focus:ring focus:outline-none" required>
        </div>

        <!-- Submit -->
        <div class="text-center">
          <button type="submit"
                  class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold px-6 py-2 rounded-full transition">
            I confirm my payment
          </button>
        </div>

      </form>

    </div>
  </div>

</div>
<?php include('bottomnavbar.php'); ?>
</body>