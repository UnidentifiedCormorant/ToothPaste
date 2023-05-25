<?php

namespace App\Http\Middleware;

use App\Exceptions\NotAdminException;
use App\Exceptions\NotFoundException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        return (Auth::check() && Auth::user()->hasAccess('*')) ? $next($request) : throw new NotAdminException();
    }
}
