<?php

namespace App\Services\Global_Moderations;

use App\Services\Global_Moderations\Models\BannedWord;
use Illuminate\Support\Facades\Cache;

class WordFilter
{
    private const CACHE_KEY = 'moderation_banned_words';
    private const CACHE_TTL = 3600; // 1 heure

    /**
     * Analyse le contenu pour détecter les mots interdits
     * Vérifie contre TOUTES les langues (les utilisateurs peuvent publier en n'importe quelle langue)
     */
    public function analyze(string $content): ModerationResult
    {
        $result = new ModerationResult();
        $normalizedContent = $this->normalize($content);
        $bannedWords = $this->getBannedWords();

        foreach ($bannedWords as $word) {
            if ($this->matches($normalizedContent, $word)) {
                $result->addMatchedWord(
                    $word->word,
                    $word->severity,
                    $word->category
                );
            }
        }

        return $result;
    }

    /**
     * Vérifie si un mot interdit correspond au contenu
     */
    private function matches(string $normalizedContent, BannedWord $word): bool
    {
        if ($word->is_regex) {
            // Pattern regex - utiliser directement
            try {
                return (bool) preg_match('/' . $word->word . '/iu', $normalizedContent);
            } catch (\Exception $e) {
                // Pattern invalide, ignorer
                return false;
            }
        }

        // Mot simple - recherche avec word boundaries
        // Utiliser la version normalisée du mot
        $pattern = '/\b' . preg_quote($word->normalized_word, '/') . '\b/iu';
        return (bool) preg_match($pattern, $normalizedContent);
    }

    /**
     * Normalise le contenu pour la comparaison
     * - Convertit en minuscules
     * - Supprime les accents
     * - Normalise les espaces
     */
    public function normalize(string $content): string
    {
        // Convertir en minuscules (UTF-8 safe)
        $normalized = mb_strtolower($content, 'UTF-8');

        // Supprimer les accents latins
        $normalized = $this->removeAccents($normalized);

        // Normaliser les espaces multiples
        $normalized = preg_replace('/\s+/', ' ', $normalized);

        // Supprimer les caractères de substitution courants (l33t speak)
        $normalized = $this->normalizeLeetSpeak($normalized);

        return trim($normalized);
    }

    /**
     * Supprime les accents des caractères latins
     */
    private function removeAccents(string $string): string
    {
        $accents = [
            // Français
            'à' => 'a', 'â' => 'a', 'ä' => 'a', 'á' => 'a', 'ã' => 'a', 'å' => 'a',
            'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'é' => 'e',
            'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'í' => 'i',
            'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'ó' => 'o', 'õ' => 'o', 'ø' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
            'ÿ' => 'y', 'ý' => 'y',
            'ñ' => 'n',
            'ç' => 'c',
            // Allemand
            'ß' => 'ss',
            'æ' => 'ae',
            'œ' => 'oe',
        ];

        return strtr($string, $accents);
    }

    /**
     * Normalise le leet speak (substitutions de caractères)
     */
    private function normalizeLeetSpeak(string $string): string
    {
        $substitutions = [
            '0' => 'o',
            '1' => 'i',
            '3' => 'e',
            '4' => 'a',
            '5' => 's',
            '7' => 't',
            '@' => 'a',
            '$' => 's',
        ];

        return strtr($string, $substitutions);
    }

    /**
     * Récupère tous les mots interdits (avec cache)
     *
     * @return \Illuminate\Support\Collection<BannedWord>
     */
    private function getBannedWords()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return BannedWord::active()->get();
        });
    }

    /**
     * Vide le cache des mots interdits
     * À appeler après modification de la table banned_words
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
     * Retourne les mots trouvés (pour debug/admin)
     */
    public function getMatches(string $content): array
    {
        $result = $this->analyze($content);
        return $result->getMatchedWords();
    }
}
