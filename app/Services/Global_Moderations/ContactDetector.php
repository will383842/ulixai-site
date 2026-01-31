<?php

namespace App\Services\Global_Moderations;

class ContactDetector
{
    /**
     * Patterns de détection pour différents types de coordonnées
     */
    private array $patterns;

    /**
     * Mapping des nombres écrits vers chiffres (multilingue)
     */
    private array $writtenNumbers = [
        // Français
        'zéro' => '0', 'zero' => '0', 'un' => '1', 'deux' => '2', 'trois' => '3',
        'quatre' => '4', 'cinq' => '5', 'six' => '6', 'sept' => '7',
        'huit' => '8', 'neuf' => '9', 'dix' => '10',
        // English
        'one' => '1', 'two' => '2', 'three' => '3', 'four' => '4', 'five' => '5',
        'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10',
        // Deutsch
        'null' => '0', 'eins' => '1', 'zwei' => '2', 'drei' => '3', 'vier' => '4',
        'fünf' => '5', 'funf' => '5', 'sechs' => '6', 'sieben' => '7',
        'acht' => '8', 'neun' => '9', 'zehn' => '10',
        // Español
        'cero' => '0', 'uno' => '1', 'dos' => '2', 'tres' => '3', 'cuatro' => '4',
        'cinco' => '5', 'seis' => '6', 'siete' => '7', 'ocho' => '8', 'nueve' => '9',
        // Português
        'um' => '1', 'três' => '3', 'quatro' => '4', 'sete' => '7',
        'oito' => '8', 'nove' => '9',
        // Русский (translitéré)
        'nol' => '0', 'odin' => '1', 'dva' => '2', 'tri' => '3', 'chetyre' => '4',
        'pyat' => '5', 'shest' => '6', 'sem' => '7', 'vosem' => '8', 'devyat' => '9',
    ];

    /**
     * Unicode lookalikes pour la normalisation
     */
    private array $unicodeLookalikes = [
        // Cyrillique qui ressemble au latin
        'а' => 'a', 'е' => 'e', 'о' => 'o', 'р' => 'p', 'с' => 'c', 'х' => 'x',
        'А' => 'A', 'В' => 'B', 'Е' => 'E', 'К' => 'K', 'М' => 'M', 'Н' => 'H',
        'О' => 'O', 'Р' => 'P', 'С' => 'C', 'Т' => 'T', 'Х' => 'X',
        // Caractères spéciaux
        '０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
        '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
        'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
        // Zero-width et espaces invisibles
        "\u{200B}" => '', "\u{200C}" => '', "\u{200D}" => '', "\u{FEFF}" => '',
    ];

    public function __construct()
    {
        $this->patterns = $this->loadPatterns();
    }

