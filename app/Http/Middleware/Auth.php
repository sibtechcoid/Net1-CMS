<?php

namespace App\Http\Middleware;

use Closure;

class Auth
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
        // echo $request->cookie('authToken');exit;
        if($request->cookie('authToken')=='') {
            return redirect()->route('admin.login')->with('danger', 'Please, login with your credentials');
        }
        return $next($request);
    }
}
