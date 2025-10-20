<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('recruit_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('role_title');
            $table->string('country')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->text('message')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('recruit_applications');
    }
};
