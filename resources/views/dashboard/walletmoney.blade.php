<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Wallet with Transaction History</title>
</head>
<body class="bg-gray-100 min-h-screen p-4">
    <!-- Wallet & Referral -->
    <div class="flex flex-row items-center gap-4 mb-8">
        <div class="relative flex-1 max-w-xs">
            <div class="bg-blue-500 text-white px-6 py-2 rounded-full text-sm font-medium flex items-center justify-between hover:bg-blue-600 transition-colors cursor-pointer w-full min-w-[170px] min-h-[48px]"
                 style="height:48px"
                 onmouseenter="showWalletPopup()" onmouseleave="hideWalletPopup()">
                <span class="whitespace-nowrap">piggi bank</span>
                <span class="font-bold text-base ml-2 whitespace-nowrap">243&nbsp;€</span>
            </div>
            <!-- Wallet Popup -->
            <div id="walletHoverPopup" class="absolute top-full left-0 mt-2 bg-white rounded-2xl p-6 w-96 shadow-xl z-50 hidden" onmouseenter="showWalletPopup()" onmouseleave="hideWalletPopup()">
                <h2 class="text-xl font-bold text-gray-900 mb-4">My Piggi Bank</h2>
                
                <div class="space-y-4">
                    <!-- Transaction 1 -->
                    <div class="flex justify-between items-start py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 26/01/2023</div>
                            <div class="text-gray-500 text-sm">Service on 23/01/2023 at "First Name"</div>
                        </div>
                        <div class="font-bold text-gray-900">€96</div>
                    </div>
                    
                    <!-- Transaction 2 -->
                    <div class="flex justify-between items-start py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 26/01/2023</div>
                            <div class="text-gray-500 text-sm">Service on 23/01/2023 at "First Name"</div>
                        </div>
                        <div class="font-bold text-gray-900">€38</div>
                    </div>
                    
                    <!-- Transaction 3 -->
                    <div class="flex justify-between items-start py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 24/01/2023</div>
                            <div class="text-gray-500 text-sm">Service on 21/01/2023 at "First Name"</div>
                        </div>
                        <div class="font-bold text-gray-900">€67</div>
                    </div>
                    
                    <!-- Transaction 4 -->
                    <div class="flex justify-between items-start py-3">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 22/01/2023</div>
                            <div class="text-gray-500 text-sm">Service on 19/01/2023 at "First Name"</div>
                        </div>
                        <div class="font-bold text-gray-900">€42</div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Total Balance:</span>
                        <span class="font-bold text-xl text-blue-600">€243</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="relative flex-1 max-w-xs">
            <div class="bg-yellow-300 text-black px-6 py-2 rounded-full text-sm font-medium flex items-center justify-between hover:bg-yellow-400 transition-colors cursor-pointer w-full min-w-[170px] min-h-[48px]"
                 style="height:48px"
                 onmouseenter="showReferralPopup()" onmouseleave="hideReferralPopup()">
                <span class="whitespace-nowrap">Referral</span>
                <span class="font-bold text-base ml-2 whitespace-nowrap">243&nbsp;€</span>
            </div>
            <!-- Referral Popup -->
            <div id="referralHoverPopup" class="absolute top-full left-0 mt-2 bg-white rounded-2xl p-6 w-96 shadow-xl z-50 hidden" onmouseenter="showReferralPopup()" onmouseleave="hideReferralPopup()">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Referral Earnings</h2>
                
                <div class="space-y-4">
                    <!-- Referral 1 -->
                    <div class="flex justify-between items-start py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 25/01/2023</div>
                            <div class="text-gray-500 text-sm">Referral bonus from "John Doe"</div>
                        </div>
                        <div class="font-bold text-gray-900">€25</div>
                    </div>
                    
                    <!-- Referral 2 -->
                    <div class="flex justify-between items-start py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 23/01/2023</div>
                            <div class="text-gray-500 text-sm">Referral bonus from "Jane Smith"</div>
                        </div>
                        <div class="font-bold text-gray-900">€25</div>
                    </div>
                    
                    <!-- Referral 3 -->
                    <div class="flex justify-between items-start py-3 border-b border-gray-100">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 20/01/2023</div>
                            <div class="text-gray-500 text-sm">Referral bonus from "Mike Johnson"</div>
                        </div>
                        <div class="font-bold text-gray-900">€25</div>
                    </div>
                    
                    <!-- Referral 4 -->
                    <div class="flex justify-between items-start py-3">
                        <div>
                            <div class="font-semibold text-gray-900 text-sm">Received on 18/01/2023</div>
                            <div class="text-gray-500 text-sm">Referral bonus from "Sarah Wilson"</div>
                        </div>
                        <div class="font-bold text-gray-900">€168</div>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-900">Total Referral Earnings:</span>
                        <span class="font-bold text-xl text-yellow-600">€243</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Ensure both buttons are the same size and vertically centered */
        .bg-blue-500, .bg-yellow-300 {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 170px;
            min-height: 48px;
            height: 48px;
        }
    </style>

    <script>
        function showWalletPopup() {
            document.getElementById('walletHoverPopup').classList.remove('hidden');
        }

        function hideWalletPopup() {
            document.getElementById('walletHoverPopup').classList.add('hidden');
        }

        function showReferralPopup() {
            document.getElementById('referralHoverPopup').classList.remove('hidden');
        }

        function hideReferralPopup() {
            document.getElementById('referralHoverPopup').classList.add('hidden');
        }
    </script>
</body>
</html>