@extends('layout')

@section('contenu')
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h5><strong>{{ Crypt::decrypt($fournisseur->civilite) }}  {{ Crypt::decrypt($fournisseur->nom) }}  {{ Crypt::decrypt($fournisseur->prenom) }}</strong></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <strong>Adresse : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->rue) }}, {{ Crypt::decrypt($fournisseur->nrue) }} 
                        </div>
                        <div class="col-6">
                            <strong>Localité : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->localite->code_postal) }} {{ Crypt::decrypt($fournisseur->localite->intitule) }} ({{ Crypt::decrypt($fournisseur->pays) }}) 
                        </div>
                        <div class="col-6">
                            <strong>E-mail : </strong>
                        </div>
                        <div class="col-6">
                            <a href="mailto:{{ Crypt::decrypt($fournisseur->email) }}">{{ Crypt::decrypt($fournisseur->email) }}</a> 
                        </div>
                        <div class="col-6">
                            <strong>Téléphone : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->telephone) }} 
                        </div>
                        <div class="col-6">
                            <strong>Mobile : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->mobile) }} 
                        </div>
                        <div class="col-6">
                            <strong>Numéro TVA : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->assujetti->num_tva) }} 
                        </div>
                        <div class="col-6">
                            <strong>Numéro de compte : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->num_compte) }} 
                        </div>
                        <div class="col-6">
                            <strong>Référence personnel : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->reference_personnel) }} 
                        </div>
                        <div class="col-6">
                            <strong>Délai de paiement : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->delai_paiement) }} 
                        </div>
                        <div class="col-6">
                            <strong>Remarque : </strong>
                        </div>
                        <div class="col-6">
                            {{ Crypt::decrypt($fournisseur->remarque) }} 
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ URL::to('fournisseurs/' . $fournisseur->id . '/edit') }}" class="btn btn-success">Modifier</a>
                </div>
            </div>
        </div>
        <div class="col-md-2">

        </div>
    </div>
@endsection