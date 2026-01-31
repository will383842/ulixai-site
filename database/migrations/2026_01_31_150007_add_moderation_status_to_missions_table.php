<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            // Statut de modération
            // approved: contenu approuvé et visible
            // pending_review: en attente de vérification admin
            // blocked: bloqué automatiquement
            // rejected: rejeté manuellement par admin
            $table->enum('moderation_status', ['approved', 'pending_review', 'blocked', 'rejected'])
                ->default('approved')
                ->after('status');

            // Score de risque de modération
            $table->unsignedTinyInteger('moderation_score')->default(0)->after('moderation_status');

            // Notes de modération (pour admin)
            $table->text('moderation_notes')->nullable()->after('moderation_score');

            // Index
            $table->index('moderation_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            $table->dropIndex(['moderation_status']);
            $table->dropColumn(['moderation_status', 'moderation_score', 'moderation_notes']);
        });
    }
};
