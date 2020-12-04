@extends('layout')

@section('contenu')
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Num vente</th>
                <th>Date</td>
                <th>Total TTC</th>
                <th>Total HT</th>
                <th>Mode règlement</th>
                <th>A Fact.</th>
                <th>Est Payé</th>
                               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ventes as $vente)
            <tr>
                <td>{{ $vente->id }}</td>
                <td>{{ $vente->created_at }}</td>
                @foreach ($vente->postes as $poste)
                    {{ $totalttc = floatval($poste['pivot']['quantite'] * $poste['pivot']['prix_unitaire']) }}
                    <td>{{ $totalttc }}</td>
                    {{ $taux = $poste->tva->taux }}
                
                @endforeach
                {{ $totalht = $totalttc - ($totalttc * floatval($taux)/100) }}
                <td>{{ $totalht }}</td>
                
                <td>{{ $vente->modereglement->intitule }}</td>
                <td>{{ $vente->a_facturer }}</td>
                <td>{{ $vente->est_paye }}</td>
    
                   
                    
                <td>
                    <form action= "{{ URL::to('ventes/' . $vente->id) }}" method="post">
    
                        <!-- edit this shark (uses the edit method found at GET /sharks/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('ventes/' . $vente->id . '/edit') }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wrench" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019L13 11l-.471.242-.529.026-.287.445-.445.287-.026.529L11 13l.242.471.026.529.445.287.287.445.529.026L13 15l.471-.242.529-.026.287-.445.445-.287.026-.529L15 13l-.242-.471-.026-.529-.445-.287-.287-.445-.529-.026z"/>
                            </svg>
                        </a>
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
@endsection