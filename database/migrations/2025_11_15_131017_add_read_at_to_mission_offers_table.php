<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mission_offers', function (Blueprint $table) {
            $table->timestamp('read_at')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('mission_offers', function (Blueprint $table) {
            $table->dropColumn('read_at');
        });
    }
};