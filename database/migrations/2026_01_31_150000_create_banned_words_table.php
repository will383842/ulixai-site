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
        Schema::create('banned_words', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('normalized_word');
            $table->enum('severity', ['critical', 'warning', 'info'])->default('warning');
            $table->enum('category', [
                'sexual',
                'political',
                'religious',
                'hate_speech',
                'illegal',
                'spam',
                'contact_info',
                'other'
            ]);
            $table->string('language', 10)->default('fr');
            $table->boolean('is_regex')->default(false);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['word', 'language']);
            $table->index('severity');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banned_words');
    }
};
