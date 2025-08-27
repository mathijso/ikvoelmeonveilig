<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'is_available_for_help',
        'receive_notifications',
        'google_id',
        'avatar',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_available_for_help' => 'boolean',
            'receive_notifications' => 'boolean',
            'last_active_at' => 'datetime',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the user's locations
     */
    public function locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    /**
     * Get the user's emergency alerts
     */
    public function emergencyAlerts()
    {
        return $this->hasMany(EmergencyAlert::class);
    }

    /**
     * Get the user's active emergency alert
     */
    public function activeEmergencyAlert()
    {
        return $this->hasOne(EmergencyAlert::class)->where('status', 'active');
    }

    /**
     * Get notifications sent to this user
     */
    public function alertNotifications()
    {
        return $this->hasMany(AlertNotification::class, 'notified_user_id');
    }

    /**
     * Get users within a certain radius of given coordinates based on their locations
     */
    public static function withinRadius($latitude, $longitude, $radiusKm = 5)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        return static::whereHas('locations', function ($query) use ($latitude, $longitude, $radiusKm, $earthRadius) {
            $query->active()
                ->selectRaw("
                    *,
                    ({$earthRadius} * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
                ", [$latitude, $longitude, $latitude])
                ->having('distance', '<=', $radiusKm);
        });
    }

    /**
     * Get count of users within 5km of the current user's locations
     */
    public function getNearbyUsersCount($radiusKm = 5)
    {
        $userLocations = $this->locations()->active()->get();
        
        if ($userLocations->isEmpty()) {
            return 0;
        }

        $nearbyUsers = collect();
        
        foreach ($userLocations as $location) {
            $usersInRadius = static::where('is_available_for_help', true)
                ->where('receive_notifications', true)
                ->where('id', '!=', $this->id)
                ->whereHas('locations', function ($query) use ($location, $radiusKm) {
                    $query->active()
                        ->selectRaw("
                            *,
                            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
                        ", [$location->latitude, $location->longitude, $location->latitude])
                        ->having('distance', '<=', $radiusKm);
                })
                ->get();
            
            $nearbyUsers = $nearbyUsers->merge($usersInRadius);
        }
        
        // Remove duplicates based on user ID
        return $nearbyUsers->unique('id')->count();
    }

    /**
     * Get total count of registered locations in the system
     */
    public static function getTotalLocationsCount()
    {
        return \App\Models\UserLocation::where('is_active', true)->count();
    }
}
