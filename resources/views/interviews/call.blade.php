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
        html,
        body {
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
            to {
                transform: rotate(360deg);
            }
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

    <script src="https://cdn.jsdelivr.net/npm/@zegocloud/zego-uikit-prebuilt@2.6.0/dist/index.js"></script>

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

        // Track if library loaded
        let libraryLoadAttempts = 0;
        const maxAttempts = 30; // 30 attempts = 6 seconds (200ms each)

        function checkLibraryLoaded() {
            if (typeof ZegoUIKitPrebuilt !== 'undefined' && ZegoUIKitPrebuilt) {
                console.log("ZegoUIKitPrebuilt loaded successfully");
                initZego();
                return true;
            }

            libraryLoadAttempts++;
            if (libraryLoadAttempts >= maxAttempts) {
                console.error("Failed to load ZegoUIKitPrebuilt library");
                loadingDiv.innerHTML = `
                <div style="text-align: center; padding: 20px;">
                    <div style="color: #ff6b6b; font-size: 48px; margin-bottom: 20px;">❌</div>
                    <div class="loading-text" style="color: #ff6b6b;">Failed to load video library</div>
                    <div style="color: #ccc; margin-top: 10px; font-size: 14px;">Please check your internet connection</div>
                    <button onclick="location.reload()" style="margin-top: 20px; padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Retry
                    </button>
                </div>
            `;
                return false;
            }

            setTimeout(checkLibraryLoaded, 200);
            return false;
        }

        function initZego() {
            try {
                console.log("Initializing video call...");
                console.log("ZegoUIKitPrebuilt available:", typeof ZegoUIKitPrebuilt);

                // Use the pre-generated token from Laravel backend
                const kitToken = "{{ $kitToken }}";
                const roomID = "{{ $roomID }}";

                if (!kitToken || kitToken === "") {
                    throw new Error("Kit token is empty");
                }

                // Create instance directly with the pre-generated token
                const zp = ZegoUIKitPrebuilt.create(kitToken);

                if (!zp) {
                    throw new Error("Failed to create ZegoUIKitPrebuilt instance");
                }

                // Remove loading screen
                loadingDiv.style.opacity = '0';
                setTimeout(() => loadingDiv.remove(), 500);

                // Join room with responsive config
                zp.joinRoom({
                    container: document.getElementById("root"),
                    scenario: {
                        mode: ZegoUIKitPrebuilt.VideoConference,
                    },
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

                console.log("Video call started!");

            } catch (error) {
                console.error("Error in initZego:", error);
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

        // Start checking for library
        checkLibraryLoaded();
    </script>
</body>

</html>