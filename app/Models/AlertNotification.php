<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'alert_id',
        'notified_user_id',
        'notification_type',
        'status',
        'sent_at',
        'delivered_at',
        'responded_at',
        'response_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    /**
     * Get the emergency alert this notification is for
     */
    public function alert()
    {
        return $this->belongsTo(EmergencyAlert::class, 'alert_id');
    }

    /**
     * Get the user who was notified
     */
    public function notifiedUser()
    {
        return $this->belongsTo(User::class, 'notified_user_id');
    }

    /**
     * Scope to get only sent notifications
     */
    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    /**
     * Scope to get delivered notifications
     */
    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    /**
     * Scope to get responded notifications
     */
    public function scopeResponded($query)
    {
        return $query->where('status', 'responded');
    }
}
