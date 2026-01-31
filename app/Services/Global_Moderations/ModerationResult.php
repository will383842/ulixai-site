<?php

namespace App\Services\Global_Moderations;

/**
 * DTO contenant le résultat d'une analyse de modération
 */
class ModerationResult
{
    public const STATUS_CLEAN = 'clean';
    public const STATUS_REVIEW = 'review';
    public const STATUS_BLOCKED = 'blocked';

    private int $score = 0;
    private string $status = self::STATUS_CLEAN;
    private array $matchedWords = [];
    private array $detectedContacts = [];
    private array $spamIndicators = [];
    private array $issues = [];
    private bool $hasContactInfo = false;
    private bool $isSpam = false;

    /**
     * Ajoute un mot interdit détecté
     */
    public function addMatchedWord(string $word, string $severity, string $category): self
    {
        $this->matchedWords[] = [
            'word' => $word,
            'severity' => $severity,
            'category' => $category,
        ];

        $this->addScore($this->getScoreForSeverity($severity));
        $this->addIssue("Mot interdit détecté: {$category}", $severity);

        return $this;
    }

    /**
     * Ajoute une coordonnée détectée
     */
    public function addDetectedContact(string $type, string $value, string $severity): self
    {
        $this->detectedContacts[] = [
            'type' => $type,
            'value' => $this->maskValue($value),
            'severity' => $severity,
        ];

        $this->hasContactInfo = true;
        $this->addScore($this->getContactScore($type));
        $this->addIssue("Coordonnée détectée: {$type}", $severity);

        return $this;
    }

    /**
     * Ajoute un indicateur de spam
     */
    public function addSpamIndicator(string $type, float $value, int $threshold): self
    {
        $this->spamIndicators[] = [
            'type' => $type,
            'value' => $value,
            'threshold' => $threshold,
        ];

        $this->isSpam = true;
        $scoreToAdd = config("moderations.scoring.spam_{$type}", 20);
        $this->addScore($scoreToAdd);
        $this->addIssue("Spam détecté: {$type}", 'warning');

        return $this;
    }

    /**
     * Ajoute des points au score
     */
    public function addScore(int $points): self
    {
        $this->score = min(100, $this->score + $points);
        $this->updateStatus();
        return $this;
    }

    /**
     * Ajoute un problème à la liste
     */
    public function addIssue(string $message, string $severity = 'info'): self
    {
        $this->issues[] = [
            'message' => $message,
            'severity' => $severity,
        ];
        return $this;
    }

    /**
     * Met à jour le statut en fonction du score
     */
    private function updateStatus(): void
    {
        $cleanMax = config('moderations.thresholds.clean_max', 30);
        $blockMin = config('moderations.thresholds.block_min', 70);

        if ($this->score >= $blockMin) {
            $this->status = self::STATUS_BLOCKED;
        } elseif ($this->score >= $cleanMax) {
            $this->status = self::STATUS_REVIEW;
        } else {
            $this->status = self::STATUS_CLEAN;
        }
    }

    /**
     * Score pour une sévérité de mot
     */
    private function getScoreForSeverity(string $severity): int
    {
        return match ($severity) {
            'critical' => config('moderations.scoring.word_critical', 80),
            'warning' => config('moderations.scoring.word_warning', 40),
            'info' => config('moderations.scoring.word_info', 10),
            default => 0,
        };
    }

    /**
     * Score pour un type de contact
     * Les types correspondent à ceux définis dans ContactDetector
     */
    private function getContactScore(string $type): int
    {
        // Emails
        if (str_starts_with($type, 'email')) {
            return config('moderations.scoring.contact_email', 70);
        }

        // Téléphones (tous les formats)
        if (str_starts_with($type, 'phone')) {
            return config('moderations.scoring.contact_phone', 70);
        }

        // Messageries (WhatsApp, Telegram, etc.)
        if (str_starts_with($type, 'messaging')) {
            return config('moderations.scoring.contact_messaging', 70);
        }

        // Demandes de contact explicites
        if (str_starts_with($type, 'contact_request')) {
            return config('moderations.scoring.contact_request', 80);
        }

        // Réseaux sociaux
        if (str_starts_with($type, 'social')) {
            return config('moderations.scoring.contact_social', 50);
        }

        // URLs et domaines
        if (in_array($type, ['url_full', 'url_short', 'domain'])) {
            return config('moderations.scoring.contact_url', 60);
        }

        return 40;
    }

    /**
     * Masque partiellement une valeur sensible
     */
    private function maskValue(string $value): string
    {
        $length = mb_strlen($value);

        if ($length === 0) {
            return '';
        }

        if ($length <= 2) {
            return str_repeat('*', $length);
        }

        if ($length <= 4) {
            return mb_substr($value, 0, 1) . str_repeat('*', $length - 1);
        }

        return mb_substr($value, 0, 2) . str_repeat('*', max(1, $length - 4)) . mb_substr($value, -2);
    }

    // ============================================================
    // GETTERS
    // ============================================================

    public function getScore(): int
    {
        return $this->score;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMatchedWords(): array
    {
        return $this->matchedWords;
    }

    public function getDetectedContacts(): array
    {
        return $this->detectedContacts;
    }

    public function getSpamIndicators(): array
    {
        return $this->spamIndicators;
    }

    public function getIssues(): array
    {
        return $this->issues;
    }

    public function hasContactInfo(): bool
    {
        return $this->hasContactInfo;
    }

    public function isSpam(): bool
    {
        return $this->isSpam;
    }

    public function isClean(): bool
    {
        return $this->status === self::STATUS_CLEAN;
    }

    public function needsReview(): bool
    {
        return $this->status === self::STATUS_REVIEW;
    }

    public function isBlocked(): bool
    {
        return $this->status === self::STATUS_BLOCKED;
    }

    public function hasCriticalWords(): bool
    {
        foreach ($this->matchedWords as $word) {
            if ($word['severity'] === 'critical') {
                return true;
            }
        }
        return false;
    }

    /**
     * Convertit en tableau pour stockage JSON
     */
    public function toArray(): array
    {
        return [
            'score' => $this->score,
            'status' => $this->status,
            'matched_words' => $this->matchedWords,
            'detected_contacts' => $this->detectedContacts,
            'spam_indicators' => $this->spamIndicators,
            'issues' => $this->issues,
            'has_contact_info' => $this->hasContactInfo,
            'is_spam' => $this->isSpam,
        ];
    }

    /**
     * Résumé texte des problèmes
     */
    public function getSummary(): string
    {
        $parts = [];

        if (count($this->matchedWords) > 0) {
            $parts[] = count($this->matchedWords) . ' mot(s) interdit(s)';
        }

        if ($this->hasContactInfo) {
            $parts[] = count($this->detectedContacts) . ' coordonnée(s)';
        }

        if ($this->isSpam) {
            $parts[] = 'spam détecté';
        }

        return empty($parts) ? 'Aucun problème' : implode(', ', $parts);
    }
}
