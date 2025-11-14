<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geo_regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('code', 10);
            $table->string('name');
            $table->string('type', 50)->nullable();
            $table->string('timezone', 50)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamps();
            
            $table->unique(['country_id', 'code']);
            $table->index('timezone');
            $table->index('name');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('geo_regions');
    }
};
