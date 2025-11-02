<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('service_providers') && Schema::hasColumn('service_providers', 'slug')) {
            Schema::table('service_providers', function (Blueprint $table) {
                $table->index('slug', 'sp_slug_idx');
            });
        }
        if (Schema::hasTable('providers') && Schema::hasColumn('providers', 'slug')) {
            Schema::table('providers', function (Blueprint $table) {
                $table->index('slug', 'providers_slug_idx');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('service_providers')) {
            Schema::table('service_providers', function (Blueprint $table) {
                $table->dropIndex('sp_slug_idx');
            });
        }
        if (Schema::hasTable('providers')) {
            Schema::table('providers', function (Blueprint $table) {
                $table->dropIndex('providers_slug_idx');
            });
        }
    }
};
