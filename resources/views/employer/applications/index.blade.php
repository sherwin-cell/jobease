@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Applications for My Jobs</h1>
    @if(session('success'))<div class="text-green-600">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="text-red-600">{{ session('error') }}</div>@endif
    <table class="w-full border">
        <thead>
            <tr class="border-b">
                <th class="text-left p-2">Job</th>
                <th class="text-left p-2">Applicant</th>
                <th class="text-left p-2">Status</th>
                <th class="text-left p-2">Applied</th>
                <th class="text-left p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
            <tr class="border-b">
                <td class="p-2">{{ $app->job->title }}</td>
                <td class="p-2">{{ $app->user->name }} ({{ $app->user->email }})</td>
                <td class="p-2">{{ ucfirst($app->status) }}</td>
                <td class="p-2">{{ $app->created_at->format('M j, Y') }}</td>
                <td class="p-2">
                    <a href="{{ route('employer.applications.show', $app) }}">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="p-4">No applications yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
