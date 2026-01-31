<?php

namespace App\Services\Global_Notifications\Moderation;

use App\Services\Global_Notifications\BaseNotification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Notification envoyée quand un contenu est automatiquement bloqué
 * Fournit un feedback clair à l'utilisateur sans révéler les détails techniques
 * Traduite dans les 9 langues supportées
 */
class ContentBlockedNotification extends BaseNotification
{
    protected array $defaultChannels = ['database', 'mail'];

    public function __construct(
        protected string $contentType,
        protected string $contentTitle,
        protected array $publicReasons = []
    ) {}

    public function toMail($notifiable): MailMessage
    {
        $locale = $notifiable->preferred_language ?? app()->getLocale();
        $reasonText = $this->getHumanReadableReasons($locale);
        $contentTypeLabel = __('notifications.content_types.' . $this->contentType, [], $locale);

        $lines = [
            __('notifications.messages.content_blocked', [
                'type' => $contentTypeLabel,
                'title' => $this->contentTitle
            ], $locale),
            '',
            $reasonText,
            '',
            __('notifications.blocked_advice.intro', [], $locale),
            '• ' . __('notifications.blocked_advice.modify', [], $locale),
            '• ' . __('notifications.blocked_advice.no_contact', [], $locale),
            '• ' . __('notifications.blocked_advice.use_messaging', [], $locale),
            '',
            __('notifications.blocked_advice.review_info', [], $locale),
        ];

        return $this->buildMailMessage(
            __('notifications.titles.content_blocked', [], $locale),
            $lines,
            __('notifications.email.view_terms', [], $locale),
            url('/terms-of-service')
        );
    }

    public function toArray($notifiable): array
    {
        $locale = $notifiable->preferred_language ?? app()->getLocale();
        $reasonText = $this->getHumanReadableReasons($locale);
        $contentTypeLabel = __('notifications.content_types.' . $this->contentType, [], $locale);

        $message = __('notifications.messages.content_blocked', [
            'type' => $contentTypeLabel,
            'title' => $this->contentTitle
        ], $locale) . ' ' . $reasonText;

        return $this->buildDatabaseArray(
            'moderation.content_blocked',
            __('notifications.titles.content_blocked', [], $locale),
            $message,
            url('/terms-of-service'),
            [
                'content_type' => $this->contentType,
                'content_title' => $this->contentTitle,
                'reasons' => $this->publicReasons,
            ]
        );
    }

    protected function getNotificationType(): string
    {
        return 'moderation.content_blocked';
    }

    /**
     * Convertit les raisons techniques en messages compréhensibles (traduits)
     */
    protected function getHumanReadableReasons(string $locale): string
    {
        $messages = [];

        foreach ($this->publicReasons as $reason) {
            $key = match ($reason) {
                'inappropriate_content' => 'notifications.block_reasons.inappropriate_content',
                'contact_info_detected' => 'notifications.block_reasons.contact_info_detected',
                'spam_detected' => 'notifications.block_reasons.spam_detected',
                default => 'notifications.block_reasons.default',
            };
            $messages[] = __($key, [], $locale);
        }

        return empty($messages)
            ? __('notifications.block_reasons.default', [], $locale)
            : implode(' ', array_unique($messages));
    }
}
