<?php

namespace App\Services\Global_Moderations;

use App\Models\User;
use App\Models\Mission;
use Illuminate\Support\Facades\Cache;

class SpamDetector
{
    /**
     * Analyse le contenu pour détecter les patterns de spam
     */
    public function analyze(string $content, ?User $user = null): ModerationResult
    {
        $result = new ModerationResult();

        // Vérifier le ratio de majuscules
        $this->checkCapsRatio($content, $result);

        // Vérifier les caractères spéciaux excessifs
        $this->checkSpecialChars($content, $result);

        // Vérifier les répétitions de caractères
        $this->checkRepetition($content, $result);

        // Vérifier la vélocité de création (si user fourni)
        if ($user) {
            $this->checkVelocity($user, $result);
            $this->checkDuplicateContent($content, $user, $result);
        }

        return $result;
    }

    /**
     * Vérifie le ratio de majuscules (TOUT EN MAJUSCULES = spam)
     */
    private function checkCapsRatio(string $content, ModerationResult $result): void
    {
        // Ne compter que les lettres
        $letters = preg_replace('/[^a-zA-ZÀ-ÿ]/u', '', $content);

        if (mb_strlen($letters) < 20) {
            // Trop court pour être significatif
            return;
        }

        $uppercase = preg_replace('/[^A-ZÀ-Ý]/u', '', $content);
        $ratio = mb_strlen($uppercase) / mb_strlen($letters);

        $maxRatio = config('moderations.spam_detection.max_caps_ratio', 0.3);

        if ($ratio > $maxRatio) {
            $result->addSpamIndicator('caps_ratio', round($ratio, 2), $maxRatio);
        }
    }

    /**
     * Vérifie les caractères spéciaux excessifs
     */
    private function checkSpecialChars(string $content, ModerationResult $result): void
    {
        $length = mb_strlen($content);

        if ($length < 20) {
            return;
        }

        // Compter les caractères spéciaux (excluant espaces et ponctuation normale)
        $specialChars = preg_match_all('/[!@#$%^&*()+=\[\]{}|\\:;"\'<>,?\/~`★☆♥♡●○■□▲△▼▽◆◇]/u', $content);
        $ratio = $specialChars / $length;

        $maxRatio = config('moderations.spam_detection.max_special_chars_ratio', 0.15);

        if ($ratio > $maxRatio) {
            $result->addSpamIndicator('special_chars', round($ratio, 2), $maxRatio);
        }
    }

    /**
     * Vérifie les répétitions de caractères (aaaaaa, !!!!!!)
     */
    private function checkRepetition(string $content, ModerationResult $result): void
    {
        $maxRepeated = config('moderations.spam_detection.max_repeated_chars', 4);

        // Pattern pour détecter N+ caractères identiques consécutifs
        $pattern = '/(.)\1{' . $maxRepeated . ',}/u';

        if (preg_match($pattern, $content, $matches)) {
            $result->addSpamIndicator(
                'repetition',
                mb_strlen($matches[0]),
                $maxRepeated
            );
        }
    }

    /**
     * Vérifie la vélocité de création (trop de contenus en peu de temps)
     */
    private function checkVelocity(User $user, ModerationResult $result): void
    {
        $minInterval = config('moderations.spam_detection.min_creation_interval', 60);

        // Clé de cache pour le dernier timestamp de création
        $cacheKey = "user_last_content_{$user->id}";
        $lastCreation = Cache::get($cacheKey);

        if ($lastCreation) {
            $elapsed = time() - $lastCreation;

            if ($elapsed < $minInterval) {
                $result->addSpamIndicator('velocity', $elapsed, $minInterval);
            }
        }

        // Mettre à jour le timestamp (sera fait par ModerationService après analyse)
    }

