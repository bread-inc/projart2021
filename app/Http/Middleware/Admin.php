<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class Admin
{
    /**
     * Handle an incoming request. To get through, the user must be an admin.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (isset($request->user()->isAdmin) && $request->user()->isAdmin) {
            return $next($request);
        }
        return redirect()->back();
    }
}
