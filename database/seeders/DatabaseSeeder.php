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
        Role::firstOrCreate(['name' => 'job_seeker']);
        Role::firstOrCreate(['name' => 'employer']);
        Role::firstOrCreate(['name' => 'admin']);

        // No dummy users created here
    }
}