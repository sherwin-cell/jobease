let client, localTracks = {}, localScreenTrack;
const remoteUsers = {};

async function fetchToken() {
    const sessionId = window.AgoraConfig.channel;
    const response = await fetch(`/live-skill-qa/session/${sessionId}/token`);
    const data = await response.json();
    window.AgoraConfig.token = data.token;
    window.AgoraConfig.uid = data.uid;
}

async function startCall() {
    await fetchToken();
    client = AgoraRTC.createClient({ mode: "rtc", codec: "vp8" });
    await client.join(
        window.AgoraConfig.appId,
        window.AgoraConfig.channel,
        window.AgoraConfig.token,
        Number(window.AgoraConfig.uid)
    );

    localTracks.audio = await AgoraRTC.createMicrophoneAudioTrack();
    localTracks.video = await AgoraRTC.createCameraVideoTrack();
    localTracks.video.play('local-stream');
    await client.publish(Object.values(localTracks));

    client.on("user-published", async (user, mediaType) => {
        await client.subscribe(user, mediaType);
        if (mediaType === "video") {
            let remotePlayer = document.createElement("div");
            remotePlayer.id = `remote-player-${user.uid}`;
            remotePlayer.style.width = "320px";
            remotePlayer.style.height = "240px";
            document.getElementById('remote-streams').appendChild(remotePlayer);
            user.videoTrack.play(remotePlayer);
        }
        if (mediaType === "audio") {
            user.audioTrack.play();
        }
    });

    client.on("user-unpublished", user => {
        let remotePlayer = document.getElementById(`remote-player-${user.uid}`);
        if (remotePlayer) remotePlayer.remove();
    });
}

document.getElementById('mic-btn').onclick = () => {
    localTracks.audio.setEnabled(!localTracks.audio.enabled);
};
document.getElementById('cam-btn').onclick = () => {
    localTracks.video.setEnabled(!localTracks.video.enabled);
};
document.getElementById('screen-btn').onclick = async () => {
    if (!localScreenTrack) {
        localScreenTrack = await AgoraRTC.createScreenVideoTrack();
        await client.unpublish(localTracks.video);
        await client.publish(localScreenTrack);
        localScreenTrack.play('local-stream');
    } else {
        await client.unpublish(localScreenTrack);
        await client.publish(localTracks.video);
        localTracks.video.play('local-stream');
        localScreenTrack = null;
    }
};
document.getElementById('leave-btn').onclick = async () => {
    await client.leave();
    document.getElementById('video-call-container').style.display = 'none';
    document.getElementById('feedback-modal').style.display = 'block';
};

window.onload = startCall;
