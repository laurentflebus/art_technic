$(document).ready(function(){
    // cache le bouton supprimer
    $('#supprimerposte').hide();
    // Nombre de poste max
    var max = 10;
    var cptPoste = 1;
    var cPoste = '1';
    // compteur de touches afin d'executer la requête ajax 1 seule fois et pas à chaque fois qu'une touche est préssée
    var cptkey = 0;

    // Évenement lorsqu'une touche est relachée dans le champs codebarreAchat
    $('#codebarreAchat').keyup(function(e){
        var codebarre = $('#codebarreAchat').val();
        cptkey++;
        console.log(cptkey);
        // crée une instance de XmlHttpRequest
        // permet d'envoyer une requête HTTP 
        // Appel AJAX en JQuery
        if (cptkey > 12) {
            $.ajax({                        
                url : '/ajax', // fichier cible coté serveur, script qui récupère les infos du poste de vente
                type: 'GET', // Type de la requête HTTP
                data: {'codebarre': codebarre}, // passe la variable codebarre issue du formulaire
                datatype: 'json', // type de données à recevoir      
                // si l'appel AJAX a réussi
                success: function(data) {
                    // code pour gérer le retour de l'appel AJAX
                    console.log(data);                            
                    $('#numeroposte'+ $('#nbPoste').val()).val(data[0].numero);
                    $('#intituleposte'+ $('#nbPoste').val()).val(data[0].intitule);
                    cptkey = 0; 
                }, 
            }); 
        }               
        
    });
    // Évenement lorsqu'une touche est relachée dans le champs quantiteAchat
    $('#quantiteAchat').keyup(function(e){
        var quantite = $('#quantiteAchat').val();
        $('#quantite'+$('#nbPoste').val()).val(quantite);      
    });
    // Évenement lorsqu'une touche est relachée dans le champs montantAchat 
    $('#montantAchat').keyup(function(e){
        var montant = Number($('#montantAchat').val());
        var codebarre = $('#codebarreAchat').val();
        var quantite = $('#quantiteAchat').val();
        $('#montanttvac'+$('#nbPoste').val()).val(montant.toFixed(2));
        $.ajax({                        
            url : '/ajax', // fichier cible coté serveur, script qui récupère les infos du poste de vente
            type: 'GET', // Type de la requête HTTP
            data: {'codebarre': codebarre}, // passe la variable codebarre issue du formulaire
            datatype: 'json', // type de données à recevoir      
            // si l'appel AJAX a réussi
            success: function(data) {
                // code pour gérer le retour de l'appel AJAX
                console.log(data);
                var taux = data[1].taux;
                var montanthtva = montant * (1-(taux/100));                           
                $('#montanthtva'+ $('#nbPoste').val()).val(montanthtva.toFixed(2));
                    
                // Calcul du total TTC
                var totalttc = 0;
                var totalht = 0;
                for (let i = 1; i <= cPoste; i++) {
                    totalttc += Number($('#montanttvac'+i).val());
                    totalht += Number($('#montanthtva'+i).val());
                }
                $('#totalht').val(totalht.toFixed(2));
                $('#totalttc').val(totalttc.toFixed(2));
                $('#tva').val((totalttc-totalht).toFixed(2));
            },          
        });
    });

    // événement lors du click sur le bouton ajouter (+)
    $('#ajouterposteAchat').click(function(e) {
        // efface les données dans les champs codebarre et quantite
        $('#codebarreAchat').val('');
        $('#quantiteAchat').val('');
        $('#montantAchat').val('');
        // positionner le curseur dans le champs codebarre
        $('#codebarreAchat').focus();
        // affiche le bouton supprimer
        $('#supprimerposteAchat').show();
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
            $('#bloc #montanthtva1').attr('name', 'montanthtva'+cPoste);
            $('#bloc #montanthtva1').attr('id', 'montanthtva'+cPoste);
            $('#bloc #montanttvac1').attr('name', 'montanttvac'+cPoste);
            $('#bloc #montanttvac1').attr('id', 'montanttvac'+cPoste);

            // modifie l'id du clone
            $('#bloc #clone').attr('id', 'clone'+cPoste);

            // vide les nouveaux champs
            $('#numeroposte'+cPoste).val('');
            $('#intituleposte'+cPoste).val('');
            $('#quantite'+cPoste).val('');
            $('#montanthtva'+cPoste).val('');
            $('#montanttvac'+cPoste).val('');
            
            // supprimme tous les label du div bloc
            $('#bloc label').remove();
            // change la valeur de l'input caché avec la derrière valeur de cPoste (nombre de poste).
            $('#nbPoste').val(cPoste);
        }
        console.log(cPoste);
    });

    // événement lors du click sur le bouton supprimer (-)    
    $('#supprimerposteAchat').click(function(e) {
        // supprime le clone
        $('#clone'+cPoste).remove();
        // Décrémente le compteur poste et on le transforme en chaine de caractère
        cptPoste--;
        cPoste = cptPoste.toString();
        // change la valeur de l'input caché avec la dernière valeur de cPoste
        $('#nbPoste').val(cPoste);
        // si nombre de poste = 1, cache le bouton supprimer
        if(cptPoste == 1) {
            $('#supprimerposte').hide()
        }
    });

});