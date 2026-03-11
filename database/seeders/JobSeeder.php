<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Skill;

class JobSeeder extends Seeder
{
    public function run()
    {
        $skills = Skill::pluck('id')->all(); // get all skill IDs

        Job::factory(50)->create()->each(function ($job) use ($skills) {
            $job->skills()->attach(collect($skills)->random(rand(1, 5))->toArray());
        });
    }
}