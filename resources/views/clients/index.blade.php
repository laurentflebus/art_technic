@extends('layout')

@section('contenu')

<h1>Tous les clients</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</td>
            <th>Adresse</th>
            <th>Localité</th>
            <th>Contacts</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{ Crypt::decrypt($client->nom) }}</td>
            <td>{{ Crypt::decrypt($client->prenom) }}</td>
            <td>{{ Crypt::decrypt($client->rue) }}, {{ Crypt::decrypt($client->nrue) }} </td>
            <td>{{ Crypt::decrypt($client->localite->code_postal) }} {{ Crypt::decrypt($client->localite->intitule) }} </td>
            <td>{{ Crypt::decrypt($client->email) }} <br> {{ Crypt::decrypt($client->telephone) }} <br> {{ Crypt::decrypt($client->mobile) }} </td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the shark (uses the destroy method DESTROY /sharks/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

               
                

            <form action= "{{ URL::to('clients/' . $client->id) }}" method="post">

                     <!-- show the shark (uses the show method found at GET /sharks/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('clients/' . $client->id) }}">Afficher</a>

                    <!-- edit this shark (uses the edit method found at GET /sharks/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('clients/' . $client->id . '/edit') }}">Modifier</a>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
<<<<<<< HEAD
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce client.')">Supprimer</button>
=======
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce client ?')">Supprimer</button>
>>>>>>> poste
                </form>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@endsection