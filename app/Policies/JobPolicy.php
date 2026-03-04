<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function update(User $user, Job $job): bool
    {
        return $job->employer_id === $user->id;
    }

    public function delete(User $user, Job $job): bool
    {
        return $job->employer_id === $user->id;
    }
}
