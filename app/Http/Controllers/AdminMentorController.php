<?php

namespace App\Http\Controllers;

use App\Models\MentorProfile;
use Illuminate\Http\Request;

class AdminMentorController extends Controller
{
    public function index()
    {
        $mentors = MentorProfile::with('user')
            ->orderByRaw("status = 'pending' DESC")
            ->latest()
            ->paginate(10);
            
        return view('admin.mentors.index', compact('mentors'));
    }

    public function approve(MentorProfile $mentor)
    {
        if ($mentor->status === 'approved') {
            return back()->with('error', 'Mentor is already approved.');
        }

        $mentor->update(['status' => 'approved']);

        return back()->with('success', 'Mentor approved successfully.');
    }

    public function reject(MentorProfile $mentor)
    {
        if ($mentor->status === 'rejected') {
            return back()->with('error', 'Mentor is already rejected.');
        }

        $mentor->update(['status' => 'rejected']);

        return back()->with('success', 'Mentor rejected successfully.');
    }
}
