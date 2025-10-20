<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dispute</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-4">
     <?php include('../includes/header.php'); ?>
      <?php include('../popup.php'); ?>
     
    <div class="max-w-2xl mx-auto">
        <!-- Header with X button -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-2">
                <!-- <div class="w-3 h-3 bg-pink-400 rounded-full"></div> -->
                <!-- <span class="text-gray-600 text-sm">Hi</span>
                <button class="text-gray-400 hover:text-gray-600">×</button> -->
            </div>
        </div>

        <!-- Main dispute notification -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <!-- Alert header -->
            <div class="flex items-center gap-3 mb-4">
                <div class="w-6 h-6 bg-red-100 rounded flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h1 class="text-lg font-semibold text-gray-900">You have received a dispute</h1>
            </div>
            
            <p class="text-gray-600 text-sm mb-6">The client has sent you the following message:</p>

            <!-- Message content -->
            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <p class="text-gray-700 mb-4">Hi "name service provider",</p>
                
                <p class="text-gray-700 mb-4">I hope you're doing well. I'm contacting you because I have some concerns about the current order:</p>
                
                <ul class="list-disc pl-6 mb-4 space-y-2">
                    <li class="text-gray-700">No update has been shared since the project started.</li>
                    <li class="text-gray-700">The expected delivery date was 3 days ago.</li>
                    <li class="text-gray-700">I sent 2 messages without a reply.</li>
                </ul>
                
                <p class="text-gray-700">I'd really appreciate it if you could either provide a clear update or cancel the order if you're unable to continue. Looking forward to your response. Thanks in advance!</p>
            </div>
        </div>

        <!-- Timer -->
        <div class="flex items-center gap-2 mb-6">
            <div class="w-5 h-5 bg-orange-100 rounded flex items-center justify-center">
                <svg class="w-3 h-3 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <span class="text-red-600 font-medium text-sm">Time remaining to respond: <span id="countdown">23:51:52</span></span>
        </div>

        <!-- Action buttons -->
        <div class="flex gap-4">
            <button class="px-6 py-3 text-red-600 border border-red-200 rounded-lg hover:bg-red-50 font-medium">
                Refuse Request
            </button>
            <button class="px-6 py-3 bg-blue-700 text-white rounded-lg hover:bg-blue-800 font-medium">
                Accept Request
            </button>
        </div>
    </div>

    <script>
        // Simple countdown timer
        let timeRemaining = 23 * 3600 + 51 * 60 + 52; // 23:51:52 in seconds
        
        function updateCountdown() {
            const hours = Math.floor(timeRemaining / 3600);
            const minutes = Math.floor((timeRemaining % 3600) / 60);
            const seconds = timeRemaining % 60;
            
            const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            document.getElementById('countdown').textContent = formattedTime;
            
            if (timeRemaining > 0) {
                timeRemaining--;
            }
        }
        
        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call
    </script>
    <?php include('bottomnavbar.php'); ?>
</body>
</html>