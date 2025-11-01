<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class CookieController extends Controller
{
    /**
     * Afficher la page de gestion des cookies
     */
    public function show(): View
    {
        return view('pages.cookies');
    }

    /**
     * Sauvegarder les préférences de l'utilisateur
     */
    public function save(Request $request): JsonResponse
    {
        $preferences = $request->validate([
            'strictly_necessary' => 'required|boolean',
            'performance' => 'required|boolean',
            'functionality' => 'required|boolean',
            'marketing' => 'required|boolean',
        ]);

        // Sauvegarder en cookie (365 jours)
        $cookie = cookie(
            'ulixai_cookie_preferences',
            json_encode($preferences),
            60 * 24 * 365,
            '/',
            null,
            false,
            false
        );

        // Sauvegarder aussi en BDD si connecté
        if (auth()->check()) {
            auth()->user()->update([
                'cookie_preferences' => json_encode($preferences)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '✅ Your preferences have been saved!'
        ])->cookie($cookie);
    }

    /**
     * Accepter tous les cookies
     */
    public function acceptAll(): JsonResponse
    {
        $preferences = [
            'strictly_necessary' => true,
            'performance' => true,
            'functionality' => true,
            'marketing' => true,
        ];

        $cookie = cookie(
            'ulixai_cookie_preferences',
            json_encode($preferences),
            60 * 24 * 365,
            '/',
            null,
            false,
            false
        );

        if (auth()->check()) {
            auth()->user()->update([
                'cookie_preferences' => json_encode($preferences)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '✅ All cookies accepted!'
        ])->cookie($cookie);
    }

    /**
     * Rejeter les cookies optionnels
     */
    public function rejectAll(): JsonResponse
    {
        $preferences = [
            'strictly_necessary' => true,
            'performance' => false,
            'functionality' => false,
            'marketing' => false,
        ];

        $cookie = cookie(
            'ulixai_cookie_preferences',
            json_encode($preferences),
            60 * 24 * 365,
            '/',
            null,
            false,
            false
        );

        if (auth()->check()) {
            auth()->user()->update([
                'cookie_preferences' => json_encode($preferences)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '🚫 Optional cookies rejected!'
        ])->cookie($cookie);
    }

    /**
     * Réinitialiser les préférences
     */
    public function reset(): JsonResponse
    {
        $cookie = cookie(
            'ulixai_cookie_preferences',
            null,
            -1
        );

        if (auth()->check()) {
            auth()->user()->update([
                'cookie_preferences' => null
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => '🔄 Preferences reset!'
        ])->cookie($cookie);
    }
}