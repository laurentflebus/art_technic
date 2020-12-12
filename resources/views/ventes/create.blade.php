@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Création d'une Vente</h3>
    </div>
    <div class="card-body">
        <form action="/ventes" id="formvente" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="nbPoste" name="nbPoste" value="1">
            
                <div class="form-row text-center">
                    <div class="form-group col-md-4">
                        <label>Code barre</label>
                        <input type="text" id="codebarre" name="codebarre" class="form-control" value="{{ old('codebarre') }}">
                        @if ($errors->has('codebarre'))
                                <p class="alert alert-danger">{{ $errors->first('codebarre') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label>Quantité</label>
                        <input type="text" id="quantite" name="quantite" class="form-control" value="{{ old('quantite') }}">
                        @for ($i = 1; $i <= 10; $i++)
                            @if ($errors->has('quantite'.$i))
                            <p class="alert alert-danger">{{ $errors->first('quantite'.$i) }}</p>
                            @endif
                        @endfor
                        
                    </div>
                    <div class="form-group col-md-2">
                        <div>
                            <label>Ajouter</label>
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm" id="ajouterposte">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="form-group col-md-2">
                        <div>
                            <label>Supprimer</label>
                        </div>
                        
                        <button type="button" class="btn btn-outline-danger btn-sm" id="supprimerposte">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </button>
                    </div>
                </div>
        
                <div id="clone">
                    <div class="form-row text-center">
                        <div class="form-group col-md-2">
                            <label>Référence</label>
                            <input type="text" id="numeroposte1" name="numeroposte1" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Intitulé</label>
                            <input type="text" id="intituleposte1" name="intituleposte1" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Qté</label>
                            <input type="text" id="quantite1" name="quantite1" class="form-control" readonly>
                        </div>
        
                        <div class="form-group col-md-2">
                            <label for="poste">P.U TVAC</label>
                            <input type="text" id="prixtvac1" name="prixtvac1" class="form-control" readonly>
                            
                        </div>
        
                        <div class="form-group col-md-2">
                            <label>P.U HT</label>
                            <input type="text" id="prixhtva1" name="prixhtva1" class="form-control" readonly>                   
                        </div>
        
                        <div class="form-group col-md-2">
                            <label>Total TTC</label>
                            <input type="text" id="totalttca1" name="totalttca1" class="form-control" readonly>                              
                        </div>

                        
                    </div>
                </div>
        
            <div id="bloc">
                
            </div>
            
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Client</label>
                    <select name="client" class="form-control">
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">
                                {{ Crypt::decrypt($client->nom) }} {{ Crypt::decrypt($client->prenom) }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('client'))
                        <p class="alert alert-danger">{{ $errors->first('client') }}</p>
                    @endif
                </div>
        
                <div class="form-group col-md-6">
                    <label>Total TTC</label>
                    <input type="text" id="totalttc" name="totalttc" class="form-control" readonly>
                    @if ($errors->has('totalttc'))
                        <p class="alert alert-danger">{{ $errors->first('totalttc') }}</p>
                    @endif
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Mode de règlement</label>
                    <select name="modereglement" class="form-control">
                            <option>Comptant</option>
                            <option>Carte</option>
                            <option>Crédit</option>
                    </select>
                    @if ($errors->has('modereglement'))
                        <p class="alert alert-danger">{{ $errors->first('modereglement') }}</p>
                    @endif
                </div>
        
                <div class="form-group col-md-6">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="{{ $d = date('Y-m-d') }}" placeholder="Y-m-d">
                    @if ($errors->has('date'))
                        <p class="alert alert-danger">{{ $errors->first('date') }}</p>
                    @endif
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="ticket" id="ticket" name='ticket' checked>
                <label class="form-check-label" for="ticket">
                    Ticket de caisse
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="facture" id="facture" name='facture'>
                <label class="form-check-label" for="facture">
                    Facture
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="bon" id="bon" name='bon'>
                <label class="form-check-label" for="bon">
                    Bon de commande
                </label>
            </div>
    </div>
    
    <div class="card-footer text-center">
        <button type="reset" class="btn btn-danger">Annuler</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vos données ?')">Valider</button>
        </form>
    </div>
</div>


@endsection