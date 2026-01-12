<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        // 'login',
        // 'auth/login',
        // '/login'
    ];

    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Agar login request hai to special handling karo
        if ($request->route()->named('auth.login')) {
            // Agar user already logged in hai to dashboard redirect karo
            if (Auth::check()) {
                return redirect()->route('dashboard');
            }

            // CSRF token check karo
            if (
                $this->isReading($request) ||
                $this->runningUnitTests() ||
                $this->inExceptArray($request) ||
                $this->tokensMatch($request)
            ) {
                return $this->addCookieToResponse($request, $next($request));
            }

            // Agar CSRF token mismatch hai to session completely regenerate karo
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('auth.login.form')
                ->withErrors(['_token' => 'Security token expired. Please try again.'])
                ->withInput($request->except('password'));
        }

        // Default CSRF check for other routes
        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->inExceptArray($request) ||
            $this->tokensMatch($request)
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }

        // CSRF token mismatch handle karo
        if (!$request->session()->has('_token')) {
            $request->session()->regenerateToken();
        }

        // Agar user logged in nahi hai to login page redirect karo
        if (!Auth::check()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('auth.login.form')
                ->with('error', 'Your session has expired. Please login again.');
        }

        // Default CSRF error for authenticated users
        throw new \Illuminate\Session\TokenMismatchException('CSRF token mismatch.');
    }
}
