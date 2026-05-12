<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MentorProfile;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStartups = User::where('role', 'startup')->count();
        $totalMentors = User::where('role', 'mentor')->count();
        $approvedMentors = MentorProfile::where('status', 'approved')->count();
        $pendingMentorsCount = MentorProfile::where('status', 'pending')->count();
        $rejectedMentors = MentorProfile::where('status', 'rejected')->count();
        $totalBookings = Booking::count();
        $completedSessions = Booking::where('status', 'completed')->count();

        // Session stats breakdown
        $scheduledSessions = Booking::where('status', 'scheduled')->count();
        $cancelledSessions = Booking::where('status', 'cancelled')->count();

        // Platform split percentages
        $mentorPercentage = $totalUsers > 0 ? round(($totalMentors / $totalUsers) * 100) : 0;
        $startupPercentage = $totalUsers > 0 ? round(($totalStartups / $totalUsers) * 100) : 0;

        // Pending mentor profiles with user relationship (for approval cards)
        $pendingMentors = MentorProfile::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Latest 3 users (for dashboard preview)
        $users = User::with('mentorProfile')->latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStartups',
            'totalMentors',
            'approvedMentors',
            'pendingMentorsCount',
            'rejectedMentors',
            'totalBookings',
            'completedSessions',
            'scheduledSessions',
            'cancelledSessions',
            'mentorPercentage',
            'startupPercentage',
            'pendingMentors',
            'users'
        ));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('mentorProfile')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }
}
