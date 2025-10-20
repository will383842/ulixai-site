<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderReviewsTable extends Migration
{
    public function up(): void
    {
        Schema::create('provider_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('service_providers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('rating')->default(5);
            $table->text('comment')->nullable();
            $table->text('attributes')->nullable();
            $table->boolean('service_success')->default(0);
            $table->foreignId('mission_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_reviews');
    }
}
