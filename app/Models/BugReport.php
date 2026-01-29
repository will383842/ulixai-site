<?php

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
        'page_url',
        'user_agent',
        'screen_size',
        'priority',
        'status',
        'report_type',
        'resolved_at',
        'resolved_by',
        'admin_notes',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('report_type', $type);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => ['color' => 'yellow', 'label' => 'En attente'],
            'in_progress' => ['color' => 'blue', 'label' => 'En cours'],
            'resolved' => ['color' => 'green', 'label' => 'Résolu'],
            'dismissed' => ['color' => 'gray', 'label' => 'Rejeté'],
            default => ['color' => 'gray', 'label' => 'Inconnu'],
        };
    }

    public function getPriorityBadgeAttribute()
    {
        return match($this->priority) {
            'low' => ['color' => 'gray', 'label' => 'Basse'],
            'medium' => ['color' => 'yellow', 'label' => 'Moyenne'],
            'high' => ['color' => 'orange', 'label' => 'Haute'],
            'critical' => ['color' => 'red', 'label' => 'Critique'],
            default => ['color' => 'gray', 'label' => 'Inconnue'],
        };
    }

    public function getTypeLabelAttribute()
    {
        return match($this->report_type) {
            'bug' => 'Bug',
            'suggestion' => 'Suggestion',
            'question' => 'Question',
            'other' => 'Autre',
            default => 'Inconnu',
        };
    }
}
