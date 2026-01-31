<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Services\NotificationService;
use Illuminate\Notifications\Messages\MailMessage;

class PayPalDisputeNotification extends BaseNotification
{
    protected string $type = NotificationService::TYPE_DISPUTE;

    private ?Mission $mission;
    private string $disputeId;
    private ?float $amount;
    private bool $isAdmin;

    public function __construct(?Mission $mission, string $disputeId, ?float $amount = null, bool $isAdmin = false)
    {
        $this->mission = $mission;
        $this->disputeId = $disputeId;
        $this->amount = $amount;
        $this->isAdmin = $isAdmin;
    }

    public function toMail($notifiable): MailMessage
    {
        if ($this->isAdmin) {
            return $this->toAdminMail($notifiable);
        }

        $locale = $this->getUserLocale($notifiable);

        if ($locale === 'fr') {
            $mail = (new MailMessage)
                ->subject('Litige PayPal ouvert')
                ->greeting('Bonjour ' . $notifiable->name . ',')
                ->line('Un litige PayPal a été ouvert concernant un paiement.');

            if ($this->mission) {
                $mail->line('**Mission :** ' . $this->mission->title);
            }

            if ($this->amount) {
                $mail->line('**Montant contesté :** ' . number_format($this->amount, 2) . ' EUR');
            }

            return $mail
                ->line('**ID du litige PayPal :** ' . $this->disputeId)
                ->line('')
                ->line('Notre équipe examine ce litige. Le paiement est temporairement bloqué.')
                ->line('Vous serez informé de la résolution.')
                ->action('Voir mes litiges', url('/my-disputes'))
                ->line('Si vous avez des questions, n\'hésitez pas à nous contacter.');
        }

        $mail = (new MailMessage)
            ->subject('PayPal Dispute Opened')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A PayPal dispute has been opened regarding a payment.');

        if ($this->mission) {
            $mail->line('**Mission:** ' . $this->mission->title);
        }

        if ($this->amount) {
            $mail->line('**Disputed Amount:** ' . number_format($this->amount, 2) . ' EUR');
        }

        return $mail
            ->line('**PayPal Dispute ID:** ' . $this->disputeId)
            ->line('')
            ->line('Our team is reviewing this dispute. The payment is temporarily held.')
            ->line('You will be notified of the resolution.')
            ->action('View My Disputes', url('/my-disputes'))
            ->line('If you have any questions, please contact us.');
    }

    private function toAdminMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('[ADMIN ALERT] PayPal Dispute - ' . $this->disputeId)
            ->greeting('Admin Alert')
            ->line('A PayPal dispute requires attention.')
            ->line('')
            ->line('**Dispute ID:** ' . $this->disputeId);

        if ($this->mission) {
            $mail->line('**Mission ID:** ' . $this->mission->id)
                ->line('**Mission Title:** ' . $this->mission->title)
                ->line('**Requester ID:** ' . $this->mission->requester_id)
                ->line('**Provider ID:** ' . $this->mission->selected_provider_id);
        }

        if ($this->amount) {
            $mail->line('**Disputed Amount:** ' . number_format($this->amount, 2) . ' EUR');
        }

        return $mail
            ->line('')
            ->line('Please investigate and respond to this dispute in PayPal.')
            ->action('View Admin Disputes', url('/admin/disputes'));
    }

    public function toArray($notifiable): array
    {
        return [
            'type' => 'paypal_dispute',
            'dispute_id' => $this->disputeId,
            'mission_id' => $this->mission?->id,
            'mission_title' => $this->mission?->title,
            'amount' => $this->amount,
            'is_admin' => $this->isAdmin,
            'icon' => 'alert-triangle',
            'color' => 'warning',
            'url' => $this->isAdmin ? '/admin/disputes' : '/my-disputes',
        ];
    }
}
