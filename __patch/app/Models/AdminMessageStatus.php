<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMessageStatus extends Model
{
    protected $fillable = [
        'message_type',
        'message_id',
        'is_read',
        'is_processed',
        'read_at',
        'processed_at',
        'assigned_admin_id',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_processed' => 'boolean',
        'read_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public $timestamps = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'assigned_admin_id');
    }
}
