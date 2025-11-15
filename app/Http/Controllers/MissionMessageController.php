<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MissionMessage;
use App\Models\Mission;
use App\Events\MissionMessageSent;

class MissionMessageController extends Controller
{
    // Contact filtering patterns
    private $contactPatterns = [
        // Email patterns
        '/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/',
        '/\b[A-Za-z0-9._%+-]+\(dot\)[A-Za-z0-9.-]+\(dot\)[A-Z|a-z]{2,}\b/',
        '/\bgmail\(dot\)com\b/',
        
        // Phone patterns - Fixed regex
        '/\b\+?[1-9]\d{7,14}\b/', // International format (8-15 digits)
        '/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', // US format
        '/\b\+33\/?\d{1,2}[-.\s]?\d{2}[-.\s]?\d{2}[-.\s]?\d{2}[-.\s]?\d{2}\b/', // French format
        '/\b06\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2}\b/', // Mobile format
        '/\b0\d{9}\b/', // Simple 10-digit starting with 0
        '/\btel:\s*\d+\b/i',
        '/\bphone:\s*\d+\b/i',
        
        // Social media and messaging
        '/\bwhatsapp\b/i',
        '/\btelegram\b/i',
        '/\binstagram\b/i',
        '/\bfacebook\b/i',
        '/\btwitter\b/i',
        '/\bdiscord\b/i',
        '/\bskype\b/i',
        
        // Website patterns
        '/\b(?:https?:\/\/)?(?:www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(?:\/[^\s]*)?\b/',
        '/\.com\/[^\s]*/',
        '/\.fr\/[^\s]*/',
        '/\.org\/[^\s]*/',
        '/\.net\/[^\s]*/',
        
        // Disguised forms
        '/\b\d+\s?xx\s?\d+\s?xx\s?\d+\b/', // Phone with xx
        '/\bat\s*gmail\s*dot\s*com\b/i',
        '/\[at\]/i',
        '/\(at\)/i',
    ];

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
        $userId = auth()->id();
        
        // Check for contact information
        $contactDetected = $this->detectContactInfo($originalMessage);
        $filteredMessage = $originalMessage;
        
        if ($contactDetected) {
            // Replace detected contact info with dots/stars
            $filteredMessage = $this->filterContactInfo($originalMessage);
        }

        // Create message with is_read: false
        $msg = MissionMessage::with('user.serviceProvider')->find(
            MissionMessage::create([
                'mission_id' => $mission->id,
                'user_id' => $userId,
                'message' => $filteredMessage,
                'is_read' => false
            ])->id
        );

        // Trigger event if not the requester
        if ($userId !== $mission->requester_id) {
            event(new MissionMessageSent(
                $mission->id,
                $mission->requester_id,
                $msg->id
            ));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Message posted.',
            'data' => [
                'user' => [
                    'name' => $msg->user->name,
                    'profile_photo' => $msg->user->serviceProvider->profile_photo ?? null,
                ],
                'message' => $msg->message,
                'created_at' => $msg->created_at->diffForHumans()
            ]
        ]);
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
     * Detect if message contains contact information
     */
    private function detectContactInfo($message)
    {
        foreach ($this->contactPatterns as $pattern) {
            if (preg_match($pattern, $message)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Filter contact information from message
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