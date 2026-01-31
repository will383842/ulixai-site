<?php

namespace App\Services\Global_Moderations\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\Global_Moderations\ModerationResult analyze(string $content, ?\App\Models\User $user = null)
 * @method static array moderate(\Illuminate\Database\Eloquent\Model $content, string $textToAnalyze, \App\Models\User $author, string $contentType = 'mission')
 * @method static array quickCheck(string $content)
 * @method static array canUserPublish(\App\Models\User $user, string $type = 'mission')
 * @method static void adminReview(\Illuminate\Database\Eloquent\Model $content, string $decision, ?string $reason = null, ?int $adminId = null)
 * @method static array getStats(?int $days = 30)
 *
 * @see \App\Services\Global_Moderations\ModerationService
 */
class Moderation extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'moderation';
    }
}
