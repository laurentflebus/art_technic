@extends('layout')

@section('contenu')
<div class="container">
    
    <h1>Voir {{ $poste->intitule }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $poste->code_barre }}</h2>
        <p>
            <strong>Numéro</strong> {{ $poste->numero }} <br>
            <strong>Quantité</strong> {{ $poste->quantite }}<br>
            <strong>Prix unitaire</strong> {{ $poste->prix_unitaire }}
        </p>
    </div>

</div>
@endsection