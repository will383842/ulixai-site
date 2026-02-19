<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ulix_commissions', function (Blueprint $table) {
            $table->dropColumn('org_fee');
        });
    }

    public function down(): void
    {
        Schema::table('ulix_commissions', function (Blueprint $table) {
            $table->decimal('org_fee', 5, 4)->default(0.0500)->after('provider_fee');
        });
    }
};
