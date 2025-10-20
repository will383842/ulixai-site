<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionOffer extends Model
{
    protected $table = 'mission_offers';

    protected $fillable = [
        'mission_id',
        'provider_id',
        'price',
        'message',
        'delivery_time',
        'status'
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class, 'mission_id');
    }

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }
}
