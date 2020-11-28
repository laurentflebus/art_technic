@extends('layout')

@section('contenu')

<h1>Tous les clients</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Civilité</td>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($clients as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->civilite }}</td>
            <td>{{ $value->nom }}</td>
            <td>{{ $value->prenom }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the shark (uses the destroy method DESTROY /sharks/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the shark (uses the show method found at GET /sharks/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('sharks/' . $value->id) }}">Voir ce client</a>

                <!-- edit this shark (uses the edit method found at GET /sharks/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('sharks/' . $value->id . '/edit') }}">Modifier ce client</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    
@endsection