<?php

namespace App\Http\Controllers;

use App\Models\MentorRequest;
use App\Models\Booking;
use App\Services\MentorMatchingService;
use Illuminate\Http\Request;

class StartupDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalRequests = MentorRequest::where('startup_id', $user->id)->count();
        $acceptedMentors = MentorRequest::where('startup_id', $user->id)->where('status', 'accepted')->count();
        $upcomingBookings = Booking::where('startup_id', $user->id)->where('status', 'scheduled')->count();
        $completedSessions = Booking::where('startup_id', $user->id)->where('status', 'completed')->count();

        $recommendedMentors = collect();
        if ($user->startupProfile) {
            $recommendedMentors = MentorMatchingService::getMatchedMentors($user->startupProfile, 3);
        }

        return view('startup.dashboard', compact(
            'totalRequests',
            'acceptedMentors',
            'upcomingBookings',
            'completedSessions',
            'recommendedMentors'
        ));
    }
}
