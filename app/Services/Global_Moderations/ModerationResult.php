<?php

namespace App\Services\Global_Moderations;

/**
 * DTO contenant le résultat d'une analyse de modération
 * Version améliorée avec analyse contextuelle
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
    private array $combinationMatches = [];
    private array $contextFlags = [];
    private bool $hasContactInfo = false;
    private bool $isSpam = false;

    /**
     * Ajoute un mot interdit détecté (avec score contextuel optionnel)
     */
    public function addMatchedWord(
        string $word,
        string $severity,
        string $category,
        ?int $contextScore = null
    ): self {
        $this->matchedWords[] = [
            'word' => $word,
            'severity' => $severity,
            'category' => $category,
            'context_score' => $contextScore,
        ];

        // Utiliser le score contextuel si fourni, sinon le score par défaut
        $scoreToAdd = $contextScore ?? $this->getScoreForSeverity($severity);
        $this->addScore($scoreToAdd);

        // Message adapté au contexte
        $contextInfo = '';
        if ($this->hasContextFlag('legitimate_context')) {
            $contextInfo = ' (contexte légitime détecté)';
        } elseif ($this->hasContextFlag('question_context')) {
            $contextInfo = ' (utilisé dans une question)';
        }

        $this->addIssue("Mot détecté: {$category}{$contextInfo}", $severity);

        return $this;
    }

    /**
     * Ajoute une combinaison suspecte de mots
     */
    public function addCombinationMatch(array $words, int $score, string $reason): self
    {
        $this->combinationMatches[] = [
            'words' => $words,
            'score' => $score,
            'reason' => $reason,
        ];

        $this->addScore($score);
        $this->addIssue("Combinaison suspecte: " . implode(' + ', $words), 'warning');

        return $this;
    }

    /**
     * Définit un flag de contexte
     */
    public function setContextFlag(string $flag, bool $value = true): self
    {
        $this->contextFlags[$flag] = $value;
        return $this;
    }

    /**
     * Vérifie si un flag de contexte est défini
     */
    public function hasContextFlag(string $flag): bool
    {
        return $this->contextFlags[$flag] ?? false;
    }

    /**
     * Retourne tous les flags de contexte
     */
    public function getContextFlags(): array
    {
        return $this->contextFlags;
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
        $scoreToAdd = config("moderations.scoring.spam_{$type}", 15);
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
     * NOUVEAUX SEUILS plus souples:
     * - 0-39: Clean (approuvé)
     * - 40-79: Review (vérification admin)
     * - 80+: Blocked (bloqué automatiquement)
     */
    private function updateStatus(): void
    {
        $cleanMax = config('moderations.thresholds.clean_max', 40);
        $blockMin = config('moderations.thresholds.block_min', 80);

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
     * NOUVEAUX SCORES plus progressifs
     */
    private function getScoreForSeverity(string $severity): int
    {
        return match ($severity) {
            'critical' => config('moderations.scoring.word_critical', 40),
            'warning' => config('moderations.scoring.word_warning', 15),
            'info' => config('moderations.scoring.word_info', 5),
            default => 0,
        };
    }

    /**
     * Score pour un type de contact
     * SCORES AJUSTÉS - moins punitifs pour les cas edge
     */
    private function getContactScore(string $type): int
    {
        // Emails
        if (str_starts_with($type, 'email')) {
            return config('moderations.scoring.contact_email', 50);
        }

        // Téléphones (tous les formats)
        if (str_starts_with($type, 'phone')) {
            return config('moderations.scoring.contact_phone', 50);
        }

        // Messageries (WhatsApp, Telegram, etc.)
        if (str_starts_with($type, 'messaging')) {
            return config('moderations.scoring.contact_messaging', 45);
        }

        // Demandes de contact explicites ("contactez-moi en DM")
        if (str_starts_with($type, 'contact_request')) {
            return config('moderations.scoring.contact_request', 35);
        }

        // Réseaux sociaux
        if (str_starts_with($type, 'social')) {
            return config('moderations.scoring.contact_social', 30);
        }

        // URLs et domaines
        if (in_array($type, ['url_full', 'url_short', 'domain'])) {
            return config('moderations.scoring.contact_url', 25);
        }

        return 20;
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

    public function getCombinationMatches(): array
    {
        return $this->combinationMatches;
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
     * Vérifie si le contenu a un contexte légitime
     */
    public function hasLegitimateContext(): bool
    {
        return $this->hasContextFlag('legitimate_context');
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
            'combination_matches' => $this->combinationMatches,
            'detected_contacts' => $this->detectedContacts,
            'spam_indicators' => $this->spamIndicators,
            'issues' => $this->issues,
            'context_flags' => $this->contextFlags,
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
            $parts[] = count($this->matchedWords) . ' mot(s) détecté(s)';
        }

        if (count($this->combinationMatches) > 0) {
            $parts[] = count($this->combinationMatches) . ' combinaison(s) suspecte(s)';
        }

        if ($this->hasContactInfo) {
            $parts[] = count($this->detectedContacts) . ' coordonnée(s)';
        }

        if ($this->isSpam) {
            $parts[] = 'spam détecté';
        }

        if ($this->hasLegitimateContext()) {
            $parts[] = '(contexte légitime)';
        }

        return empty($parts) ? 'Aucun problème' : implode(', ', $parts);
    }

    /**
     * Retourne un résumé pour les admins
     */
    public function getAdminSummary(): array
    {
        return [
            'score' => $this->score,
            'status' => $this->status,
            'status_label' => match ($this->status) {
                self::STATUS_CLEAN => 'Approuvé',
                self::STATUS_REVIEW => 'En révision',
                self::STATUS_BLOCKED => 'Bloqué',
            },
            'summary' => $this->getSummary(),
            'has_legitimate_context' => $this->hasLegitimateContext(),
            'word_count' => count($this->matchedWords),
            'contact_count' => count($this->detectedContacts),
            'combination_count' => count($this->combinationMatches),
        ];
    }
}
