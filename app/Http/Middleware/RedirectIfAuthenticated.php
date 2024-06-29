<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            switch ($guard) {

                case "admin":
                    $redirect_link = RouteServiceProvider::ADMIN_HOME;
                    break;
                case "web":
                    $redirect_link = RouteServiceProvider::WEB_HOME;
                    break;
                case "host":
                    $redirect_link = RouteServiceProvider::HOST_HOME;
                    break;
                default :
                    $redirect_link = RouteServiceProvider::HOME;
                    break;
            }

            if (Auth::guard($guard)->check()) {
                return redirect($redirect_link);
            }
        }

        return $next($request);
    }
}
