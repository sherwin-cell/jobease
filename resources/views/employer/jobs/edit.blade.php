@extends('layouts.app')

@section('title', 'Edit Job - ' . $job->title)

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Job Posting</h1>

        <form method="POST" action="{{ route('employer.jobs.update', $job) }}">
            @csrf
            @method('PUT')

            <!-- Job Title -->
            <div class="mb-4">
                <label class="block font-semibold mb-2">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}"
                    class="w-full border rounded p-2 @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label class="block font-semibold mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}"
                    class="w-full border rounded p-2 @error('location') border-red-500 @enderror" required>
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salary -->
            <div class="mb-4">
                <label class="block font-semibold mb-2">Salary</label>
                <input type="text" name="salary" value="{{ old('salary', $job->salary) }}"
                    class="w-full border rounded p-2 @error('salary') border-red-500 @enderror"
                    placeholder="e.g., $50,000 - $70,000">
                @error('salary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Experience Level -->
            <!-- Experience Level -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Experience Level <span class="text-red-500">*</span></label>
                <select name="experience_level"
                    class="w-full border rounded p-3 @error('experience_level') border-red-500 @enderror" required>
                    <option value="">-- Select Experience Level --</option>
                    <option value="entry" {{ old('experience_level', $job->experience_level ?? '') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                    <option value="mid" {{ old('experience_level', $job->experience_level ?? '') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                    <option value="senior" {{ old('experience_level', $job->experience_level ?? '') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                </select>
                @error('experience_level')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Job Description -->
            <div class="mb-4">
                <label class="block font-semibold mb-2">Job Description</label>
                <textarea name="description" rows="6"
                    class="w-full border rounded p-2 @error('description') border-red-500 @enderror"
                    required>{{ old('description', $job->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Skills Required -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Skills Required (comma separated)</label>
                <input type="text" name="skills_required"
                    value="{{ old('skills_required', is_array($job->skills_required) ? implode(', ', $job->skills_required) : '') }}"
                    class="w-full border rounded p-2 @error('skills_required') border-red-500 @enderror"
                    placeholder="e.g., PHP, Laravel, MySQL">
                <p class="text-gray-500 text-sm mt-1">Separate skills with commas</p>
                @error('skills_required')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Q&A Questions -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Application Questions (Q&A)</label>
                <p class="text-gray-500 text-sm mb-2">Add questions that applicants must answer when applying.</p>
                <div id="qa-questions-container" class="space-y-2">
                    @php
                        $existingQuestions = old('qa_questions', $job->qa_questions ?? []);
                    @endphp
                    @forelse($existingQuestions as $index => $question)
                        <div class="flex gap-2 qa-question-row">
                            <input type="text" name="qa_questions[]" value="{{ $question }}"
                                class="w-full border rounded p-2" placeholder="Enter a question">
                            <button type="button" onclick="this.closest('.qa-question-row').remove()"
                                class="text-red-500 font-bold px-2">✕</button>
                        </div>
                    @empty
                        <div class="flex gap-2 qa-question-row">
                            <input type="text" name="qa_questions[]"
                                class="w-full border rounded p-2" placeholder="Enter a question">
                            <button type="button" onclick="this.closest('.qa-question-row').remove()"
                                class="text-red-500 font-bold px-2">✕</button>
                        </div>
                    @endforelse
                </div>
                <button type="button" onclick="addQuestion()"
                    class="mt-2 text-sm text-blue-600 hover:underline">+ Add another question</button>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 justify-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded">
                    Update Job
                </button>
                <a href="{{ route('employer.jobs.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-2 rounded">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function addQuestion() {
            const container = document.getElementById('qa-questions-container');
            const row = document.createElement('div');
            row.className = 'flex gap-2 qa-question-row';
            row.innerHTML = `
                <input type="text" name="qa_questions[]" class="w-full border rounded p-2" placeholder="Enter a question">
                <button type="button" onclick="this.closest('.qa-question-row').remove()" class="text-red-500 font-bold px-2">✕</button>
            `;
            container.appendChild(row);
        }
    </script>
@endsection