<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Seed Tiers (Inheritance Weights: Silver=1, Gold=2, Platinum=3)
        $tiers = [
            ['name' => 'Silver', 'weight' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Gold', 'weight' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Platinum', 'weight' => 3, 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('tiers')->insert($tiers);

        // 2. Seed Resources (Strictly matching the mission parameters)
        $resources = [
            // Silver Resources (Weight 1)
            ['name' => 'Food Stations', 'min_tier_weight' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sleeping Pods', 'min_tier_weight' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Basic Hygiene', 'min_tier_weight' => 1, 'created_at' => $now, 'updated_at' => $now],
            // Gold Resources (Weight 2)
            ['name' => 'Private Cabins', 'min_tier_weight' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Adv. Medical Bay', 'min_tier_weight' => 2, 'created_at' => $now, 'updated_at' => $now],
            // Platinum Resources (Weight 3)
            ['name' => 'Luxury O2 Pods', 'min_tier_weight' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'VIP Rec Deck', 'min_tier_weight' => 3, 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('resources')->insert($resources);

        // 3. Seed Users (Exactly 3 Crew Leads + Sample Passengers)
        // Default password for all test accounts is 'password123'
        $password = Hash::make('password123'); 
        
        $users = [
            // Administrators: Crew Leads (No tier_id required)
            ['name' => 'Commander Alpha', 'email' => 'alpha@x26.com', 'password' => $password, 'role' => 'crew_lead', 'tier_id' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Lieutenant Beta', 'email' => 'beta@x26.com', 'password' => $password, 'role' => 'crew_lead', 'tier_id' => null, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Officer Gamma', 'email' => 'gamma@x26.com', 'password' => $password, 'role' => 'crew_lead', 'tier_id' => null, 'created_at' => $now, 'updated_at' => $now],
            
            // Standard Passengers
            ['name' => 'Passenger John (Silver)', 'email' => 'john@earth.com', 'password' => $password, 'role' => 'passenger', 'tier_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Passenger Jane (Gold)', 'email' => 'jane@earth.com', 'password' => $password, 'role' => 'passenger', 'tier_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Passenger Elon (Platinum)', 'email' => 'elon@earth.com', 'password' => $password, 'role' => 'passenger', 'tier_id' => 3, 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('users')->insert($users);

        // 4. Seed Audit Logs (Provides initial data for your analytics charts)
        $logs = [
            // John (Silver) accessing Food Station (Valid)
            ['user_id' => 4, 'resource_id' => 1, 'access_status' => 'granted', 'created_at' => $now->copy()->subHours(2), 'updated_at' => $now->copy()->subHours(2)],
            // John (Silver) trying to access Luxury O2 Pod (Invalid - Blocked)
            ['user_id' => 4, 'resource_id' => 6, 'access_status' => 'denied', 'created_at' => $now->copy()->subHour(), 'updated_at' => $now->copy()->subHour()], 
            // Elon (Platinum) accessing Luxury O2 Pod (Valid)
            ['user_id' => 6, 'resource_id' => 6, 'access_status' => 'granted', 'created_at' => $now, 'updated_at' => $now], 
        ];
        DB::table('resource_usage_logs')->insert($logs);
    }
}