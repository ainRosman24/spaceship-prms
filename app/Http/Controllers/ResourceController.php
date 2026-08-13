<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\ResourceUsageLog;

class ResourceController extends Controller
{
    public function access(Request $request)
    {
        // 1. Validate the incoming request
        $request->validate([
            'resource_id' => 'required|exists:resources,id'
        ]);

        $user = auth()->user();
        $resource = Resource::findOrFail($request->resource_id);

        // 2. Perform the Level 2 System Validation Check
        $isGranted = $user->hasAccessTo($resource->min_tier_weight);
        $status = $isGranted ? 'granted' : 'denied';

        // 3. Automatic Audit Logging
        ResourceUsageLog::create([
            'user_id' => $user->id,
            'resource_id' => $resource->id,
            'access_status' => $status
        ]);

        // 4. Return to the dashboard with the result
        if ($isGranted) {
            return back()->with('success', 'ACCESS GRANTED: Welcome to ' . $resource->name);
        } else {
            return back()->with('error', 'ACCESS DENIED: Your membership tier does not permit access to ' . $resource->name);
        }
    }
}