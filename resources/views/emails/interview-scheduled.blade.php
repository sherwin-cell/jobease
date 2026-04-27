<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduled</title>
</head>
<body>
    <h2>Interview Scheduled</h2>

    <p>Your interview has been scheduled.</p>

    <p><strong>Date:</strong> {{ $session->scheduled_at }}</p>
    <p><strong>Room:</strong> {{ $session->room_id }}</p>

    <p>
        <a href="{{ route('interviews.call', $session->id) }}">
            Join Interview Room
        </a>
    </p>

    <p>Please prepare and join on time.</p>
</body>
</html>