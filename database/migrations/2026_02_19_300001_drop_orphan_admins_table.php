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
        Schema::dropIfExists('admins');
    }

    public function down(): void
    {
        // No rollback — table was orphaned
    }
};
