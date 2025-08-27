<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'user_id',
        'vote_type',
    ];

    /**
     * Get the feedback this vote belongs to
     */
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    /**
     * Get the user who made this vote
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
