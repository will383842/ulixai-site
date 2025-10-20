<?php



// app/Models/BugReport.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugReport extends Model
{
    protected $fillable = [
        'user_id',
        'country',
        'language',
        'bug_description',
        'suggestions',
    ];

    public function user(){
        return $this->belongsTo(user::class,'user_id');
    }
}
