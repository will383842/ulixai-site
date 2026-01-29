<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds 'type' column to distinguish between:
     * - general: General terms (default, existing content)
     * - client: Client-specific terms
     * - provider: Service provider terms
     * - affiliate: Affiliate program terms
     */
    public function up()
    {
        Schema::table('terms_sections', function (Blueprint $table) {
            $table->string('type', 20)->default('general')->after('slug')->index();
        });

        // Update existing records to 'general' type
        DB::table('terms_sections')->whereNull('type')->orWhere('type', '')->update(['type' => 'general']);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('terms_sections', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropColumn('type');
        });
    }
};
