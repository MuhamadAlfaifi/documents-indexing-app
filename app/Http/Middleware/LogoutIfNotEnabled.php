<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutIfNotEnabled
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
        if(auth()->check() && (auth()->user()->enabled == false)){
            auth('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $request->session()->flash('status', 'المستخدم محضور، الرجاء مراجعة الإدارة.');

            return redirect()->route('login');
        }

        return $next($request);
    }
}
