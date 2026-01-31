<?php

namespace App\Services\Global_Moderations\Traits;

use App\Services\Global_Moderations\Models\ModerationFlag;
use App\Services\Global_Moderations\Models\ContentReport;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait pour les modèles qui peuvent être modérés
 * Utilisé par: Mission, MissionOffer, Message
 */
trait HasModerationFlags
{
    /**
     * Relation avec les flags de modération
     */
    public function moderationFlags(): MorphMany
    {
        return $this->morphMany(ModerationFlag::class, 'flaggable');
    }

    /**
     * Relation avec les signalements
     */
    public function reports(): MorphMany
    {
        return $this->morphMany(ContentReport::class, 'reportable');
    }

    /**
     * Récupère le dernier flag de modération
     */
    public function getLatestModerationFlag(): ?ModerationFlag
    {
        return $this->moderationFlags()->latest()->first();
    }

    /**
     * Vérifie si le contenu a des flags en attente
     */
    public function hasPendingModerationFlags(): bool
    {
        return $this->moderationFlags()->where('status', 'pending')->exists();
    }

    /**
     * Vérifie si le contenu a été signalé
     */
    public function hasBeenReported(): bool
    {
        return $this->reports()->exists();
    }

    /**
     * Compte le nombre de signalements non résolus
     */
    public function unresolvedReportsCount(): int
    {
        return $this->reports()->whereIn('status', ['pending', 'investigating'])->count();
    }
}
