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

        $hasAcceptedRequest = false;
        $availableSlots = collect();

        if (auth()->check() && auth()->user()->role === 'startup') {
            $hasAcceptedRequest = \App\Models\MentorRequest::where('startup_id', auth()->id())
                ->where('mentor_id', $mentor->user_id)
                ->where('status', 'accepted')
                ->exists();

            if ($hasAcceptedRequest) {
                $today = \Carbon\Carbon::today()->toDateString();
                $now = \Carbon\Carbon::now()->format('H:i:s');

                $availableSlots = \App\Models\TimeSlot::where('mentor_id', $mentor->user_id)
                    ->where('is_booked', false)
                    ->where(function($query) use ($today, $now) {
                        $query->where('date', '>', $today)
                              ->orWhere(function($q) use ($today, $now) {
                                  $q->where('date', '=', $today)
                                    ->where('start_time', '>', $now);
                              });
                    })
                    ->orderBy('date')
                    ->orderBy('start_time')
                    ->get();
            }
        }

        return view('mentors.show', compact('mentor', 'hasAcceptedRequest', 'availableSlots'));
    }
}
