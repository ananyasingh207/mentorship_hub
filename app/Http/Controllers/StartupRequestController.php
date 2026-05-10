<?php

namespace App\Http\Controllers;

use App\Models\MentorProfile;
use App\Models\MentorRequest;
use Illuminate\Http\Request;

class StartupRequestController extends Controller
{
    public function index()
    {
        $requests = MentorRequest::with('mentor')
            ->where('startup_id', auth()->id())
            ->latest()
            ->get();

        return view('startup.requests.index', compact('requests'));
    }

    public function create(MentorProfile $mentor)
    {
        if ($mentor->status !== 'approved') {
            abort(404);
        }

        return view('startup.requests.create', compact('mentor'));
    }

    public function store(Request $request, MentorProfile $mentor)
    {
        if ($mentor->status !== 'approved') {
            abort(404);
        }

        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        // Prevent duplicate pending requests
        $existingRequest = MentorRequest::where('startup_id', auth()->id())
            ->where('mentor_id', $mentor->user_id)
            ->where('status', 'pending')
            ->exists();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'You already have a pending request for this mentor.');
        }

        MentorRequest::create([
            'startup_id' => auth()->id(),
            'mentor_id' => $mentor->user_id,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('startup.requests.index')->with('success', 'Mentorship request sent successfully.');
    }
}
