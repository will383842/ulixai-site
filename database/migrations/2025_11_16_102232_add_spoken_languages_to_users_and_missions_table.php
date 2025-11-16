<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * ✅ MIGRATION ULTRA-SÉCURISÉE
     * - Vérifie que les tables existent
     * - Vérifie que les colonnes n'existent pas déjà
     * - Ajoute uniquement ce qui manque
     * - Ne touche PAS aux colonnes existantes
     */
    public function up()
    {
        // ═══════════════════════════════════════════════════════
        // 📊 TABLE USERS
        // ═══════════════════════════════════════════════════════
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // ✅ AJOUTER spoken_languages SEULEMENT si elle n'existe pas
                if (!Schema::hasColumn('users', 'spoken_languages')) {
                    $table->json('spoken_languages')
                          ->nullable()
                          ->after('preferred_language')
                          ->comment('All languages the user speaks - JSON array');
                    
                    Log::info('✅ [MIGRATION] Added spoken_languages to users table');
                } else {
                    Log::info('⚠️ [MIGRATION] spoken_languages already exists in users table - skipping');
                }
            });
        } else {
            Log::warning('⚠️ [MIGRATION] Table users does not exist - skipping');
        }
        
        // ═══════════════════════════════════════════════════════
        // 📊 TABLE MISSIONS
        // ═══════════════════════════════════════════════════════
        if (Schema::hasTable('missions')) {
            Schema::table('missions', function (Blueprint $table) {
                // ✅ AJOUTER spoken_languages SEULEMENT si elle n'existe pas
                if (!Schema::hasColumn('missions', 'spoken_languages')) {
                    $table->json('spoken_languages')
                          ->nullable()
                          ->after('language')
                          ->comment('All languages for this mission - JSON array');
                    
                    Log::info('✅ [MIGRATION] Added spoken_languages to missions table');
                } else {
                    Log::info('⚠️ [MIGRATION] spoken_languages already exists in missions table - skipping');
                }
            });
        } else {
            Log::warning('⚠️ [MIGRATION] Table missions does not exist - skipping');
        }
    }

    /**
     * ✅ ROLLBACK SÉCURISÉ
     * - Supprime uniquement les colonnes si elles existent
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'spoken_languages')) {
                    $table->dropColumn('spoken_languages');
                    Log::info('✅ [ROLLBACK] Removed spoken_languages from users table');
                }
            });
        }
        
        if (Schema::hasTable('missions')) {
            Schema::table('missions', function (Blueprint $table) {
                if (Schema::hasColumn('missions', 'spoken_languages')) {
                    $table->dropColumn('spoken_languages');
                    Log::info('✅ [ROLLBACK] Removed spoken_languages from missions table');
                }
            });
        }
    }
};