@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>Achat n°{{ $achat->numero }}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="detailtable3" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>                       
                        <th>Fournisseur</th>
                        <th>Date</td>
                        <th>Echéance</th>
                        <th>Est Payé</th>
                        <th>Total HT</th>
                        <th>Total TTC</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" value="{{ $totalttc = 0 }}">
                    <input type="hidden" value="{{ $totaltva = 0 }}">
                    <input type="hidden" value="{{ $datefr = date("d/m/Y", strtotime($achat->date)) }}">
                    <input type="hidden" value="{{ $dateapayer = date("d/m/Y", strtotime($achat->date_a_payer)) }}">
                    <tr> 
                        <td>{{ Crypt::decrypt($achat->fournisseur->nom) }} {{ Crypt::decrypt($achat->fournisseur->prenom) ?? "" }}</td>
                        <td>{{ $datefr }}</td>
                        <td>{{ $dateapayer }}</td>
                        <td>
                            <input type="checkbox"
                            @if ($achat->est_paye)
                                checked
                            @endif
                            >
                        </td>
                        @foreach ($achat->postes as $poste)
                            <input type="hidden" value="{{ $totalttc += floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">            
                            <input type="hidden" value="{{ $totaltva += floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval($poste->tva->taux/100) }}">
                            <input type="hidden" value="{{ $totalht = $totalttc -  $totaltva }}"> 
                        @endforeach
                        <td>{{  number_format($totalttc, 2, '.', '') }}€</td>
                        <td>{{ number_format($totalht, 2, '.', '') }}€</td>
                        <td>
                            {{-- Payer l'achat (utilise la route GET /payerachat/{id}) --}}
                            <a class="btn btn-small btn-success" href="{{ URL::to('payerachat/' . $achat->id) }}" title="Payer l'achat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                    <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
<br>
<div class="card">
    <div class="card-header text-center">
        <h4>Détails de l'achat</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">  
            <table id="detailtable4" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Référence</th>
                        <th>Intitulé</td>
                        <th>Qté</th>
                        <th>P.U. TVAC</th>
                        <th>Montant HTVA</th>
                        <th>Montant TVAC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achat->postes as $poste)
                        <input type="hidden" value="{{ $montanttvac = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">
                        <input type="hidden" value="{{ $montanthtva = $montanttvac * (1 - $poste->tva->taux/100) }}">
                        <tr>
                            <td>{{ $poste->numero }}</td>
                            <td>{{ $poste->intitule }}</td>
                            <td>{{ $poste->pivot->quantite }}</td>
                            <td>{{ $poste->pivot->prix_unitaire }}€</td>
                            <td>{{ number_format($montanthtva, 2, '.', '') }}€</td>
                            <td>{{ number_format($montanttvac, 2, '.', '') }}€</td>    
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-center">
        
    </div>
</div>


@endsection