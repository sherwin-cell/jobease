<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Get or create admin role, ensuring it has ID 3
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['id' => 3]
        );

        // Ensure role has ID 3
        if ($adminRole->id != 3) {
            $adminRole->id = 3;
            $adminRole->save();
        }

        // Check if admin already exists before creating
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3, // Directly use ID 3
                'email_verified_at' => now(),
            ]);
        }
    }
}