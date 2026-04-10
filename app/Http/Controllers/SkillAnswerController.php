<?php
namespace App\Http\Controllers;

use App\Events\SkillAnswerPosted;
use App\Models\SkillAnswer;
use App\Models\SkillQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillAnswerController extends Controller
{
    public function store(Request $request, SkillQuestion $skillQuestion)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);
        $answer = SkillAnswer::create([
            'question_id' => $skillQuestion->id,
            'user_id' => Auth::id(),
            'body' => $validated['body'],
        ]);

        broadcast(new SkillAnswerPosted($skillQuestion, $answer))->toOthers();

        return redirect()->route('skill-qa.show', $skillQuestion)->with('success', 'Answer posted!');
    }
}
