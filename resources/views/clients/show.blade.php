@extends('layout')

@section('contenu')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h5><strong>{{ Crypt::decrypt($client->civilite) }}  {{ Crypt::decrypt($client->nom) }}  {{ Crypt::decrypt($client->prenom) }}</strong></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <strong>Adresse : </strong>
                    </div>
                    <div class="col-6">
                        {{ Crypt::decrypt($client->rue) }}, {{ Crypt::decrypt($client->nrue) }} 
                    </div>
                    <div class="col-6">
                        <strong>Localité : </strong>
                    </div>
                    <div class="col-6">
                        {{ Crypt::decrypt($client->localite->code_postal) }} {{ Crypt::decrypt($client->localite->intitule) }} ({{ Crypt::decrypt($client->pays) }}) 
                    </div>
                    <div class="col-6">
                        <strong>E-mail : </strong>
                    </div>
                    <div class="col-6">
                        <a href="mailto:{{ Crypt::decrypt($client->email) }}">{{ Crypt::decrypt($client->email) }}</a> 
                    </div>
                    <div class="col-6">
                        <strong>Téléphone : </strong>
                    </div>
                    <div class="col-6">
                        {{ Crypt::decrypt($client->telephone) }} 
                    </div>
                    <div class="col-6">
                        <strong>Mobile : </strong>
                    </div>
                    <div class="col-6">
                        {{ Crypt::decrypt($client->mobile) }} 
                    </div>
                    <div class="col-6">
                        <strong>Numéro TVA : </strong>
                    </div>
                    <div class="col-6">
                        {{ Crypt::decrypt($client->assujetti->num_tva) }} 
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ URL::to('clients/' . $client->id . '/edit') }}" class="btn btn-success">Modifier</a>
            </div>
        </div>
    </div>
    <div class="col-md-2">

    </div>
</div>
@endsection