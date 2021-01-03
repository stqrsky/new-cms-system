<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(!$request->user()->userHasRole($role)){
            abort(403, 'Sorry, you are not authorized to access this page. by: Star');
        }


        return $next($request);
    }
}
