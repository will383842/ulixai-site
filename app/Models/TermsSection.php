<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsSection extends Model
{
    // Available types for terms sections
    public const TYPE_GENERAL = 'general';
    public const TYPE_CLIENT = 'client';
    public const TYPE_PROVIDER = 'provider';
    public const TYPE_AFFILIATE = 'affiliate';

    protected $fillable = [
        'number', 'title', 'slug', 'body', 'type', 'is_active', 'version', 'effective_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'effective_date' => 'date',
    ];

    /**
     * Scope to filter by type
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get all available types with labels
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_GENERAL => 'Conditions Générales d\'Utilisation',
            self::TYPE_CLIENT => 'Conditions Générales Clients',
            self::TYPE_PROVIDER => 'Conditions Générales Prestataires',
            self::TYPE_AFFILIATE => 'Conditions Générales d\'Affiliation',
        ];
    }
}
