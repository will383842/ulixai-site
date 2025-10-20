<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('special_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('stitle')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('special_statuses');
    }
}
