@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>Détail de la vente</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">  
            <table id="table" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Référence</th>
                        <th>Intitulé</td>
                        <th>Qté</th>
                        <th>P.U. TVAC</th>
                        <th>P.U. HT</th>
                        <th>Total TTC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vente->postes as $poste)
                        <input type="hidden" value="{{ $puhtva = $poste->prix_unitaire * (1 - $poste->tva->taux/100) }}">
                        <input type="hidden" value="{{ $totalttc = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">
                        <tr>
                            <td>{{ $poste->numero }}</td>
                            <td>{{ $poste->intitule }}</td>
                            <td>{{ $poste->pivot->quantite }}€</td>
                            <td>{{ $poste->prix_unitaire }}€</td>
                            <td>{{ number_format($puhtva, 4, '.', '') }}€</td>
                            <td>{{ number_format($totalttc, 2, '.', '') }}€</td>    
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-center">
        <a class="btn btn-small btn-info" href="{{ URL::to('email/' . $vente->id) }}" title="Modifier le poste">
            Envoyer la facture par e-mail
        </a>
    </div>
</div>


@endsection