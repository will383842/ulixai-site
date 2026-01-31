<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MissionMessage;
use App\Models\Mission;
use App\Events\MissionMessageSent;
use App\Services\Global_Moderations\ModerationService;

class MissionMessageController extends Controller
{
    protected $moderationService;

    public function __construct(ModerationService $moderationService)
    {
        $this->moderationService = $moderationService;
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $mission = Mission::findOrFail($id);

        // ✅ BLOQUER si prestataire déjà sélectionné
        if ($mission->selected_provider_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Public messaging is closed. This mission has a selected provider.'
            ], 403);
        }

        $originalMessage = $request->message;
        $user = auth()->user();
        $userId = $user->id;

        // ═══════════════════════════════════════════════════════
        // 🛡️ MODÉRATION DU MESSAGE
        // ═══════════════════════════════════════════════════════
        // Créer d'abord le message en mode "draft" pour la modération
        $msg = MissionMessage::create([
            'mission_id' => $mission->id,
            'user_id' => $userId,
            'message' => $originalMessage,
            'is_read' => false,
        ]);

        // Analyser le contenu via le service de modération
        $moderationResult = $this->moderationService->moderate($msg, $originalMessage, $user, 'message');
        $moderationStatus = $moderationResult['status'] ?? 'approved';

        // Gérer selon le résultat de modération
        if ($moderationStatus === 'blocked') {
            // Contenu critique - supprimer et bloquer
            $msg->delete();

            Log::warning('🛡️ [MODERATION] Message blocked', [
                'mission_id' => $mission->id,
                'user_id' => $userId,
                'score' => $moderationResult['score'] ?? 0,
            ]);

            return response()->json([
                'status' => 'moderation_blocked',
                'message' => $moderationResult['user_message'] ?? __('notifications.block_reasons.default'),
            ], 422);
        }

        // Pour les messages en review ou approuvés, masquer les coordonnées détectées
        $filteredMessage = $originalMessage;
        if ($moderationResult['score'] ?? 0 > 0) {
            // Si des problèmes détectés, filtrer les coordonnées
            $filteredMessage = $this->filterContactInfo($originalMessage);
            $msg->update(['message' => $filteredMessage]);
        }

        // Charger les relations
        $msg->load('user.serviceProvider');

        // Trigger event if not the requester
        if ($userId !== $mission->requester_id) {
            event(new MissionMessageSent(
                $mission->id,
                $mission->requester_id,
                $msg->id
            ));
        }

        $response = [
            'status' => 'success',
            'message' => 'Message posted.',
            'data' => [
                'user' => [
                    'id' => $msg->user->id,
                    'name' => $msg->user->name,
                    'profile_photo' => $msg->user->serviceProvider->profile_photo ?? null,
                ],
                'message' => $msg->message,
                'created_at' => $msg->created_at->diffForHumans()
            ]
        ];

        // Ajouter un avertissement si coordonnées masquées
        if ($filteredMessage !== $originalMessage) {
            $response['warning'] = __('notifications.block_reasons.contact_info_detected');
        }

        return response()->json($response);
    }

    public function list($id)
    {
        $mission = Mission::findOrFail($id);
        
        $messages = MissionMessage::where('mission_id', $id)
            ->with('user.serviceProvider')
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read if requester is viewing
        if (auth()->id() === $mission->requester_id) {
            MissionMessage::where('mission_id', $id)
                ->where('is_read', false)
                ->where('user_id', '!=', auth()->id())
                ->update(['is_read' => true]);
        }

        $data = $messages->map(function($msg) {
            return [
                'user' => [
                    'id' => $msg->user->id,  // ✅ AJOUTÉ - permet au frontend de savoir qui a envoyé
                    'name' => $msg->user->name,
                    'profile_photo' => $msg->user->serviceProvider->profile_photo ?? null,
                ],
                'message' => $msg->message,
                'created_at' => $msg->created_at->diffForHumans()
            ];
        });

        return response()->json(['status' => 'success', 'messages' => $data]);
    }

    /**
     * Contact filtering patterns for masking
     */
    private $contactPatterns = [
        '/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/',
        '/\b\+?[1-9]\d{7,14}\b/',
        '/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/',
        '/\b06\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2}\b/',
        '/\b0\d{9}\b/',
        '/\bwhatsapp\b/i',
        '/\btelegram\b/i',
        '/\binstagram\b/i',
        '/\bfacebook\b/i',
        '/\b(?:https?:\/\/)?(?:www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(?:\/[^\s]*)?\b/',
    ];

    /**
     * Filter/mask contact information from message
     */
    private function filterContactInfo($message)
    {
        $filteredMessage = $message;
        
        foreach ($this->contactPatterns as $pattern) {
            $filteredMessage = preg_replace_callback($pattern, function($matches) {
                $original = $matches[0];
                $length = strlen($original);
                
                // For phone numbers starting with +
                if (preg_match('/^\+\d/', $original)) {
                    return substr($original, 0, 3) . str_repeat('•', max(1, $length - 3));
                }
                // For phone numbers starting with 0
                elseif (preg_match('/^0\d/', $original)) {
                    return '0' . str_repeat('•', max(1, $length - 1));
                }
                // For emails
                elseif (strpos($original, '@') !== false) {
                    $parts = explode('@', $original);
                    return substr($parts[0], 0, 1) . str_repeat('•', max(1, strlen($parts[0]) - 1)) . '@' . $parts[1];
                }
                // For URLs and other patterns
                elseif (preg_match('/\.(com|org|net|fr)/', $original)) {
                    return str_repeat('•', min(10, $length)) . '.***';
                }
                // For other numeric patterns (like long numbers)
                elseif (preg_match('/^\d+$/', $original)) {
                    if ($length > 6) {
                        return substr($original, 0, 2) . str_repeat('•', $length - 2);
                    }
                    return str_repeat('•', $length);
                }
                // Default: replace with dots
                else {
                    return str_repeat('•', max(3, min(10, $length)));
                }
            }, $filteredMessage);
        }
        
        return trim($filteredMessage);
    }
}