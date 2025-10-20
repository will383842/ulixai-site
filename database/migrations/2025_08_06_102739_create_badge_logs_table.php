<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeLogsTable extends Migration
{
    public function up()
    {
        Schema::create('badge_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_badge_id')->constrained('user_badges')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('users');
            $table->string('action');
            $table->json('changes')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('badge_logs');
    }
}

