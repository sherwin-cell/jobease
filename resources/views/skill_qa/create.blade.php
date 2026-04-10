@extends('layouts.app')

@section('title', 'Ask a Skill Question')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Ask a Skill Question</h1>
    <form method="POST" action="{{ route('skill-qa.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" value="{{ old('title') }}" required>
            @error('title')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Skill</label>
            <select name="skill_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select a skill</option>
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}" {{ old('skill_id') == $skill->id ? 'selected' : '' }}>{{ $skill->name }}</option>
                @endforeach
            </select>
            @error('skill_id')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tags</label>
            <select name="tags[]" class="w-full border rounded px-3 py-2" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
            @error('tags')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Question Details</label>
            <textarea name="body" class="w-full border rounded px-3 py-2" rows="5" required>{{ old('body') }}</textarea>
            @error('body')<div class="text-red-600 text-xs mt-1">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Post Question</button>
    </form>
</div>
@endsection
