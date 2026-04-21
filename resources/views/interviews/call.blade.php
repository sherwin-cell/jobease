<div id="root" style="width:100%; height:100vh;"></div>

<!-- Zego SDK must be loaded first -->
<script src="https://cdn.jsdelivr.net/npm/@zegocloud/zego-uikit-prebuilt@latest"></script>
<!-- Your custom script must come after -->
<script>
const kitToken = "{{ $kitToken }}";
const appID = {{ $appID }};
const userID = "{{ $userID }}";
const userName = "{{ $userName }}";
const roomID = "{{ $roomID }}";

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
</script>