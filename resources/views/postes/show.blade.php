@extends('layout')

@section('contenu')
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5>{{ $poste->intitule }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <strong>Code barre / Code : </strong>
                        </div>
                        <div class="col-6">
                            {{ $poste->code_barre }} 
                        </div>
                        <div class="col-6">
                            <strong>Numéro : </strong>
                        </div>
                        <div class="col-6">
                            {{ $poste->numero }} 
                        </div>
                        <div class="col-6">
                            <strong>Quantité : </strong>
                        </div>
                        <div class="col-6">
                            {{ $poste->quantite }} 
                        </div>
                        <div class="col-6">
                            <strong>Prix unitaire : </strong>
                        </div>
                        <div class="col-6">
                            {{ $poste->prix_unitaire }} 
                        </div>
                        <div class="col-6">
                            <strong>Taux de TVA : </strong>
                        </div>
                        <div class="col-6">
                            {{ $poste->tva->taux }}% 
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ URL::to('postes/' . $poste->id . '/edit') }}" class="btn btn-success">Modifier</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    
@endsection