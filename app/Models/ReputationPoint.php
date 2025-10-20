<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReputationPoint extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'reputation_points';

    // Define the fillable columns that you want to allow mass assignment on
    protected $fillable = [
        'user_id',
        'mission_with_review',
        'five_star_review',
        'four_star_review',
        'response_24h',
        'profile_complete',
        'active_3_months',
        'active_12_months',
        'no_disputes',
        'client_recommendations',
        'client_abuse_report',
        'dispute_refund',
        'provider_canceled',
        'no_reply_5_requests',
    ];

    protected $hidden = [];
    protected $casts = [];

}
