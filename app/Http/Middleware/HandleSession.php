<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleSession
{
    public function handle(Request $request, Closure $next): Response
    {
        // Public routes list
        $publicRoutes = [
            'login',
            'register',
            'password.request',
            'password.email',
            'password.reset',
            'verification.notice',
            'verification.verify',
            'verification.resend',
        ];

        $currentRoute = $request->route()->getName();

        // Allow public routes without session checks
        if (in_array($currentRoute, $publicRoutes)) {
            return $next($request);
        }

        // If user is authenticated
        if (Auth::check()) {
            $session = $request->session();

            // Initialize session if not set
            if (!$session->has('session_started')) {
                $session->put('session_started', time());
                $session->put('last_activity', time());
            }

            // Check session expiry
            $lastActivity = $session->get('last_activity');
            $sessionLifetime = config('session.lifetime', 120) * 60;

            if (time() - $lastActivity > $sessionLifetime) {
                Auth::logout();
                $session->flush();

                // Redirect to login with message
                return redirect()->route('login')
                    ->with('session_expired', 'Your session has expired. Please login again.');
            }

            // Update activity timestamp
            $session->put('last_activity', time());
        }

        return $next($request);
    }
}
