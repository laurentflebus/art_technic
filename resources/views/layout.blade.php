<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Flebus Laurent">
        <title>Art Technic</title>
        {{-- Bootstrap CSS --}}
        
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css.map">
        <link href="/css/simple-sidebar.css" rel="stylesheet">
        {{-- <link rel="stylesheet" href="/css/bootstrap.css"> --}}

        {{-- Bootstrap Javascript --}}
        {{-- JQuery --}}
        <script src="/js/jquery-3.5.1.min.js"></script>
        <script src="/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">ART TECHNIC</div>
                <div class="list-group list-group-flush">
                    <a href="/mon-compte" class="list-group-item list-group-item-action bg-light">Accueil</a>
                    <a href="{{ URL::to('clients') }}" class="list-group-item list-group-item-action bg-light">Tous les clients</a>
                    <a href="{{ URL::to('clients/create') }}" class="list-group-item list-group-item-action bg-light">Créer un client</a>
                    <a href="{{ URL::to('postes') }}" class="list-group-item list-group-item-action bg-light">Postes de vente</a>
                    <a href="{{ URL::to('postes/create') }}" class="list-group-item list-group-item-action bg-light">Créer un poste de vente</a>
                    <a href="{{ URL::to('ventes') }}" class="list-group-item list-group-item-action bg-light">Listing ventes</a>
                    <a href="{{ URL::to('ventes/create') }}" class="list-group-item list-group-item-action bg-light">Caisse</a>
                </div>
            </div>

            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom">
                    <button id="menu-toggle" class="btn btn-light">MENU</button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars fa-1x"></i></span>
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
        
        
        <script>
            // Quand le document HTML est chargé, lance la fonction avec le code jQuery
            
                $('#codebarre').keyup(function(e){
                    var codebarre = $('#codebarre').val();
                    // crée une instance de XmlHttpRequest
                    // permet d'envoyer une requête HTTP 
                    // Appel AJAX en JQuery
                    
                    $.ajax({                        
                        url : '/ajax', // fichier cible coté serveur, script qui récupère les infos du poste de vente
                        type: 'GET', // Type de la requête HTTP
                        data: {'codebarre': codebarre}, // passe la variable codebarre issue du formulaire
                        datatype: 'json', // type de données à recevoir      
                        // si l'appel AJAX a réussi
                        success: function(data) {
                            // code pour gérer le retour de l'appel AJAX
                            console.log(data);
                            $('#prixtvac').val(data.prix_unitaire);
                            $('#quantite').val(data.quantite);
                            $('#numeroposte').val(data.numero);
                            $('#intituleposte').val(data.intitule)
                            var quantite = data.quantite;
                            var prixunitaire = data.prix_unitaire;
                            
                            $('#totalttca').val(quantite*prixunitaire);
                        },
                        
                    });
                });
            
            
            

            $("#menu-toggle").click(function(e) {
                e.preventDefault(); // annule l'action du div id=menu-toggle
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        
    </body>
</html>
            