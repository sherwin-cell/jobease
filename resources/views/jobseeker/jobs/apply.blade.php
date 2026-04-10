@extends('layouts.app')

@section('title', 'Apply for ' . $job->title)

@section('content')
    <div class="max-w-3xl mx-auto mt-8 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Apply for {{ $job->title }}</h1>

        <!-- Job Summary -->
        <div class="mb-6 border p-4 rounded bg-gray-50">
            <p><strong>Job Title:</strong> {{ $job->title }}</p>
            <p><strong>Location:</strong> {{ $job->location }}</p>
            <p><strong>Salary:</strong> {{ $job->salary ?? 'Negotiable' }}</p>
            <p><strong>Skills Required:</strong>
                @if($job->skills_required && count($job->skills_required) > 0)
                    {{ implode(', ', $job->skills_required) }}
                @else
                    None
                @endif
            </p>
        </div>

        <!-- Application Form -->
        <form method="POST" action="{{ route('jobseeker.jobs.apply.submit', $job) }}" enctype="multipart/form-data">
            @csrf

            <!-- Cover Letter -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Cover Letter (Optional)</label>
                <textarea name="cover_letter" rows="5"
                    class="w-full border rounded p-2 @error('cover_letter') border-red-500 @enderror"
                    placeholder="Tell the employer why you're a great fit...">{{ old('cover_letter') }}</textarea>
                @error('cover_letter')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Resume Upload -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Upload Resume (Required)</label>
                <input type="file" name="resume"
                    class="w-full border rounded p-2 @error('resume') border-red-500 @enderror">
                <p class="text-gray-400 text-xs mt-1">PDF, DOC, DOCX (Max 5MB)</p>
                @error('resume')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Q&A Questions -->
            @if($job->qa_questions && count($job->qa_questions) > 0)
                <div class="mb-6 border p-4 rounded bg-gray-50">
                    <h2 class="text-lg font-semibold mb-4">Application Questions</h2>
                    <p class="text-gray-500 text-sm mb-4">Please answer the following questions from the employer.</p>
                    @foreach($job->qa_questions as $index => $question)
                        <div class="mb-4">
                            <label class="block font-medium mb-1">{{ $index + 1 }}. {{ $question }}</label>
                            <textarea name="qa_answers[{{ $index }}]" rows="3"
                                class="w-full border rounded p-2 @error('qa_answers.' . $index) border-red-500 @enderror"
                                placeholder="Your answer...">{{ old('qa_answers.' . $index) }}</textarea>
                            @error('qa_answers.' . $index)
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Buttons -->
            <div class="flex gap-4 justify-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded">
                    Submit Application
                </button>
                <a href="{{ route('jobseeker.jobs.show', $job) }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-2 rounded">
                    Cancel
                </a>
            </div>

        </form>
    </div>
@endsection