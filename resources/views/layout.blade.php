<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Flebus Laurent">
        <title>Art Technic</title>
        {{-- Bootstrap CSS --}}
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/simple-sidebar.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">ART TECHNIC</div>
                <div class="list-group list-group-flush">
                <a href="/" class="list-group-item list-group-item-action bg-light">Accueil</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
                </div>
            </div>

            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom">
                    <button id="menu-toggle" class="btn btn-light">MENU</button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
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
                
            </div>
        </div>
        {{-- Bootstrap Javascript --}}
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        
    </body>
</html>
            