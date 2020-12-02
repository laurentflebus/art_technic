@extends('layout')

@section('contenu')
  <!-- Card -->
    <div class="card text-center">
        <h5 class="card-header">Client</h5>
        <div class="card-body">
            <h5 class="card-title">{{ Crypt::decrypt($client->civilite) }}  {{ Crypt::decrypt($client->nom) }}  {{ Crypt::decrypt($client->prenom) }}</h5>
            <p class="card-text">
                <strong>Adresse : </strong> {{ Crypt::decrypt($client->rue) }}, {{ Crypt::decrypt($client->nrue) }} <br>
                <strong>Localité : </strong> {{ Crypt::decrypt($client->localite->code_postal) }} {{ Crypt::decrypt($client->localite->intitule) }}
            </p>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('clients/' . $client->id . '/edit') }}" class="btn btn-success">Modifier</a>
        </div>
     
    </div>  
@endsection