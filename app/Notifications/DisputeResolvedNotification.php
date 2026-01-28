<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Models\Transaction;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class DisputeResolvedNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_DISPUTE;

    private Mission $mission;
    private string $resolution; // 'refunded' ou 'transferred'
    private ?float $amount;

    public function __construct(Mission $mission, string $resolution, ?float $amount = null)
    {
        $this->mission = $mission;
        $this->resolution = $resolution;
        $this->amount = $amount;
    }

    public function toMail($notifiable): MailMessage
    {
        $locale = $this->getUserLocale($notifiable);
        $isRequester = $notifiable->id === $this->mission->requester_id;
        $currency = $this->mission->budget_currency ?? 'EUR';
        $amountFormatted = $this->amount ? number_format($this->amount, 2) . ' ' . $currency : '';

        if ($locale === 'fr') {
            $subject = 'Litige résolu - Mission #' . $this->mission->id;
            $greeting = 'Bonjour ' . $notifiable->name . ',';

            if ($this->resolution === 'refunded') {
                if ($isRequester) {
                    $intro = 'Bonne nouvelle ! Votre litige a été résolu en votre faveur.';
                    $lines = [
                        '**Mission :** ' . $this->mission->title,
                        '**Décision :** Remboursement accordé',
                        $this->amount ? '**Montant remboursé :** ' . $amountFormatted : '',
                        '',
                        'Le montant a été remboursé sur votre moyen de paiement original.',
                    ];
                } else {
                    $intro = 'Le litige concernant cette mission a été résolu.';
                    $lines = [
                        '**Mission :** ' . $this->mission->title,
                        '**Décision :** Remboursement au demandeur',
                        '',
                        'Le demandeur a été remboursé suite à ce litige.',
                    ];
                }
            } else {
                if ($isRequester) {
                    $intro = 'Le litige concernant cette mission a été résolu.';
                    $lines = [
                        '**Mission :** ' . $this->mission->title,
                        '**Décision :** Paiement au prestataire',
                        '',
                        'Après examen, le paiement a été transféré au prestataire.',
                    ];
                } else {
                    $intro = 'Bonne nouvelle ! Le litige a été résolu en votre faveur.';
                    $lines = [
                        '**Mission :** ' . $this->mission->title,
                        '**Décision :** Paiement transféré',
                        $this->amount ? '**Montant reçu :** ' . $amountFormatted : '',
                        '',
                        'Le paiement a été transféré sur votre compte Stripe.',
                    ];
                }
            }
            $actionText = 'Voir le détail';
            $outro = 'Merci de votre confiance.';
        } else {
            $subject = 'Dispute Resolved - Mission #' . $this->mission->id;
            $greeting = 'Hello ' . $notifiable->name . ',';

            if ($this->resolution === 'refunded') {
                if ($isRequester) {
                    $intro = 'Good news! Your dispute has been resolved in your favor.';
                    $lines = [
                        '**Mission:** ' . $this->mission->title,
                        '**Decision:** Refund approved',
                        $this->amount ? '**Amount refunded:** ' . $amountFormatted : '',
                        '',
                        'The amount has been refunded to your original payment method.',
                    ];
                } else {
                    $intro = 'The dispute regarding this mission has been resolved.';
                    $lines = [
                        '**Mission:** ' . $this->mission->title,
                        '**Decision:** Refund to requester',
                        '',
                        'The requester has been refunded following this dispute.',
                    ];
                }
            } else {
                if ($isRequester) {
                    $intro = 'The dispute regarding this mission has been resolved.';
                    $lines = [
                        '**Mission:** ' . $this->mission->title,
                        '**Decision:** Payment to provider',
                        '',
                        'After review, the payment has been transferred to the provider.',
                    ];
                } else {
                    $intro = 'Good news! The dispute has been resolved in your favor.';
                    $lines = [
                        '**Mission:** ' . $this->mission->title,
                        '**Decision:** Payment transferred',
                        $this->amount ? '**Amount received:** ' . $amountFormatted : '',
                        '',
                        'The payment has been transferred to your Stripe account.',
                    ];
                }
            }
            $actionText = 'View Details';
            $outro = 'Thank you for your trust.';
        }

        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->line($intro);

        foreach ($lines as $line) {
            if (!empty($line)) {
                $mail->line($line);
            }
        }

        return $mail
            ->action($actionText, url('/dashboard'))
            ->line($outro);
    }

    public function toArray($notifiable): array
    {
        $isRequester = $notifiable->id === $this->mission->requester_id;
        $inFavor = ($this->resolution === 'refunded' && $isRequester) ||
                   ($this->resolution === 'transferred' && !$isRequester);

        return [
            'type' => 'dispute_resolved',
            'mission_id' => $this->mission->id,
            'mission_title' => $this->mission->title,
            'resolution' => $this->resolution,
            'in_favor' => $inFavor,
            'amount' => $this->amount,
            'icon' => $inFavor ? 'check-circle' : 'info',
            'color' => $inFavor ? 'success' : 'info',
            'url' => '/dashboard',
        ];
    }
}
