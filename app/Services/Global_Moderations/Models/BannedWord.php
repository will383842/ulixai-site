<?php

namespace App\Services\Global_Moderations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BannedWord extends Model
{
    protected $fillable = [
        'word',
        'normalized_word',
        'severity',
        'category',
        'language',
        'is_regex',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'is_regex' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Catégories disponibles
     */
    public const CATEGORIES = [
        'sexual' => 'Contenu sexuel',
        'political' => 'Contenu politique',
        'religious' => 'Contenu religieux',
        'hate_speech' => 'Discours haineux',
        'illegal' => 'Contenu illégal',
        'spam' => 'Spam',
        'contact_info' => 'Coordonnées',
        'other' => 'Autre',
    ];

    /**
     * Niveaux de sévérité
     */
    public const SEVERITIES = [
        'critical' => 'Critique - Blocage automatique',
        'warning' => 'Avertissement - Review admin',
        'info' => 'Info - Surveillance',
    ];

    /**
     * Boot du modèle
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Normaliser automatiquement le mot
            $model->normalized_word = self::normalizeWord($model->word);
        });
    }

    /**
     * Normalise un mot pour la comparaison
     */
    public static function normalizeWord(string $word): string
    {
        // Convertir en minuscules
        $normalized = mb_strtolower($word, 'UTF-8');

        // Supprimer les accents
        $normalized = self::removeAccents($normalized);

        // Supprimer les espaces multiples
        $normalized = preg_replace('/\s+/', ' ', $normalized);

        return trim($normalized);
    }

    /**
     * Supprime les accents d'une chaîne
     */
    private static function removeAccents(string $string): string
    {
        $accents = [
            'à' => 'a', 'â' => 'a', 'ä' => 'a', 'á' => 'a', 'ã' => 'a',
            'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'é' => 'e',
            'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'í' => 'i',
            'ò' => 'o', 'ô' => 'o', 'ö' => 'o', 'ó' => 'o', 'õ' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
            'ÿ' => 'y', 'ý' => 'y',
            'ñ' => 'n',
            'ç' => 'c',
        ];

        return strtr($string, $accents);
    }

    /**
     * Scope pour les mots actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour une sévérité spécifique
     */
    public function scopeSeverity($query, string $severity)
    {
        return $query->where('severity', $severity);
    }

    /**
     * Scope pour une catégorie spécifique
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope pour une langue spécifique (inclut mots universels)
     */
    public function scopeLanguage($query, string $language)
    {
        return $query->where(function ($q) use ($language) {
            $q->where('language', $language)
                ->orWhere('language', '*'); // Mots universels
        });
    }

    /**
     * Scope pour TOUTES les langues (utilisé pour la modération de contenu)
     * Les utilisateurs peuvent publier dans n'importe quelle langue,
     * donc on vérifie contre tous les mots interdits de toutes les langues.
     */
    public function scopeAllLanguages($query)
    {
        // Retourne tous les mots actifs, toutes langues confondues
        return $query->where('is_active', true);
    }

    /**
     * Récupère tous les mots interdits pour la modération (cache recommandé)
     */
    public static function getAllForModeration()
    {
        return static::active()->get()->groupBy('severity');
    }

    /**
     * Vérifie si ce mot matche le contenu
     */
    public function matches(string $normalizedContent): bool
    {
        if ($this->is_regex) {
            return (bool) preg_match('/' . $this->word . '/iu', $normalizedContent);
        }

        return str_contains($normalizedContent, $this->normalized_word);
    }

    /**
     * Label de la sévérité
     */
    public function getSeverityLabelAttribute(): string
    {
        return self::SEVERITIES[$this->severity] ?? $this->severity;
    }

    /**
     * Label de la catégorie
     */
    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
