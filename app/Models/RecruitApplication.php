<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruitApplication extends Model
{
    protected $fillable = [
        'user_id','role_title','country','first_name','last_name',
        'phone','email','message','cv_path','status'
    ];
}
