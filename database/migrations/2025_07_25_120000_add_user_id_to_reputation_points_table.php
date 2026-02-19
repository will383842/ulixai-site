<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cette migration ajoute la colonne user_id manquante à la table reputation_points.
     * Le modèle ReputationPoint définit user_id dans $fillable mais la colonne
     * n'existait pas dans la migration originale.
     */
    public function up(): void
    {
        Schema::table('reputation_points', function (Blueprint $table) {
            // Vérifier si la colonne n'existe pas déjà
            if (!Schema::hasColumn('reputation_points', 'user_id')) {
                $table->foreignId('user_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reputation_points', function (Blueprint $table) {
            if (Schema::hasColumn('reputation_points', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
