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

        $mentorRequests = [];
        if (auth()->check() && auth()->user()->role === 'startup') {
            $mentorRequests = \App\Models\MentorRequest::where('startup_id', auth()->id())
                ->pluck('status', 'mentor_id')
                ->toArray();
        }

        return view('mentors.index', compact('mentors', 'mentorRequests'));
    }

    public function show(MentorProfile $mentor)
    {
        if ($mentor->status !== 'approved') {
            abort(404);
        }

        $mentor->load('user');

        $hasAcceptedRequest = false;
        $availableSlots = collect();

        $reviews = \App\Models\Review::with('startup')->where('mentor_id', $mentor->user_id)->latest()->get();
        $averageRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
        $reviewCount = $reviews->count();

        $canReview = false;
        $requestStatus = 'no_request';

        if (auth()->check() && auth()->user()->role === 'startup') {
            $existingRequest = \App\Models\MentorRequest::where('startup_id', auth()->id())
                ->where('mentor_id', $mentor->user_id)
                ->first();

            if ($existingRequest) {
                $requestStatus = $existingRequest->status;
            }

            $hasAcceptedRequest = $requestStatus === 'accepted';

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

            // Check if user can review
            $hasCompletedBooking = \App\Models\Booking::where('startup_id', auth()->id())
                ->where('mentor_id', $mentor->user_id)
                ->where('status', 'completed')
                ->exists();

            $existingReview = \App\Models\Review::where('startup_id', auth()->id())
                ->where('mentor_id', $mentor->user_id)
                ->exists();

            $canReview = $hasCompletedBooking && !$existingReview;
        }

        return view('mentors.show', compact('mentor', 'hasAcceptedRequest', 'availableSlots', 'reviews', 'averageRating', 'reviewCount', 'canReview', 'requestStatus'));
    }
}
