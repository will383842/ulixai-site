<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Renommer custum_description → custom_description dans mission_cancellation_reasons
        if (Schema::hasColumn('mission_cancellation_reasons', 'custum_description')
            && !Schema::hasColumn('mission_cancellation_reasons', 'custom_description')) {
            DB::statement('ALTER TABLE mission_cancellation_reasons CHANGE custum_description custom_description TEXT NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('mission_cancellation_reasons', 'custom_description')
            && !Schema::hasColumn('mission_cancellation_reasons', 'custum_description')) {
            DB::statement('ALTER TABLE mission_cancellation_reasons CHANGE custom_description custum_description TEXT NULL');
        }
    }
};
