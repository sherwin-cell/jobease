<?php
namespace App\Http\Controllers;

use App\Models\SkillQuestion;
use App\Models\SkillTag;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillQuestionController extends Controller
{
    public function index()
    {
        $questions = SkillQuestion::with(['user', 'skill', 'tags', 'answers.user'])->latest()->paginate(10);
        return view('skill_qa.index', compact('questions'));
    }

    public function create()
    {
        $skills = Skill::all();
        $tags = SkillTag::all();
        return view('skill_qa.create', compact('skills', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'skill_id' => 'required|exists:skills,id',
            'tags' => 'array',
            'tags.*' => 'exists:skill_tags,id',
        ]);
        $question = SkillQuestion::create([
            'user_id' => Auth::id(),
            'skill_id' => $validated['skill_id'],
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);
        if (!empty($validated['tags'])) {
            $question->tags()->sync($validated['tags']);
        }
        return redirect()->route('skill-qa.index')->with('success', 'Question posted!');
    }

    public function show(SkillQuestion $skillQuestion)
    {
        $skillQuestion->load(['user', 'skill', 'tags', 'answers.user']);
        return view('skill_qa.show', compact('skillQuestion'));
    }
}
