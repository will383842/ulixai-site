<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('url', 500)->unique();
            $table->string('locale', 5)->default('en');
            $table->string('page_type', 50)->nullable();
            $table->string('title', 70)->nullable();
            $table->string('description', 160)->nullable();
            $table->text('keywords')->nullable();
            $table->string('og_title', 70)->nullable();
            $table->string('og_description', 200)->nullable();
            $table->string('og_image', 500)->nullable();
            $table->string('og_type', 20)->default('website');
            $table->string('twitter_card', 20)->default('summary_large_image');
            $table->string('twitter_site', 50)->nullable();
            $table->string('twitter_creator', 50)->nullable();
            $table->string('canonical_url', 500)->nullable();
            $table->string('robots', 100)->default('index, follow');
            $table->json('schema_markup')->nullable();
            $table->integer('impressions')->default(0);
            $table->integer('clicks')->default(0);
            $table->decimal('ctr', 5, 2)->default(0);
            $table->timestamps();
            
            $table->index('locale');
            $table->index('page_type');
            $table->index('robots');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('seo_metadata');
    }
};
