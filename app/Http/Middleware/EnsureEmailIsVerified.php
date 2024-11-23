<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->is_verified) {
            return redirect()->route('verify.otp')->withErrors(['email' => 'Please verify your email first.']);
        }

        return $next($request);
    }
}
