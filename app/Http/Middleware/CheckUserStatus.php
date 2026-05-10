<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $status = Auth::user()->status;

            if ($status === 'pending' && !$request->routeIs('approval.pending') && !$request->routeIs('logout')) {
                return redirect()->route('approval.pending');
            }

            if ($status === 'rejected' && !$request->routeIs('approval.rejected') && !$request->routeIs('logout')) {
                return redirect()->route('approval.rejected');
            }
        }

        return $next($request);
    }
}
