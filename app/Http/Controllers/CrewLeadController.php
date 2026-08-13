<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tier;
use App\Models\Resource;
use App\Models\ResourceUsageLog;

class CrewLeadController extends Controller
{
    // PAGE 1: Statistics & Charts
    public function dashboard()
    {
        $totalInteractions  = ResourceUsageLog::count();
        $deniedRequests     = ResourceUsageLog::where('access_status', 'denied')->count();
        $grantedRequests    = ResourceUsageLog::where('access_status', 'granted')->count();
        
        $topResource        = ResourceUsageLog::select('resource_id')
                                ->selectRaw('COUNT(*) as count')
                                ->groupBy('resource_id')
                                ->orderByDesc('count')
                                ->with('resource')
                                ->first();
        
        $resourceUsageData  = Resource::withCount('usageLogs')->get();
        $chartLabels        = $resourceUsageData->pluck('name');
        $chartData          = $resourceUsageData->pluck('usage_logs_count');

        return view('admin.dashboard', compact(
            'totalInteractions', 'deniedRequests', 'grantedRequests', 'topResource',
            'chartLabels', 'chartData'
        ));
    }

    // PAGE 2: Passenger Management
    public function passengers()
    {
        $passengers = User::where('role', 'passenger')->with('tier')->get();
        $tiers      = Tier::orderBy('weight')->get();
        
        return view('admin.passengers', compact('passengers', 'tiers'));
    }

    // PAGE 3: Ship Facilities
    public function resources()
    {
        $resources = Resource::all();
        
        return view('admin.resources', compact('resources'));
    }

    // PAGE 4: System Logs with Filters
    public function logs(Request $request)
    {
        $passengers = User::where('role', 'passenger')->orderBy('name')->get();
        $query = ResourceUsageLog::with(['user.tier', 'resource'])->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // CHANGED: Use paginate(10) instead of get()
        $logs = $query->paginate(10);
        
        return view('admin.logs', compact('logs', 'passengers'));
    }
}