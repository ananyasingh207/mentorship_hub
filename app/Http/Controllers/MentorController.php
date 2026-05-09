<?php

namespace App\Http\Controllers;

use App\Models\MentorProfile;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $query = MentorProfile::with('user')->where('status', 'approved');

        $expertise = trim($request->query('expertise'));
        if (!empty($expertise)) {
            $query->where('expertise', 'like', "%{$expertise}%");
        }

        $mentors = $query->latest()->get();

        return view('mentors.index', compact('mentors'));
    }

    public function show(MentorProfile $mentor)
    {
        if ($mentor->status !== 'approved') {
            abort(404);
        }

        $mentor->load('user');

        return view('mentors.show', compact('mentor'));
    }
}
