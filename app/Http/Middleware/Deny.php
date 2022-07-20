<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class Deny
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$pathnames
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$pathnames)
    {
        $isMaster = optional(\Auth::user())->master === 1;
        $stricted = empty($pathnames) || \Str::startsWith($request->path(), $pathnames);

        if ($stricted && !$isMaster) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
