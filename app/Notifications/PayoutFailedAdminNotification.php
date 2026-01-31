<?php

namespace App\Notifications;

use App\Models\Transaction;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class PayoutFailedAdminNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_PAYMENT;

    private ?Transaction $transaction;
    private string $batchId;
    private string $reason;

    public function __construct(?Transaction $transaction, string $batchId, string $reason = 'PayPal payout failed')
    {
        $this->transaction = $transaction;
        $this->batchId = $batchId;
        $this->reason = $reason;
    }

    public function toMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('[ADMIN ALERT] PayPal Payout Failed - Batch ' . $this->batchId)
            ->greeting('Admin Alert')
            ->line('A PayPal payout has failed and requires attention.')
            ->line('')
            ->line('**Batch ID:** ' . $this->batchId)
            ->line('**Reason:** ' . $this->reason);

        if ($this->transaction) {
            $mail->line('**Transaction ID:** ' . $this->transaction->id)
                ->line('**Mission ID:** ' . $this->transaction->mission_id)
                ->line('**Provider ID:** ' . $this->transaction->provider_id)
                ->line('**Amount:** ' . number_format($this->transaction->amount_paid, 2) . ' ' . $this->transaction->currency);
        }

        return $mail
            ->line('')
            ->line('Please investigate and resolve this issue manually.')
            ->action('View Admin Dashboard', url('/admin/transactions'));
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'payout_failed_admin',
            'batch_id' => $this->batchId,
            'transaction_id' => $this->transaction?->id,
            'mission_id' => $this->transaction?->mission_id,
            'provider_id' => $this->transaction?->provider_id,
            'reason' => $this->reason,
            'icon' => 'alert-octagon',
            'color' => 'danger',
            'url' => '/admin/transactions',
        ];
    }
}
