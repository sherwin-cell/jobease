@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')
    <div class="container mt-4">

        <!-- Welcome Section -->
        <div class="p-4 mb-4 rounded" style="background-color:#0d6efd; color:white;">
            <h2 class="fw-bold">Welcome, {{ auth()->user()->name }} 👋</h2>
            <p class="mb-0 fs-5">
                Manage your profile, browse jobs, and track your applications easily.
            </p>
        </div>

        <!-- Simple Actions -->
        <!-- Simple Actions Card -->
        <div class="row mt-3">

            <!-- Edit Profile -->
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">Edit Profile</h5>
                        <p class="text-muted">Update your personal information.</p>
                        <a href="{{ route('jobseeker.profile.create') }}" class="btn btn-primary w-100">
                            Go to Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Browse Jobs -->
            <div class="padding col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5 class="fw-bold">Browse Jobs</h5>
                        <p class="text-muted">Explore available job opportunities.</p>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="btn btn-primary w-100">
                            View Jobs
                        </a>
                    </div>
                </div>
            </div>

            <!-- My Applications -->
            <div class="padding col-md-4 mb-3">
                <a href="{{ route('jobseeker.applications.index') }}" class="text-decoration-none">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-dark">My Applications</h5>
                            <p class="text-muted">Check the status of your applications.</p>
                            <span class="btn btn-dark w-100">
                                View Applications
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@endsection