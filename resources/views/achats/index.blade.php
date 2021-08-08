@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>Listing des Achats</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="achatstable" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fournisseur</th>
                        <th>Référence</th>
                        <th>Num achat</th>
                        <th>Date</td>
                        
                        <th>Echéance</th>
                        <th>Est Payé</th>
                        <th>Total HT</th>
                        <th>Total TTC</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achats as $achat)
                        <input type="hidden" value="{{ $totalttc = 0 }}">
                        <input type="hidden" value="{{ $totaltva = 0 }}">
                        <input type="hidden" value="{{ $timestamp = strtotime($achat->date) }}">
                        <input type="hidden" value="{{ $datefr = date("d/m/Y", $timestamp) }}">
                        <input type="hidden" value="{{ $timestamp = strtotime($achat->date_a_payer) }}">
                        <input type="hidden" value="{{ $dateapayer = date("d/m/Y", $timestamp) }}">
                        <tr>
                            <td>{{ $achat->id }}</td>
                            <td>{{ Crypt::decrypt($achat->fournisseur->nom) }} {{ Crypt::decrypt($achat->fournisseur->prenom) ?? "" }}</td>
                            <td>{{ $achat->reference }}</td>
                            <td>{{ $achat->numero }}</td>
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
                                <form action= "{{ URL::to('achats/' . $achat->id) }}" method="post">
                                    {{-- Affiche l'achat (utilise la méthode show avec la route GET /achats/{id}) --}}
                                    <a class="btn btn-small btn-success" href="{{ URL::to('achats/' . $achat->id) }}" title="Afficher le détail de l'achat'">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                        </svg>
                                    </a>
                                    {{-- Supprime l'achat (utilise la méthode destroy avec la route DELETE /achats/{id}) --}}
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer cet achat ?')" title="Supprimer la vente">
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