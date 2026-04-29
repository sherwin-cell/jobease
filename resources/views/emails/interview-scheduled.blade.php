<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
        }
        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .info {
            background-color: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>Interview Scheduled</h2>

    <p>Your interview has been scheduled.</p>

    <div class="info">
        <p><strong>Date & Time:</strong> {{ \Carbon\Carbon::parse($session->scheduled_at)->format('l, F j, Y g:i A') }}</p>
        <p><strong>Room ID:</strong> {{ $session->room_id }}</p>
    </div>

    <p>
        <a href="{{ route('interviews.call', $session->id) }}" class="btn">
            Join Interview Room
        </a>
    </p>

    <p>Please prepare and join on time.</p>
</body>
</html>