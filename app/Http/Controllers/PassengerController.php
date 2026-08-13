<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\ResourceUsageLog;

class PassengerController extends Controller
{
    // PAGE 1: Resource Discovery 
    public function dashboard()
    {
        $user = auth()->user();
        
        // Only load the resources, we no longer need to load history here
        $allowedResources = Resource::where('min_tier_weight', '<=', $user->tier->weight ?? 0)->get();
        $resources = Resource::orderBy('min_tier_weight')->get(); 

        return view('passenger.dashboard', compact('user', 'resources', 'allowedResources'));
    }

    // PAGE 2: Usage History & Date Filtering
    public function history(Request $request)
    {
        $user = auth()->user();

        // Build the History Query
        $query = ResourceUsageLog::with('resource')
            ->where('user_id', $user->id)
            ->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $history = $query->get();

        return view('passenger.history', compact('user', 'history'));
    }

    // PAGE 3: TIER INFORMATION
    public function tier()
    {
        return view('passenger.tier');
    }
}