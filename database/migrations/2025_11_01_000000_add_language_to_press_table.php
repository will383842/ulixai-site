<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('press', function (Blueprint $table) {
            // Ajoute la colonne après l'id, taille courte, indexée
            $table->string('language', 5)->default('en')->after('id')->index();
        });

        // Backfill pour les lignes existantes (au cas où default ne s’applique pas)
        DB::table('press')->whereNull('language')->update(['language' => 'en']);
    }

    public function down(): void
    {
        Schema::table('press', function (Blueprint $table) {
            $table->dropIndex(['language']);
            $table->dropColumn('language');
        });
    }
};
