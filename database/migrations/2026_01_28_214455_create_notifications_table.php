<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table notifications Laravel standard + préférences
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type'); // Classe de notification
            $table->morphs('notifiable'); // user_id + type
            $table->text('data'); // JSON avec les données
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            // Index pour performance
            $table->index(['notifiable_id', 'notifiable_type', 'read_at']);
            $table->index('created_at');
        });

        // Table des préférences de notification par utilisateur
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('channel'); // 'email', 'database', 'push'
            $table->string('type'); // 'dispute', 'payment', 'mission', 'message'
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->unique(['user_id', 'channel', 'type']);
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
        Schema::dropIfExists('notifications');
    }
};
