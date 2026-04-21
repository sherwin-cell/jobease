@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Complete Your Profile</h1>
    <p>Please complete your profile to access the dashboard.</p>
    <a href="{{ route('employer.profile.edit') }}" class="btn btn-primary">Complete Profile</a>
</div>
@endsection