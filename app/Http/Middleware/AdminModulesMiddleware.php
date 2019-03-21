<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AdminModules;

class AdminModulesMiddleware
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


        $modules = new AdminModules();
         return $next($request);
    }
}
