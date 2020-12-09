
jQuery(function($){

    // Nombre de poste max
    var max = 10;
    var cptPoste = 1;
    var cPoste = '1';
    // Évenement lorsqu'une touche est relachée dans le champs code barre
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
    $('#quantite').keyup(function(e){
        var quantite = $('#quantite').val();
        var codebarre = $('#codebarre').val();
        
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

                // Calcul du total TTC
                var totalttc = 0;
                for (let i = 1; i <= cPoste; i++) {
                    totalttc += Number($('#totalttca'+i).val());
                }
                $('#totalttc').val(totalttc.toFixed(2));
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
            $('#bloc #numeroposte1').attr('name', 'numeroposte'+cPoste);
            $('#bloc #numeroposte1').attr('id', 'numeroposte'+cPoste);
            $('#bloc #intituleposte1').attr('name', 'intituleposte'+cPoste);
            $('#bloc #intituleposte1').attr('id', 'intituleposte'+cPoste);
            $('#bloc #quantite1').attr('name', 'quantite'+cPoste);
            $('#bloc #quantite1').attr('id', 'quantite'+cPoste);
            $('#bloc #prixtvac1').attr('name', 'prixtvac'+cPoste);
            $('#bloc #prixtvac1').attr('id', 'prixtvac'+cPoste);
            $('#bloc #prixhtva1').attr('name', 'prixhtva'+cPoste);
            $('#bloc #prixhtva1').attr('id', 'prixhtva'+cPoste);
            $('#bloc #totalttca1').attr('name', 'totalttca'+cPoste);
            $('#bloc #totalttca1').attr('id', 'totalttca'+cPoste);

            // vide les nouveaux champs
            $('#numeroposte'+cPoste).val('');
            $('#intituleposte'+cPoste).val('');
            $('#quantite'+cPoste).val('');
            $('#prixtvac'+cPoste).val('');
            $('#prixhtva'+cPoste).val('');
            $('#totalttca'+cPoste).val('');
            
            // supprimme tous les label du div bloc
            $('#bloc label').remove();
            // change la valeur de l'input caché avec la derrière valeur de cPoste (nombre de poste).
            $('#nbPoste').val(cPoste);
        }
        console.log(cPoste);

    });

    // événement menu aside
    $("#menu-toggle").click(function(e) {
        e.preventDefault(); // annule l'action du div id=menu-toggle
        $("#wrapper").toggleClass("toggled");
    });
});
