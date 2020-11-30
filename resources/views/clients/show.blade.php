@extends('layout')

@section('contenu')
<div class="container">
    
    <h1>Voir {{ Crypt::decrypt($client->nom) }}  {{ Crypt::decrypt($client->prenom) }} </h1>
    
        <div class="jumbotron text-center">
            <h2>{{ Crypt::decrypt($client->email) }}</h2>
            <p>
                <strong>Rue:</strong> {{ Crypt::decrypt($client->rue) }}<br>
                <strong>N rue:</strong> {{ Crypt::decrypt($client->nrue) }}
            </p>
        </div>
    
    </div>
@endsection