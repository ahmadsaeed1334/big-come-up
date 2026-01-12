<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity_time');
            $currentTime = time();
            $timeout = 30 * 60; // 30 minutes in seconds

            if ($lastActivity && ($currentTime - $lastActivity > $timeout)) {
                Auth::logout();
                session()->flush();
                return redirect()->route('login')->withErrors(['session_expired' => 'Your session has expired. Please login again.']);
            }

            session(['last_activity_time' => $currentTime]);
        }

        return $next($request);
    }
}
