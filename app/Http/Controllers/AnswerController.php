<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'answer' => 'required|string|max:2000',
            'question_id' => 'required|exists:questions,id'
        ]);

        Answer::create([
            'user_id' => auth()->id(),
            'question_id' => $request->question_id,
            'answer' => $request->answer
        ]);

        return back()->with('success', 'Answer submitted!');
    }
}
