<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\MentorProfile;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(MentorProfile $mentor)
    {
        $startupId = auth()->id();
        $mentorId = $mentor->user_id;

        $hasCompletedBooking = Booking::where('startup_id', $startupId)
            ->where('mentor_id', $mentorId)
            ->where('status', 'completed')
            ->exists();

        if (!$hasCompletedBooking) {
            abort(403, 'You can only review mentors you have completed a session with.');
        }

        $existingReview = Review::where('startup_id', $startupId)
            ->where('mentor_id', $mentorId)
            ->exists();

        if ($existingReview) {
            return redirect()->route('mentors.show', $mentor)->with('error', 'You have already submitted a review for this mentor.');
        }

        return view('reviews.create', compact('mentor'));
    }

    public function store(Request $request, MentorProfile $mentor)
    {
        $startupId = auth()->id();
        $mentorId = $mentor->user_id;

        $hasCompletedBooking = Booking::where('startup_id', $startupId)
            ->where('mentor_id', $mentorId)
            ->where('status', 'completed')
            ->exists();

        if (!$hasCompletedBooking) {
            abort(403, 'You can only review mentors you have completed a session with.');
        }

        $existingReview = Review::where('startup_id', $startupId)
            ->where('mentor_id', $mentorId)
            ->exists();

        if ($existingReview) {
            return redirect()->route('mentors.show', $mentor)->with('error', 'You have already submitted a review for this mentor.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1500',
        ]);

        Review::create([
            'startup_id' => $startupId,
            'mentor_id' => $mentorId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('mentors.show', $mentor)->with('success', 'Review submitted successfully!');
    }

    public function mentorIndex()
    {
        $mentorId = auth()->id();

        $reviews = Review::with('startup')->where('mentor_id', $mentorId)->latest()->get();
        $averageRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
        $reviewCount = $reviews->count();

        return view('mentor.reviews.index', compact('reviews', 'averageRating', 'reviewCount'));
    }
}
