<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 500);
            $table->text('answer');
            $table->string('category', 100)->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);  // ← CORRIGÉ : 'status' comme en production !
            $table->timestamps();
            
            $table->index('category');
            $table->index('status');  // ← CORRIGÉ : index sur 'status'
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
