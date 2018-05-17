<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AdminsOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role != User::ROLE_ADMIN) {
            abort(404);
        }

        return $next($request);
    }
}
