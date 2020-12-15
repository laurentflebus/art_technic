@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>Listing des Ventes</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Num Facture</th>
                        <th>Client</th>
                        <th>Date</td>
                        <th>Total TTC</th>
                        <th>Total HT</th>
                        <th>Mode règlement</th>
                        <th>A Fact.</th>
                        <th>Est Fact</th>
                        <th>Est Payé</th>
                        <th>Bon</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventes as $vente)
                        <input type="hidden" value="{{ $totalttc = 0 }}">
                        <input type="hidden" value="{{ $totaltva = 0 }}">
                        <input type="hidden" value="{{ $timestamp = strtotime($vente->date) }}">
                        <input type="hidden" value="{{ $datefr = date("d/m/y", $timestamp) }}">
                        <tr>
                            <td>{{ $vente->id }}</td>
                            <td>
                                @if ($vente->facture)
                                    {{ $vente->facture->numero }}
                                @endif
                            </td>
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

                            <td>
                                <input type="checkbox"
                                @if ($vente->a_facturer)
                                    checked
                                @endif
                                >
                            </td>
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
                            <td>
                                <form action= "{{ URL::to('ventes/' . $vente->id) }}" method="post">
                                    
                                    {{-- Affiche la vente (utilise la méthode show avec la route GET /ventes/{id}) --}}
                                    <a class="btn btn-small btn-success" href="{{ URL::to('ventes/' . $vente->id) }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        </svg>
                                    </a>
                                    {{-- Modifie la vente (utilise la méthode edit avec la route GET /postes/{id}/edit) --}}
                                    <a class="btn btn-small btn-info" href="{{ URL::to('ventes/' . $vente->id . '/edit') }}">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                            <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                        </svg>
                                    </a>
            
                                    {{-- Supprime la vente (utilise la méthode destroy avec la route DELETE /postes/{id}) --}}
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce vente de vente ?')">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>


@endsection