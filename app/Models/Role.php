<?php
// app/Models/Role.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title','accent_class','emoji','short_tagline','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
