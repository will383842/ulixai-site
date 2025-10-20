<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionMessagesTable extends Migration
{
    public function up(): void
    {
        Schema::create('mission_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_id')->constrained('missions')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->timestamps();

            $table->index('mission_id', 'idx_mission_msg_mission_id');
            $table->index('user_id', 'idx_mission_msg_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_messages');
    }
}
