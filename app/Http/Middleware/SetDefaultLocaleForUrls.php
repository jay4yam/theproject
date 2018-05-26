<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class SetDefaultLocaleForUrls
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
        //défini la valeur par défault de 'locale' afin de ne pas avoir à passer le paramètre à chaque requête
        \URL::defaults(['locale' => \App::getLocale()]);

        return $next($request);
    }
}
