@extends('layout')

@section('contenu')

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Intitulé</td>
                <th>Code barre</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>TVA</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($postes as $poste)
            <tr>
                <td>{{ $poste->numero }}</td>
                <td>{{ $poste->intitule }}</td>
                <td>{{ $poste->code_barre }}</td>
                <td>{{ $poste->quantite }} pc.</td>
                <td>{{ $poste->prix_unitaire }}€</td>
                <td>{{ $poste->tva->taux }}%</td>
    
                <!-- we will also add show, edit, and delete buttons -->
                <td>
    
                    <!-- delete the shark (uses the destroy method DESTROY /sharks/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->
    
                   
                    
    
                <form action= "{{ URL::to('postes/' . $poste->id) }}" method="post">
    
                         <!-- show the shark (uses the show method found at GET /sharks/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('postes/' . $poste->id) }}">Afficher</a>
    
                        <!-- edit this shark (uses the edit method found at GET /sharks/{id}/edit -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('postes/' . $poste->id . '/edit') }}">Modifier</a>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce poste de vente ?')">Supprimer</button>
                    </form>
    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection