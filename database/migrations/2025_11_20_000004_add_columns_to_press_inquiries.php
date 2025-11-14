<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('press', function (Blueprint $table) {
            // Ajouter seulement les colonnes qui manquent vraiment
            
            // Colonnes internationales
            if (!Schema::hasColumn('press', 'country')) {
                $table->string('country', 255)->nullable()->after('email');
            }
            
            if (!Schema::hasColumn('press', 'country_code')) {
                $table->string('country_code', 10)->nullable()->after('phone');
            }
            
            // Statut de la demande
            if (!Schema::hasColumn('press', 'status')) {
                $table->enum('status', ['new', 'in_progress', 'responded', 'closed'])->default('new')->after('message');
            }
            
            if (!Schema::hasColumn('press', 'responded_at')) {
                $table->timestamp('responded_at')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('press', function (Blueprint $table) {
            $table->dropColumn(['country', 'country_code', 'status', 'responded_at']);
        });
    }
};
