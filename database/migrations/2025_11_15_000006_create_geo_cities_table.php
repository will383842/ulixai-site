<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geo_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('geo_region_id')->nullable()->constrained('geo_regions')->onDelete('set null');
            $table->string('name');
            $table->string('ascii_name')->index();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->integer('population')->nullable();
            $table->string('timezone', 50);
            $table->boolean('is_capital')->default(false);
            $table->timestamps();
            
            $table->index(['latitude', 'longitude']);
            $table->index(['country_id', 'is_capital']);
            $table->index('population');
            $table->index('name');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('geo_cities');
    }
};
