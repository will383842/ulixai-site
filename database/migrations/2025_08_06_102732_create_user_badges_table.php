<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBadgesTable extends Migration
{
    public function up()
    {
        Schema::create('user_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('badge_id')->constrained('badges')->cascadeOnDelete();
            $table->enum('assigned_by', ['system', 'admin', 'moderator'])->default('system');
            $table->unsignedBigInteger('assigned_by_id')->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'badge_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_badges');
    }
}

