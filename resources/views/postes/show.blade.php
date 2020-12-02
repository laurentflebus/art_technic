@extends('layout')

@section('contenu')
    <div class="card text-center">
        <h5 class="card-header">Poste de vente</h5>
        <div class="card-body">
            <h5 class="card-title">{{ $poste->intitule }}</h5>
            <p class="card-text">
                <strong>Numéro : </strong> {{ $poste->numero }} <br>
                <strong>Quantité : </strong> {{ $poste->quantite }}<br>
                <strong>Prix unitaire : </strong> {{ $poste->prix_unitaire }}
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('postes/' . $poste->id . '/edit') }}" class="btn btn-success">Modifier</a>
        </div>
    </div>
@endsection