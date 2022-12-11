<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class DbWizard
{
    public function handle($request, Closure $next, $guard = null)
    {
        if(DB::connection()->getDatabaseName())
        {
            return $next($request);
        } else {
            return redirect()->route('install');
        }
    }
}

