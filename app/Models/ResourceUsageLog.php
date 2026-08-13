<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceUsageLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resource_id',
        'access_status', // 'granted' or 'denied'
    ];

    /**
     * Relationship: A log entry belongs to a specific User (Passenger)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A log entry belongs to a specific Resource
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}