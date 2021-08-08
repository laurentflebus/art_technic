$(document).ready(function() {
    $('#ventestable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "order": [ [ 0, "desc" ] ],
        "columnDefs": [
            { className: "center", "targets": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] }
        ] 
    });

    $('#clientstable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [ 0, 1, 2, 3, 4, 5] }
        ] 
    });

    $('#postestable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [ 0, 1, 2, 3, 4, 5, 6] }
        ] 
    });

    $('.listingtable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [ 0, 1] },
            { className: "right", "targets": [2, 3] },
        ] 
    });

    $('#detailtable1').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [0, 1, 2, 3, 4, 5, 6, 7] },
        ] 
    });

    $('#detailtable2').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [0, 1, 2, 3, 4, 5] },
        ] 
    });

    $('#inventairetable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [ 0, 1, 2, 3, 4, 5, 6] },
        ] 
    });

    $('#utilisateurstable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [ 0, 1, 2, 3] },
        ] 
    });

    $('#achatstable').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "order": [ [ 0, "desc" ] ],
        "columnDefs": [
            { className: "center", "targets": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9] }
        ] 
    });

    $('#detailtable3').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [0, 1, 2, 3, 4, 5, 6] },
        ] 
    });

    $('#detailtable4').DataTable({
        "language": {
            "lengthMenu": "_MENU_ entrées par page",
            "search": "Recherche ",
            "info": "_START_ à _END_ entrée(s)",
            "infoEmpty": "0 entrées",
            "infoFiltered": "(Filtré sur _MAX_ au total)",
            "zeroRecords": "Aucun résultat",
            "paginate": {
                "previous": "Précédent",
                "next": "Suivant"
            },
        },
        "columnDefs": [
            { className: "center", "targets": [0, 1, 2, 3, 4, 5] },
        ] 
    });
});