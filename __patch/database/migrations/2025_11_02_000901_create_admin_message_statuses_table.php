<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_message_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('message_type', 64); // 'press','reportbug','partner','recruitment'
            $table->unsignedBigInteger('message_id');
            $table->boolean('is_read')->default(false)->index();
            $table->boolean('is_processed')->default(false)->index();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->unsignedBigInteger('assigned_admin_id')->nullable();
            $table->timestamps();

            $table->unique(['message_type','message_id'], 'msg_type_id_unique');
            $table->index(['message_type','is_processed']);
            $table->index(['message_type','is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_message_statuses');
    }
};
