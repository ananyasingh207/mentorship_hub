<?php

namespace App\Http\Controllers;

use App\Models\MentorRequest;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class MentorDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $incomingRequests = MentorRequest::where('mentor_id', $user->id)->where('status', 'pending')->count();
        $totalBookings = Booking::where('mentor_id', $user->id)->count();
        $completedSessions = Booking::where('mentor_id', $user->id)->where('status', 'completed')->count();

        $reviews = Review::where('mentor_id', $user->id);
        $averageRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
        $reviewCount = $reviews->count();

        return view('mentor.dashboard', compact(
            'incomingRequests',
            'totalBookings',
            'completedSessions',
            'averageRating',
            'reviewCount'
        ));
    }
}
