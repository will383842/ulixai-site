<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('ULIX AI');
            $table->json('legal_info')->nullable(); // Store all legal info as JSON
            $table->timestamps();
        });

        // Insert default row
        DB::table('site_settings')->insert([
            'site_name' => 'ULIX AI',
            'legal_info' => json_encode([
                'publisher' => '',
                'ip' => '',
                'liability' => '',
                'privacy' => '',
                'law' => ''
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
