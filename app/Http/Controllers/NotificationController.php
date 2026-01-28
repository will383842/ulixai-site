<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Récupère les notifications non lues (pour le header/dropdown)
     */
    public function getUnread(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 10);

        $notifications = NotificationService::getUnread($user, $limit);
        $count = NotificationService::countUnread($user);

        return response()->json([
            'success' => true,
            'count' => $count,
            'notifications' => $notifications->map(function ($n) {
                return [
                    'id' => $n->id,
                    'type' => $n->data['type'] ?? 'info',
                    'title' => $this->getNotificationTitle($n->data),
                    'message' => $this->getNotificationMessage($n->data),
                    'icon' => $n->data['icon'] ?? 'bell',
                    'color' => $n->data['color'] ?? 'primary',
                    'url' => $n->data['url'] ?? '/dashboard',
                    'created_at' => $n->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    /**
     * Récupère toutes les notifications avec pagination
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = NotificationService::getAll($user, 20);

        return view('dashboard.notifications', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Marque une notification comme lue
     */
    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $success = NotificationService::markAsRead($user, $id);

        return response()->json(['success' => $success]);
    }

    /**
     * Marque toutes les notifications comme lues
     */
    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $count = NotificationService::markAllAsRead($user);

        return response()->json([
            'success' => true,
            'marked' => $count,
        ]);
    }

    /**
     * Compte les notifications non lues (pour badge)
     */
    public function count()
    {
        $user = Auth::user();
        $count = NotificationService::countUnread($user);

        return response()->json(['count' => $count]);
    }

    /**
     * Met à jour les préférences de notification
     */
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'preferences' => 'required|array',
            'preferences.*.type' => 'required|string',
            'preferences.*.channel' => 'required|string',
            'preferences.*.enabled' => 'required|boolean',
        ]);

        foreach ($validated['preferences'] as $pref) {
            NotificationService::updatePreference(
                $user,
                $pref['channel'],
                $pref['type'],
                $pref['enabled']
            );
        }

        return response()->json(['success' => true]);
    }

    /**
     * Récupère les préférences de notification
     */
    public function getPreferences()
    {
        $user = Auth::user();
        $preferences = NotificationService::getPreferences($user);

        return response()->json([
            'success' => true,
            'preferences' => $preferences,
        ]);
    }

    /**
     * Génère le titre d'une notification selon son type
     */
    private function getNotificationTitle(array $data): string
    {
        $locale = Auth::user()->preferred_language ?? 'fr';
        $type = $data['type'] ?? 'info';

        $titles = [
            'fr' => [
                'dispute_opened' => 'Litige ouvert',
                'dispute_resolved' => 'Litige résolu',
                'payment_received' => 'Paiement reçu',
                'mission_match' => 'Nouvelle mission',
                'offer_accepted' => 'Offre acceptée',
                'mission_completed' => 'Mission complétée',
                'new_offer_received' => 'Nouvelle offre',
            ],
            'en' => [
                'dispute_opened' => 'Dispute Opened',
                'dispute_resolved' => 'Dispute Resolved',
                'payment_received' => 'Payment Received',
                'mission_match' => 'New Mission',
                'offer_accepted' => 'Offer Accepted',
                'mission_completed' => 'Mission Completed',
                'new_offer_received' => 'New Offer',
            ],
        ];

        return $titles[$locale][$type] ?? $titles['en'][$type] ?? 'Notification';
    }

    /**
     * Génère le message d'une notification selon son type
     */
    private function getNotificationMessage(array $data): string
    {
        $type = $data['type'] ?? 'info';
        $title = $data['mission_title'] ?? '';

        switch ($type) {
            case 'dispute_opened':
                return "Mission: {$title}";
            case 'dispute_resolved':
                $resolution = $data['in_favor'] ?? false;
                return $resolution ? "Résolu en votre faveur" : "Mission: {$title}";
            case 'payment_received':
                $amount = $data['amount'] ?? 0;
                $currency = $data['currency'] ?? 'EUR';
                return number_format($amount, 2) . ' ' . $currency;
            case 'new_offer_received':
                $provider = $data['provider_name'] ?? 'Un prestataire';
                return "De: {$provider}";
            default:
                return $title;
        }
    }
}
