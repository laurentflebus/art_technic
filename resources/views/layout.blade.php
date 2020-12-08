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
                    <a href="{{ URL::to('clients') }}" class="list-group-item list-group-item-action bg-light">Tous les clients</a>                    
                    <a href="{{ URL::to('clients/create') }}" class="list-group-item list-group-item-action bg-light">Créer un client</a>
                    <a href="{{ URL::to('postes') }}" class="list-group-item list-group-item-action bg-light">Postes de vente</a>
                    <a href="{{ URL::to('postes/create') }}" class="list-group-item list-group-item-action bg-light">Créer un poste de vente</a>
                    <a href="{{ URL::to('ventes') }}" class="list-group-item list-group-item-action bg-light">Listing ventes</a>
                    <a href="{{ URL::to('ventes/create') }}" class="list-group-item list-group-item-action bg-light">Caisse</a>
                    <a href="{{ URL::to('parametres') }}" class="list-group-item list-group-item-action bg-light">Paramètres</a>
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
            
                // Nombre de poste max
                var max = 10;
                var cptPoste = 1;
                var cPoste = '1';
                // Évenement lorsqu'une touche est relachée dans le champs code barre
                $('#codebarre1').keyup(function(e){
                    var codebarre = $('#codebarre1').val();
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
                            $('#prixtvac'+ $('#nbPoste').val()).val(data[0].prix_unitaire);                            
                            $('#numeroposte'+ $('#nbPoste').val()).val(data[0].numero);
                            $('#intituleposte'+ $('#nbPoste').val()).val(data[0].intitule);

                            
                            var prixunitaire = data[0].prix_unitaire;
                            var taux = data[1].taux;
                            var prixhtva = prixunitaire * (1-(taux/100));                           
                            $('#prixhtva'+ $('#nbPoste').val()).val(prixhtva.toFixed(2));

                            console.log($('#nbPoste').val());
                            
                        },
                        
                    });
                    

                });
                // Évenement lorsqu'une touche est relachée dans le champs quantite
                $('#quantite1').keyup(function(e){
                    var quantite = $('#quantite1').val();
                    var codebarre = $('#codebarre1').val();
                    $.ajax({                        
                        url : '/ajax', // fichier cible coté serveur, script qui récupère les infos du poste de vente
                        type: 'GET', // Type de la requête HTTP
                        data: {'codebarre': codebarre}, // passe la variable codebarre issue du formulaire
                        datatype: 'json', // type de données à recevoir      
                        // si l'appel AJAX a réussi
                        success: function(data) {
                            // code pour gérer le retour de l'appel AJAX
                            console.log(data);
                            var prixunitaire = data[0].prix_unitaire;
                            var total = quantite * prixunitaire;

                            $('#totalttca'+ $('#nbPoste').val()).val(total.toFixed(2));
                            $('#totalttc'+ $('#nbPoste').val()).val(total.toFixed(2));
                            $('#quantite'+$('#nbPoste').val()).val(quantite);
                        },
                        
                    });
                    
                });
                
                $('#ajouterposte').click(function(e) {

                    if (cptPoste < max) {
                        // incremente le compteur et transforme en chaine de caractère
                        cptPoste++;
                        cPoste = cptPoste.toString();
                        // clone la div avec tous les éléments du poste
                        var clone = $('#clone').clone();

                        // ajoute à une div vide le clone
                        $('#bloc').append(clone);
                        // modifie les attributs id et name des input codebarre, numeroposte, intituleposte, quantite, prixtvac, prixhtva, totalttca
                        $('#bloc #codebarre1').attr('id', 'codebarre'+cPoste);
                        $('#bloc #codebarre1').attr('name', 'codebarre'+cPoste);
                        $('#bloc #numeroposte1').attr('id', 'numeroposte'+cPoste);
                        $('#bloc #numeroposte1').attr('name', 'numeroposte'+cPoste);
                        $('#bloc #intituleposte1').attr('id', 'intituleposte'+cPoste);
                        $('#bloc #intituleposte1').attr('name', 'intituleposte'+cPoste);
                        $('#bloc #quantite1').attr('id', 'quantite'+cPoste);
                        $('#bloc #quantite1').attr('name', 'quantite'+cPoste);
                        $('#bloc #prixtvac1').attr('id', 'prixtvac'+cPoste);
                        $('#bloc #prixtvac1').attr('name', 'prixtvac'+cPoste);
                        $('#bloc #prixhtva1').attr('id', 'prixhtva'+cPoste);
                        $('#bloc #prixhtva1').attr('name', 'prixhtva'+cPoste);
                        $('#bloc #totalttca1').attr('id', 'totalttca'+cPoste);
                        $('#bloc #totalttca1').attr('id', 'totalttca'+cPoste);

                        // vide les nouveaux champs
                        $('#codebarre'+cPoste).val('');
                        $('#numeroposte'+cPoste).val('');
                        $('#intituleposte'+cPoste).val('');
                        $('#quantite'+cPoste).val('');
                        $('#prixtvac'+cPoste).val('');
                        $('#prixhtva'+cPoste).val('');
                        $('#totalttca'+cPoste).val('');
                                             
                        // change la valeur de l'input caché avec la derrière valeur de cPoste (nombre de poste).
                        $('#nbPoste').val(cPoste);
                    }
                    console.log(cPoste);

                });

                $("#menu-toggle").click(function(e) {
                    e.preventDefault(); // annule l'action du div id=menu-toggle
                    $("#wrapper").toggleClass("toggled");
                });

            
        </script>
        
        
    </body>
</html>
            