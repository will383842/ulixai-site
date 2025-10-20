<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mission_cancellation_reasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mission_id');
            $table->enum('cancelled_by', ['requester', 'provider', 'admin']);
            $table->text('reason');
            $table->text('custum_description')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->timestamps();
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_cancellation_reasons');
    }
};
