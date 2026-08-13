<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'tier_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship: A User belongs to one Tier
     */
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    /**
     * Relationship: A User has many usage logs (Audit Trail)
     */
    public function usageLogs()
    {
        return $this->hasMany(ResourceUsageLog::class);
    }

    /**
     * Level 2 Validation: Checks if the user's tier weight 
     * meets or exceeds the required resource weight.
     */
    public function hasAccessTo($resource_min_tier_weight)
    {
        // Crew Leads are administrators and have full system access
        if ($this->role === 'crew_lead') {
            return true;
        }

        // Failsafe: If a passenger somehow has no tier assigned, deny access
        if (!$this->tier) {
            return false;
        }

        // Core Inheritance Logic: Compare weights (e.g., Platinum's 3 >= Silver's 1)
        return $this->tier->weight >= $resource_min_tier_weight;
    }

    /**
     * Helper function to easily check admin status in Middleware or Blade views
     */
    public function isCrewLead()
    {
        return $this->role === 'crew_lead';
    }
}