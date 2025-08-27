<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard with basic statistics
     */
    public function index()
    {
        if(!auth()->user()->isAdmin()){
            return redirect()->route('dashboard');
        }

        $stats = [
            'total_users' => User::count(),
            'total_locations' => UserLocation::where('is_active', true)->count(),
        ];

        return view('admin.index', compact('stats'));
    }
}
