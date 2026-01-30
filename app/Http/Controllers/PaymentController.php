<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Models\MissionOffer;
use App\Models\Mission;
use App\Services\CurrencyService;
use App\Services\Gateways\PaymentGatewaySelector;

class PaymentController extends Controller
{
    protected CurrencyService $currencyService;
    protected PaymentGatewaySelector $gatewaySelector;

    public function __construct(CurrencyService $currencyService, PaymentGatewaySelector $gatewaySelector)
    {
        $this->currencyService = $currencyService;
        $this->gatewaySelector = $gatewaySelector;
    }

    public function index(Request $request) {
        $providerId = $request->query('id');
        $missionId = $request->query('mission_id');
        $provider = ServiceProvider::find($providerId);

        if (!$provider) {
            abort(404, 'Provider not found');
        }

        // ✅ KYC SUPPRIMÉ - Stripe gérera le refus automatiquement si nécessaire

        $commissions = \App\Models\UlixCommission::where('is_active', true)->first();
        $requester = auth()->user();

        $offer = null;
        $mission = null;

        if ($missionId) {
            $offer = MissionOffer::where('mission_id', $missionId)
                ->where('provider_id', $providerId)
                ->first();
            $mission = Mission::find($missionId);
        }

        // Vérifier que l'offre existe
        if (!$offer) {
            return redirect()->route('quote-offer', ['id' => $missionId])
                ->with('error', 'No offer found for this provider and mission.');
        }

        // ✅ Récupérer la devise de la mission
        $currency = strtoupper($mission->budget_currency ?? 'EUR');

        $calculateClientFee = number_format($commissions->requester_fee * ($offer->price ?? 0), 2, '.', '');

        // ✅ Calculer les frais prestataire avec le minimum appliqué
        $offerPrice = $offer->price ?? 0;
        $calculatedProviderFee = round($commissions->provider_fee * $offerPrice, 2);
        $minimumServiceFee = $this->currencyService->getMinimumServiceFee($currency);
        $providerFee = max($calculatedProviderFee, $minimumServiceFee);
        $isMinimumApplied = $calculatedProviderFee < $minimumServiceFee;

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

        // ✅ Déterminer la passerelle de paiement recommandée
        $countryCode = $mission->location_country ?? $requester->country ?? 'FR';
        $recommendedGateway = $this->gatewaySelector->selectForCountry($countryCode);
        $availableGateways = $this->gatewaySelector->getAllGatewaysInfo($countryCode);
        $isPayPalAvailable = $this->gatewaySelector->isPayPalAvailable();
        $isStripeAvailable = $this->gatewaySelector->isStripeAvailable();

        return view('dashboard.payments', compact(
            'provider',
            'offer',
            'reviews',
            'clientFee',
            'remainingCreditBalance',
            'mission',
            'providerFee',
            'minimumServiceFee',
            'isMinimumApplied',
            'recommendedGateway',
            'availableGateways',
            'isPayPalAvailable',
            'isStripeAvailable'
        ));
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