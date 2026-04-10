@extends('layouts.app')

@section('title', $skillQuestion->title)

@section('content')
<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-white rounded shadow p-6 mb-6">
        <h1 class="text-2xl font-bold mb-2">{{ $skillQuestion->title }}</h1>
        <div class="text-gray-500 text-sm mb-2">
            Asked by {{ $skillQuestion->user->name }} • {{ $skillQuestion->created_at->diffForHumans() }}
            <span class="ml-2">Skill: <span class="font-semibold">{{ $skillQuestion->skill->name }}</span></span>
        </div>
        <div class="mb-2">
            @foreach($skillQuestion->tags as $tag)
                <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full mr-1">{{ $tag->name }}</span>
            @endforeach
        </div>
        <div class="text-gray-800 mb-4">{!! nl2br(e($skillQuestion->body)) !!}</div>
    </div>

    <div class="mb-6">
        <div class="flex items-center justify-between gap-4 mb-2">
            <h2 class="text-lg font-semibold">Answers (<span id="answers-count">{{ $skillQuestion->answers->count() }}</span>)</h2>
        </div>

        <div id="answers-list" data-skill-question-id="{{ $skillQuestion->id }}">
            @forelse($skillQuestion->answers as $answer)
                <div class="bg-gray-50 rounded p-4 mb-3" data-answer-id="{{ $answer->id }}">
                    <div class="text-gray-700">{!! nl2br(e($answer->body)) !!}</div>
                    <div class="text-xs text-gray-500 mt-2">Answered by {{ $answer->user->name }} • {{ $answer->created_at->diffForHumans() }}</div>
                </div>
            @empty
                <div id="answers-empty" class="text-gray-400">No answers yet. Be the first to answer!</div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h3 class="text-lg font-semibold mb-2">Your Answer</h3>
        <form method="POST" action="{{ route('skill-qa.answer.store', $skillQuestion) }}">
            @csrf
            <textarea name="body" class="w-full border rounded px-3 py-2 mb-2" rows="4" required>{{ old('body') }}</textarea>
            @error('body')<div class="text-red-600 text-xs mb-2">{{ $message }}</div>@enderror
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Post Answer</button>
        </form>
    </div>
</div>

<script type="module">
    const listEl = document.getElementById('answers-list');
    const countEl = document.getElementById('answers-count');
    const emptyEl = document.getElementById('answers-empty');

    if (listEl && window.Echo) {
        const skillQuestionId = listEl.dataset.skillQuestionId;

        window.Echo.private(`skill-question.${skillQuestionId}`)
            .listen('.skill.answer.posted', (e) => {
                if (!e?.answer?.id) return;
                if (listEl.querySelector(`[data-answer-id="${e.answer.id}"]`)) return;

                if (emptyEl) emptyEl.remove();

                const wrapper = document.createElement('div');
                wrapper.className = 'bg-gray-50 rounded p-4 mb-3';
                wrapper.dataset.answerId = e.answer.id;

                const body = (e.answer.body ?? '').toString()
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/\n/g, '<br>');

                const userName = (e.answer.user?.name ?? 'Unknown').toString()
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');

                const createdHuman = (e.answer.created_at_human ?? 'just now').toString()
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');

                wrapper.innerHTML = `
                    <div class="text-gray-700">${body}</div>
                    <div class="text-xs text-gray-500 mt-2">Answered by ${userName} • ${createdHuman}</div>
                `;

                listEl.prepend(wrapper);

                const current = parseInt(countEl?.textContent ?? '0', 10);
                if (countEl && Number.isFinite(current)) countEl.textContent = String(current + 1);
            });
    }
</script>
@endsection
