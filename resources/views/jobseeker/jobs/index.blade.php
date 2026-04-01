@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-between gap-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Browse Jobs</h1>
            <p class="mt-1 text-sm text-gray-500">
                Filter jobs by experience and quickly see your skill match.
            </p>
        </div>
        <a href="{{ route('jobseeker.profile.show') }}"
            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
            My Profile
        </a>
    </div>

    <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-4">
        <form method="GET" action="{{ route('jobseeker.jobs.index') }}"
            class="grid grid-cols-1 gap-3 md:grid-cols-3 md:items-end">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Experience level</label>
                <select name="experience_level"
                    class="mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Any experience</option>
                    <option value="Junior" @if(request('experience_level') == 'Junior') selected @endif>Junior</option>
                    <option value="Mid" @if(request('experience_level') == 'Mid') selected @endif>Mid</option>
                    <option value="Senior" @if(request('experience_level') == 'Senior') selected @endif>Senior</option>
                </select>
            </div>

            <div class="md:col-span-2 flex gap-2">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                    Apply filters
                </button>
                <a href="{{ route('jobseeker.jobs.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="mt-6 space-y-4">
        @forelse($jobs as $job)
            @php
                $candidate = auth()->user()->profile;
                $candidateSkills = $candidate && $candidate->skills ? collect($candidate->skills) : collect();
                $jobSkills = collect($job->skills_required ?? []);

                $matched = $jobSkills->filter(function ($jobSkill) use ($candidateSkills) {
                    return $candidateSkills->contains(function ($candidateSkill) use ($jobSkill) {
                        return strtolower(trim($candidateSkill)) === strtolower(trim($jobSkill));
                    });
                })->count();

                $match = $jobSkills->count() ? round(($matched / $jobSkills->count()) * 100, 2) : 0;
            @endphp

            <div class="rounded-2xl border border-gray-200 bg-white p-6 hover:shadow-sm transition">
                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                    <div class="min-w-0">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <a href="{{ route('jobseeker.jobs.show', $job) }}" class="hover:text-blue-700">
                                {{ $job->title }}
                            </a>
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ Str::limit($job->description, 170) }}
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-2 text-sm text-gray-600">
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1">
                                📍 {{ $job->location ?? 'N/A' }}
                            </span>
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1">
                                🧭 {{ $job->experience_level ?? 'Any' }}
                            </span>
                            <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-blue-800">
                                🎯 Match: {{ $match }}%
                            </span>
                        </div>

                        <div class="mt-4">
                            <div class="text-xs font-semibold uppercase tracking-wide text-gray-500">Skills required</div>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @if($job->skills_required && count($job->skills_required) > 0)
                                    @foreach($job->skills_required as $skill)
                                        <span class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1 text-sm text-gray-700">
                                            {{ trim($skill) }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-sm text-gray-500">No specific skills required</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex shrink-0 gap-2">
                        <a href="{{ route('jobseeker.jobs.show', $job) }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            View
                        </a>
                        <a href="{{ route('jobseeker.jobs.apply.form', $job) }}"
                            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                            Apply
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-gray-200 bg-white p-10 text-center">
                <div class="text-lg font-semibold text-gray-900">No jobs found</div>
                <p class="mt-1 text-sm text-gray-600">Try resetting filters or check back later.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
@endsection