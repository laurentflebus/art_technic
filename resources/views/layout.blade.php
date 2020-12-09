<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Flebus Laurent">
        <title>Art Technic</title>
        {{-- Bootstrap CSS --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css.map">
        <link href="/css/simple-sidebar.css" rel="stylesheet">
        
        {{-- <link rel="stylesheet" href="/css/bootstrap.css"> --}}

        {{-- Bootstrap Javascript --}}
        {{-- JQuery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- <script src="/js/jquery-3.5.1.min.js"></script> --}}
        <script src="/js/script.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">
                    
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-brush" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.117 8.117 0 0 1-3.078.132 3.658 3.658 0 0 1-.563-.135 1.382 1.382 0 0 1-.465-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.393-.197.625-.453.867-.826.094-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.2-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.175-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04zM4.705 11.912a1.23 1.23 0 0 0-.419-.1c-.247-.013-.574.05-.88.479a11.01 11.01 0 0 0-.5.777l-.104.177c-.107.181-.213.362-.32.528-.206.317-.438.61-.76.861a7.127 7.127 0 0 0 2.657-.12c.559-.139.843-.569.993-1.06a3.121 3.121 0 0 0 .126-.75l-.793-.792zm1.44.026c.12-.04.277-.1.458-.183a5.068 5.068 0 0 0 1.535-1.1c1.9-1.996 4.412-5.57 6.052-8.631-2.591 1.927-5.566 4.66-7.302 6.792-.442.543-.796 1.243-1.042 1.826a11.507 11.507 0 0 0-.276.721l.575.575zm-4.973 3.04l.007-.005a.031.031 0 0 1-.007.004zm3.582-3.043l.002.001h-.002z"/>
                    </svg>
                    ART TECHNIC
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/mon-compte" class="list-group-item list-group-item-action bg-light">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        Accueil
                    </a>
                    <a href="#clientSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light dropdown-toggle">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-people" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        </svg>
                        Clients</a>
	            		<ul class="collapse list-unstyled" id="clientSubmenu">
                			<li>
                    			<a href="{{ URL::to('clients') }}" class="list-group-item list-group-item-action bg-light">Les Clients</a>
                			</li>
                			<li>
                    			<a href="{{ URL::to('clients/create') }}" class="list-group-item list-group-item-action bg-light">Créer un client</a>
                			</li>
                			
	            		</ul>
                        <a href="#posteSubmenu" data-toggle="collapse" aria-expanded="false" class="list-group-item list-group-item-action bg-light dropdown-toggle">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
                            </svg>
                            Postes
                        </a>
	            		<ul class="collapse list-unstyled" id="posteSubmenu">
                			<li>
                    			<a href="{{ URL::to('postes') }}" class="list-group-item list-group-item-action bg-light">Les Postes de vente</a>
                			</li>
                			<li>
                    			<a href="{{ URL::to('postes/create') }}" class="list-group-item list-group-item-action bg-light">Créer un poste de vente</a>
                			</li>
                			
	            		</ul>                   
                    
                    
                    
                    <a href="{{ URL::to('ventes') }}" class="list-group-item list-group-item-action bg-light">Listing ventes</a>
                    <a href="{{ URL::to('ventes/create') }}" class="list-group-item list-group-item-action bg-light">Caisse</a>
                    <a href="{{ URL::to('parametres') }}" class="list-group-item list-group-item-action bg-light">Paramètres</a>
                </div>
            </div>

            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                    <button type="button" id="menu-toggle" class="btn btn-light">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Menu</span>
                    </button>

                    <div id="navbarSupportedContent" class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            {{-- Si l'utilisateur est connecté --}}
                            {{-- @if (auth()->check()) --}}
                            @auth

                                {{-- Si administrateur, affiche le lien Créer un utilisateur --}}
                                @if (auth()->user()->admin)
                                    @include('partials.nav-item', ['lien' => 'inscriptionAuthentification', 'texte' => 'Créer un utilisateur'])
                                @endif

                                @include('partials.nav-item', ['lien' => 'mon-compte', 'texte' => 'Mon compte'])
                                
                                
                                @include('partials.nav-item', ['lien' => 'deconnexion', 'texte' => 'Deconnexion'])
                               
                            @else
                                @include('partials.nav-item', ['lien' => '/', 'texte' => 'Connexion'])
   
                            @endauth
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
        
        
        
        
    </body>
</html>
            