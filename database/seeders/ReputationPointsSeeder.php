<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReputationPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example of seeding reputation points for users
        DB::table('reputation_points')->insert([
            [
                'mission_with_review' => 20,
                'five_star_review' => 10,
                'four_star_review' => 5,
                'response_24h' => 5,
                'profile_complete' => 10,
                'active_3_months' => 10,
                'active_12_months' => 15,
                'no_disputes' => 15,
                'client_recommendations' => 15,
                'client_abuse_report' => -10,
                'dispute_refund' => -30,
                'provider_canceled' => -150,
                'no_reply_5_requests' => -20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
