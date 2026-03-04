@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}</h1>

<p>This is your Admin Dashboard.</p>
@endsection