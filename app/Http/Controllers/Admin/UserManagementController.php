<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Country;
use App\Models\Transaction;
use App\Models\ServiceProvider;
use App\Models\Mission;


class UserManagementController extends Controller
{
    public function users()
    {
        $users = User::whereNotIn('user_role', ['super_admin', 'regional_admin', 'moderator'])
                ->orderByDesc('created_at')
                ->paginate(20);
        $transactions = Transaction::with(['mission', 'provider'])->latest()->limit(20)->get();
        $providers = ServiceProvider::all();
        return view('admin.dashboard.users', compact('users', 'transactions', 'providers'));
    }
    
    public function manage(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Handle PATCH request for user status update
        if ($request->isMethod('patch')) {
            // Manual edit of payable amount
            if ($request->has('edit_payable_user_id')) {
                $refUser = User::find($request->input('edit_payable_user_id'));
                if ($refUser) {
                    $refUser->update([
                        'pending_affiliate_balance' => $request->input('payable_amount', 0)
                    ]);
                }
                return back()->with('success', 'Payable amount updated.');
            }

            // Retroactive linking (reassign referrals) by email or ID
            if ($request->has('retroactive_user_id') && $request->has('new_referrer_id')) {
                $refUser = User::find($request->input('retroactive_user_id'));
                $newReferrer = null;
                $newReferrerInput = $request->input('new_referrer_id');
                if (filter_var($newReferrerInput, FILTER_VALIDATE_EMAIL)) {
                    $newReferrer = User::where('email', $newReferrerInput)->first();
                } else {
                    $newReferrer = User::find($newReferrerInput);
                }
                if ($refUser && $newReferrer) {
                    $refUser->referred_by = $newReferrer->id;
                    $refUser->save();
                    return back()->with('success', 'Referral reassigned.');
                } else {
                    return back()->with('error', 'Referrer not found.');
                }
            }

            // Block affiliate account
            if ($request->has('block_affiliate_user_id')) {
                $refUser = User::find($request->input('block_affiliate_user_id'));
                if ($refUser) {
                    $refUser->status = 'suspended';
                    $refUser->save();
                }
                return back()->with('success', 'Affiliate account blocked.');
            }

            if ($request->has('unblock_affiliate_user_id')) {
                $refUser = User::find($request->input('unblock_affiliate_user_id'));
                if ($refUser) {
                    $refUser->status = 'active';
                    $refUser->save();
                }
                return back()->with('success', 'Affiliate account is unblocked.');
            }

            // User status update
            if ($request->has('status')) {
                $request->validate([
                    'status' => 'required|in:active,suspended',
                ]);
                $user->status = $request->input('status');
                $user->save();
                return redirect()->route('admin.users.manage', $userId)->with('success', 'User status updated.');
            }
        }

        $missions = Mission::where('requester_id', $userId)->with('transactions')->get();
        $provider = ServiceProvider::where('user_id', $userId)->first();

        $transactionsQuery = Transaction::with(['mission', 'provider'])
            ->whereIn('mission_id', $missions->pluck('id'));
        if ($provider) {
            $transactionsQuery->orWhere('provider_id', $provider->id);
        }
        $transactions = $transactionsQuery->get();

        // AJAX for affiliate filter
        if ($request->ajax() && $request->has('ajax_affiliate')) {
            $referredUsers = User::where('referred_by', $user->id)
                ->when($request->date, fn($q) => $q->whereDate('dob', $request->date))
                ->when($request->country, fn($q) => $q->where('country', $request->country))
                ->when($request->role, fn($q) => $q->where('user_role', $request->role))
                ->when($request->language, fn($q) => $q->where('preferred_language', $request->language))
                ->when($request->influencer !== null, fn($q) => $q->where('special_status', 'like', '%influencer%'))
                ->when($request->entity, fn($q) => $q->where('affiliate_code', $request->entity))
                ->get();

            $html = view('admin.dashboard.partials.affiliate-accounts-table', compact('referredUsers', 'user'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.dashboard.user-manage', compact('user', 'missions', 'transactions', 'provider'));
    }

    public function manageMission(Request $request, $missionId)
    {
        $mission = Mission::findOrFail($missionId);
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'payment_status' => 'required|in:paid,unpaid',
            'selected_provider_id' => 'nullable|exists:service_providers,id',
        ]);

        $mission->status = $request->input('status');
        $mission->payment_status = $request->input('payment_status');
        $mission->selected_provider_id = $request->input('selected_provider_id') ?: null;
        $mission->save();

        return back()->with('success', 'Mission updated successfully.');
    }


    public function adminWorldMap(Request $request)
    {
        // Fetch only visible providers
        $providers = ServiceProvider::with(['user', 'reviews'])
            ->where('provider_visibility', true)
            ->get();

        return view('admin.dashboard.world-map', compact('providers'));
    }

    public function toggleProviderVisibility(Request $request, $id): JsonResponse
    {
        $provider = ServiceProvider::findOrFail($id);
        $provider->provider_visibility = !$provider->provider_visibility;
        $provider->save();

        // Optionally clear cache if used
        Cache::forget('map_providers');

        return response()->json([
            'success' => true,
            'visible' => $provider->provider_visibility
        ]);
    }

    public function updateProviderCoords(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $provider = ServiceProvider::findOrFail($id);
        $provider->city_coords = $request->input('city_coords');
        $provider->country_coords = $request->input('country_coords');
        $provider->save();

        \Cache::forget('map_providers');

        return response()->json(['success' => true]);
    }

    public function toggleProviderPin(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $provider = \App\Models\ServiceProvider::findOrFail($id);
        $provider->pinned = !$provider->pinned;
        $provider->save();

        return response()->json([
            'success' => true,
            'pinned' => $provider->pinned
        ]);
    }

    public function editUserProfile(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->name = $request->input('name');
        $user->dob = $request->input('dob');
        $user->country = $request->input('country');
        $user->gender = $request->input('gender');
        $user->preferred_language = $request->input('preferred_language');
        $user->save();

        return redirect()->route('admin.users.manage', $user->id)->with('success', 'Profile updated.');
    }

    public function editProviderProfile(Request $request, $id)
    {
        $provider = ServiceProvider::findOrFail($id);
        $provider->first_name = $request->input('first_name');
        $provider->last_name = $request->input('last_name');
        $provider->native_language = $request->input('native_language');
        $countryCoordinates = [
            'Afghanistan' => [33.9391, 67.7100],
            'Albania' => [41.1533, 20.1683],
            'Algeria' => [28.0339, 1.6596],
            'Andorra' => [42.5063, 1.5218],
            'Angola' => [-11.2027, 17.8739],
            'Argentina' => [-38.4161, -63.6167],
            'Armenia' => [40.0691, 45.0382],
            'Australia' => [-25.2744, 133.7751],
            'Austria' => [47.5162, 14.5501],
            'Azerbaijan' => [40.1431, 47.5769],
            'Bahamas' => [25.0343, -77.3963],
            'Bahrain' => [25.9304, 50.6378],
            'Bangladesh' => [23.6850, 90.3563],
            'Barbados' => [13.1939, -59.5432],
            'Belarus' => [53.7098, 27.9534],
            'Belgium' => [50.5039, 4.4699],
            'Belize' => [17.1899, -88.4976],
            'Benin' => [9.3077, 2.3158],
            'Bhutan' => [27.5142, 90.4336],
            'Bolivia' => [-16.2902, -63.5887],
            'Bosnia and Herzegovina' => [43.9159, 17.6791],
            'Botswana' => [-22.3285, 24.6849],
            'Brazil' => [-14.2350, -51.9253],
            'Brunei' => [4.5353, 114.7277],
            'Bulgaria' => [42.7339, 25.4858],
            'Burkina Faso' => [12.2383, -1.5616],
            'Burundi' => [-3.3731, 29.9189],
            'Cabo Verde' => [16.5388, -24.0132],
            'Cambodia' => [12.5657, 104.9910],
            'Cameroon' => [7.3697, 12.3547],
            'Canada' => [56.1304, -106.3468],
            'Central African Republic' => [6.6111, 20.9394],
            'Chad' => [15.4542, 18.7322],
            'Chile' => [-35.6751, -71.5430],
            'China' => [35.8617, 104.1954],
            'Colombia' => [4.5709, -74.2973],
            'Comoros' => [-11.6455, 43.3333],
            'Congo' => [-0.2280, 15.8277],
            'Costa Rica' => [9.7489, -83.7534],
            'Croatia' => [45.1000, 15.2000],
            'Cuba' => [21.5218, -77.7812],
            'Cyprus' => [35.1264, 33.4299],
            'Czech Republic' => [49.8175, 15.4730],
            'Denmark' => [56.2639, 9.5018],
            'Djibouti' => [11.8251, 42.5903],
            'Dominica' => [15.4140, -61.3710],
            'Dominican Republic' => [18.7357, -70.1627],
            'Ecuador' => [-1.8312, -78.1834],
            'Egypt' => [26.0975, 30.0444],
            'El Salvador' => [13.7942, -88.8965],
            'Equatorial Guinea' => [1.6508, 10.2679],
            'Eritrea' => [15.1794, 39.7823],
            'Estonia' => [58.5953, 25.0136],
            'Eswatini' => [-26.5225, 31.4659],
            'Ethiopia' => [9.1450, 40.4897],
            'Fiji' => [-16.7784, 179.4144],
            'Finland' => [61.9241, 25.7482],
            'France' => [46.6034, 1.8883],
            'Gabon' => [-0.8037, 11.6094],
            'Gambia' => [13.4432, -15.3101],
            'Georgia' => [42.3154, 43.3569],
            'Germany' => [51.1657, 10.4515],
            'Ghana' => [7.9465, -1.0232],
            'Greece' => [39.0742, 21.8243],
            'Grenada' => [12.1165, -61.6790],
            'Guatemala' => [15.7835, -90.2308],
            'Guinea' => [9.9456, -9.6966],
            'Guinea-Bissau' => [11.8037, -15.1804],
            'Guyana' => [4.8604, -58.9302],
            'Haiti' => [18.9712, -72.2852],
            'Honduras' => [15.2000, -86.2419],
            'Hungary' => [47.1625, 19.5033],
            'Iceland' => [64.9631, -19.0208],
            'India' => [20.5937, 78.9629],
            'Indonesia' => [-0.7893, 113.9213],
            'Iran' => [32.4279, 53.6880],
            'Iraq' => [33.2232, 43.6793],
            'Ireland' => [53.4129, -8.2439],
            'Israel' => [31.0461, 34.8516],
            'Italy' => [41.8719, 12.5674],
            'Jamaica' => [18.1096, -77.2975],
            'Japan' => [36.2048, 138.2529],
            'Jordan' => [30.5852, 36.2384],
            'Kazakhstan' => [48.0196, 66.9237],
            'Kenya' => [-0.0236, 37.9062],
            'Kiribati' => [-3.3704, -168.7340],
            'Kuwait' => [29.3117, 47.4818],
            'Kyrgyzstan' => [41.2044, 74.7661],
            'Laos' => [19.8563, 102.4955],
            'Latvia' => [56.8796, 24.6032],
            'Lebanon' => [33.8547, 35.8623],
            'Lesotho' => [-29.6100, 28.2336],
            'Liberia' => [6.4281, -9.4295],
            'Libya' => [26.3351, 17.2283],
            'Liechtenstein' => [47.1660, 9.5554],
            'Lithuania' => [55.1694, 23.8813],
            'Luxembourg' => [49.8153, 6.1296],
            'Madagascar' => [-18.7669, 46.8691],
            'Malawi' => [-13.2543, 34.3015],
            'Malaysia' => [4.2105, 101.9758],
            'Maldives' => [3.2028, 73.2207],
            'Mali' => [17.5707, -3.9962],
            'Malta' => [35.9375, 14.3754],
            'Marshall Islands' => [7.1315, 171.1845],
            'Mauritania' => [21.0079, -10.9408],
            'Mauritius' => [-20.3484, 57.5522],
            'Mexico' => [23.6345, -102.5528],
            'Micronesia' => [7.4256, 150.5508],
            'Moldova' => [47.4116, 28.3699],
            'Monaco' => [43.7384, 7.4246],
            'Mongolia' => [46.8625, 103.8467],
            'Montenegro' => [42.7087, 19.3744],
            'Morocco' => [31.7917, -7.0926],
            'Mozambique' => [-18.6657, 35.5296],
            'Myanmar' => [21.9162, 95.9560],
            'Namibia' => [-22.9576, 18.4904],
            'Nauru' => [-0.5228, 166.9315],
            'Nepal' => [28.3949, 84.1240],
            'Netherlands' => [52.1326, 5.2913],
            'New Zealand' => [-40.9006, 174.8860],
            'Nicaragua' => [12.2650, -85.2072],
            'Niger' => [17.6078, 8.0817],
            'Nigeria' => [9.0820, 8.6753],
            'North Korea' => [40.3399, 127.5101],
            'North Macedonia' => [41.6086, 21.7453],
            'Norway' => [60.4720, 8.4689],
            'Oman' => [21.4735, 55.9754],
            'Pakistan' => [30.3753, 69.3451],
            'Palau' => [7.5150, 134.5825],
            'Palestine' => [31.9522, 35.2332],
            'Panama' => [8.5380, -80.7821],
            'Papua New Guinea' => [-6.3140, 143.9555],
            'Paraguay' => [-23.4425, -58.4438],
            'Peru' => [-9.1900, -75.0152],
            'Philippines' => [12.8797, 121.7740],
            'Poland' => [51.9194, 19.1451],
            'Portugal' => [39.3999, -8.2245],
            'Qatar' => [25.3548, 51.1839],
            'Romania' => [45.9432, 24.9668],
            'Russia' => [61.5240, 105.3188],
            'Rwanda' => [-1.9403, 29.8739],
            'Saint Kitts and Nevis' => [17.3578, -62.7830],
            'Saint Lucia' => [13.9094, -60.9789],
            'Saint Vincent and the Grenadines' => [12.9843, -61.2872],
            'Samoa' => [-13.7590, -172.1046],
            'San Marino' => [43.9424, 12.4578],
            'Sao Tome and Principe' => [0.1864, 6.6131],
            'Saudi Arabia' => [23.8859, 45.0792],
            'Senegal' => [14.4974, -14.4524],
            'Serbia' => [44.0165, 21.0059],
            'Seychelles' => [-4.6796, 55.4920],
            'Sierra Leone' => [8.4606, -11.7799],
            'Singapore' => [1.3521, 103.8198],
            'Slovakia' => [48.6690, 19.6990],
            'Slovenia' => [46.1512, 14.9955],
            'Solomon Islands' => [-9.6457, 160.1562],
            'Somalia' => [5.1521, 46.1996],
            'South Africa' => [-30.5595, 22.9375],
            'South Korea' => [35.9078, 127.7669],
            'South Sudan' => [6.8770, 31.3070],
            'Spain' => [40.4637, -3.7492],
            'Sri Lanka' => [7.8731, 80.7718],
            'Sudan' => [12.8628, 30.2176],
            'Suriname' => [3.9193, -56.0278],
            'Sweden' => [60.1282, 18.6435],
            'Switzerland' => [46.8182, 8.2275],
            'Syria' => [34.8021, 38.9968],
            'Taiwan' => [23.6978, 120.9605],
            'Tajikistan' => [38.8610, 71.2761],
            'Tanzania' => [-6.3690, 34.8888],
            'Thailand' => [15.8700, 100.9925],
            'Timor-Leste' => [-8.8742, 125.7275],
            'Togo' => [8.6195, 0.8248],
            'Tonga' => [-21.1789, -175.1982],
            'Trinidad and Tobago' => [10.6918, -61.2225],
            'Tunisia' => [33.8869, 9.5375],
            'Turkey' => [38.9637, 35.2433],
            'Turkmenistan' => [38.9697, 59.5563],
            'Tuvalu' => [-7.1095, 177.6493],
            'Uganda' => [1.3733, 32.2903],
            'Ukraine' => [48.3794, 31.1656],
            'United Arab Emirates' => [23.4241, 53.8478],
            'United Kingdom' => [55.3781, -3.4360],
            'United States' => [39.8283, -98.5795],
            'Uruguay' => [-32.5228, -55.7658],
            'Uzbekistan' => [41.3775, 64.5853],
            'Vanuatu' => [-15.3767, 166.9592],
            'Vatican City' => [41.9029, 12.4534],
            'Venezuela' => [6.4238, -66.5897],
            'Vietnam' => [14.0583, 108.2772],
            'Yemen' => [15.5527, 48.5164],
            'Zambia' => [-13.1339, 27.8493],
            'Zimbabwe' => [-19.0154, 29.1549]
        ];
        $countryCoordinates = $countryCoordinates[$request->input('country')] ?? null;
        $countryCoords = $countryCoordinates ? json_encode($countryCoordinates) : null;
        $provider->country = $request->input('country');
        $provider->country_coords = $countryCoords;
        $provider->preferred_language = $request->input('preferred_language');
        $provider->phone_number = $request->input('phone_number');
        $provider->profile_description = $request->input('profile_description');
        $provider->provider_address = $request->input('provider_address');

        $services = $request->input('services_to_offer') ?? [];
        $categories = $request->input('services_to_offer_category') ?? [];

        $provider->services_to_offer = !empty($services)
            ? json_encode(array_map('intval', $services))
            : null;

        $provider->services_to_offer_category = !empty($categories)
            ? json_encode(array_map('intval', $categories))
            : null;
        $provider->communication_online = $request->input('communication_online') ? 1 : 0;
        $provider->communication_inperson = $request->input('communication_inperson') ? 1 : 0;

        // Handle special_status (convert array to key => true format)
        if ($request->filled('special_status') && is_array($request->input('special_status'))) {
            $statuses = [];
            foreach ($request->input('special_status') as $status) {
                $statuses[trim($status)] = true;
            }
            $provider->special_status = json_encode($statuses);
        } else {
            $provider->special_status = null;
        }

        $provider->save();


        return redirect()->route('admin.users.manage', $provider->user_id)->with('success', 'Provider profile updated.');
    }

    public function editProfileView($id)
    {
        $user = User::findOrFail($id);
        $provider = ServiceProvider::where('user_id', $user->id)->first();
        $country = Country::where('status', 1)->get();
        return view('admin.dashboard.edit-profile', compact('user', 'provider', 'country'));
    }


    public function suspendUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'suspended';
        $user->save();

       return response()->json(['success' => true, 'message' => 'User blocked successfully']);
    }
    public function unblockUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

       return response()->json(['success' => true, 'message' => 'User unblocked successfully']);
    }

}
