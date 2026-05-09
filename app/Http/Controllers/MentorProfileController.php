<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentorProfileController extends Controller
{
    public function create(Request $request)
    {
        if ($request->user()->mentorProfile()->exists()) {
            return redirect()->route('mentor.dashboard');
        }

        return view('mentor.profile.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->mentorProfile()->exists()) {
            return redirect()->route('mentor.dashboard');
        }

        $validated = $request->validate([
            'expertise' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'availability' => 'required|string|max:255',
            'pricing' => 'required|in:free,paid',
        ]);

        $validated['status'] = 'pending';

        $request->user()->mentorProfile()->create($validated);

        return redirect()->route('mentor.dashboard');
    }
}
