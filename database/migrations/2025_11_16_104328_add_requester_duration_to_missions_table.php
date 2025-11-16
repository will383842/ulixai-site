<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

return new class extends Migration
{
    /**
     * ✅ Ajouter le champ requester_duration_in_country
     */
    public function up()
    {
        if (Schema::hasTable('missions')) {
            Schema::table('missions', function (Blueprint $table) {
                if (!Schema::hasColumn('missions', 'requester_duration_in_country')) {
                    $table->string('requester_duration_in_country', 100)
                          ->nullable()
                          ->after('location_city')
                          ->comment('How long the requester has been in the country');
                    
                    Log::info('✅ [MIGRATION] Added requester_duration_in_country to missions table');
                } else {
                    Log::info('⚠️ [MIGRATION] requester_duration_in_country already exists in missions table');
                }
            });
        } else {
            Log::warning('⚠️ [MIGRATION] Table missions does not exist');
        }
    }

    /**
     * ✅ Supprimer le champ si rollback
     */
    public function down()
    {
        if (Schema::hasTable('missions')) {
            Schema::table('missions', function (Blueprint $table) {
                if (Schema::hasColumn('missions', 'requester_duration_in_country')) {
                    $table->dropColumn('requester_duration_in_country');
                    Log::info('✅ [ROLLBACK] Removed requester_duration_in_country from missions table');
                }
            });
        }
    }
};