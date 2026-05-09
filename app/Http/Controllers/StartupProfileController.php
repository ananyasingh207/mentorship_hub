<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartupProfileController extends Controller
{
    public function create(Request $request)
    {
        if ($request->user()->startupProfile()->exists()) {
            return redirect()->route('startup.dashboard');
        }

        return view('startup.profile.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->startupProfile()->exists()) {
            return redirect()->route('startup.dashboard');
        }

        $validated = $request->validate([
            'startup_name' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'stage' => 'required|in:idea,mvp,growth',
            'problem' => 'required|string',
            'help_needed' => 'required|string',
        ]);

        $request->user()->startupProfile()->create($validated);

        return redirect()->route('startup.dashboard');
    }
}
