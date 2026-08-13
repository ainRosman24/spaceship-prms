<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\CrewLeadController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsCrewLead;

// Root redirect - sends authenticated users to their dashboard, others to login
Route::get('/', function () {
    if (auth()->check()) {
        // Redirect based on user role
        if (auth()->user()->isCrewLead()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('passenger.dashboard');
    }
    return redirect('/login');
});

// All routes require the user to be authenticated
Route::middleware(['auth'])->group(function () {

    //CREW PROFILE (Accessible by ALL users)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // PASSENGER PANEL (Accessible by ALL Passenger)
    Route::prefix('passenger')->name('passenger.')->group(function () {
        // Tab 1 : Terminal Access
        Route::get('/dashboard', [PassengerController::class, 'dashboard'])->name('dashboard');
        // Tab 2 : Usage History
        Route::get('/history', [PassengerController::class, 'history'])->name('history');
        // Tab 3 : Package Overview
        Route::get('/tier', [PassengerController::class, 'tier'])->name('tier');
    });

    // RESOURCE SCANNER (Accessible by ALL users)
    // This handles the real-time access validation and automatic audit logging
    Route::post('/resource/access', [ResourceController::class, 'access'])->name('resource.access');


    // CREW LEAD PANEL (Protected by IsCrewLead)
    Route::middleware([IsCrewLead::class])->prefix('admin')->name('admin.')->group(function () {
        
        // The 4 Separate Dashboard Pages
        Route::get('/dashboard', [CrewLeadController::class, 'dashboard'])->name('dashboard');
        Route::get('/passengers', [CrewLeadController::class, 'passengers'])->name('passengers');
        Route::get('/resources', [CrewLeadController::class, 'resources'])->name('resources');
        Route::get('/logs', [CrewLeadController::class, 'logs'])->name('logs');
        
        // Tier Management
        Route::patch('/users/{user}/update-tier', [CrewLeadController::class, 'updateTier'])->name('users.update_tier');
        
        // Create & Delete Passengers 
        Route::post('/users', [CrewLeadController::class, 'storePassenger'])->name('users.store');
        Route::delete('/users/{user}', [CrewLeadController::class, 'destroyPassenger'])->name('users.destroy');

        // Create & Delete Resources
        Route::post('/resources', [CrewLeadController::class, 'storeResource'])->name('resources.store');
        Route::delete('/resources/{resource}', [CrewLeadController::class, 'destroyResource'])->name('resources.destroy');
    });

});

// This pulls in your login, logout, and registration routes
require __DIR__ . '/auth.php';