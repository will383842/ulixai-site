<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
    use HasFactory;

    protected $table = 'partnership_requests';

    protected $fillable = [
        'first_name',
        'last_name',
        'language_spoken',
        'phone',
        'country',
        'sector_of_activity',
        'preferred_time',
        'how_heard_about',
        'motivation',
        'partnership_type',
    ];
}
