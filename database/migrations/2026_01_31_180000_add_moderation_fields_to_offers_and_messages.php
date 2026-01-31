<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ajoute les champs de modération aux tables mission_offers et mission_messages
     */
    public function up(): void
    {
        // Ajouter les champs à mission_offers
        Schema::table('mission_offers', function (Blueprint $table) {
            $table->string('moderation_status', 20)->default('approved')->after('status');
            $table->integer('moderation_score')->default(0)->after('moderation_status');
            $table->json('moderation_notes')->nullable()->after('moderation_score');
        });

        // Ajouter les champs à mission_messages (si la table existe)
        if (Schema::hasTable('mission_messages')) {
            Schema::table('mission_messages', function (Blueprint $table) {
                $table->string('moderation_status', 20)->default('approved')->after('message');
                $table->integer('moderation_score')->default(0)->after('moderation_status');
                $table->json('moderation_notes')->nullable()->after('moderation_score');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mission_offers', function (Blueprint $table) {
            $table->dropColumn(['moderation_status', 'moderation_score', 'moderation_notes']);
        });

        if (Schema::hasTable('mission_messages')) {
            Schema::table('mission_messages', function (Blueprint $table) {
                $table->dropColumn(['moderation_status', 'moderation_score', 'moderation_notes']);
            });
        }
    }
};
