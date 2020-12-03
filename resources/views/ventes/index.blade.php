@extends('layout')

@section('contenu')
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Num vente</th>
                <th>Date</td>
                <th>Total TTC</th>
                <th>Total HT</th>
                <th>Mode règlement</th>
                <th>A Fact.</th>
                <th>Est Fact.</th>
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
                @endforeach
                
                <td></td>
                <td></td>
                <td></td>
    
                <!-- we will also add show, edit, and delete buttons -->
                <td>
    
                    <!-- delete the shark (uses the destroy method DESTROY /sharks/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->
    
                   
                    
    
                <form action= "{{ URL::to('ventes/' . $vente->id) }}" method="post">
    
                         <!-- show the shark (uses the show method found at GET /sharks/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('ventes/' . $vente->id) }}">Afficher</a>
    
                        <!-- edit this shark (uses the edit method found at GET /sharks/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('ventes/' . $vente->id . '/edit') }}">Modifier</a>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce vente de vente ?')">Supprimer</button>
                    </form>
    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection