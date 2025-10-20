<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Report Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex flex-col">
       @include('includes.header')
      @include('pages.popup')
        
        <!-- Main Content Container -->
        <main class="flex-1 flex items-center justify-center p-4 py-8">
        <!-- Bug Report Form -->
        <div id="bugForm" class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-2xl">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-blue-700 mb-2 flex items-center">
                    <span class="mr-2">🔧</span>
                    Having trouble using the platform?
                </h2>
                <p class="text-gray-600 text-sm">
                    Got ideas to improve @site? Report any bugs or share your suggestions below — your feedback helps us make Ulixar better for everyone.
                </p>
            </div>

            <!-- Form -->
            <form id="feedbackForm" class="space-y-6">
                <!-- Country Selection -->
               <div>
                    <label class="block text-blue-700 font-semibold mb-2">Your country of installation</label>
                    <select  name="country" class="w-full p-3 border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500">
                        <option value="" disabled selected>Select your country</option>
                        @foreach([
                            'Afghanistan','Albania','Algeria','Andorra','Angola','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cabo Verde','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Eswatini','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','North Korea','North Macedonia','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Korea','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe'
                        ] as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>
                </div>


                                <!-- Language Selection -->
                            <div>
                    <label class="block text-blue-700 font-semibold mb-2">Your language</label>
                    <select name="language" class="w-full p-3 border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:border-blue-500">
                        <option value="" disabled selected>Select your language</option>
                        @foreach([
                            'Afrikaans','Albanian','Amharic','Arabic','Armenian','Azerbaijani','Basque','Belarusian','Bengali','Bosnian',
                            'Bulgarian','Burmese','Catalan','Cebuano','Chichewa','Chinese (Simplified)','Chinese (Traditional)','Corsican',
                            'Croatian','Czech','Danish','Dutch','English','Esperanto','Estonian','Filipino','Finnish','French','Frisian',
                            'Galician','Georgian','German','Greek','Gujarati','Haitian Creole','Hausa','Hawaiian','Hebrew','Hindi','Hmong',
                            'Hungarian','Icelandic','Igbo','Indonesian','Irish','Italian','Japanese','Javanese','Kannada','Kazakh','Khmer',
                            'Kinyarwanda','Korean','Kurdish (Kurmanji)','Kyrgyz','Lao','Latin','Latvian','Lithuanian','Luxembourgish',
                            'Macedonian','Malagasy','Malay','Malayalam','Maltese','Maori','Marathi','Mongolian','Nepali','Norwegian',
                            'Odia','Pashto','Persian','Polish','Portuguese','Punjabi','Romanian','Russian','Samoan','Scots Gaelic','Serbian',
                            'Sesotho','Shona','Sindhi','Sinhala','Slovak','Slovenian','Somali','Spanish','Sundanese','Swahili','Swedish',
                            'Tajik','Tamil','Tatar','Telugu','Thai','Turkish','Turkmen','Ukrainian','Urdu','Uyghur','Uzbek','Vietnamese',
                            'Welsh','Xhosa','Yiddish','Yoruba','Zulu'
                        ] as $language)
                            <option value="{{ $language }}">{{ $language }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Bug Description -->
                <div>
                    <label class="block text-blue-700 font-semibold mb-2">Describe any bugs you've encountered</label>
                    <textarea  name="bug_description" 
                        class="w-full p-3 border border-gray-300 rounded-lg resize-none h-24 focus:outline-none focus:border-blue-500" 
                        placeholder="Describe the issue or malfunction you experienced..."
                    ></textarea>
                </div>

                <!-- Suggestions -->
                <div>
                    <label class="block text-blue-700 font-semibold mb-2">Do you have any suggestions for improving @site?</label>
                    <textarea name="suggestions" 
                        class="w-full p-3 border border-gray-300 rounded-lg resize-none h-24 focus:outline-none focus:border-blue-500" 
                        placeholder="Tell us how we could improve the platform..."
                    ></textarea>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200"
                >
                    Send your feedback
                </button>
            </form>
        </div>
        </main>

    </div>

    <!-- Thank You Modal (Hidden by default) -->
    <div id="thankYouModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md text-center border border-blue-100">
            <div class="mb-4">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4">
                    <span class="text-green-600 text-2xl">✓</span>
                </div>
                <h3 class="text-2xl font-bold text-blue-700 mb-2">Thank You!</h3>
                <p class="text-gray-600 mb-2">We've received your feedback.</p>
                <p class="text-gray-600 mb-2">Our team will review your message carefully.</p>
                <p class="text-gray-600 mb-6">Thank you for helping us improve @site!</p>
            </div>
            <button 
                id="backToUlixar" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center mx-auto"
            >
                <span class="mr-2">←</span>
               <a href="/index"> Back to @site</a>
            </button>
        </div>
    </div>

     @include('includes.footer')

<script>
    const feedbackForm = document.getElementById('feedbackForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const LOGGED_IN_USER_ID = @if(auth()->check()) {{ auth()->user()->id }} @else null @endif;

    feedbackForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!LOGGED_IN_USER_ID) {
            toastr.error('You must be logged in to submit a bug report.', 'Error');
    return;
}




        function showGreenNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
    notification.innerHTML = `
        <div class="flex items-center">
            <span class="mr-2">ℹ️</span>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(notification);
    
    // Slide in
    setTimeout(() => notification.classList.remove('translate-x-full'), 100);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

        const formData = new FormData(feedbackForm);

        const payload = {
            user_id: LOGGED_IN_USER_ID,
            country: formData.get('country'),
            language: formData.get('language'),
            bug_description: formData.get('bug_description'),
            suggestions: formData.get('suggestions'),
        };

        try {
            const response = await fetch('/api/report-bug', { // Add /api prefix
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    // Note: API routes typically don't need CSRF token
                },
                body: JSON.stringify(payload),
            });

            if (!response.ok) throw new Error('Failed to submit');

            // Show thank you modal
            document.getElementById('bugForm').style.display = 'none';
            document.getElementById('thankYouModal').classList.remove('hidden');
            feedbackForm.reset();
        } catch (error) {
            console.error('Error:', error);
            alert('Error submitting bug report.');
        }
    });
</script>

</body>
</html>