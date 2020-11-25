<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Art Technic</title>
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Art Technic</a>
                </div>
            

            
                <ul class="navbar-nav navbar-right">
                    {{-- Si l'utilisateur est connecté --}}
                    @if (auth()->check())
                        <li class="nav-item {{ request()->is('mon-compte') ? 'active' : '' }}">
                            <a class="nav-link" href="/mon-compte">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/deconnexion">Déconnexion</a>
                        </li> 
                    @else
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="/">Connexion</a>
                        </li>
                        <li class="nav-item {{ request()->is('inscriptionAuthentification') ? 'active' : '' }}">
                            <a class="nav-link" href="/inscriptionAuthentification">Inscription</a>
                        </li> 
                    @endif
                    
                </ul>
            </div>

        </nav>
        <div class="container-fluid">
            <div class="container">
                @include('flash::message')

                {{-- directive yield --}}
                @yield('contenu') 
                
            </div> 
        </div>   
    </body>
</html>
            