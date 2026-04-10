@extends('layouts.app')

@section('title', 'Live Skill Q&A Call')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex items-start justify-between gap-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Live Skill Q&amp;A</h1>
                <p class="mt-1 text-sm text-gray-500">
                    Session #{{ $session->id }} • Channel: <span class="font-semibold">{{ $session->agora_channel_name }}</span>
                </p>
            </div>
            <div class="text-sm text-gray-500">
                Role: <span class="font-semibold text-gray-900">{{ $role }}</span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-4">
            <div class="lg:col-span-3 rounded-2xl border border-gray-200 bg-white p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="rounded-xl bg-black/90 aspect-video overflow-hidden relative">
                        <div id="local-player" class="w-full h-full"></div>
                        <div class="absolute left-3 bottom-3 text-xs bg-black/60 text-white px-2 py-1 rounded">You</div>
                    </div>
                    <div class="rounded-xl bg-black/90 aspect-video overflow-hidden relative">
                        <div id="remote-player" class="w-full h-full"></div>
                        <div class="absolute left-3 bottom-3 text-xs bg-black/60 text-white px-2 py-1 rounded">Remote</div>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap items-center gap-2">
                    <button id="btn-join" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                        Join
                    </button>
                    <button id="btn-leave" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-800 border border-gray-200 hover:bg-gray-50 transition">
                        Leave
                    </button>
                    <button id="btn-camera" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-800 border border-gray-200 hover:bg-gray-50 transition">
                        Camera: on
                    </button>
                    <button id="btn-mic" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-800 border border-gray-200 hover:bg-gray-50 transition">
                        Mic: on
                    </button>
                    <button id="btn-screen" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-800 border border-gray-200 hover:bg-gray-50 transition">
                        Share screen
                    </button>
                </div>

                <div id="call-status" class="mt-3 text-sm text-gray-600"></div>
            </div>

            <div class="lg:col-span-1 rounded-2xl border border-gray-200 bg-white p-4">
                <div class="font-semibold text-gray-900">Chat</div>
                <div id="chat-messages" class="mt-3 h-72 overflow-auto space-y-2 text-sm"></div>
                <form id="chat-form" class="mt-3 flex gap-2">
                    <input id="chat-input" class="flex-1 border rounded-lg px-3 py-2 text-sm" placeholder="Type a message..." autocomplete="off" />
                    <button class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition" type="submit">
                        Send
                    </button>
                </form>
                <div class="mt-2 text-xs text-gray-500">
                    (Chat wiring uses broadcasting; we’ll connect it next.)
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        import AgoraRTC from 'agora-rtc-sdk-ng';

        const statusEl = document.getElementById('call-status');
        const btnJoin = document.getElementById('btn-join');
        const btnLeave = document.getElementById('btn-leave');
        const btnCam = document.getElementById('btn-camera');
        const btnMic = document.getElementById('btn-mic');
        const btnScreen = document.getElementById('btn-screen');

        const sessionId = {{ (int) $session->id }};
        const tokenUrl = `{{ route('live-skill-qa.token', $session) }}`;

        const client = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' });
        let localTracks = { audio: null, video: null };
        let screenTrack = null;
        let joined = false;

        function setStatus(msg) {
            if (statusEl) statusEl.textContent = msg;
        }

        client.on('user-published', async (user, mediaType) => {
            await client.subscribe(user, mediaType);
            if (mediaType === 'video') {
                user.videoTrack.play('remote-player');
            }
            if (mediaType === 'audio') {
                user.audioTrack.play();
            }
        });

        client.on('user-unpublished', (user, mediaType) => {
            if (mediaType === 'video') {
                const el = document.getElementById('remote-player');
                if (el) el.innerHTML = '';
            }
        });

        btnJoin?.addEventListener('click', async () => {
            if (joined) return;
            setStatus('Joining...');

            const res = await fetch(tokenUrl, { headers: { 'Accept': 'application/json' } });
            if (!res.ok) {
                setStatus('Failed to fetch Agora token. Check AGORA_APP_ID/AGORA_APP_CERTIFICATE.');
                return;
            }
            const data = await res.json();

            await client.join(data.appId, data.channel, data.token, data.uid);
            localTracks.audio = await AgoraRTC.createMicrophoneAudioTrack();
            localTracks.video = await AgoraRTC.createCameraVideoTrack();
            localTracks.video.play('local-player');
            await client.publish([localTracks.audio, localTracks.video]);

            joined = true;
            setStatus('Connected.');
        });

        btnLeave?.addEventListener('click', async () => {
            if (!joined) return;
            setStatus('Leaving...');
            if (screenTrack) {
                await client.unpublish(screenTrack);
                screenTrack.close();
                screenTrack = null;
            }
            if (localTracks.video) { localTracks.video.close(); localTracks.video = null; }
            if (localTracks.audio) { localTracks.audio.close(); localTracks.audio = null; }
            await client.leave();
            joined = false;
            setStatus('Left.');
        });

        btnCam?.addEventListener('click', async () => {
            if (!localTracks.video) return;
            const enabled = localTracks.video.isEnabled;
            await localTracks.video.setEnabled(!enabled);
            btnCam.textContent = `Camera: ${!enabled ? 'on' : 'off'}`;
        });

        btnMic?.addEventListener('click', async () => {
            if (!localTracks.audio) return;
            const enabled = localTracks.audio.isEnabled;
            await localTracks.audio.setEnabled(!enabled);
            btnMic.textContent = `Mic: ${!enabled ? 'on' : 'off'}`;
        });

        btnScreen?.addEventListener('click', async () => {
            if (!joined) return;
            if (screenTrack) {
                await client.unpublish(screenTrack);
                screenTrack.close();
                screenTrack = null;
                btnScreen.textContent = 'Share screen';
                return;
            }
            screenTrack = await AgoraRTC.createScreenVideoTrack();
            await client.publish(screenTrack);
            btnScreen.textContent = 'Stop sharing';
        });
    </script>
@endsection

