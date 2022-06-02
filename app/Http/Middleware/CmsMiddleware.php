<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CmsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path = request()->path();
        if (!in_array($path, ['auth/login']) && !session()->get('users_id')) {
            return redirect('auth/login');
        } elseif (in_array($path, ['auth/login']) && session()->get('users_id') != "") {
            return redirect('dashboard');
        }

        return $next($request);
    }
}
