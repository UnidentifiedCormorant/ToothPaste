<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth extends \Illuminate\Auth\Middleware\Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($request, $guards);
        } catch (\Exception $e) {

        }

        return $next($request);
    }
}
