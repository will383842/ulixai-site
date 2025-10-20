<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugReportsTable extends Migration
{
    public function up()
    {
        Schema::create('bug_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Optional if user is logged in
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->text('bug_description')->nullable();
            $table->text('suggestions')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bug_reports');
    }
}

