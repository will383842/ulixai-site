<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration pour ajouter le soft delete à la table users
 * 
 * ÉTAPES :
 * 1. Créer le fichier de migration :
 *    php artisan make:migration add_deleted_at_to_users_table
 * 
 * 2. Remplacer le contenu par celui-ci
 * 
 * 3. Exécuter la migration :
 *    php artisan migrate
 * 
 * 4. Vérifier dans phpMyAdmin que la colonne deleted_at existe bien
 * 
 * Nom du fichier : 2025_11_14_XXXXXX_add_deleted_at_to_users_table.php
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne deleted_at pour le soft delete
            // Elle sera placée après updated_at
            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la colonne deleted_at en cas de rollback
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
