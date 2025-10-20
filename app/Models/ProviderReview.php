<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderReview extends Model
{
    protected $fillable = [
        'provider_id', 'user_id', 'rating', 'comment', 'attributes', 'service_success', 'mission_id'
    ];

    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
