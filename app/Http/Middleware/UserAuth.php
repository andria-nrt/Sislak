<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;

class UserAuth extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if((Auth::guard('user')->check()))
        {
            return $next($request);
        }
        else
        {
            if($request->ajax()) {
                if($request->expectsJson()) {
                    return json_encode(array('auth' => 0));
                } else {
                    return 0;
                }
            } else {
                return route('login');
            }
        }
    }
}
