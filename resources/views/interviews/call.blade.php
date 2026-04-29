<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Video Interview - Jobease</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Full screen container */
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
        }
        
        /* Main container - full viewport */
        #root {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #1a1a1a;
        }
        
        /* Ensure Zego UI fills container properly */
        .zego-container {
            width: 100% !important;
            height: 100% !important;
        }
        
        /* Optional: Add loading indicator */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #1a1a1a;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #333;
            border-top-color: #4CAF50;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: white;
            font-size: 16px;
            margin-top: 20px;
        }
        
        /* Mobile optimizations */
        @media (max-width: 768px) {
            .loading-text {
                font-size: 14px;
            }
        }
        
        /* Landscape mode on mobile */
        @media (orientation: landscape) and (max-height: 600px) {
            .loading-screen {
                padding: 10px;
            }
            .loading-spinner {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div id="root"></div>

    <script src="https://unpkg.com/@zegocloud/zego-uikit-prebuilt/zego-uikit-prebuilt.js"></script>
    
    <script>
        // Show loading indicator
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'loading-screen';
        loadingDiv.innerHTML = `
            <div style="text-align: center;">
                <div class="loading-spinner"></div>
                <div class="loading-text">Initializing video call...</div>
            </div>
        `;
        document.body.appendChild(loadingDiv);
        
        function initZego() {
            if (typeof ZegoUIKitPrebuilt === 'undefined') {
                setTimeout(initZego, 200);
                return;
            }
            
            try {
                const appID = {{ $appID }};
                const serverSecret = "ce03ae3dcd79230ca20ec00a5faa7ec2";
                const roomID = "{{ $roomID }}";
                const userID = "{{ $userID }}";
                const userName = "{{ $userName }}";
                
                console.log("Initializing video call...");
                
                // Generate token
                const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(
                    appID, serverSecret, roomID, userID, userName
                );
                
                // Create instance
                const zp = ZegoUIKitPrebuilt.create(kitToken);
                
                // Remove loading screen
                loadingDiv.style.opacity = '0';
                setTimeout(() => loadingDiv.remove(), 500);
                
                // Join room with responsive config
                zp.joinRoom({
                    container: document.getElementById("root"),
                    scenario: {
                        mode: ZegoUIKitPrebuilt.VideoConference,
                    },
                    // Responsive layout settings
                    layout: 'auto',
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
                    // Optimize for mobile
                    videoQuality: 'auto',
                    audioQuality: 'auto',
                });
                
                console.log("Video call started!");
                
            } catch (error) {
                console.error("Error:", error);
                loadingDiv.innerHTML = `
                    <div style="text-align: center; padding: 20px;">
                        <div style="color: #ff6b6b; font-size: 48px; margin-bottom: 20px;">❌</div>
                        <div class="loading-text" style="color: #ff6b6b;">Failed to start video call</div>
                        <div style="color: #ccc; margin-top: 10px; font-size: 14px;">${error.message}</div>
                        <button onclick="location.reload()" style="margin-top: 20px; padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Retry
                        </button>
                    </div>
                `;
            }
        }
        
        // Handle window resize for responsive updates
        window.addEventListener('resize', function() {
            const root = document.getElementById('root');
            if (root) {
                root.style.width = window.innerWidth + 'px';
                root.style.height = window.innerHeight + 'px';
            }
        });
        
        // Start initialization
        initZego();
    </script>
</body>
</html>