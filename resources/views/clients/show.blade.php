@extends('layout')

@section('contenu')
<div class="container">
    
    <h1>Voir {{ $client->nom }}  {{ $client->prenom }} </h1>
    
        <div class="jumbotron text-center">
            <h2>{{ $client->email }}</h2>
            <p>
                <strong>Rue:</strong> {{ $client->rue }}<br>
                <strong>N rue:</strong> {{ $client->nrue }}
            </p>
        </div>
    
    </div>
@endsection