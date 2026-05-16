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

    <script>
        const loadingDiv = document.getElementById('loadingDiv');

        function showError(title, message) {
            loadingDiv.innerHTML = `
                <div style="text-align: center; padding: 20px;">
                    <div style="color: #ff6b6b; font-size: 48px; margin-bottom: 20px;">❌</div>
                    <div class="loading-text" style="color: #ff6b6b;">${title}</div>
                    <div style="color: #ccc; margin-top: 10px; font-size: 14px;">${message}</div>
                    <button onclick="location.reload()" style="margin-top: 20px; padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                        Retry
                    </button>
                </div>
            `;
        }

        function loadScript(src) {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }

        async function loadZegoLibrary() {
            const cdnUrls = [
                'https://unpkg.com/@zegocloud/zego-uikit-prebuilt@2.6.0/dist/index.js',
                'https://cdn.jsdelivr.net/npm/@zegocloud/zego-uikit-prebuilt@2.6.0/dist/index.js',
                'https://cdn.jsdelivr.net/npm/@zegocloud/zego-uikit-prebuilt/dist/index.js',
            ];

            for (const url of cdnUrls) {
                try {
                    loadingDiv.querySelector('.loading-text').textContent = 'Loading video library...';
                    await loadScript(url);
                    console.log('ZegoCloud loaded from:', url);
                    return true;
                } catch (e) {
                    console.warn('Failed CDN:', url);
                }
            }
            return false;
        }

        function initZego() {
            try {
                const kitToken = "{{ $kitToken }}";
                const roomID   = "{{ $roomID }}";

                if (!kitToken) {
                    showError('Token Error', 'Kit token is missing. Please try again.');
                    return;
                }

                loadingDiv.querySelector('.loading-text').textContent = 'Connecting to room...';

                const zp = ZegoUIKitPrebuilt.create(kitToken);

                if (!zp) {
                    showError('Connection Failed', 'Could not create video instance.');
                    return;
                }

                loadingDiv.style.opacity = '0';
                loadingDiv.style.transition = 'opacity 0.5s';
                setTimeout(() => loadingDiv.remove(), 500);

                zp.joinRoom({
                    container: document.getElementById('root'),
                    scenario: { mode: ZegoUIKitPrebuilt.VideoConference },
                    layout: 'Auto',
                    showPreJoinView: true,
                    turnOnMicrophoneWhenJoining: true,
                    turnOnCameraWhenJoining: true,
                    showMyCameraToggleButton: true,
                    showMyMicrophoneToggleButton: true,
                    showAudioVideoSettingsButton: true,
                    showScreenSharingButton: true,
                    showTextChat: true,
                    showUserList: true,
                    showRemoveUserButton: false,
                    maxUsers: 2,
                    videoQuality: 3,
                    audioQuality: 3,
                });

                console.log('Video call started!');

            } catch (error) {
                console.error('initZego error:', error);
                showError('Failed to start video call', error.message);
            }
        }

        // Load library then init
        loadZegoLibrary().then(loaded => {
            if (loaded) {
                initZego();
            } else {
                showError('Failed to load video library', 'All CDN sources failed. Please check your internet connection.');
            }
        });
    </script>
</body>
</html>