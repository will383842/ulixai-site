<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionOffersTable extends Migration
{
    public function up(): void
    {
        Schema::create('mission_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained('missions')->onDelete('cascade');
            $table->foreignId('provider_id')->constrained('service_providers')->onDelete('cascade');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('delivery_time')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamps();

            // Important indexes
            $table->index('mission_id', 'idx_mission_id');
            $table->index('provider_id', 'idx_provider_id');
            $table->index('status', 'idx_status');
            $table->index('price', 'idx_price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_offers');
    }
}
