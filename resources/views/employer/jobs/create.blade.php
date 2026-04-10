@extends('layouts.app')

@section('title', isset($job) ? 'Edit Job' : 'Create Job')

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">
            {{ isset($job) ? 'Edit Job' : 'Create Job' }}
        </h1>

        <form action="{{ isset($job) ? route('employer.jobs.update', $job) : route('employer.jobs.store') }}" method="POST"
            class="space-y-4">
            @csrf
            @if(isset($job)) @method('PUT') @endif

            <!-- Job Title -->
            <div>
                <label class="block font-medium mb-1">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}"
                    class="w-full border rounded p-2 @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="5"
                    class="w-full border rounded p-2 @error('description') border-red-500 @enderror"
                    required>{{ old('description', $job->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location & Salary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Location</label>
                    <input type="text" name="location" value="{{ old('location', $job->location ?? '') }}"
                        class="w-full border rounded p-2 @error('location') border-red-500 @enderror" required>
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium mb-1">Salary</label>
                    <input type="number" name="salary" value="{{ old('salary', $job->salary ?? '') }}"
                        class="w-full border rounded p-2 @error('salary') border-red-500 @enderror">
                    @error('salary')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Experience Level -->
            <div>
                <label class="block font-medium mb-1">Experience Level</label>
                <input type="text" name="experience_level"
                    value="{{ old('experience_level', $job->experience_level ?? '') }}"
                    class="w-full border rounded p-2 @error('experience_level') border-red-500 @enderror">
                @error('experience_level')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Required Skills -->
            <div>
                <label class="block font-medium mb-1">Required Skills</label>
                <input type="text" name="skills_required"
                    value="{{ old('skills_required', is_array($job->skills_required ?? null) ? implode(', ', $job->skills_required) : '') }}"
                    class="w-full border p-2 rounded" placeholder="Example: PHP, Laravel, MySQL">
                <p class="text-gray-400 text-xs mt-1">Separate skills with commas</p>
            </div>

            @php
                $live = old('live_skill_qa_enabled', (int) (($job->liveSkillQa->enabled ?? false) ? 1 : 0));
                $liveQa = $job->liveSkillQa ?? null;
                $slots = old('live_skill_qa_slot_start') ? null : (($liveQa->slots ?? []) ?: []);
                $slotStartsOld = old('live_skill_qa_slot_start', []);
                $slotEndsOld = old('live_skill_qa_slot_end', []);
            @endphp

            <div class="mt-6 rounded-xl border border-gray-200 bg-gray-50 p-5">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-base font-semibold text-gray-900">Live Skill Q&amp;A</h2>
                        <p class="text-sm text-gray-600">Schedule live Q&amp;A sessions for candidates.</p>
                    </div>
                    <label class="inline-flex items-center gap-2 text-sm font-semibold text-gray-700">
                        <input id="live-skill-qa-toggle" type="checkbox" name="live_skill_qa_enabled" value="1"
                            {{ (int) $live === 1 ? 'checked' : '' }}>
                        Enable
                    </label>
                </div>

                <div id="live-skill-qa-fields" class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Session duration</label>
                            <select name="live_skill_qa_duration_minutes" class="w-full border rounded p-2">
                                @php $dur = old('live_skill_qa_duration_minutes', $liveQa->duration_minutes ?? '15'); @endphp
                                <option value="15" {{ (string) $dur === '15' ? 'selected' : '' }}>15 minutes</option>
                                <option value="30" {{ (string) $dur === '30' ? 'selected' : '' }}>30 minutes</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Max candidates</label>
                            <input type="number" min="1" max="500" name="live_skill_qa_max_candidates"
                                value="{{ old('live_skill_qa_max_candidates', $liveQa->max_candidates ?? 10) }}"
                                class="w-full border rounded p-2">
                            <p class="text-gray-500 text-xs mt-1">Example: 10</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Session type</label>
                            @php $st = old('live_skill_qa_session_type', $liveQa->session_type ?? 'video_audio'); @endphp
                            <select name="live_skill_qa_session_type" class="w-full border rounded p-2">
                                <option value="video_audio" {{ $st === 'video_audio' ? 'selected' : '' }}>Video + Audio</option>
                                <option value="audio_only" {{ $st === 'audio_only' ? 'selected' : '' }}>Audio only</option>
                                <option value="screen_share" {{ $st === 'screen_share' ? 'selected' : '' }}>Video + Audio (Screen sharing allowed)</option>
                            </select>
                        </div>
                        <div class="flex items-center gap-2 pt-7">
                            <input type="checkbox" name="live_skill_qa_screen_sharing_allowed" value="1"
                                {{ old('live_skill_qa_screen_sharing_allowed', (int) ($liveQa->screen_sharing_allowed ?? 0)) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">Allow screen sharing</span>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium mb-2">Available date &amp; time slots</label>
                        <div id="live-qa-slots" class="space-y-2">
                            @php
                                $rows = [];
                                if (count($slotStartsOld) || count($slotEndsOld)) {
                                    $max = max(count($slotStartsOld), count($slotEndsOld));
                                    for ($i=0; $i<$max; $i++) $rows[] = ['start_at' => $slotStartsOld[$i] ?? null, 'end_at' => $slotEndsOld[$i] ?? null];
                                } else {
                                    $rows = $slots ?: [['start_at' => null, 'end_at' => null]];
                                }
                            @endphp
                            @foreach($rows as $row)
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 slot-row">
                                    <input type="datetime-local" name="live_skill_qa_slot_start[]"
                                        value="{{ $row['start_at'] ? \Illuminate\Support\Carbon::parse($row['start_at'])->format('Y-m-d\TH:i') : '' }}"
                                        class="w-full border rounded p-2">
                                    <input type="datetime-local" name="live_skill_qa_slot_end[]"
                                        value="{{ $row['end_at'] ? \Illuminate\Support\Carbon::parse($row['end_at'])->format('Y-m-d\TH:i') : '' }}"
                                        class="w-full border rounded p-2">
                                    <button type="button" class="remove-slot rounded border px-3 py-2 text-sm hover:bg-white">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-live-qa-slot"
                            class="mt-3 inline-flex items-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-800 border hover:bg-gray-100">
                            + Add slot
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Question categories (one per line)</label>
                            <textarea name="live_skill_qa_question_categories" rows="4" class="w-full border rounded p-2"
                                placeholder="Laravel&#10;SQL&#10;System Design">{{ old('live_skill_qa_question_categories', isset($liveQa) && is_array($liveQa->question_categories) ? implode("\n", $liveQa->question_categories) : '') }}</textarea>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Specific questions (one per line)</label>
                            <textarea name="live_skill_qa_questions" rows="4" class="w-full border rounded p-2"
                                placeholder="Explain Eloquent relationships.&#10;Optimize this query...">{{ old('live_skill_qa_questions', isset($liveQa) && is_array($liveQa->questions) ? implode("\n", array_map(fn($q) => $q['question'] ?? '', $liveQa->questions)) : '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded">
                    {{ isset($job) ? 'Update Job' : 'Create Job' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const toggle = document.getElementById('live-skill-qa-toggle');
            const fields = document.getElementById('live-skill-qa-fields');
            const addBtn = document.getElementById('add-live-qa-slot');
            const slots = document.getElementById('live-qa-slots');

            function syncVisibility() {
                if (!toggle || !fields) return;
                fields.style.display = toggle.checked ? '' : 'none';
            }

            function bindRemoveButtons() {
                if (!slots) return;
                slots.querySelectorAll('.remove-slot').forEach(btn => {
                    if (btn.dataset.bound) return;
                    btn.dataset.bound = '1';
                    btn.addEventListener('click', () => {
                        const row = btn.closest('.slot-row');
                        if (!row) return;
                        row.remove();
                    });
                });
            }

            if (toggle) toggle.addEventListener('change', syncVisibility);
            syncVisibility();
            bindRemoveButtons();

            if (addBtn && slots) {
                addBtn.addEventListener('click', () => {
                    const row = document.createElement('div');
                    row.className = 'grid grid-cols-1 md:grid-cols-3 gap-2 slot-row';
                    row.innerHTML = `
                        <input type="datetime-local" name="live_skill_qa_slot_start[]" class="w-full border rounded p-2">
                        <input type="datetime-local" name="live_skill_qa_slot_end[]" class="w-full border rounded p-2">
                        <button type="button" class="remove-slot rounded border px-3 py-2 text-sm hover:bg-white">Remove</button>
                    `;
                    slots.appendChild(row);
                    bindRemoveButtons();
                });
            }
        })();
    </script>
@endsection