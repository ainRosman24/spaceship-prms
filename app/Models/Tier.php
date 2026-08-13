<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight',
    ];

    /**
     * Relationship: A Tier has many Users (Passengers)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}