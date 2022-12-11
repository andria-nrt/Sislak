<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckIfAdmin
{
    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);
    }
}

