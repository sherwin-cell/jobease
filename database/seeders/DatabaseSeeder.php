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
        // -----------------------------
        // 1️⃣ Create Roles
        // -----------------------------
        $jobSeekerRole = Role::firstOrCreate(['name' => 'job_seeker']);
        $employerRole  = Role::firstOrCreate(['name' => 'employer']);
        $adminRole     = Role::firstOrCreate(['name' => 'admin']);

        // -----------------------------
        // 2️⃣ Create Test Users
        // -----------------------------
        User::factory()->create([
            'name' => 'Test Job Seeker',
            'email' => 'jobseeker@example.com',
            'role_id' => $jobSeekerRole->id,
            'password' => bcrypt('password123'), // default test password
        ]);

        User::factory()->create([
            'name' => 'Test Employer',
            'email' => 'employer@example.com',
            'role_id' => $employerRole->id,
            'password' => bcrypt('password123'),
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id,
            'password' => bcrypt('admin123'),
        ]);
    }
}