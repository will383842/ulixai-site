<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogService
{
    /**
     * Log une action critique (paiement, dispute, etc.)
     */
    public static function log(
        string $action,
        ?object $model = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): AuditLog {
        $user = Auth::user();

        return AuditLog::create([
            'user_id' => $user?->id,
            'admin_id' => $user && in_array($user->user_role, ['super_admin', 'regional_admin', 'moderator'])
                ? $user->id
                : null,
            'action' => $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model?->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip() ?? '0.0.0.0',
            'user_agent' => Request::userAgent() ?? 'Unknown',
            'method' => Request::method(),
            'url' => Request::fullUrl() ?? '',
            'session_id' => session()->getId(),
        ]);
    }

    /**
     * Raccourcis pour les actions courantes
     */
    public static function logPayment($transaction, string $action = 'payment_processed'): AuditLog
    {
        return self::log($action, $transaction, null, [
            'amount' => $transaction->amount_paid,
            'status' => $transaction->status,
            'mission_id' => $transaction->mission_id,
        ]);
    }

    public static function logDispute($mission, string $action = 'dispute_opened'): AuditLog
    {
        return self::log($action, $mission, null, [
            'mission_id' => $mission->id,
            'status' => $mission->status,
            'payment_status' => $mission->payment_status,
        ]);
    }

    public static function logRefund($transaction, string $action = 'refund_processed'): AuditLog
    {
        return self::log($action, $transaction, null, [
            'amount' => $transaction->amount_paid,
            'mission_id' => $transaction->mission_id,
        ]);
    }

    public static function logAdminAction(string $action, $model = null, ?array $details = null): AuditLog
    {
        return self::log("admin_{$action}", $model, null, $details);
    }
}
