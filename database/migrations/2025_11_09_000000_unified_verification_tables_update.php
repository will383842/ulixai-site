<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Migration fusionnée pour gérer proprement les tables de vérification
 * Remplace les 3 migrations redondantes :
 * - 2025_11_09_143949_fix_verification_tables.php
 * - 2025_11_09_add_session_id_to_verification_tables.php  
 * - migration create_press_inquiries_table (mal nommé)
 * 
 * Cette version est optimisée et évite toute redondance
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ==================================================
        // 1. PROVIDER DOCUMENT VERIFICATIONS
        // ==================================================
        
        if (Schema::hasTable('provider_document_verifications')) {
            Schema::table('provider_document_verifications', function (Blueprint $table) {
                // Ajouter session_id si elle n'existe pas
                if (!Schema::hasColumn('provider_document_verifications', 'session_id')) {
                    $table->string('session_id', 255)
                          ->nullable()
                          ->after('id')
                          ->index()
                          ->comment('Session ID for anonymous verification before user registration');
                }
                
                // Rendre user_id nullable s'il ne l'est pas déjà
                // Nécessaire pour permettre la vérification avant inscription
                $columns = DB::select("SHOW COLUMNS FROM provider_document_verifications WHERE Field = 'user_id'");
                if (!empty($columns) && $columns[0]->Null === 'NO') {
                    DB::statement('ALTER TABLE `provider_document_verifications` MODIFY `user_id` BIGINT UNSIGNED NULL');
                }
            });
        }
        
        // ==================================================
        // 2. PROVIDER PHOTO VERIFICATIONS
        // ==================================================
        
        if (!Schema::hasTable('provider_photo_verifications')) {
            // Créer la table si elle n'existe pas
            Schema::create('provider_photo_verifications', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')
                      ->nullable()
                      ->constrained()
                      ->onDelete('cascade')
                      ->comment('User ID, nullable for pre-registration verification');
                      
                $table->string('session_id', 255)
                      ->nullable()
                      ->index()
                      ->comment('Session ID for anonymous verification');
                      
                $table->string('image_path')
                      ->comment('Path to the uploaded photo');
                      
                $table->enum('status', ['pending', 'processing', 'verified', 'rejected', 'error'])
                      ->default('pending')
                      ->comment('Current verification status');
                      
                $table->integer('confidence_score')
                      ->nullable()
                      ->comment('AI confidence score (0-100)');
                      
                $table->text('rejection_reason')
                      ->nullable()
                      ->comment('Reason if photo is rejected');
                      
                $table->json('google_vision_response')
                      ->nullable()
                      ->comment('Complete Google Vision API response');
                      
                $table->timestamp('verified_at')
                      ->nullable()
                      ->comment('Timestamp when verification completed');
                      
                $table->timestamps();
                
                // Indexes pour performance
                $table->index(['user_id', 'status'], 'idx_user_status');
                $table->index('status', 'idx_status');
                $table->index('created_at', 'idx_created_at');
            });
            
        } else {
            // Si la table existe, ajouter session_id si manquant
            Schema::table('provider_photo_verifications', function (Blueprint $table) {
                if (!Schema::hasColumn('provider_photo_verifications', 'session_id')) {
                    $table->string('session_id', 255)
                          ->nullable()
                          ->after('user_id')
                          ->index()
                          ->comment('Session ID for anonymous verification');
                }
                
                // Rendre user_id nullable si nécessaire
                $columns = DB::select("SHOW COLUMNS FROM provider_photo_verifications WHERE Field = 'user_id'");
                if (!empty($columns) && $columns[0]->Null === 'NO') {
                    DB::statement('ALTER TABLE `provider_photo_verifications` MODIFY `user_id` BIGINT UNSIGNED NULL');
                }
            });
        }
        
        // ==================================================
        // 3. OPTIMISATIONS ET NETTOYAGE
        // ==================================================
        
        // S'assurer que les index existent pour les performances
        $this->ensureIndexExists('provider_document_verifications', 'session_id', 'idx_session_doc');
        $this->ensureIndexExists('provider_photo_verifications', 'session_id', 'idx_session_photo');
        
        // Log de succès
        DB::table('migrations')->whereIn('migration', [
            '2025_11_09_add_session_id_to_verification_tables',
            'migration create_press_inquiries_table'
        ])->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retirer session_id de provider_document_verifications
        if (Schema::hasTable('provider_document_verifications')) {
            Schema::table('provider_document_verifications', function (Blueprint $table) {
                if (Schema::hasColumn('provider_document_verifications', 'session_id')) {
                    $table->dropIndex(['session_id']);
                    $table->dropColumn('session_id');
                }
                
                // Restaurer user_id comme NOT NULL si nécessaire
                // Note: Ceci pourrait échouer si des enregistrements ont user_id NULL
                try {
                    DB::statement('ALTER TABLE `provider_document_verifications` MODIFY `user_id` BIGINT UNSIGNED NOT NULL');
                } catch (\Exception $e) {
                    // Ignorer si des enregistrements ont user_id NULL
                }
            });
        }
        
        // Gérer provider_photo_verifications
        if (Schema::hasTable('provider_photo_verifications')) {
            // Si la table a été créée par cette migration, la supprimer
            // Sinon, juste retirer session_id
            
            $wasCreatedByUs = !DB::table('migrations')
                ->where('migration', 'LIKE', '%create_provider_photo_verifications%')
                ->exists();
            
            if ($wasCreatedByUs) {
                Schema::dropIfExists('provider_photo_verifications');
            } else {
                Schema::table('provider_photo_verifications', function (Blueprint $table) {
                    if (Schema::hasColumn('provider_photo_verifications', 'session_id')) {
                        $table->dropIndex(['session_id']);
                        $table->dropColumn('session_id');
                    }
                    
                    try {
                        DB::statement('ALTER TABLE `provider_photo_verifications` MODIFY `user_id` BIGINT UNSIGNED NOT NULL');
                    } catch (\Exception $e) {
                        // Ignorer si des enregistrements ont user_id NULL
                    }
                });
            }
        }
    }
    
    /**
     * Helper pour s'assurer qu'un index existe
     */
    private function ensureIndexExists(string $table, string $column, string $indexName): void
    {
        $indexExists = collect(DB::select("SHOW INDEX FROM {$table}"))
            ->pluck('Column_name')
            ->contains($column);
            
        if (!$indexExists) {
            Schema::table($table, function (Blueprint $table) use ($column, $indexName) {
                $table->index($column, $indexName);
            });
        }
    }
};
