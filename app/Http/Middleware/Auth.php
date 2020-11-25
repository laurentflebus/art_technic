<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // $next fonction qui représente la suite d'application
    public function handle(Request $request, Closure $next)
    {
        // si l'utilisateur n'est pas connecté / est un invité
        if (auth()->guest()) {

            flash('Vous devez être connecté pour voir cette page.')->error();

            return redirect('/');
            
        }

        return $next($request);
    }
}
