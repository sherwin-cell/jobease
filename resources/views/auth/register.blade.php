<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
        @error('name')<div>{{ $message }}</div>@enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email')<div>{{ $message }}</div>@enderror

        <input type="password" name="password" placeholder="Password" required>
        @error('password')<div>{{ $message }}</div>@enderror

        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

        <select name="role_id" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                </option>
            @endforeach
        </select>
        @error('role_id')<div>{{ $message }}</div>@enderror

        <button type="submit">Register</button>
    </form>
</body>
</html>