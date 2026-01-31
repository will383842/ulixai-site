<?php

namespace App\Services\Global_Moderations\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware pour vérifier le statut de l'utilisateur (banni, suspendu)
 */
class CheckUserStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        // Vérifier si l'utilisateur est banni
        if ($user->isBanned()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'account_banned',
                    'message' => __('moderation.account_banned'),
                    'reason' => $user->ban_reason,
                    'can_appeal' => $user->can_appeal,
                    'appeal_until' => $user->appeal_until,
                ], 403);
            }

            return redirect()->route('account.banned')
                ->with('ban_reason', $user->ban_reason)
                ->with('can_appeal', $user->can_appeal)
                ->with('appeal_until', $user->appeal_until);
        }

        // Vérifier si l'utilisateur est suspendu
        if ($user->isSuspended()) {
            // Vérifier si la suspension est terminée
            if ($user->appeal_until && now()->isAfter($user->appeal_until)) {
                // Lever automatiquement la suspension
                $user->update([
                    'status' => 'active',
                    'ban_reason' => null,
                    'banned_at' => null,
                    'appeal_until' => null,
                ]);

                return $next($request);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'account_suspended',
                    'message' => __('moderation.account_suspended'),
                    'reason' => $user->ban_reason,
                    'until' => $user->appeal_until,
                ], 403);
            }

            return redirect()->route('account.suspended')
                ->with('reason', $user->ban_reason)
                ->with('until', $user->appeal_until);
        }

        return $next($request);
    }
}
