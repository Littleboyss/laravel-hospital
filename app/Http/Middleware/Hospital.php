<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Hospital
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
        if (empty(Session::get('hospital_info'))) {
            return redirect('index/index');
        }
        return $next($request);
    }
}
