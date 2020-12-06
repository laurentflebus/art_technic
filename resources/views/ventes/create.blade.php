@extends('layout')

@section('contenu')
<h3>Création d'une Vente</h3>
<form action="/ventes" method="post">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Code barre</label>
            <input type="text" id="codebarre" name="codebarre" class="form-control" value="{{ old('codebarre') }}">
            @if ($errors->has('codebarre'))
                    <p class="alert alert-danger">{{ $errors->first('codebarre') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Référence</label>
            <select id="numeroposte" name="numeroposte" class="form-control">
                @foreach ($postes as $poste)
                    <option value="{{ $poste->numero }}">
                        {{ $poste->numero }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('numeroposte'))
                <p class="alert alert-danger">{{ $errors->first('numeroposte') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Intitulé</label>
            <select id="intituleposte" name="intituleposte" class="form-control">
                @foreach ($postes as $poste)
                    <option value="{{ $poste->intitule }}">
                        {{ $poste->intitule }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('intituleposte'))
                <p class="alert alert-danger">{{ $errors->first('intituleposte') }}</p>
            @endif
        </div>
        
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Quantité</label>
            <input type="text" id="quantite" name="quantite" class="form-control" value="{{ old('quantite') }}">
            @if ($errors->has('quantite'))
                    <p class="alert alert-danger">{{ $errors->first('quantite') }}</p>
            @endif
        </div>

        <div class="form-group col-md-3">
                <label for="poste">Prix unitaire TVAC</label>
                <input type="text" id="prixtvac" name="prixtvac" class="form-control" value="{{ old('prixtvac') }}">
                @if ($errors->has('prixtvac'))
                    <p class="alert alert-danger">{{ $errors->first('prixtvac') }}</p>
                @endif
        </div>

        <div class="form-group col-md-3">
            <label>Prix unitaire HT</label>
            <input type="text" id="prixhtva" name="prixhtva" class="form-control" value="{{ old('prixhtva') }}">
            @if ($errors->has('prixhtva'))
                <p class="alert alert-danger">{{ $errors->first('prixhtva') }}</p>
            @endif
        </div>

        <div class="form-group col-md-3">
            <label>Total TTC par article</label>
            <input type="text" id="totalttca" name="totalttca" class="form-control" value="{{ old('totalttca') }}">
            @if ($errors->has('totalttca'))
                <p class="alert alert-danger">{{ $errors->first('totalttca') }}</p>
            @endif
        </div>
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