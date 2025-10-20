<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Night Babysitting Mom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <?php include('../includes/header.php'); ?>
    <?php include('../popup.php'); ?>
   
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-md mx-auto px-4 py-3 flex items-center justify-between">
            <i class="fas fa-chevron-left text-gray-600 text-lg"></i>
            <h1 class="text-lg font-semibold text-gray-800 uppercase tracking-wide text-center flex-1">NIGHT BABYSITTING MOM</h1>
            <div class="flex items-center space-x-1"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-md mx-auto px-2 sm:px-4 py-6 space-y-6">
        <!-- Service Info Card -->
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                <div class="flex-shrink-0 flex justify-center w-full sm:w-auto">
                    <!-- Minion Character -->
                    <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center relative">
                        <div class="w-12 h-12 bg-yellow-300 rounded-full relative">
                            <!-- Goggles -->
                            <div class="absolute top-2 left-1/2 transform -translate-x-1/2">
                                <div class="w-8 h-6 bg-gray-700 rounded-full flex items-center justify-center">
                                    <div class="w-6 h-4 bg-white rounded-full border-2 border-gray-600"></div>
                                </div>
                            </div>
                            <!-- Mouth -->
                            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-4 h-2 bg-gray-800 rounded-full"></div>
                        </div>
                        <!-- Overalls -->
                        <div class="absolute bottom-0 w-12 h-6 bg-blue-600 rounded-b-full"></div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Watch over children from 6mons of the night. She is calm and sleeps through the night without waking up.
                        <span class="text-blue-500 underline cursor-pointer">Details of the service request</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-gray-300 aspect-square rounded-lg"></div>
            <div class="bg-gray-300 aspect-square rounded-lg"></div>
            <div class="bg-gray-300 aspect-square rounded-lg"></div>
            <div class="bg-gray-300 aspect-square rounded-lg"></div>
        </div>

        <!-- Service Details -->
        <div class="space-y-2 text-sm text-gray-600">
            <p><span class="font-medium">Date:</span> 16/10/2023</p>
            <p><span class="font-medium">From:</span> 19H00 to 06H00</p>
            <p><span class="font-medium">Address:</span> 42170 Saint Just Saint Rambert</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3">
            <button class="w-full sm:w-auto flex-1 py-3 px-4 bg-gray-100 text-blue-500 rounded-lg font-medium text-sm uppercase tracking-wide">
                <a href="canclerequest.php">CANCEL MY REQUEST</a>
            </button>
            <button class="w-full sm:w-auto flex-1 py-3 px-4 bg-blue-500 text-white rounded-lg font-medium text-sm uppercase tracking-wide">
                <a href="jobdetail.php">MODIFICATIONS</a>
            </button>
        </div>

        <!-- Offers and Messages Section -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Offers Received -->
            <div class="w-full lg:w-1/2">
                <h3 class="font-semibold text-gray-800 mb-4 uppercase tracking-wide text-sm">OFFERS RECEIVED</h3>
                <div class="space-y-4">
                    <!-- Julien -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2 gap-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                <div>
                                    <p class="font-semibold text-gray-800">JULIEN</p>
                                    <p class="text-xs text-gray-500">propose 36 €</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-800">36 €</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 mb-3">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                            </div>
                            <span class="text-xs text-gray-500">4.65</span>
                        </div>
                        <p class="text-xs text-gray-600 mb-3">
                            Je suis un jeune homme à ans
                        </p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button class="flex-1 py-2 px-3 bg-blue-500 text-white rounded text-xs font-medium">
                                <a href="userprofile.php">My profile</a>
                            </button>
                            <button class="flex-1 py-2 px-3 bg-yellow-400 text-black rounded text-xs font-bold">
                                <a href="payments.php">I choose him!</a>
                            </button>
                        </div>
                    </div>

                    <!-- Emili -->
                    <div class="bg-white rounded-lg border border-gray-200 p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2 gap-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                <div>
                                    <p class="font-semibold text-gray-800">EMILI</p>
                                    <p class="text-xs text-gray-500">propose 42 €</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-800">42 €</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 mb-3">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                                <i class="fas fa-star text-xs"></i>
                            </div>
                            <span class="text-xs text-gray-500">4.52</span>
                        </div>
                        <p class="text-xs text-gray-600 mb-3">
                            Je suis une mere de famille à ans avec une riche experience 3 ans dans la garde d'enfant.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button class="flex-1 py-2 px-3 bg-blue-500 text-white rounded text-xs font-medium">
                                My profile
                            </button>
                            <button class="flex-1 py-2 px-3 bg-yellow-400 text-black rounded text-xs font-bold">
                                I choose him!
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Public Messages -->
            <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
                <h3 class="font-semibold text-gray-800 mb-4 uppercase tracking-wide text-sm">PUBLIC MESSAGES</h3>
                <div class="space-y-4">
                    <!-- Benjamin Mitchell -->
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="font-semibold text-sm text-gray-800">Benjamin Mitchell</span>
                                <span class="text-xs text-gray-400">19h59m</span>
                            </div>
                            <p class="text-xs text-gray-600">
                                Managing stress! Who's tackling the tech triangle for the immediate future?
                            </p>
                        </div>
                    </div>

                    <!-- Darin Parker -->
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="font-semibold text-sm text-gray-800">Darin Parker</span>
                                <span class="text-xs text-gray-400">8h39m</span>
                            </div>
                            <p class="text-xs text-gray-600">
                                Fantastic, tell you what love the specific routine they had in mind? Meanwhile, cherish Smith, the first you need to lift is the first message sent and tell you how.
                            </p>
                        </div>
                    </div>

                    <!-- Mia Alvarez -->
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-400 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="font-semibold text-sm text-gray-800">Mia Alvarez</span>
                                <span class="text-xs text-gray-400">6 mins ago</span>
                            </div>
                            <p class="text-xs text-gray-600">
                                Amazing! Is this time pre-booked before night marketing. They'd like to see some side of cost at this talk location buttons. Bit pro Oiseau, would you like to rise tonight?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('bottomnavbar.php'); ?>
</body>
</html>
<style>
@media (max-width: 640px) {
    .max-w-md {
        max-width: 100vw !important;
    }
    .space-y-6 > :not([hidden]) ~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: 1.25rem;
        margin-bottom: 0;
    }
    .grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    .flex-col.lg\:flex-row {
        flex-direction: column !important;
    }
    .w-full.lg\:w-1\/2 {
        width: 100% !important;
    }
    .mt-8.lg\:mt-0 {
        margin-top: 2rem !important;
    }
}
</style>