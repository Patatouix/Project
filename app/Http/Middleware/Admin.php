<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::user() &&  Auth::user()->admin)
        {
            return $next($request);
        }

        $path = $request->path();

        //on retire le préfixe '/admin' pour rediriger vers la route équivalente mais non-admin
        $auth_path = str_replace('admin', '', $path);

        return redirect($auth_path);
    }
}