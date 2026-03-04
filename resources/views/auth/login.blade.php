<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email')<div>{{ $message }}</div>@enderror

        <input type="password" name="password" placeholder="Password" required>
        @error('password')<div>{{ $message }}</div>@enderror

        <button type="submit">Login</button>
    </form>
</body>
</html>