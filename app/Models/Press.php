<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    protected $table = 'press';
    
    protected $fillable = [
        'title',
        'description',
        'language',
        'pdf',
        'photo',
        'icon',
        'guideline_pdf'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}