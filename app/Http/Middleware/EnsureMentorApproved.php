<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureMentorApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'mentor') {
            abort(403, 'Unauthorized action.');
        }

        $profile = $user->mentorProfile;

        if (!$profile) {
            return redirect()->route('mentor.profile.create');
        }

        if ($profile->status === 'approved') {
            return $next($request);
        }

        if ($profile->status === 'rejected') {
            if ($request->routeIs('mentor.rejected')) {
                return $next($request);
            }
            return redirect()->route('mentor.rejected');
        }

        if ($profile->status === 'pending') {
            if ($request->routeIs('mentor.dashboard')) {
                return $next($request);
            }
            return redirect()->route('mentor.dashboard')->with('info', 'Your mentor profile is pending approval.');
        }

        abort(403, 'Unauthorized action.');
    }
}
