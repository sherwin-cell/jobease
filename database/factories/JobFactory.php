<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\Models\Employer;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'employer_id' => \App\Models\User::where('role_id', 2)->inRandomOrder()->first()->id
                ?? \App\Models\User::factory()->create(['role_id' => 2])->id,
            'location' => $this->faker->city(),
            'salary' => $this->faker->numberBetween(20000, 100000),
        ];
    }
}