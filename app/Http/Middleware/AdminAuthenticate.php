<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            logger()->info('User not authenticated in auth:admin middleware', [
                'path' => $request->path(),
            ]);

            return redirect()->route('admin.login');
        }

        return $next($request);
    }

}
