@extends('layouts.app')

@section('title', 'Admin Jobs')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Job Listings</h1>

        <table class="w-full border">
            <thead>
                <tr>
                    <th class="border px-3 py-2">Title</th>
                    <th class="border px-3 py-2">Company</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <!-- Title -->
                        <td class="border px-3 py-2">
                            {{ $job->title }}
                        </td>

                        <!-- Company -->
                        <td class="border px-3 py-2">
                            {{ $job->employer->employerProfile->company_name ?? 'No Company' }}
                        </td>

                        <!-- Status -->
                        <!-- Status -->
                        <td class="border px-3 py-2">
                            @php
                                $statusClasses = [
                                    'active' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'rejected' => 'bg-red-100 text-red-700',
                                ];
                            @endphp

                            <span
                                class="px-2 py-1 text-xs rounded {{ $statusClasses[$job->status] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </td>
                        <td class="border px-3 py-2">
                            <div class="flex gap-2">
                                <!-- APPROVE -->
                                <form method="POST" action="{{ route('admin.jobs.approve', $job->id) }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 text-xs rounded">
                                        Approve
                                    </button>
                                </form>

                                <!-- REJECT -->
                                <form method="POST" action="{{ route('admin.jobs.reject', $job->id) }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 text-xs rounded">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
@endsection