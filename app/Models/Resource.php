<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_tier_weight',
    ];

    /**
     * Relationship: A Resource has many usage logs (Audit Trail)
     */
    public function usageLogs()
    {
        return $this->hasMany(ResourceUsageLog::class);
    }
}