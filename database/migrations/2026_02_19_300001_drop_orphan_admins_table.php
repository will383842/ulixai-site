<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fix #43: Table admins créée mais jamais utilisée.
     * Le modèle Admin utilise la table 'users' (pas 'admins').
     */
    public function up(): void
    {
        // Drop foreign key referencing admins before dropping the table
        if (Schema::hasTable('press_assets')) {
            Schema::table('press_assets', function ($table) {
                $table->dropForeign(['created_by']);
            });
        }
        Schema::dropIfExists('admins');
    }

    public function down(): void
    {
        // No rollback — table was orphaned
    }
};