    /**
     * Charge les patterns de détection
     */
    private function loadPatterns(): array
    {
        return [
            // ============================================================
            // EMAILS
            // ============================================================
            'email' => [
                'pattern' => '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/i',
                'severity' => 'critical',
                'description' => 'Email standard',
            ],
            'email_disguised' => [
                'pattern' => '/[a-zA-Z0-9._%+-]+\s*[\[\(\{]?\s*(@|at|arobase|arroba|chez|собака|аt)\s*[\]\)\}]?\s*[a-zA-Z0-9.-]+\s*[\[\(\{]?\s*(\.|\s*dot\s*|\s*point\s*|\s*punto\s*|\s*точка\s*)\s*[\]\)\}]?\s*[a-zA-Z]{2,}/iu',
                'severity' => 'critical',
                'description' => 'Email déguisé (multilingue)',
            ],
            'email_spaced' => [
                'pattern' => '/[a-zA-Z0-9]+\s*[\.\s]\s*[a-zA-Z0-9]+\s*@\s*[gG]\s*[mM]\s*[aA]\s*[iI]\s*[lL]\s*[\.\s]\s*[cC]\s*[oO]\s*[mM]/i',
                'severity' => 'critical',
                'description' => 'Gmail espacé',
            ],

            // ============================================================
            // TÉLÉPHONES
            // ============================================================
            'phone_international' => [
                'pattern' => '/(?:\+|00)[1-9]\d{6,14}/',
                'severity' => 'critical',
                'description' => 'Téléphone international',
            ],
            'phone_with_spaces' => [
                'pattern' => '/(?:\+|00)\s*[1-9](?:[\s.\-]*\d){6,14}/',
                'severity' => 'critical',
                'description' => 'Téléphone avec espaces/séparateurs',
            ],
            'phone_local' => [
                'pattern' => '/\b0\s*[1-9](?:[\s.\-]*\d){8,9}\b/',
                'severity' => 'critical',
                'description' => 'Téléphone local (format européen)',
            ],
            'phone_us' => [
                'pattern' => '/\b(?:\+?1[\s.-]?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}\b/',
                'severity' => 'critical',
                'description' => 'Téléphone format US',
            ],
            'phone_digits_only' => [
                'pattern' => '/\b\d{10,15}\b/',
                'severity' => 'warning',
                'description' => 'Suite de chiffres (possible téléphone)',
            ],

            // ============================================================
            // NUMÉROS ÉCRITS EN LETTRES (multilingue)
            // ============================================================
            'phone_written_fr' => [
                'pattern' => '/(?:z[eé]ro|un|deux|trois|quatre|cinq|six|sept|huit|neuf)(?:\s+(?:z[eé]ro|un|deux|trois|quatre|cinq|six|sept|huit|neuf)){4,}/iu',
                'severity' => 'critical',
                'description' => 'Numéro écrit en français',
            ],
            'phone_written_en' => [
                'pattern' => '/\b(?:zero|one|two|three|four|five|six|seven|eight|nine)(?:\s+(?:zero|one|two|three|four|five|six|seven|eight|nine)){4,}\b/i',
                'severity' => 'critical',
                'description' => 'Numéro écrit en anglais',
            ],
            'phone_written_es' => [
                'pattern' => '/\b(?:cero|uno|dos|tres|cuatro|cinco|seis|siete|ocho|nueve)(?:\s+(?:cero|uno|dos|tres|cuatro|cinco|seis|siete|ocho|nueve)){4,}\b/i',
                'severity' => 'critical',
                'description' => 'Numéro écrit en espagnol',
            ],
            'phone_written_de' => [
                'pattern' => '/\b(?:null|eins|zwei|drei|vier|f[uü]nf|sechs|sieben|acht|neun)(?:\s+(?:null|eins|zwei|drei|vier|f[uü]nf|sechs|sieben|acht|neun)){4,}\b/i',
                'severity' => 'critical',
                'description' => 'Numéro écrit en allemand',
            ],

            // ============================================================
            // MESSAGERIES
            // ============================================================
            'messaging_whatsapp' => [
                'pattern' => '/wh[a4]ts?\s*[a4]pp?\s*[:\-]?\s*[\d\s\+\-\.]+/i',
                'severity' => 'critical',
                'description' => 'WhatsApp avec numéro',
            ],
            'messaging_whatsapp_leet' => [
                'pattern' => '/wh[a4@]t[s5][a4@]pp?/i',
                'severity' => 'warning',
                'description' => 'WhatsApp en leet speak',
            ],
            'messaging_telegram' => [
                'pattern' => '/t[e3]l[e3]gr[a4]m\s*[:\-]?\s*[@\w\d\+\-\.]+/i',
                'severity' => 'critical',
                'description' => 'Telegram avec identifiant',
            ],
            'messaging_other' => [
                'pattern' => '/(?:signal|viber|wechat|line|kakao)\s*[:\-]?\s*[@\w\d\s\+\-\.]+/i',
                'severity' => 'critical',
                'description' => 'Autres messageries',
            ],

            // ============================================================
            // RÉSEAUX SOCIAUX
            // ============================================================
            'social_instagram' => [
                'pattern' => '/(?:instagram|insta|ig)\s*[:\-@]?\s*[a-zA-Z0-9._]{3,30}/i',
                'severity' => 'warning',
                'description' => 'Instagram',
            ],
            'social_facebook' => [
                'pattern' => '/(?:facebook|fb|face)\s*[:\-@]?\s*[a-zA-Z0-9._]{3,50}/i',
                'severity' => 'warning',
                'description' => 'Facebook',
            ],
            'social_other' => [
                'pattern' => '/(?:twitter|x\.com|tiktok|snapchat|snap|linkedin)\s*[:\-@]?\s*[a-zA-Z0-9._]{3,30}/i',
                'severity' => 'warning',
                'description' => 'Autres réseaux sociaux',
            ],
            'social_username' => [
                'pattern' => '/@[a-zA-Z0-9._]{3,30}\b/',
                'severity' => 'warning',
                'description' => 'Nom d\'utilisateur avec @',
            ],

            // ============================================================
            // DEMANDES DE CONTACT INDIRECTES (multilingue)
            // ============================================================
            'contact_request_fr' => [
                'pattern' => '/(?:ajout|contact|appel|écri)[ez]?\s*(?:-|\s)*moi\s*(?:sur|via|par|en)\s*(?:insta|snap|whats|telegram|facebook|priv[ée]|dm|mp)/iu',
                'severity' => 'critical',
                'description' => 'Demande de contact FR',
            ],
            'contact_request_en' => [
                'pattern' => '/(?:add|contact|call|text|dm|message|hit)\s*me\s*(?:on|via|at|in)\s*(?:insta|snap|whats|telegram|facebook|private|dm)/i',
                'severity' => 'critical',
                'description' => 'Demande de contact EN',
            ],
            'contact_request_dm' => [
                'pattern' => '/(?:envo[iy]e|send|schick)\s*(?:moi|me|mir)?\s*(?:un|a|eine?)?\s*(?:dm|mp|pm|message\s*priv[ée]?|private\s*message)/iu',
                'severity' => 'warning',
                'description' => 'Demande de DM',
            ],
            'contact_indirect_fr' => [
                'pattern' => '/(?:contact(?:ez)?|joign(?:ez)?|trouv(?:ez)?)\s*(?:-|\s)*moi\s*(?:hors|en\s*dehors|ailleurs|autrement)/iu',
                'severity' => 'warning',
                'description' => 'Contact indirect FR',
            ],
            'contact_indirect_en' => [
                'pattern' => '/(?:contact|reach|find)\s*me\s*(?:outside|elsewhere|off\s*platform|privately)/i',
                'severity' => 'warning',
                'description' => 'Contact indirect EN',
            ],

            // ============================================================
            // URLS
            // ============================================================
            'url_full' => [
                'pattern' => '/https?:\/\/[^\s<>"\'{}|\\^`\[\]]+/i',
                'severity' => 'critical',
                'description' => 'URL complète',
            ],
            'url_short' => [
                'pattern' => '/\b(?:bit\.ly|tinyurl|t\.co|goo\.gl|shorturl|cutt\.ly|rb\.gy)\/[a-zA-Z0-9]+/i',
                'severity' => 'critical',
                'description' => 'URL raccourcie',
            ],
            'domain' => [
                'pattern' => '/\b[a-zA-Z0-9][a-zA-Z0-9-]*\s*[\.\s]\s*(?:com|fr|net|org|io|co|be|ch|ca|app|site|online|me|uk|de|es|pt|ru|cn|in|br|mx|ar)\b/i',
                'severity' => 'warning',
                'description' => 'Nom de domaine',
            ],
            'domain_disguised' => [
                'pattern' => '/[a-zA-Z0-9]+\s*(?:dot|point|punto|punkt|точка)\s*(?:com|fr|net|org|io|co)\b/i',
                'severity' => 'critical',
                'description' => 'Domaine déguisé',
            ],
        ];
    }

