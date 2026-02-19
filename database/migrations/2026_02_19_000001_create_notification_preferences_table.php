<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('channel', 20); // email, push, sms, in_app
            $table->string('type', 50);    // missions, messages, payments, marketing, etc.
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            // Un seul enregistrement par combinaison user + channel + type
            // La contrainte UNIQUE crée l'index MySQL automatiquement — pas d'index séparé nécessaire
            $table->unique(['user_id', 'channel', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
    }
};
