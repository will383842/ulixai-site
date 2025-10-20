<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('terms_sections', function (Blueprint $table) {
            $table->id();
            // display order / number (1..10…)
            $table->unsignedSmallInteger('number')->default(1)->index();
            // visible title and a unique slug
            $table->string('title');
            $table->string('slug')->unique();
            // rich text/HTML body
            $table->longText('body')->nullable();

            // optional helpers you’ll likely want
            $table->boolean('is_active')->default(true)->index();
            $table->string('version')->nullable()->index();       // e.g., "v1.0"
            $table->date('effective_date')->nullable();           // when version goes live

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terms_sections');
    }
};
