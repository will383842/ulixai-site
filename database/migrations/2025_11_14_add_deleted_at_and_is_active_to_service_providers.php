<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter le soft delete et le statut is_active à service_providers
 * 
 * ÉTAPES :
 * 1. Créer le fichier de migration :
 *    php artisan make:migration add_deleted_at_and_is_active_to_service_providers_table
 * 
 * 2. Remplacer le contenu par celui-ci
 * 
 * 3. Exécuter la migration :
 *    php artisan migrate
 * 
 * 4. Vérifier dans phpMyAdmin que les colonnes existent bien
 * 
 * Nom du fichier : 2025_11_14_XXXXXX_add_deleted_at_and_is_active_to_service_providers_table.php
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            // Ajouter la colonne deleted_at pour le soft delete
            if (!Schema::hasColumn('service_providers', 'deleted_at')) {
                $table->softDeletes();
            }
            
            // Ajouter la colonne is_active pour désactiver le provider
            if (!Schema::hasColumn('service_providers', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_providers', function (Blueprint $table) {
            // Supprimer les colonnes en cas de rollback
            if (Schema::hasColumn('service_providers', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
            
            if (Schema::hasColumn('service_providers', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
