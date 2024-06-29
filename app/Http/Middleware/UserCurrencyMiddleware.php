<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /* public function handle(Request $request, Closure $next)
     {
         return $next($request);
     }*/

    public function handle(Request $request, Closure $next) {
        if (! $request->getSession()->get('currency')) {
            $localCurrency = 'USD';
            /*$request->getSession()->put([
                'currency' => $localCurrency,
            ]);*/
            /*            Session::put('currency', $localCurrency);*/
            session(['currency' => $localCurrency]);

        }
        return $next($request);
    }
}
