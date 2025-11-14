<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('event_type', 50);
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('city')->nullable();
            $table->integer('risk_score')->default(0);
            $table->boolean('is_suspicious')->default(false);
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->string('device')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['user_id', 'event_type', 'created_at']);
            $table->index(['is_suspicious', 'created_at']);
            $table->index('ip_address');
            $table->index('event_type');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('security_logs');
    }
};
