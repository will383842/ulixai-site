<?php
// database/migrations/2025_09_22_000000_create_roles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('accent_class')->default('text-blue-700'); // Tailwind text color
            $table->string('emoji', 8)->nullable();                   // e.g. "🎥"
            $table->string('short_tagline');                          // one-liner subtitle
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('roles');
    }
};
