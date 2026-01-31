<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_strikes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('reason', [
                'banned_word_critical',
                'contact_info',
                'spam',
                'reported_content',
                'manual_admin'
            ]);
            $table->text('details')->nullable();
            $table->string('content_type')->nullable(); // mission, message, offer
            $table->unsignedBigInteger('content_id')->nullable();
            $table->integer('strike_number'); // 1, 2, ou 3
            $table->timestamp('expires_at')->nullable(); // Strike peut expirer après X mois
            $table->boolean('is_active')->default(true);
            $table->foreignId('issued_by')->nullable()->constrained('users'); // Admin qui a émis (si manuel)
            $table->timestamps();

            $table->index(['user_id', 'is_active']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_strikes');
    }
};
