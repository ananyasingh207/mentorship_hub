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
            $connectedMentorIds = MentorRequest::where('startup_id', $user->id)
                ->where('status', 'accepted')
                ->pluck('mentor_id')
                ->toArray();

            $recommendedMentors = MentorMatchingService::getMatchedMentors($user->startupProfile, 3, $connectedMentorIds);
        }

        $recentSessions = Booking::where('startup_id', $user->id)
            ->with(['mentor.mentorProfile', 'timeSlot'])
            ->orderBy(
                \App\Models\TimeSlot::select('date')
                    ->whereColumn('id', 'bookings.slot_id')
                    ->limit(1), 
                'desc'
            )
            ->take(5)
            ->get();

        $sentRequests = MentorRequest::where('startup_id', $user->id)
            ->with('mentor.mentorProfile')
            ->latest()
            ->take(3)
            ->get();

        return view('startup.dashboard', compact(
            'totalRequests',
            'acceptedMentors',
            'upcomingBookings',
            'completedSessions',
            'recommendedMentors',
            'recentSessions',
            'sentRequests'
        ));
    }
}
