@extends('layouts.app')

@section('content')
<div id="video-call-container">
    <div id="local-stream" style="width: 320px; height: 240px; background: #222;"></div>
    <div id="remote-streams"></div>
    <div>
        <button id="mic-btn">Mic On/Off</button>
        <button id="cam-btn">Camera On/Off</button>
        <button id="screen-btn">Share Screen</button>
        <button id="leave-btn">Leave</button>
    </div>
    <div id="chat-container">
        <!-- Real-time chat UI here (reuse your Pusher chat) -->
    </div>
</div>
<div id="feedback-modal" style="display:none;">
    <form id="feedback-form">
        <label>Rate the session:</label>
        <select name="rating">
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Good</option>
            <option value="3">3 - Okay</option>
            <option value="2">2 - Poor</option>
            <option value="1">1 - Bad</option>
        </select>
        <textarea name="feedback" placeholder="Your feedback"></textarea>
        <button type="submit">Submit</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script>
    window.AgoraConfig = {
        appId: "{{ config('services.agora.app_id') }}",
        channel: "{{ $session->agora_channel_name }}",
        token: "", // Will be fetched via AJAX
        uid: "{{ auth()->id() }}"
    };
</script>
<script src="{{ asset('js/qa-video-call.js') }}"></script>
@endsection
