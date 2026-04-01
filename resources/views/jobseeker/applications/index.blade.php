@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
    <div class="flex items-start justify-between gap-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Applications</h1>
            <p class="mt-1 text-sm text-gray-500">Track your job applications and their current status.</p>
        </div>
        <a href="{{ route('jobseeker.jobs.index') }}"
            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
            Browse Jobs
        </a>
    </div>

    @if($applications->isEmpty())
        <div class="mt-6 rounded-2xl border border-gray-200 bg-white p-10 text-center">
            <div class="text-lg font-semibold text-gray-900">No applications yet</div>
            <p class="mt-1 text-sm text-gray-600">When you apply for jobs, they’ll show up here.</p>
            <a href="{{ route('jobseeker.jobs.index') }}"
                class="mt-5 inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Browse jobs
            </a>
        </div>
    @else
        <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Job
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Location
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Applied
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Status
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($applications as $application)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <a href="{{ route('jobseeker.jobs.show', $application->job) }}"
                                        class="font-semibold text-gray-900 hover:text-blue-700">
                                        {{ $application->job->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $application->job->location ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $application->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $status = $application->status;
                                        $badge = match ($status) {
                                            'pending' => 'bg-yellow-50 text-yellow-800 border-yellow-200',
                                            'accepted' => 'bg-green-50 text-green-800 border-green-200',
                                            'rejected' => 'bg-red-50 text-red-800 border-red-200',
                                            default => 'bg-gray-50 text-gray-800 border-gray-200',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $badge }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('jobseeker.applications.show', $application) }}"
                                        class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                        View details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection