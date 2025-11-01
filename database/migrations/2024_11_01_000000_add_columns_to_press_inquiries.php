<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('press_inquiries', function (Blueprint $table) {
            // Ajouter la colonne country (pays du journaliste)
            $table->string('country', 255)->nullable()->after('email');
            
            // Ajouter la colonne country_code (indicatif téléphonique)
            $table->string('country_code', 10)->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('press_inquiries', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('country_code');
        });
    }
};