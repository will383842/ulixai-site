<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('provider_photo_verifications', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('id');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });

        Schema::table('provider_document_verifications', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('id');
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('provider_photo_verifications', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });

        Schema::table('provider_document_verifications', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });
    }
};