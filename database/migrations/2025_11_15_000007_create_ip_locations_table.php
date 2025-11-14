<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ip_locations', function (Blueprint $table) {
            $table->id();
            $table->string('ip_start', 45);
            $table->string('ip_end', 45);
            $table->bigInteger('ip_start_numeric')->nullable();
            $table->bigInteger('ip_end_numeric')->nullable();
            $table->string('country_code', 2)->index();
            $table->string('region_code', 20)->nullable();
            $table->string('city', 100)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('timezone', 50)->nullable();
            $table->string('isp', 255)->nullable();
            $table->string('connection_type', 20)->nullable();
            $table->timestamps();
            
            $table->index(['ip_start', 'ip_end']);
            $table->index(['ip_start_numeric', 'ip_end_numeric']);
            $table->index('city');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('ip_locations');
    }
};