    /**
     * Contextes légitimes où des numéros ne sont PAS des coordonnées
     */
    private array $legitimateContexts = [
        // Expressions composées avec numéro/référence de commande + nombre
        '/(?:numéro|numero|n°)\s+de\s+(?:commande|colis|tracking|suivi|client|dossier|facture)\s*(?:est|is|:|\s)\s*[A-Z0-9\-]+/iu',
        '/(?:référence|reference|ref)\s*(?:de\s+)?(?:commande|client|dossier|facture)?\s*(?:est|is|:|\s)\s*[A-Z0-9\-]+/iu',
        '/(?:commande|order|tracking|colis)\s*(?:n°|numéro|numero|#|:)?\s*[A-Z0-9\-]+/iu',
        // Codes simples (code, n°, ref suivi de alphanumérique)
        '/(?:code|n°|ref)\s*(?::|est|is)?\s*[A-Z0-9\-]+/iu',
        // Prix et devises
        '/\b(?:prix|price|coût|cout|cost|tarif|budget)\s*(?::|est|is|de)?\s*\d+/iu',
        '/\b\d+\s*(?:€|euros?|dollars?|\$|£|CHF)\b/iu',
        '/\b(?:€|euros?|dollars?|\$|£|CHF)\s*\d+/iu',
        // Heures et dates
        '/\b\d{1,2}[h:]\d{2}\b/', // Heures (14h30, 14:30)
        '/\b\d{1,2}\/\d{1,2}(?:\/\d{2,4})?\b/', // Dates
        // Adresses postales
        '/\b(?:rue|avenue|boulevard|bd|allée|place|chemin)\s+[^,]+,?\s*\d{5}/iu',
        // Quantités et mesures
        '/\b\d+\s*(?:kg|g|km|m|cm|mm|l|ml|h|min|jours?|semaines?|mois|ans?)\b/iu',
    ];

