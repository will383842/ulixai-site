<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceProvidersTable extends Migration
{
    public function up(): void
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('native_language')->nullable();
            $table->json('spoken_language')->nullable();
            $table->json('services_to_offer')->nullable();
            $table->json('services_to_offer_category')->nullable();
            $table->text('provider_address')->nullable();
            $table->text('operational_countries')->nullable();
            
            $table->boolean('communication_online')->nullable();
            $table->boolean('communication_inperson')->nullable();
            $table->text('profile_description')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('provider_docs')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country')->nullable();
            $table->string('preferred_language')->nullable();
            $table->json('special_status')->nullable();
            $table->boolean('provider_visibility')->default(true);
            $table->json('country_coords')->nullable();
            $table->json('city_coords')->nullable();
            $table->string('email')->unique()->nullable();
            $table->json('documents')->nullable();
            $table->boolean('pinned')->default(false);
            // Stripe related columns
            $table->string('stripe_account_id')->nullable();
            $table->boolean('stripe_chg_enabled')->default(false);
            $table->boolean('stripe_pts_enabled')->default(false);
            $table->string('kyc_link')->nullable();
            
            // KYC Status column
            $table->enum('kyc_status', ['pending', 'incomplete', 'verified', 'rejected'])->default('pending');
            $table->integer('points')->default(0);
            $table->enum('ulysse_status', ['Ulysse+', 'Top Ulysse', 'Ulysse Diamond'])->default('Ulysse+');
            $table->ipAddress('ip_address')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            
            // Add indexes for better performance
            $table->index(['stripe_chg_enabled', 'stripe_pts_enabled']);
            $table->index('kyc_status');
            $table->index('stripe_account_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
}