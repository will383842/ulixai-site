<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('partnership_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Store the first name
            $table->string('last_name');  // Store the last name
            $table->string('language_spoken');
            $table->string('phone'); // Store the phone number
            $table->string('country'); // Store the country
            $table->string('sector_of_activity')->nullable(); // Store sector of activity, nullable
            $table->string('preferred_time')->nullable(); // Store preferred time, nullable
            $table->string('how_heard_about')->nullable(); // Store how they heard about Ulixai, nullable
            $table->text('motivation')->nullable(); // Store motivation, nullable
            $table->string('partnership_type'); // Store partnership type
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('partnership_requests');
    }
};
