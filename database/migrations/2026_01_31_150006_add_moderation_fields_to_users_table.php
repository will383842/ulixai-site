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
        Schema::table('users', function (Blueprint $table) {
            // Compteur de strikes actifs
            $table->unsignedTinyInteger('strike_count')->default(0)->after('status');

            // Date du dernier strike
            $table->timestamp('last_strike_at')->nullable()->after('strike_count');

            // Raison du bannissement (si banni)
            $table->text('ban_reason')->nullable()->after('last_strike_at');

            // Date de bannissement
            $table->timestamp('banned_at')->nullable()->after('ban_reason');

            // Peut faire appel ?
            $table->boolean('can_appeal')->default(true)->after('banned_at');

            // Date limite pour faire appel
            $table->timestamp('appeal_until')->nullable()->after('can_appeal');

            // Score de confiance (0-100)
            $table->unsignedTinyInteger('trust_score')->default(100)->after('appeal_until');

            // Contenu nécessite review automatique?
            $table->boolean('requires_review')->default(false)->after('trust_score');

            // Index pour les requêtes de modération
            $table->index('strike_count');
            $table->index('trust_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['strike_count']);
            $table->dropIndex(['trust_score']);

            $table->dropColumn([
                'strike_count',
                'last_strike_at',
                'ban_reason',
                'banned_at',
                'can_appeal',
                'appeal_until',
                'trust_score',
                'requires_review'
            ]);
        });
    }
};
