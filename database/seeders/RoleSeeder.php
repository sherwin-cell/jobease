<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::truncate();

        Role::insert([
            ['name' => 'Job Seeker'],
            ['name' => 'Employer'],
            ['name' => 'Admin'],
        ]);
    }
}