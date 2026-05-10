<?php

namespace App\Http\Controllers;

use App\Models\MentorRequest;
use Illuminate\Http\Request;

class MentorRequestController extends Controller
{
    public function index()
    {
        $requests = MentorRequest::with('startup')
            ->where('mentor_id', auth()->id())
            ->latest()
            ->get();

        return view('mentor.requests.index', compact('requests'));
    }

    public function accept(MentorRequest $mentorRequest)
    {
        if ($mentorRequest->mentor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($mentorRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending requests can be accepted.');
        }

        $mentorRequest->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Request accepted successfully.');
    }

    public function reject(MentorRequest $mentorRequest)
    {
        if ($mentorRequest->mentor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($mentorRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending requests can be rejected.');
        }

        $mentorRequest->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Request rejected successfully.');
    }
}
