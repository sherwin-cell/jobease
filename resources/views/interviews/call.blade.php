<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Video Interview - Jobease</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%; height: 100%;
            overflow: hidden; position: fixed;
            top: 0; left: 0;
        }

        #root {
            position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: #1a1a1a;
        }

        .loading-screen {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            background: #1a1a1a;
            display: flex; justify-content: center; align-items: center;
            z-index: 9999;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .loading-spinner {
            width: 50px; height: 50px;
            border: 4px solid #333;
            border-top-color: #4CAF50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .loading-text { color: white; font-size: 16px; margin-top: 20px; }

        @media (max-width: 768px) { .loading-text { font-size: 14px; } }
    </style>
</head>

<body>
    <div id="root"></div>

    <div class="loading-screen" id="loadingDiv">
        <div style="text-align: center;">
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading video library...</div>
        </div>
    </div>

    <script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>

    <script>
        const loadingDiv = document.getElementById('loadingDiv');

        function showError(title, message) {
            loadingDiv.innerHTML = `
                <div style="text-align: center; padding: 20px;">
                    <div style="color: #ff6b6b; font-size: 48px; margin-bottom: 20px;">❌</div>
                    <div class="loading-text" style="color: #ff6b6b;">${title}</div>
                    <div style="color: #ccc; margin-top: 10px; font-size: 14px;">${message}</div>
                    <button onclick="location.reload()" style="margin-top: 20px; padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Retry
                    </button>
                </div>
            `;
        }

        function initZego() {
            try {
                const appID      = {{ $appID }};
                const serverSecret = "{{ $serverSecret ?? env('ZEGO_SERVER_SECRET') }}";
                const roomID     = "{{ $roomID }}";
                const userID     = "{{ $userID }}";
                const userName   = "{{ $userName }}";

                // Generate token directly in browser (test mode)
                const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(
                    appID,
                    serverSecret,
                    roomID,
                    userID,
                    userName
                );

                const zp = ZegoUIKitPrebuilt.create(kitToken);

                loadingDiv.style.opacity = '0';
                loadingDiv.style.transition = 'opacity 0.5s';
                setTimeout(() => loadingDiv.remove(), 500);

                zp.joinRoom({
                    container: document.getElementById('root'),
                    scenario: { mode: ZegoUIKitPrebuilt.VideoConference },
                    showPreJoinView: true,
                    turnOnMicrophoneWhenJoining: true,
                    turnOnCameraWhenJoining: true,
                    showMyCameraToggleButton: true,
                    showMyMicrophoneToggleButton: true,
                    showAudioVideoSettingsButton: true,
                    showScreenSharingButton: true,
                    showTextChat: true,
                    showUserList: true,
                    maxUsers: 2,
                });

            } catch (error) {
                console.error('initZego error:', error);
                showError('Failed to start video call', error.message);
            }
        }

        // Wait for script to load
        window.addEventListener('load', function() {
            if (typeof ZegoUIKitPrebuilt !== 'undefined') {
                initZego();
            } else {
                showError('Failed to load video library', 'Please check your internet connection.');
            }
        });
    </script>
</body>
</html>