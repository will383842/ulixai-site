<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    /**
     * Routes qui ne nécessitent pas de vérification de bannissement
     */
    protected array $except = [
        'appeal',
        'appeal/*',
        'logout',
        'banned',
        'suspended',
        'api/appeal/*',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        // Vérifier si la route est dans les exceptions
        if ($this->shouldPassThrough($request)) {
            return $next($request);
        }

        // Vérifier si l'utilisateur est banni
        if ($user->isBanned()) {
            return $this->handleBanned($request, $user);
        }

        // Vérifier si l'utilisateur est suspendu
        if ($user->isSuspended()) {
            return $this->handleSuspended($request, $user);
        }

        return $next($request);
    }

    /**
     * Vérifie si la requête doit passer sans vérification
     */
    protected function shouldPassThrough(Request $request): bool
    {
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gère un utilisateur banni
     */
    protected function handleBanned(Request $request, $user): Response
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'account_banned',
                'message' => __('moderation.account_banned'),
                'reason' => $user->ban_reason,
                'can_appeal' => $user->can_appeal,
                'appeal_until' => $user->appeal_until?->toISOString(),
            ], 403);
        }

        return redirect()->route('banned')->with([
            'reason' => $user->ban_reason,
            'can_appeal' => $user->can_appeal,
            'appeal_until' => $user->appeal_until,
        ]);
    }

    /**
     * Gère un utilisateur suspendu
     */
    protected function handleSuspended(Request $request, $user): Response
    {
        // Vérifier si la suspension est terminée
        if ($user->appeal_until && now()->isAfter($user->appeal_until)) {
            // La suspension est terminée, réactiver le compte
            // Champs hors fillable — assignation directe (C-05)
            $user->status = 'active';
            $user->ban_reason = null;
            $user->banned_at = null;
            $user->appeal_until = null;
            $user->save();

            return $this->handle($request, function ($req) use ($user) {
                return response()->json(['status' => 'active']);
            });
        }

        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'account_suspended',
                'message' => __('moderation.account_suspended'),
                'reason' => $user->ban_reason,
                'until' => $user->appeal_until?->toISOString(),
            ], 403);
        }

        return redirect()->route('suspended')->with([
            'reason' => $user->ban_reason,
            'until' => $user->appeal_until,
        ]);
    }
}
