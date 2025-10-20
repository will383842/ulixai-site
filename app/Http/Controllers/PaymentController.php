<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\MissionOffer;
use App\Models\Mission;

class PaymentController extends Controller
{
    public function index(Request $request) {
        $providerId = $request->query('id');
        $missionId = $request->query('mission_id');
        $provider = ServiceProvider::find($providerId);
        $commissions = \App\Models\UlixCommission::where('is_active', true)->first();
        $requester = auth()->user(); 

        if (!$provider) {
            abort(404, 'Provider not found');
        }

        $offer = null;

        if ($missionId) {
            $offer = MissionOffer::where('mission_id', $missionId)
                ->where('provider_id', $providerId)
                ->first();
        }
        $calculateClientFee = number_format($commissions->requester_fee * ($offer->price ?? 0), 2, '.', '');

        $requesterCreditBalance = $requester->credit_balance;

        $clientFee = 0;
        $remainingCreditBalance = 0;

        if($requesterCreditBalance > 0 ) {

            if($requesterCreditBalance >= $calculateClientFee) {
                $remainingCreditBalance = $requesterCreditBalance - $calculateClientFee;
            }
            if($requesterCreditBalance < $calculateClientFee) {
                $clientFee = $calculateClientFee - $requesterCreditBalance;
            }
        }
        
        // Get provider reviews
        $reviews = $provider->reviews()->get()->avg('rating');
        return view('dashboard.payments', compact('provider', 'offer', 'reviews', 'clientFee', 'remainingCreditBalance'));
    }

    public function paymentValidate(Request $request) {
        $user = auth()->user();
        $missions = [];
        if ($user) {
            $missions = Mission::with(['transactions'])->where('requester_id', $user->id)
                ->orderByDesc('created_at')
                ->get();
        }
        return view('dashboard.payments.payments-validate', compact('missions', 'user'));
    }
    public function earningAndPayments(Request $request) {
        return view('dashboard.my-earnings-payments');
    }
}
