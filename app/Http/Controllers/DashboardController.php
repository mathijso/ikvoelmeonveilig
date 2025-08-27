<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the dashboard with statistics
     */
    public function index()
    {
        $user = Auth::user();
        
        $statistics = [
            'total_locations' => \App\Models\User::getTotalLocationsCount(),
            'nearby_users' => $user->getNearbyUsersCount(5), // 5km radius
            'user_locations' => $user->locations()->count(),
        ];

        return view('dashboard', compact('statistics'));
    }
}
