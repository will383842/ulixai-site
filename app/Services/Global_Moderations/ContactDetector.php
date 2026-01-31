<?php

namespace App\Services\Global_Moderations;

class ContactDetector
{
    /**
     * Patterns de détection pour différents types de coordonnées
     * Chaque pattern a une sévérité et un score associé
     */
    private array $patterns;

    public function __construct()
    {
        $this->patterns = $this->loadPatterns();
    }

    /**
     * Charge les patterns depuis la config ou utilise les défauts
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
                'pattern' => '/[a-zA-Z0-9._%+-]+\s*[\[\(\{]?\s*(@|at|arobase|arroba|chez|собака|アット)\s*[\]\)\}]?\s*[a-zA-Z0-9.-]+\s*[\[\(\{]?\s*(\.|\s*dot\s*|\s*point\s*|\s*punto\s*|\s*точка\s*)\s*[\]\)\}]?\s*[a-zA-Z]{2,}/iu',
                'severity' => 'critical',
                'description' => 'Email déguisé (multilingue)',
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
                'pattern' => '/whatsapp\s*[:\-]?\s*[\d\s\+\-\.]+/i',
                'severity' => 'critical',
                'description' => 'WhatsApp avec numéro',
            ],
            'messaging_telegram' => [
                'pattern' => '/telegram\s*[:\-]?\s*[@\w\d\+\-\.]+/i',
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
                'pattern' => '/(?:instagram|insta)\s*[:\-@]?\s*[a-zA-Z0-9._]{3,30}/i',
                'severity' => 'warning',
                'description' => 'Instagram',
            ],
            'social_facebook' => [
                'pattern' => '/(?:facebook|fb)\s*[:\-@]?\s*[a-zA-Z0-9._]{3,50}/i',
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
            // DEMANDES DE CONTACT (multilingue)
            // ============================================================
            'contact_request_fr' => [
                'pattern' => '/(?:ajout|contact|appel|écri)[ez]?\s*(?:-|\s)*moi\s*(?:sur|via|par)\s*(?:insta|snap|whats|telegram|facebook)/iu',
                'severity' => 'critical',
                'description' => 'Demande de contact FR',
            ],
            'contact_request_en' => [
                'pattern' => '/(?:add|contact|call|text|dm|message)\s*me\s*(?:on|via|at)\s*(?:insta|snap|whats|telegram|facebook)/i',
                'severity' => 'critical',
                'description' => 'Demande de contact EN',
            ],
            'contact_request_es' => [
                'pattern' => '/(?:agrega|contacta|llama|escribe)[me]?\s*(?:en|por|via)\s*(?:insta|snap|whats|telegram|facebook)/i',
                'severity' => 'critical',
                'description' => 'Demande de contact ES',
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
                'pattern' => '/\b[a-zA-Z0-9][a-zA-Z0-9-]*\.(com|fr|net|org|io|co|be|ch|ca|app|site|online|me|uk|de|es|pt|ru|cn|in|br|mx|ar)\b/i',
                'severity' => 'critical',
                'description' => 'Nom de domaine',
            ],
        ];
    }

    /**
     * Analyse le contenu pour détecter les coordonnées
     */
    public function analyze(string $content): ModerationResult
    {
        $result = new ModerationResult();

        foreach ($this->patterns as $type => $config) {
            $matches = $this->findMatches($content, $config['pattern']);

            foreach ($matches as $match) {
                $result->addDetectedContact(
                    $type,
                    $match,
                    $config['severity']
                );
            }
        }

        return $result;
    }

    /**
     * Détecte et retourne les coordonnées trouvées
     */
    public function detect(string $content): array
    {
        $detected = [];

        foreach ($this->patterns as $type => $config) {
            $matches = $this->findMatches($content, $config['pattern']);

            foreach ($matches as $match) {
                $detected[] = [
                    'type' => $type,
                    'value' => $match,
                    'severity' => $config['severity'],
                    'description' => $config['description'],
                ];
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
        foreach ($this->patterns as $config) {
            if (preg_match($config['pattern'], $content)) {
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
        foreach ($this->patterns as $config) {
            if ($config['severity'] === 'critical' && preg_match($config['pattern'], $content)) {
                return true;
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
        $criticalPatterns = array_filter($this->patterns, fn($p) => $p['severity'] === 'critical');

        foreach ($criticalPatterns as $config) {
            if (preg_match($config['pattern'], $content)) {
                return true;
            }
        }

        return false;
    }
}
