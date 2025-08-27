<?php

namespace App\Services;

use App\Models\EmergencyAlert;
use App\Models\User;
use App\Models\AlertNotification;
use App\Notifications\EmergencyAlertNotification;
use Illuminate\Support\Facades\Log;

class EmergencyNotificationService
{
    /**
     * Send notifications to users within dynamic radius of emergency alert
     * Starts at 1km and expands up to 5km until at least 20 people are found
     */
    public function sendNotifications(EmergencyAlert $alert, $maxRadiusKm = 5, $minPeople = 20)
    {
        try {
            $currentRadius = 1; // Start with 1km
            $nearbyUsers = collect();
            $finalRadius = $currentRadius;

            // Dynamically expand radius until we find enough people or reach max radius
            while ($currentRadius <= $maxRadiusKm && $nearbyUsers->count() < $minPeople) {
                $nearbyUsers = $this->getUsersWithinRadius($alert, $currentRadius);
                $finalRadius = $currentRadius;
                
                // If we found enough people, break
                if ($nearbyUsers->count() >= $minPeople) {
                    break;
                }
                
                // Expand radius by 1km for next iteration
                $currentRadius += 1;
            }

            $notificationCount = 0;

            foreach ($nearbyUsers as $user) {
                // Create notification record
                $notification = AlertNotification::create([
                    'alert_id' => $alert->id,
                    'notified_user_id' => $user->id,
                    'notification_type' => 'email', // Default to email for now
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);

                // Send email notification
                if ($user->email) {
                    try {
                        $user->notify(new EmergencyAlertNotification($alert));
                        $notification->update(['status' => 'delivered', 'delivered_at' => now()]);
                        $notificationCount++;
                    } catch (\Exception $e) {
                        Log::error('Failed to send emergency notification email', [
                            'user_id' => $user->id,
                            'alert_id' => $alert->id,
                            'error' => $e->getMessage()
                        ]);
                        $notification->update(['status' => 'failed']);
                    }
                }

                // TODO: Add SMS notification when SMS service is configured
                // TODO: Add push notification when push service is configured
            }

            Log::info('Emergency notifications sent', [
                'alert_id' => $alert->id,
                'notifications_sent' => $notificationCount,
                'total_nearby_users' => $nearbyUsers->count(),
                'final_radius_km' => $finalRadius,
                'target_people' => $minPeople
            ]);

            return $notificationCount;

        } catch (\Exception $e) {
            Log::error('Failed to send emergency notifications', [
                'alert_id' => $alert->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Get users within a specific radius of the emergency alert
     */
    private function getUsersWithinRadius(EmergencyAlert $alert, $radiusKm)
    {
        return User::where('is_available_for_help', true)
            ->where('receive_notifications', true)
            ->where('id', '!=', $alert->user_id) // Don't notify the person who sent the alert
            ->whereHas('locations', function ($query) {
                $query->active();
            })
            ->get()
            ->filter(function ($user) use ($alert, $radiusKm) {
                // Check if user has any locations within radius
                return $user->locations()->active()->get()->some(function ($location) use ($alert, $radiusKm) {
                    return $this->calculateDistance(
                        $alert->latitude,
                        $alert->longitude,
                        $location->latitude,
                        $location->longitude
                    ) <= $radiusKm;
                });
            });
    }

    /**
     * Calculate distance between two points using Haversine formula
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}

