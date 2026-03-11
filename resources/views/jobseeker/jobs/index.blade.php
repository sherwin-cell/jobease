@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Job Listings</h1>

        <!-- Filters -->
        <form method="GET" action="{{ route('jobseeker.jobs.index') }}">
            <input type="text" name="location" placeholder="Location" value="{{ request('location') }}">
            <input type="text" name="skills" placeholder="Skills (comma-separated)" value="{{ request('skills') }}">

            <select name="experience_level">
                <option value="">Any experience</option>
                <option value="Junior" @if(request('experience_level') == 'Junior') selected @endif>Junior</option>
                <option value="Mid" @if(request('experience_level') == 'Mid') selected @endif>Mid</option>
                <option value="Senior" @if(request('experience_level') == 'Senior') selected @endif>Senior</option>
            </select>

            <button type="submit">Filter</button>
        </form>

        <hr>

        <!-- Job Listings -->
        @forelse($jobs as $job)
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <h3>
                    <a href="{{ route('jobseeker.jobs.show', $job) }}">
                        {{ $job->title }}
                    </a>
                </h3>

                <p>{{ Str::limit($job->description, 150) }}</p>

                <p>
                    Location: {{ $job->location ?? 'N/A' }} |
                    Experience: {{ $job->experience_level ?? 'Any' }}
                </p>

                <p>
                    Skills Required:
                    @if($job->skills_required && count($job->skills_required) > 0)
                        @foreach($job->skills_required as $skill)
                            <span>{{ trim($skill) }}</span>@if(!$loop->last), @endif
                        @endforeach
                    @else
                        <span>No specific skills required</span>
                    @endif
                </p>

                @php
                    $candidate = auth()->user()->profile;
                    $candidateSkills = $candidate && $candidate->skills ? collect($candidate->skills) : collect();
                    $jobSkills = collect($job->skills_required ?? []);

                    // Count matching skills (case-insensitive)
                    $matched = $jobSkills->filter(function ($jobSkill) use ($candidateSkills) {
                        return $candidateSkills->contains(function ($candidateSkill) use ($jobSkill) {
                            return strtolower(trim($candidateSkill)) === strtolower(trim($jobSkill));
                        });
                    })->count();

                    $match = $jobSkills->count() ? round(($matched / $jobSkills->count()) * 100, 2) : 0;
                @endphp

                <p>Skill Match: {{ $match }}%</p>
            </div>
        @empty
            <p>No jobs found.</p>
        @endforelse

        {{ $jobs->links() }}
    </div>
@endsection