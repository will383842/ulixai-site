<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('press_assets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('type')->default('other'); // logo|kit|release|visual|other
            $table->string('locale', 8)->default('all'); // all|fr|en|es|...
            $table->string('disk')->default('public');
            $table->string('path');     // storage path
            $table->string('filename'); // nom de fichier visible
            $table->string('mime')->nullable();
            $table->unsignedBigInteger('size')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();

            $table->index(['type', 'locale']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('press_assets');
    }
};