    /**
     * Analyse le contenu pour détecter les coordonnées
     * Avec normalisation et déduplication intelligente
     */
    public function analyze(string $content): ModerationResult
    {
        $result = new ModerationResult();

        // Vérifier si le contenu est dans un contexte légitime
        $legitimateMatches = $this->findLegitimateContextMatches($content);

        // Normaliser le contenu avant analyse
        $normalizedContent = $this->normalizeContent($content);

        // Convertir les nombres écrits en chiffres
        $convertedContent = $this->convertWrittenNumbers($normalizedContent);

        // Stocker les valeurs déjà détectées (pour éviter doublons)
        $detectedValues = [];
        $detectedByCategory = ['email' => false, 'phone' => false, 'messaging' => false, 'social' => false, 'url' => false];

        // Analyser uniquement le contenu normalisé (pas besoin de 3 passes)
        foreach ($this->patterns as $type => $config) {
            $matches = $this->findMatches($convertedContent, $config['pattern']);

            foreach ($matches as $match) {
                // Normaliser la valeur pour détecter les doublons
                $normalizedValue = $this->normalizeMatchValue($match);

                // Ignorer si c'est dans un contexte légitime
                if ($this->isInLegitimateContext($match, $content, $legitimateMatches)) {
                    continue;
                }

                // Ignorer les doublons (même valeur, pattern différent)
                if (isset($detectedValues[$normalizedValue])) {
                    continue;
                }

                // Déterminer la catégorie du contact
                $category = $this->getCategoryFromType($type);

                // Limiter à UNE détection par catégorie majeure
                // (évite que 5 patterns email donnent 5x le score)
                if ($detectedByCategory[$category]) {
                    continue;
                }

                $detectedValues[$normalizedValue] = true;
                $detectedByCategory[$category] = true;

                $result->addDetectedContact(
                    $type,
                    $match,
                    $config['severity']
                );
            }
        }

        // Détecter les patterns mixtes seulement si pas déjà détecté comme phone
        if (!$detectedByCategory['phone']) {
            $this->detectMixedPatterns($content, $result, $detectedValues);
        }

        return $result;
    }

    /**
     * Trouve les contextes légitimes dans le contenu
     */
    private function findLegitimateContextMatches(string $content): array
    {
        $matches = [];
        foreach ($this->legitimateContexts as $pattern) {
            if (preg_match_all($pattern, $content, $m)) {
                foreach ($m[0] as $match) {
                    $matches[] = mb_strtolower($match);
                }
            }
        }
        return $matches;
    }

