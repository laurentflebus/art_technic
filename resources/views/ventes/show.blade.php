@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>
            Vente n° {{ $vente->id }} -
            Facture n° 
            @if ($vente->facture)
                {{ $vente->facture->numero }}
            @endif
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Client</th>
                        <th>Date</td>
                        <th>Total TTC</th>
                        <th>Total HT</th>
                        <th>Mode règlement</th>
                        {{-- <th>A Fact.</th> --}}
                        <th>Est Fact</th>
                        <th>Est Payé</th>
                        <th>Bon</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" value="{{ $totalttc = 0 }}">
                    <input type="hidden" value="{{ $totaltva = 0 }}">
                    <input type="hidden" value="{{ $timestamp = strtotime($vente->date) }}">
                    <input type="hidden" value="{{ $datefr = date("d/m/y", $timestamp) }}">
                    <tr>
                        <td>
                            @if ($vente->client)
                                {{ Crypt::decrypt($vente->client->nom)}} {{ Crypt::decrypt($vente->client->prenom) }}
                            @endif
                        </td>
                        <td>{{ $datefr }}</td>

                        @foreach ($vente->postes as $poste)

                            <input type="hidden" value="{{ $totalttc += floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">            
                            <input type="hidden" value="{{ $totaltva += floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) * floatval($poste->tva->taux/100) }}">
                            <input type="hidden" value="{{ $totalht = $totalttc -  $totaltva }}"> 

                        @endforeach

                        <td>{{  number_format($totalttc, 2, '.', '') }}€</td>
                        <td>{{ number_format($totalht, 2, '.', '') }}€</td>
                        
                        <td>{{ $vente->modereglement->intitule }}</td>

                        {{-- <td>
                            <input type="checkbox"
                            @if ($vente->a_facturer)
                                checked
                            @endif
                            >
                        </td> --}}
                        <td>
                            <input type="checkbox"
                            {{-- Si une facture existe pour cette vente --}}
                            @if ($vente->facture)
                                checked
                            @endif
                            >
                        </td>
                        <td>
                            <input type="checkbox"
                            @if ($vente->est_paye)
                                checked
                            @endif
                            >
                        </td>
                        <td>
                            <input type="checkbox"
                            @if ($vente->a_un_bon_commande)
                                checked
                            @endif
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-center">
        {{-- Imprime le ticket de caisse --}}
        <a class="btn btn-small btn-info" href="{{ URL::to('imprimerticket/' . $vente->id) }}" title="Imprimer le ticket de caisse">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
            </svg>
        </a>
        {{-- Imprime la facture --}}
        <a class="btn btn-small btn-warning" href="{{ URL::to('imprimerfacture/' . $vente->id) }}" title="Imprimer la facture">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
            </svg>
        </a>
        {{-- Envoyer la facture par e-mail --}}
        <a class="btn btn-small btn-success" href="{{ URL::to('email/' . $vente->id) }}" title="Envoyer la facture par e-mail">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
            </svg>
        </a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header text-center">
        <h4>Détails de la vente</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">  
            <table class="table table-striped table-bordered">
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
                        <input type="hidden" value="{{ $puhtva = $poste->pivot->prix_unitaire * (1 - $poste->tva->taux/100) }}">
                        <input type="hidden" value="{{ $totalttc = floatval($poste->pivot->quantite * $poste->pivot->prix_unitaire) }}">
                        <tr>
                            <td>{{ $poste->numero }}</td>
                            <td>{{ $poste->intitule }}</td>
                            <td>{{ $poste->pivot->quantite }}</td>
                            <td>{{ $poste->pivot->prix_unitaire }}€</td>
                            <td>{{ number_format($puhtva, 4, '.', '') }}€</td>
                            <td>{{ number_format($totalttc, 2, '.', '') }}€</td>    
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