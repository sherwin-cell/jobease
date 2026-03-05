<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Skill;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidate::query()->with('skills');

        // Filter by skills (array)
        if ($request->filled('skills')) {
            $skills = $request->input('skills'); // array of skill IDs
            $query->whereHas('skills', function ($q) use ($skills) {
                $q->whereIn('skills.id', $skills);
            });
        }

        // Filter by experience
        if ($request->filled('experience')) {
            $query->where('experience', '>=', $request->input('experience'));
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', "%{$request->input('location')}%");
        }

        $candidates = $query->paginate(10);
        $allSkills = Skill::all();

        return view('candidates.index', compact('candidates', 'allSkills'));
    }
    public function updateStatus(Request $request, Candidate $candidate)
    {
        $request->validate([
            'status' => 'required|in:shortlisted,rejected,interview'
        ]);

        $candidate->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', "Candidate status updated to {$request->status}");
    }
}
