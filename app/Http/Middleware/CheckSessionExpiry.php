<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckSessionExpiry
{
    public function handle(Request $request, Closure $next): Response
    {
        $currentRoute = $request->route()->getName();

        // Agar user authenticated hai
        if (Auth::check()) {
            $session = $request->session();

            // Check if session has expired manually
            $lastActivity = $session->get('last_activity');
            $sessionLifetime = config('session.lifetime') * 60;

            if ($lastActivity && (time() - $lastActivity > $sessionLifetime)) {
                Auth::logout();
                $session->invalidate();
                $session->regenerateToken();

                return redirect()->route('auth.login.form')
                    ->with('error', 'Your session has expired. Please login again.');
            }

            // Update last activity time
            $session->put('last_activity', time());

            // Agar user logged in hai to verifyCode pe redirect karo
            if ($currentRoute === 'verify.code.form') {
                return redirect()->route('dashboard');
            }

            // Authentication successful ko allow karo agar user logged in hai
            if ($currentRoute === 'authentication.successful') {
                return $next($request);
            }
        } else {
            // Agar user logged in nahi hai to protected routes pe access block karo
            if ($this->isProtectedRoute($request)) {
                // CSRF token regenerate karo
                $request->session()->regenerateToken();

                return redirect()->route('auth.login.form')
                    ->with('error', 'Please login to continue.');
            }

            // Agar user logged out hai to verifyCode aur authentication.successful pe access block karo
            if (in_array($currentRoute, ['verify.code.form', 'authentication.successful'])) {
                $request->session()->regenerateToken();

                return redirect()->route('auth.login.form')
                    ->with('error', 'Please login to continue.');
            }
        }

        $response = $next($request);

        // Security headers
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }

    private function isProtectedRoute(Request $request): bool
    {
        $publicRoutes = [
            'auth.login.form',
            'auth.login',
            'auth.signup.form',
            'auth.register',
            'password.request',
            'password.email',
            'password.reset',
            'authentication.successful'
        ];

        $currentRoute = $request->route()->getName();

        if (!$currentRoute) {
            return false;
        }

        return !in_array($currentRoute, $publicRoutes);
    }
}
