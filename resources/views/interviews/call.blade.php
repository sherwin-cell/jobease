<div id="root" style="width:100%; height:100vh;"></div>

<script src="https://cdn.jsdelivr.net/npm/@zegocloud/zego-uikit-prebuilt@latest"></script>

<script>
window.onload = async function () {
    if (!window.ZegoUIKitPrebuilt) {
        console.error("Zego SDK not loaded");
        return;
    }

    try {
        // ✅ METHOD 1: For production test - generate token on the fly
        const appID = 948409277;  // REPLACE with your actual App ID
        const serverSecret = "ce03ae3dcd79230ca20ec00a5faa7ec2";  // REPLACE with your secret
        
        const kitToken = ZegoUIKitPrebuilt.generateKitTokenForTest(
            appID,
            serverSecret,
            "test_room_" + Date.now(),  // roomID
            "user_" + Date.now(),       // userID
            "Test User"                 // userName
        );
        
        // ✅ METHOD 2: If you already have a valid token string (one line only)
        // const kitToken = "your-valid-single-line-token-here";

        const zp = ZegoUIKitPrebuilt.create(kitToken);

        zp.joinRoom({
            container: document.querySelector("#root"),
            scenario: {
                mode: ZegoUIKitPrebuilt.VideoConference,
            },
            turnOnMicrophoneWhenJoining: true,
            turnOnCameraWhenJoining: true,
            showMyCameraToggleButton: true,
            showMyMicrophoneToggleButton: true,
            showUserList: true,
        });

    } catch (e) {
        console.error("Zego init failed:", e);
    }
};
</script>