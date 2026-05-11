<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MentorProfile;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStartups = User::where('role', 'startup')->count();
        $totalMentors = User::where('role', 'mentor')->count();
        $approvedMentors = MentorProfile::where('status', 'approved')->count();
        $pendingMentors = MentorProfile::where('status', 'pending')->count();
        $rejectedMentors = MentorProfile::where('status', 'rejected')->count();
        $totalBookings = Booking::count();
        $completedSessions = Booking::where('status', 'completed')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStartups',
            'totalMentors',
            'approvedMentors',
            'pendingMentors',
            'rejectedMentors',
            'totalBookings',
            'completedSessions'
        ));
    }
}
