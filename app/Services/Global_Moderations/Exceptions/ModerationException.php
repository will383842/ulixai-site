<?php

namespace App\Services\Global_Moderations\Exceptions;

use Exception;

class ModerationException extends Exception
{
    protected array $context = [];
    protected ?string $userMessage = null;

    /**
     * Crée une exception de limite atteinte
     */
    public static function limitReached(string $type, int $limit, string $resetAt): self
    {
        $exception = new self("Rate limit reached for {$type}: {$limit}");
        $exception->userMessage = "Vous avez atteint la limite de {$limit} {$type} par jour. Réessayez après {$resetAt}.";
        $exception->context = [
            'type' => $type,
            'limit' => $limit,
            'reset_at' => $resetAt,
        ];

        return $exception;
    }

    /**
     * Crée une exception de contenu bloqué
     */
    public static function contentBlocked(string $reason, array $detectedIssues = []): self
    {
        $exception = new self("Content blocked: {$reason}");
        $exception->userMessage = "Votre contenu ne peut pas être publié car il ne respecte pas nos conditions d'utilisation.";
        $exception->context = [
            'reason' => $reason,
            'detected_issues' => $detectedIssues,
        ];

        return $exception;
    }

    /**
     * Crée une exception d'utilisateur banni
     */
    public static function userBanned(string $reason, ?string $appealUntil = null): self
    {
        $exception = new self("User is banned: {$reason}");
        $exception->userMessage = "Votre compte a été suspendu.";

        if ($appealUntil) {
            $exception->userMessage .= " Vous pouvez faire appel jusqu'au {$appealUntil}.";
        }

        $exception->context = [
            'reason' => $reason,
            'can_appeal' => !empty($appealUntil),
            'appeal_until' => $appealUntil,
        ];

        return $exception;
    }

    /**
     * Crée une exception de contenu en attente
     */
    public static function contentPendingReview(): self
    {
        $exception = new self("Content is pending review");
        $exception->userMessage = "Votre contenu est en cours de vérification. Vous serez notifié une fois la vérification terminée.";

        return $exception;
    }

    /**
     * Crée une exception de strike émis
     */
    public static function strikeIssued(int $strikeNumber, int $maxStrikes): self
    {
        $exception = new self("Strike {$strikeNumber} issued");
        $remaining = $maxStrikes - $strikeNumber;

        if ($remaining > 0) {
            $exception->userMessage = "Vous avez reçu un avertissement ({$strikeNumber}/{$maxStrikes}). Après {$remaining} avertissement(s) supplémentaire(s), votre compte sera suspendu.";
        } else {
            $exception->userMessage = "Votre compte a été suspendu suite à de multiples violations de nos conditions d'utilisation.";
        }

        $exception->context = [
            'strike_number' => $strikeNumber,
            'max_strikes' => $maxStrikes,
            'remaining' => $remaining,
        ];

        return $exception;
    }

    /**
     * Récupère le message pour l'utilisateur
     */
    public function getUserMessage(): string
    {
        return $this->userMessage ?? $this->getMessage();
    }

    /**
     * Récupère le contexte
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Définit le message utilisateur
     */
    public function setUserMessage(string $message): self
    {
        $this->userMessage = $message;
        return $this;
    }

    /**
     * Ajoute au contexte
     */
    public function addContext(string $key, mixed $value): self
    {
        $this->context[$key] = $value;
        return $this;
    }
}
