<?php

namespace App\Http\Middleware;

use Closure;

class CheckLockout
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
        $lastSent = \Auth::user()->profile()->first()->last_sent;
        $oneDaySecs = 86400;
        if ((time() - $lastSent) < $oneDaySecs ) {
            return redirect('/lockout');
        }
        return $next($request);
    }
}
