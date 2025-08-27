<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'status',
        'upvotes',
        'downvotes',
        'is_anonymous',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    /**
     * Get the user who created this feedback
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all votes for this feedback
     */
    public function votes()
    {
        return $this->hasMany(FeedbackVote::class);
    }

    /**
     * Get upvotes for this feedback
     */
    public function upvotes()
    {
        return $this->hasMany(FeedbackVote::class)->where('vote_type', 'upvote');
    }

    /**
     * Get downvotes for this feedback
     */
    public function downvotes()
    {
        return $this->hasMany(FeedbackVote::class)->where('vote_type', 'downvote');
    }

    /**
     * Get the net score (upvotes - downvotes)
     */
    public function getScoreAttribute()
    {
        return $this->upvotes - $this->downvotes;
    }

    /**
     * Get the display name for the author (anonymous or real name)
     */
    public function getAuthorNameAttribute()
    {
        if ($this->is_anonymous) {
            return 'Anonieme gebruiker';
        }
        
        return $this->user->name ?? 'Onbekende gebruiker';
    }

    /**
     * Check if a user has voted on this feedback
     */
    public function hasUserVoted($userId)
    {
        return $this->votes()->where('user_id', $userId)->exists();
    }

    /**
     * Get the vote type for a specific user
     */
    public function getUserVote($userId)
    {
        $vote = $this->votes()->where('user_id', $userId)->first();
        return $vote ? $vote->vote_type : null;
    }

    /**
     * Scope to get feedback by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get feedback by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to order by score (highest first)
     */
    public function scopeOrderByScore($query)
    {
        return $query->orderByRaw('(upvotes - downvotes) DESC');
    }

    /**
     * Scope to order by recent
     */
    public function scopeOrderByRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