    /**
     * Vérifie si le contenu est un doublon récent
     */
    private function checkDuplicateContent(string $content, User $user, ModerationResult $result): void
    {
        $threshold = config('moderations.spam_detection.duplicate_similarity_threshold', 0.85);

        // Récupérer les missions récentes de l'utilisateur (dernières 24h)
        $recentMissions = Mission::where('requester_id', $user->id)
            ->where('created_at', '>=', now()->subDay())
            ->select('title', 'description')
            ->limit(10)
            ->get();

        $normalizedContent = $this->normalizeForComparison($content);

        foreach ($recentMissions as $mission) {
            $missionContent = $this->normalizeForComparison(
                $mission->title . ' ' . $mission->description
            );

            $similarity = $this->calculateSimilarity($normalizedContent, $missionContent);

            if ($similarity >= $threshold) {
                $result->addSpamIndicator('duplicate', round($similarity, 2), $threshold);
                break; // Un seul doublon suffit
            }
        }
    }

    /**
     * Normalise le contenu pour la comparaison de similarité
     */
    private function normalizeForComparison(string $content): string
    {
        // Minuscules
        $content = mb_strtolower($content, 'UTF-8');

        // Supprimer la ponctuation
        $content = preg_replace('/[^\p{L}\p{N}\s]/u', '', $content);

        // Normaliser les espaces
        $content = preg_replace('/\s+/', ' ', $content);

        return trim($content);
    }

    /**
     * Calcule la similarité entre deux textes (0-1)
     * Utilise l'algorithme de Jaccard sur les mots
     */
    private function calculateSimilarity(string $text1, string $text2): float
    {
        $words1 = array_unique(explode(' ', $text1));
        $words2 = array_unique(explode(' ', $text2));

        $intersection = array_intersect($words1, $words2);
        $union = array_unique(array_merge($words1, $words2));

        if (count($union) === 0) {
            return 0.0;
        }

        return count($intersection) / count($union);
    }

    /**
     * Enregistre le timestamp de création (à appeler après création réussie)
     */
    public function recordCreation(User $user): void
    {
        $cacheKey = "user_last_content_{$user->id}";
        Cache::put($cacheKey, time(), 3600); // Expire après 1h
    }

    /**
     * Vérifie si un utilisateur peut créer du contenu (limite quotidienne)
     */
    public function canCreate(User $user, string $type = 'mission'): array
    {
        $limitKey = match ($type) {
            'mission' => 'missions_per_day',
            'offer' => 'offers_per_day',
            'message' => 'messages_per_hour',
            'report' => 'reports_per_day',
            default => 'missions_per_day',
        };

        $limit = config("moderations.limits.{$limitKey}", 3);

        $count = $this->getCreationCount($user, $type);

        $allowed = $count < $limit;
        $remaining = max(0, $limit - $count);

        return [
            'allowed' => $allowed,
            'count' => $count,
            'limit' => $limit,
            'remaining' => $remaining,
            'reset_at' => $this->getResetTime($type),
        ];
    }

    /**
     * Compte les créations récentes d'un utilisateur
     */
    private function getCreationCount(User $user, string $type): int
    {
        return match ($type) {
            'mission' => Mission::where('requester_id', $user->id)
                ->whereDate('created_at', today())
                ->count(),
            // Ajouter d'autres types si nécessaire
            default => 0,
        };
    }

    /**
     * Retourne l'heure de réinitialisation du compteur
     */
    private function getResetTime(string $type): string
    {
        return match ($type) {
            'message' => now()->addHour()->startOfHour()->format('H:i'),
            default => now()->addDay()->startOfDay()->format('Y-m-d 00:00'),
        };
    }

    /**
     * Vérifie rapidement si le contenu ressemble à du spam
     */
    public function isSpam(string $content): bool
    {
        $result = $this->analyze($content);
        return $result->isSpam();
    }

    /**
     * Retourne un score de spam (0-100)
     */
    public function getSpamScore(string $content, ?User $user = null): int
    {
        $result = $this->analyze($content, $user);
        return $result->getScore();
    }
}
