<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     * Note : Ignore error hasVerifiedEmail().
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ?string $guard = null)
    {
        $user = Auth::guard($guard)->user();

        if ($user && ($user instanceof MustVerifyEmail && !$user->hasVerifiedEmail())) {
            Alert::error('Error Title', 'Sorry, your account has not been activated 🤯');


            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route('verification.notice'));
        }

        if (Auth::guard($guard)->check()) {
            Auth::shouldUse((string) $guard);
        }

        return $next($request);
    }
}
