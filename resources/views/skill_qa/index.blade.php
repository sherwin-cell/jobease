@extends('layouts.app')

@section('title', 'Live Skill Q&A')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Live Skill Q&amp;A</h1>
        <a href="{{ route('skill-qa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ask a Question</a>
    </div>
    @foreach($questions as $question)
        <div class="bg-white rounded shadow p-4 mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold">
                        <a href="{{ route('skill-qa.show', $question) }}" class="text-blue-700 hover:underline">{{ $question->title }}</a>
                    </h2>
                    <div class="text-gray-500 text-xs mt-1">
                        Asked by {{ $question->user->name }} • {{ $question->created_at->diffForHumans() }}
                        <span class="ml-2">Skill: <span class="font-semibold">{{ $question->skill->name }}</span></span>
                    </div>
                    <div class="mt-2">
                        @foreach($question->tags as $tag)
                            <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full mr-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="text-sm text-gray-600">
                    {{ $question->answers->count() }} Answers
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-6">{{ $questions->links() }}</div>
</div>
@endsection
