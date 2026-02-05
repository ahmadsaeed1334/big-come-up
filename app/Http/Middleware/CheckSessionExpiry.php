<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionExpiry
{
    public function handle(Request $request, Closure $next): Response
    {
        $currentRoute = $request->route()->getName();

        // Login اور signup routes کو bypass کریں
        $publicRoutes = ['login', 'register', 'password.request', 'password.email', 'password.reset'];

        if (in_array($currentRoute, $publicRoutes)) {
            return $next($request);
        }

        // Agar user authenticated hai
        if (Auth::check()) {
            $session = $request->session();

            // پہلے last_activity کو set کریں اگر موجود نہیں ہے
            if (!$session->has('last_activity')) {
                $session->put('last_activity', time());
                return $next($request);
            }

            $lastActivity = $session->get('last_activity');
            $sessionLifetime = config('session.lifetime', 120) * 60; // default 120 minutes

            if ($lastActivity && (time() - $lastActivity > $sessionLifetime)) {
                Auth::logout();
                $session->invalidate();
                $session->regenerateToken();

                // AJAX request check کریں
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'session_expired' => true,
                        'redirect_url' => route('login'),
                        'message' => 'Your session has expired. Please login again.'
                    ], 401);
                }

                return redirect()->route('login')
                    ->with('session_expired', 'Your session has expired. Please login again.');
            }

            // Update last activity time
            $session->put('last_activity', time());
        } else {
            // Agar user logged in nahi hai to protected routes pe access block karo
            $protectedRoutes = ['dashboard', 'admin', 'manager', 'profile', 'settings'];

            $isProtected = false;
            foreach ($protectedRoutes as $route) {
                if (str_contains($currentRoute, $route)) {
                    $isProtected = true;
                    break;
                }
            }

            if ($isProtected) {
                // AJAX request check کریں
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'session_expired' => true,
                        'redirect_url' => route('login'),
                        'message' => 'Please login to continue.'
                    ], 401);
                }

                return redirect()->route('login')
                    ->with('error', 'Please login to continue.');
            }
        }

        return $next($request);
    }
}
