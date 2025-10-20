<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_otp')->nullable();
            $table->string('country')->nullable();
            $table->string('affiliate_code')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->json('referral_stats')->nullable();
            $table->string('status')->default('active'); 
            $table->enum('user_role', ['service_requester', 'super_admin','regional_admin' ,'moderator', 'service_provider'])->default('service_requester');
            $table->string('preferred_language')->nullable();
            $table->boolean('is_fake')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('referred_by')->references('id')->on('users')->nullOnDelete();

            $table->index('email', 'idx_email');
            $table->index('affiliate_code', 'idx_affiliate_code');
            $table->index(['country'], 'idx_country_city');
            $table->index('referred_by', 'idx_referred_by');

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Insert test admin credentials
        \DB::table('users')->insert([
            'name' => 'Test Admin',
            'email' => 'admin@ulixai.com',
            'password' => bcrypt('admin123'), // Change password as needed
            'user_role' => 'super_admin',
            'status' => 'active',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
