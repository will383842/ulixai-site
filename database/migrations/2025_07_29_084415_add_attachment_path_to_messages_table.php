<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Add the attachment_path column to store the file path
            $table->string('attachment_path')->nullable(); // Nullable because not all messages will have attachments
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop the attachment_path column if the migration is rolled back
            $table->dropColumn('attachment_path');
        });
    }
};
