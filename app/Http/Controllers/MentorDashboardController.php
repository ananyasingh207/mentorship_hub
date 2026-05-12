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

        // Stats for existing cards (optional to keep or replace)
        $incomingRequests = MentorRequest::where('mentor_id', $user->id)->where('status', 'pending')->count();
        $totalBookings = Booking::where('mentor_id', $user->id)->count();
        $completedSessions = Booking::where('mentor_id', $user->id)->where('status', 'completed')->count();

        $reviews = Review::where('mentor_id', $user->id);
        $averageRating = $reviews->count() > 0 ? round($reviews->avg('rating'), 1) : 0;
        $reviewCount = $reviews->count();

        // Data for new cards
        $nextSession = Booking::where('bookings.mentor_id', $user->id)
            ->where('bookings.status', 'scheduled')
            ->with(['startup', 'timeSlot'])
            ->join('time_slots', 'bookings.slot_id', '=', 'time_slots.id')
            ->orderBy('time_slots.date')
            ->orderBy('time_slots.start_time')
            ->select('bookings.*')
            ->first();

        $activeMentees = Booking::where('mentor_id', $user->id)
            ->whereIn('status', ['scheduled', 'completed'])
            ->distinct('startup_id')
            ->count('startup_id');

        $completedBookings = Booking::where('mentor_id', $user->id)
            ->where('status', 'completed')
            ->with('timeSlot')
            ->get();
        
        $hoursMentored = $completedBookings->sum(function ($booking) {
            if (!$booking->timeSlot) return 0;
            $start = \Carbon\Carbon::parse($booking->timeSlot->start_time);
            $end = \Carbon\Carbon::parse($booking->timeSlot->end_time);
            return $start->diffInMinutes($end) / 60;
        });

        $profile = $user->mentorProfile;
        $profileCompletion = 0;
        if ($profile) {
            $fields = ['expertise', 'experience', 'availability', 'pricing'];
            $filled = 0;
            foreach ($fields as $field) {
                if (!empty($profile->$field)) $filled++;
            }
            $profileCompletion = ($filled / count($fields)) * 100;
        }

        // New data for the 2 new cards
        $recentRequests = MentorRequest::where('mentor_id', $user->id)
            ->where('status', 'pending')
            ->with(['startup.startupProfile'])
            ->latest()
            ->take(2)
            ->get();

        $upcomingSessions = Booking::where('bookings.mentor_id', $user->id)
            ->where('bookings.status', 'scheduled')
            ->with(['startup.startupProfile', 'timeSlot'])
            ->join('time_slots', 'bookings.slot_id', '=', 'time_slots.id')
            ->orderBy('time_slots.date')
            ->orderBy('time_slots.start_time')
            ->select('bookings.*')
            ->take(5)
            ->get()
            ->groupBy(function($booking) {
                return $booking->timeSlot->date->format('Y-m-d');
            });

        $recentReviews = Review::where('mentor_id', $user->id)
            ->with('startup')
            ->latest()
            ->take(2)
            ->get();

        return view('mentor.dashboard', compact(
            'incomingRequests',
            'totalBookings',
            'completedSessions',
            'averageRating',
            'reviewCount',
            'nextSession',
            'activeMentees',
            'hoursMentored',
            'profileCompletion',
            'recentRequests',
            'upcomingSessions',
            'recentReviews'
        ));
    }
}
