<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        echo "\n🔍 Checking missions table columns...\n";
        
        // ═══════════════════════════════════════════════════════
        // 1️⃣ CORRIGER service_durition → service_duration
        // ═══════════════════════════════════════════════════════
        $columns = collect(DB::select('SHOW COLUMNS FROM missions'))->pluck('Field')->toArray();
        
        if (in_array('service_durition', $columns) && !in_array('service_duration', $columns)) {
            echo "🔄 Renaming 'service_durition' to 'service_duration'...\n";
            DB::statement('ALTER TABLE missions CHANGE service_durition service_duration VARCHAR(255) NULL');
            echo "✅ Column renamed successfully!\n";
        } elseif (!in_array('service_duration', $columns) && !in_array('service_durition', $columns)) {
            echo "⚠️  Creating 'service_duration' column (neither duration nor durition found)...\n";
            Schema::table('missions', function (Blueprint $table) {
                $table->string('service_duration')->nullable()->after('budget_currency');
            });
            echo "✅ Column created!\n";
        } else {
            echo "✅ 'service_duration' already exists (nothing to rename)\n";
        }
        
        // ═══════════════════════════════════════════════════════
        // 2️⃣ AJOUTER LES COLONNES GDPR
        // ═══════════════════════════════════════════════════════
        Schema::table('missions', function (Blueprint $table) {
            if (!Schema::hasColumn('missions', 'terms_accepted')) {
                echo "➕ Adding 'terms_accepted' column...\n";
                $table->boolean('terms_accepted')->default(false)->after('service_duration');
            }
            
            if (!Schema::hasColumn('missions', 'terms_accepted_at')) {
                echo "➕ Adding 'terms_accepted_at' column...\n";
                $table->timestamp('terms_accepted_at')->nullable()->after('terms_accepted');
            }
            
            if (!Schema::hasColumn('missions', 'terms_version')) {
                echo "➕ Adding 'terms_version' column...\n";
                $table->string('terms_version', 10)->default('1.0')->after('terms_accepted_at');
            }
            
            if (!Schema::hasColumn('missions', 'terms_accepted_ip')) {
                echo "➕ Adding 'terms_accepted_ip' column...\n";
                $table->ipAddress('terms_accepted_ip')->nullable()->after('terms_version');
            }
        });
        
        echo "✅ All GDPR columns added successfully!\n\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            // Supprimer les colonnes GDPR
            $columns = ['terms_accepted_ip', 'terms_version', 'terms_accepted_at', 'terms_accepted'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('missions', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
        
        // Renommer service_duration en service_durition (restaurer l'ancien nom)
        $hasDuration = DB::select("SHOW COLUMNS FROM missions LIKE 'service_duration'");
        if (!empty($hasDuration)) {
            DB::statement('ALTER TABLE missions CHANGE service_duration service_durition VARCHAR(255) NULL');
        }
    }
};