<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'employer_id' => 'required|exists:employers,id'
        ]);

        Question::create([
            'user_id' => auth()->id(),
            'employer_id' => $request->employer_id,
            'question' => $request->question,
            'is_anonymous' => $request->has('is_anonymous')
        ]);

        return back()->with('success', 'Question posted!');
    }
}
