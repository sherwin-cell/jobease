<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles with specific IDs to ensure consistency with middleware
        Role::firstOrCreate(
            ['id' => 1, 'name' => 'job_seeker']
        );
        
        Role::firstOrCreate(
            ['id' => 2, 'name' => 'employer']
        );
        
        Role::firstOrCreate(
            ['id' => 3, 'name' => 'admin']
        );

        // No dummy users created here
    }
}