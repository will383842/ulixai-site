<?php

namespace App\Services\Global_Moderations;

use App\Services\Global_Moderations\Models\BannedWord;
use Illuminate\Support\Facades\Cache;

class WordFilter
{
    private const CACHE_KEY = 'moderation_banned_words';
    private const CACHE_TTL = 3600; // 1 heure

    /**
     * Phrases légitimes à ne PAS bloquer (whitelist contextuelle)
     * Ces phrases indiquent une utilisation normale, pas une arnaque
     */
    private array $legitimatePhrases = [
        // Western Union - contexte légitime
        'aide western union', 'help western union', 'hilfe western union',
        'comment faire western union', 'how to western union',
        'besoin aide western union', 'need help western union',
        'transfert western union', 'western union transfer',
        'envoyer argent famille', 'send money family',

        // Paiement - contexte légitime
        'aide virement', 'help transfer', 'aide paiement', 'help payment',
        'comment payer', 'how to pay', 'moyen de paiement', 'payment method',

        // Contact - contexte légitime (demande d'info, pas partage)
        'comment vous contacter', 'how to contact you',
        'moyen de contact', 'contact method',
        'préférence de contact', 'contact preference',
    ];

    /**
     * Combinaisons suspectes (plusieurs mots = alerte)
     * Format: [mots requis, score additionnel, raison]
     */
    private array $suspiciousCombinations = [
        // Arnaques financières
        [['western union', 'urgent'], 25, 'scam_urgent_transfer'],
        [['western union', 'envoyez', 'maintenant'], 35, 'scam_urgent_transfer'],
        [['virement', 'urgent', 'immédiat'], 30, 'scam_urgent_transfer'],
        [['argent', 'urgent', 'aide'], 20, 'scam_money_urgent'],
        [['paiement', 'avance', 'garantie'], 30, 'scam_advance_payment'],
        [['frais', 'débloquer', 'fonds'], 40, 'scam_unlock_fees'],
        [['héritage', 'millions', 'partager'], 50, 'scam_inheritance'],
        [['loterie', 'gagné', 'réclamer'], 50, 'scam_lottery'],

        // Tentatives de contact direct
        [['whatsapp', 'contacter'], 15, 'contact_attempt'],
        [['telegram', 'rejoindre'], 15, 'contact_attempt'],
        [['appeler', 'numéro'], 10, 'contact_attempt'],
        [['mail', 'écrire', 'directement'], 15, 'contact_attempt'],

        // Spam patterns
        [['gratuit', '100%', 'garanti'], 25, 'spam_too_good'],
        [['offre', 'limitée', 'exclusif'], 15, 'spam_urgency'],
        [['cliquez', 'ici', 'maintenant'], 20, 'spam_clickbait'],
    ];

    /**
     * Analyse le contenu avec contexte
     */
    public function analyze(string $content): ModerationResult
    {
        $result = new ModerationResult();
        $normalizedContent = $this->normalize($content);
        $originalLower = mb_strtolower($content, 'UTF-8');

        // 1. Vérifier d'abord les phrases légitimes (whitelist)
        if ($this->containsLegitimatePhrase($originalLower)) {
            $result->setContextFlag('legitimate_context', true);
            // Réduire la sévérité pour ce contenu
        }

        // 2. Analyser les mots interdits avec contexte
        $bannedWords = $this->getBannedWords();
        $foundWords = [];

        foreach ($bannedWords as $word) {
            if ($this->matches($normalizedContent, $word)) {
                $foundWords[] = $word;
            }
        }

        // 3. Scoring contextuel - un mot seul n'a pas le même poids qu'une combinaison
        foreach ($foundWords as $word) {
            $contextScore = $this->calculateContextualScore($word, $foundWords, $normalizedContent, $result);

            // Ajuster la sévérité en fonction du contexte
            $adjustedSeverity = $this->adjustSeverityByContext($word, $contextScore, $result);

            $result->addMatchedWord(
                $word->word,
                $adjustedSeverity,
                $word->category,
                $contextScore
            );
        }

        // 4. Vérifier les combinaisons suspectes
        $this->checkSuspiciousCombinations($normalizedContent, $result);

        return $result;
    }

    /**
     * Calcule le score contextuel d'un mot
     */
    private function calculateContextualScore(
        BannedWord $word,
        array $allFoundWords,
        string $content,
        ModerationResult $result
    ): int {
        $baseScore = $this->getBaseScore($word->severity);
        $contextMultiplier = 1.0;

        // Un mot SEUL = score réduit (peut être légitime)
        if (count($allFoundWords) === 1) {
            $contextMultiplier = 0.3; // 30% du score seulement
            $result->setContextFlag('single_word_match', true);
        }

        // Contexte légitime détecté = score très réduit
        if ($result->hasContextFlag('legitimate_context')) {
            $contextMultiplier *= 0.2; // 20% supplémentaire
        }

        // Plusieurs mots de la même catégorie = plus suspect
        $sameCategoryCount = 0;
        foreach ($allFoundWords as $fw) {
            if ($fw->category === $word->category) {
                $sameCategoryCount++;
            }
        }
        if ($sameCategoryCount > 1) {
            $contextMultiplier *= (1 + ($sameCategoryCount * 0.3));
        }

        // Vérifier si le mot est utilisé dans une question (moins suspect)
        if ($this->isInQuestion($content, $word->word)) {
            $contextMultiplier *= 0.5;
            $result->setContextFlag('question_context', true);
        }

        return (int) round($baseScore * $contextMultiplier);
    }

