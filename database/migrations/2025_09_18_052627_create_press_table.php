<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('press', function (Blueprint $table) {
            $table->id();
            
            // Informations de contact du journaliste
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            
            // Contenu de la demande
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            
            // Assets presse (ancien système)
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('pdf')->nullable();
            $table->string('photo')->nullable();
            $table->string('icon')->nullable();
            $table->string('guideline_pdf')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('press');
    }
};
