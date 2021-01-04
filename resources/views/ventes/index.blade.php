@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>Listing des Ventes</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="ventestable" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Num Facture</th>
                        <th>Client</th>
                        <th>Date</td>
                        <th>Total TTC</th>
                        <th>Total HT</th>
                        <th>Mode règlement</th>
                        {{-- <th>A Fact.</th> --}}
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
                            <td>
                                <form action= "{{ URL::to('ventes/' . $vente->id) }}" method="post">
                                    {{-- Affiche la vente (utilise la méthode show avec la route GET /ventes/{id}) --}}
                                    <a class="btn btn-small btn-success" href="{{ URL::to('ventes/' . $vente->id) }}" title="Afficher le détail de la vente">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        </svg>
                                    </a>
                                    {{-- Supprime la vente (utilise la méthode destroy avec la route DELETE /ventes/{id}) --}}
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce vente de vente ?')" title="Supprimer la vente">
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