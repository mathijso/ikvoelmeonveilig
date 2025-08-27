<?php

namespace App\Http\Controllers;

use App\Models\EmergencyAlert;
use App\Services\EmergencyNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmergencyController extends Controller
{
    public function __construct(
        private EmergencyNotificationService $notificationService
    ) {}

    /**
     * Show the emergency alert page
     */
    public function index()
    {
        return view('emergency.index');
    }

    /**
     * Create a new emergency alert
     */
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            // Check if user already has an active alert
            $existingAlert = Auth::user()->activeEmergencyAlert;
            if ($existingAlert) {
                return response()->json([
                    'success' => false,
                    'message' => 'Je hebt al een actieve noodmelding. Deze wordt eerst afgehandeld.'
                ], 400);
            }

            // Create the emergency alert
            $alert = EmergencyAlert::create([
                'user_id' => Auth::id(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'address' => $request->address,
                'description' => $request->description,
                'status' => 'active',
            ]);

            // Send notifications to nearby users
            $notificationCount = $this->notificationService->sendNotifications($alert);

            Log::info('Emergency alert created', [
                'alert_id' => $alert->id,
                'user_id' => Auth::id(),
                'notifications_sent' => $notificationCount
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Noodmelding verzonden! ' . $notificationCount . ' mensen in de buurt zijn op de hoogte gebracht.',
                'alert_id' => $alert->id,
                'notifications_sent' => $notificationCount
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to create emergency alert', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Er is een fout opgetreden bij het verzenden van de noodmelding. Probeer het opnieuw.'
            ], 500);
        }
    }

    /**
     * Show emergency alert details
     */
    public function show(EmergencyAlert $emergency)
    {
        return view('emergency.show', compact('emergency'));
    }

    /**
     * Resolve an emergency alert
     */
    public function resolve(EmergencyAlert $emergency)
    {
        if ($emergency->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Deze noodmelding is al afgehandeld.'
            ], 400);
        }

        $emergency->update([
            'status' => 'resolved',
            'resolved_at' => now(),
            'resolved_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Noodmelding succesvol afgehandeld.'
        ]);
    }

    /**
     * Cancel an emergency alert
     */
    public function cancel(EmergencyAlert $emergency)
    {
        if ($emergency->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Deze noodmelding is al afgehandeld.'
            ], 400);
        }

        $emergency->update([
            'status' => 'cancelled',
            'resolved_at' => now(),
            'resolved_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Noodmelding geannuleerd.'
        ]);
    }
}
