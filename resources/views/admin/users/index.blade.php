@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')

    <div style="padding: 24px;">
        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 16px;">Manage Users</h1>

        @if(session('success'))
            <div
                style="background-color: #d1fae5; border: 1px solid #34d399; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div
                style="background-color: #fee2e2; border: 1px solid #f87171; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                {{ session('error') }}
            </div>
        @endif

        <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
            <thead>
                <tr style="background-color: #f3f4f6;">
                    <th style="padding: 8px; border: 1px solid #ddd;">Name</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Email</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Role</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Status</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            {{ $user->name }}
                            @if($user->role_id == 3)
                                <span
                                    style="background-color: #9333ea; color: white; padding: 2px 6px; border-radius: 4px; font-size: 11px;">Admin</span>
                            @endif
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->email }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ ucfirst($user->role_id ?? 'user') }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            @if($user->is_banned)
                                <span style="color: #ef4444;">Banned</span>
                            @else
                                <span style="color: #22c55e;">Active</span>
                            @endif
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd;">
                            @if($user->is_banned)
                                <form action="{{ route('admin.users.unban', $user->id) }}" method="POST"
                                    style="display:inline-block; margin-right:5px;">
                                    @csrf
                                    <button type="submit"
                                        style="background-color:#22c55e; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">
                                        Unban
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.ban', $user->id) }}" method="POST"
                                    style="display:inline-block; margin-right:5px;">
                                    @csrf
                                    <button type="submit"
                                        style="background-color:#f97316; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">
                                        Ban
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Debug Info -->
        <div style="background-color: #f3f4f6; padding: 12px; margin-top: 16px;">
            <strong>Debug:</strong><br>
            @foreach($users as $user)
                {{ $user->name }}: is_banned = {{ $user->is_banned ? 'YES' : 'NO' }}<br>
            @endforeach
        </div>
    </div>

@endsection