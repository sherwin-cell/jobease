@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Manage Users</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Name</th>
                <th class="p-2">Email</th>
                <th class="p-2">Role</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr class="border-t">
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->role_id }}</td>
                    <td class="p-2">
                        @if($user->is_banned)
                            <span class="text-red-500">Banned</span>
                        @else
                            <span class="text-green-500">Active</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection