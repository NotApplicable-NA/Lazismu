<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle(Request $request, Closure $next): mixed
    {
        // Periksa apakah user login dengan guard admin
        if (Auth::guard('admin')->check()) {
            // Logging untuk memastikan siapa yang login
            logger()->info('User logged in', ['user' => Auth::guard('admin')->user()]);
            return $next($request);
        }

        // Jika sesi habis, arahkan ke halaman session expired
        logger()->warning('Session expired or unauthorized access', ['ip' => $request->ip()]);
        return redirect()->route('session.expired');
    }
}
