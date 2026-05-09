<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            if ($user->role === 'startup' && !$user->startupProfile()->exists()) {
                return redirect()->route('startup.profile.create');
            }

            if ($user->role === 'mentor' && !$user->mentorProfile()->exists()) {
                return redirect()->route('mentor.profile.create');
            }
        }

        return $next($request);
    }
}