    /**
     * Vérifie si une valeur est dans un contexte légitime
     */
    private function isInLegitimateContext(string $value, string $originalContent, array $legitimateMatches): bool
    {
        $valueLower = mb_strtolower($value);

        // Extraire les chiffres de la valeur pour comparaison
        $valueDigits = preg_replace('/\D/', '', $value);

        foreach ($legitimateMatches as $legitMatch) {
            // Vérification directe
            if (str_contains($legitMatch, $valueLower) || str_contains($valueLower, $legitMatch)) {
                return true;
            }

            // Vérification par les chiffres extraits (cas numéro de commande)
            if (!empty($valueDigits) && strlen($valueDigits) >= 5) {
                $legitDigits = preg_replace('/\D/', '', $legitMatch);
                if (!empty($legitDigits) && str_contains($legitDigits, $valueDigits)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Normalise une valeur détectée pour comparaison
     */
    private function normalizeMatchValue(string $value): string
    {
        // Supprimer tout sauf chiffres et lettres
        return preg_replace('/[^a-z0-9@.]/i', '', mb_strtolower($value));
    }

    /**
     * Détermine la catégorie principale d'un type de contact
     */
    private function getCategoryFromType(string $type): string
    {
        if (str_starts_with($type, 'email')) return 'email';
        if (str_starts_with($type, 'phone')) return 'phone';
        if (str_starts_with($type, 'messaging')) return 'messaging';
        if (str_starts_with($type, 'social')) return 'social';
        if (str_starts_with($type, 'url') || str_starts_with($type, 'domain')) return 'url';
        if (str_starts_with($type, 'contact_request') || str_starts_with($type, 'contact_indirect')) return 'messaging';
        return 'other';
    }

    /**
     * Normalise le contenu (supprime les caractères Unicode trompeurs)
     */
    private function normalizeContent(string $content): string
    {
        // Remplacer les caractères Unicode lookalikes
        $normalized = strtr($content, $this->unicodeLookalikes);

        // Supprimer les espaces multiples et invisibles
        $normalized = preg_replace('/[\s\x{00A0}\x{2000}-\x{200F}\x{2028}\x{2029}]+/u', ' ', $normalized);

        // Supprimer les caractères de contrôle
        $normalized = preg_replace('/[\x00-\x1F\x7F]/u', '', $normalized);

        return trim($normalized);
    }

    /**
     * Convertit les nombres écrits en lettres en chiffres
     */
    private function convertWrittenNumbers(string $content): string
    {
        $words = preg_split('/\s+/', mb_strtolower($content));
        $result = [];

        foreach ($words as $word) {
            $cleanWord = preg_replace('/[^a-zàâäéèêëïîôùûüÿçœæ]/u', '', $word);
            if (isset($this->writtenNumbers[$cleanWord])) {
                $result[] = $this->writtenNumbers[$cleanWord];
            } else {
                $result[] = $word;
            }
        }

        return implode(' ', $result);
    }

    /**
     * Détecte les patterns mixtes (chiffres + lettres)
     * Ex: "06 douze 34 cinquante-six 78"
     */
    private function detectMixedPatterns(string $content, ModerationResult $result, array &$detected): void
    {
        $lower = mb_strtolower($content);

        // Pattern pour détecter un mélange de chiffres et de nombres écrits
        $numberWords = implode('|', array_keys($this->writtenNumbers));
        $mixedPattern = '/(?:\d+\s+(?:' . $numberWords . ')|(?:' . $numberWords . ')\s+\d+)(?:\s+(?:\d+|' . $numberWords . ')){2,}/iu';

        if (preg_match_all($mixedPattern, $lower, $matches)) {
            foreach ($matches[0] as $match) {
                // Convertir pour vérifier si c'est un numéro de téléphone
                $converted = $this->convertWrittenNumbers($match);
                $digits = preg_replace('/\D/', '', $converted);

                // Si on a au moins 8 chiffres, c'est probablement un téléphone
                if (strlen($digits) >= 8) {
                    $matchKey = 'phone_mixed:' . $match;
                    if (!isset($detected[$matchKey])) {
                        $detected[$matchKey] = true;
                        $result->addDetectedContact(
                            'phone_mixed',
                            $match . ' → ' . $digits,
                            'critical'
                        );
                    }
                }
            }
        }
    }

    /**
     * Détecte et retourne les coordonnées trouvées
     */
    public function detect(string $content): array
    {
        $detected = [];
        $normalizedContent = $this->normalizeContent($content);
        $convertedContent = $this->convertWrittenNumbers($normalizedContent);

        $contentsToAnalyze = array_unique([$content, $normalizedContent, $convertedContent]);

        foreach ($contentsToAnalyze as $contentVersion) {
            foreach ($this->patterns as $type => $config) {
                $matches = $this->findMatches($contentVersion, $config['pattern']);

                foreach ($matches as $match) {
                    $detected[] = [
                        'type' => $type,
                        'value' => $match,
                        'severity' => $config['severity'],
                        'description' => $config['description'],
                    ];
                }
            }
        }

        return $detected;
    }

    /**
     * Trouve toutes les correspondances d'un pattern
     */
    private function findMatches(string $content, string $pattern): array
    {
        try {
            if (preg_match_all($pattern, $content, $matches)) {
                return array_unique($matches[0]);
            }
        } catch (\Exception $e) {
            // Pattern invalide, ignorer
        }

        return [];
    }

    /**
     * Vérifie si le contenu contient des coordonnées
     */
    public function hasContactInfo(string $content): bool
    {
        $normalizedContent = $this->normalizeContent($content);

        foreach ($this->patterns as $config) {
            if (preg_match($config['pattern'], $content) || preg_match($config['pattern'], $normalizedContent)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Vérifie si le contenu contient des coordonnées critiques
     */
    public function hasCriticalContact(string $content): bool
    {
        $normalizedContent = $this->normalizeContent($content);

        foreach ($this->patterns as $config) {
            if ($config['severity'] === 'critical') {
                if (preg_match($config['pattern'], $content) || preg_match($config['pattern'], $normalizedContent)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Masque les coordonnées dans le contenu (pour affichage)
     */
    public function redact(string $content): string
    {
        foreach ($this->patterns as $config) {
            $content = preg_replace_callback(
                $config['pattern'],
                fn($m) => '[' . str_repeat('•', min(mb_strlen($m[0]), 8)) . ']',
                $content
            );
        }

        return $content;
    }

    /**
     * Vérifie uniquement les patterns critiques (plus rapide)
     */
    public function quickCheck(string $content): bool
    {
        $normalizedContent = $this->normalizeContent($content);
        $criticalPatterns = array_filter($this->patterns, fn($p) => $p['severity'] === 'critical');

        foreach ($criticalPatterns as $config) {
            if (preg_match($config['pattern'], $content) || preg_match($config['pattern'], $normalizedContent)) {
                return true;
            }
        }

        return false;
    }
}
