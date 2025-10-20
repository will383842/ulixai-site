<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReputationPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reputation_points', function (Blueprint $table) {
            $table->id();
            $table->integer('mission_with_review')->default(0);
            $table->integer('five_star_review')->default(0);   
            $table->integer('four_star_review')->default(0);    
            $table->integer('response_24h')->default(0);        
            $table->integer('profile_complete')->default(0);  
            $table->integer('active_3_months')->default(0);   
            $table->integer('active_12_months')->default(0); 
            $table->integer('no_disputes')->default(0); 
            $table->integer('client_recommendations')->default(0); 
            $table->integer('client_abuse_report')->default(0);
            $table->integer('dispute_refund')->default(0);    
            $table->integer('provider_canceled')->default(0); 
            $table->integer('no_reply_5_requests')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reputation_points');
    }
}
