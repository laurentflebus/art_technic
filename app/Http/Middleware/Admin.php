<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Si l'utilisateur est null
        $utilisateur = auth()->user();
        if ( is_null($utilisateur) ) {
            abort(404);
        }
        // si l'utilisateur n'est pas un administrateur
        if (!$utilisateur->admin) {
            
            flash('Vous devez être administrateur pour voir cette page.')->error();

            return back();
            
        }

        return $next($request);
    }
}