    /**
     * Score de base par sévérité
     */
    private function getBaseScore(string $severity): int
    {
        return match ($severity) {
            'critical' => 40,
            'warning' => 15,
            'info' => 5,
            default => 10,
        };
    }

    /**
     * Ajuste la sévérité en fonction du contexte
     */
    private function adjustSeverityByContext(
        BannedWord $word,
        int $contextScore,
        ModerationResult $result
    ): string {
        // Si le contexte est légitime et score faible, downgrade la sévérité
        if ($result->hasContextFlag('legitimate_context') && $contextScore < 15) {
            if ($word->severity === 'critical') {
                return 'warning'; // Downgrade
            }
            if ($word->severity === 'warning') {
                return 'info'; // Downgrade
            }
        }

        // Mot seul dans une question = moins sévère
        if ($result->hasContextFlag('single_word_match') && $result->hasContextFlag('question_context')) {
            if ($word->severity === 'critical') {
                return 'warning';
            }
        }

        return $word->severity;
    }

    /**
     * Vérifie si le contenu contient une phrase légitime
     */
    private function containsLegitimatePhrase(string $content): bool
    {
        foreach ($this->legitimatePhrases as $phrase) {
            if (str_contains($content, $phrase)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Vérifie si un mot est utilisé dans une question
     */
    private function isInQuestion(string $content, string $word): bool
    {
        // Chercher le mot et vérifier s'il y a un ? proche ou des mots interrogatifs
        $questionIndicators = [
            'comment', 'how', 'wie', 'como', 'как',
            'pourquoi', 'why', 'warum', 'por qué', 'почему',
            'où', 'where', 'wo', 'donde', 'где',
            'quel', 'what', 'was', 'qué', 'что',
            'est-ce que', 'is it', 'kann ich', 'puedo',
            '?',
        ];

        $wordPos = mb_stripos($content, $word);
        if ($wordPos === false) return false;

        // Chercher dans un rayon de 50 caractères autour du mot
        $start = max(0, $wordPos - 50);
        $length = min(mb_strlen($content) - $start, 100 + mb_strlen($word));
        $context = mb_substr($content, $start, $length);

        foreach ($questionIndicators as $indicator) {
            if (mb_stripos($context, $indicator) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Vérifie les combinaisons suspectes de mots
     */
    private function checkSuspiciousCombinations(string $content, ModerationResult $result): void
    {
        foreach ($this->suspiciousCombinations as [$words, $score, $reason]) {
            $allFound = true;
            foreach ($words as $word) {
                if (mb_stripos($content, $word) === false) {
                    $allFound = false;
                    break;
                }
            }

            if ($allFound) {
                $result->addCombinationMatch($words, $score, $reason);
            }
        }
    }

    /**
     * Vérifie si un mot interdit correspond au contenu
     */
    private function matches(string $normalizedContent, BannedWord $word): bool
    {
        if ($word->is_regex) {
            try {
                return (bool) preg_match('/' . $word->word . '/iu', $normalizedContent);
            } catch (\Exception $e) {
                return false;
            }
        }

        $pattern = '/\b' . preg_quote($word->normalized_word, '/') . '\b/iu';
        return (bool) preg_match($pattern, $normalizedContent);
    }

    /**
     * Normalise le contenu pour la comparaison
     */
    public function normalize(string $content): string
    {
        $normalized = mb_strtolower($content, 'UTF-8');
        $normalized = $this->removeAccents($normalized);
        $normalized = preg_replace('/\s+/', ' ', $normalized);
        $normalized = $this->normalizeLeetSpeak($normalized);
        return trim($normalized);
    }

    /**
     * Supprime les accents des caractères latins
     */
    private function removeAccents(string $string): string
    {
        $accents = [
            'à' => 'a', 'â' => 'a', 'ä' => 'a', 'á' => 'a', 'ã' => 'a', 'å' => 'a',
            'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'é' => 'e',
            'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'í' => 'i',
            'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'ó' => 'o', 'õ' => 'o', 'ø' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
            'ÿ' => 'y', 'ý' => 'y',
            'ñ' => 'n',
            'ç' => 'c',
            'ß' => 'ss',
            'æ' => 'ae',
            'œ' => 'oe',
        ];

        return strtr($string, $accents);
    }

    /**
     * Normalise le leet speak
     */
    private function normalizeLeetSpeak(string $string): string
    {
        $substitutions = [
            '0' => 'o', '1' => 'i', '3' => 'e', '4' => 'a',
            '5' => 's', '7' => 't', '@' => 'a', '$' => 's',
        ];

        return strtr($string, $substitutions);
    }

    /**
     * Récupère les mots interdits (avec cache)
     */
    private function getBannedWords()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return BannedWord::active()->get();
        });
    }

    /**
     * Vide le cache
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Vérifie rapidement si le contenu contient des mots critiques
     */
    public function hasCriticalWords(string $content): bool
    {
        $result = $this->analyze($content);
        return $result->hasCriticalWords();
    }

    /**
     * Vérifie rapidement si le contenu est propre
     */
    public function isClean(string $content): bool
    {
        $result = $this->analyze($content);
        return $result->isClean();
    }

    /**
     * Retourne les mots trouvés
     */
    public function getMatches(string $content): array
    {
        $result = $this->analyze($content);
        return $result->getMatchedWords();
    }
}
