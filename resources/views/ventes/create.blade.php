@extends('layout')

@section('contenu')
<h3>Création d'une Vente</h3>
<form action="/ventes" method="post">
    {{ csrf_field() }}
    <input type="hidden" id="nbPoste" name="nbPoste" value="1">
    <div id="clone">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Code barre</label>
                <input type="text" id="codebarre1" name="codebarre1" class="form-control" value="{{ old('codebarre1') }}">
                @if ($errors->has('codebarre1'))
                        <p class="alert alert-danger">{{ $errors->first('codebarre1') }}</p>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label>Référence</label>
                <select id="numeroposte1" name="numeroposte1" class="form-control">
                    @foreach ($postes as $poste)
                        <option value="{{ $poste->numero }}">
                            {{ $poste->numero }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('numeroposte1'))
                    <p class="alert alert-danger">{{ $errors->first('numeroposte1') }}</p>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label>Intitulé</label>
                <select id="intituleposte1" name="intituleposte1" class="form-control">
                    @foreach ($postes as $poste)
                        <option value="{{ $poste->intitule }}">
                            {{ $poste->intitule }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('intituleposte1'))
                    <p class="alert alert-danger">{{ $errors->first('intituleposte1') }}</p>
                @endif
            </div>
            
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Quantité</label>
                <input type="text" id="quantite1" name="quantite1" class="form-control" value="{{ old('quantite1') }}">
                @if ($errors->has('quantite1'))
                        <p class="alert alert-danger">{{ $errors->first('quantite1') }}</p>
                @endif
            </div>

            <div class="form-group col-md-2">
                    <label for="poste">Prix unitaire TVAC</label>
                    <input type="text" id="prixtvac1" name="prixtvac1" class="form-control" value="{{ old('prixtvac1') }}">
                    @if ($errors->has('prixtvac1'))
                        <p class="alert alert-danger">{{ $errors->first('prixtvac1') }}</p>
                    @endif
            </div>

            <div class="form-group col-md-2">
                <label>Prix unitaire HT</label>
                <input type="text" id="prixhtva1" name="prixhtva1" class="form-control" value="{{ old('prixhtva1') }}">
                @if ($errors->has('prixhtva1'))
                    <p class="alert alert-danger">{{ $errors->first('prixhtva1') }}</p>
                @endif
            </div>

            <div class="form-group col-md-2">
                <label>Total TTC par article</label>
                <input type="text" id="totalttca1" name="totalttca1" class="form-control" value="{{ old('totalttca1') }}">
                @if ($errors->has('totalttca1'))
                    <p class="alert alert-danger">{{ $errors->first('totalttca1') }}</p>
                @endif           
            </div>
            <div class="form-group col-md-2">
                <button type="button" class="btn btn-outline-primary btn-sm" id="ajouterposte">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
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
            <input type="text" id="totalttc" name="totalttc" class="form-control" value="{{ old('totalttc') }}">
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
    <button type="reset" class="btn btn-danger">Annuler</button>
    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vos données ?')">Valider</button>
</form>
@endsection