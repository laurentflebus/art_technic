@extends('layout')

@section('contenu')
<h3>Modifier la vente : {{ $vente->facture->numero }}</h3>
<form action="/ventes/{{ $vente->id }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Code barre</label>
            @foreach ($vente->postes as $poste)
                <input type="text" name="codebarre" class="form-control" value="{{ $poste->code_barre }}">
            @endforeach
            @if ($errors->has('codebarre'))
                    <p class="alert alert-danger">{{ $errors->first('codebarre') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Référence</label>
            <select name="numeroposte" class="form-control">
                @foreach ($vente->postes as $poste)
                    <option value="{{ $poste->numero }}" 
                    @foreach ($postes as $item)
                        @if ($poste->id == $item->id)
                            selected
                        @endif
                    @endforeach>
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
            <select name="intituleposte" class="form-control">
                @foreach ($vente->postes as $poste)
                    <option value="{{ $poste->intitule }}" 
                    @foreach ($postes as $item)
                        @if ($poste->id == $item->id)
                            selected
                        @endif
                    @endforeach>
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
        <div class="form-group col-md-6">
            <label>Quantité</label>
            @foreach ($vente->postes as $poste)
                <input type="text" name="quantite" class="form-control" value="{{ $poste['pivot']['quantite'] }}">
                @if ($errors->has('quantite'))
                        <p class="alert alert-danger">{{ $errors->first('quantite') }}</p>
                @endif
            @endforeach          
      </div>

      <div class="form-group col-md-6">
            <label for="poste">Prix unitaire TVAC</label>
            @foreach ($vente->postes as $poste)
                <input type="text" name="prixtvac" class="form-control" value="{{ $poste['pivot']['prix_unitaire'] }}">
                @if ($errors->has('prixtvac'))
                    <p class="alert alert-danger">{{ $errors->first('prixtvac') }}</p>
                @endif
            @endforeach        
      </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Prix unitaire HT</label>
            <input type="text" name="prixhtva" class="form-control" value="{{ old('prixhtva') }}">
            @if ($errors->has('prixhtva'))
                <p class="alert alert-danger">{{ $errors->first('prixhtva') }}</p>
            @endif
        </div>

        <div class="form-group col-md-6">
            <label>Total TTC par article</label>
            <input type="text" name="totalttca" class="form-control" value="{{ old('totalttca') }}">
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
            <input type="text" name="totalttc" class="form-control" value="{{ old('totalttc') }}">
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
            <input type="text" name="date" class="form-control" value="{{ $vente->created_at }}">
            @if ($errors->has('date'))
                <p class="alert alert-danger">{{ $errors->first('date') }}</p>
            @endif
        </div>
    </div>
    <button type="reset" class="btn btn-danger">Annuler</button>
    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vouloir modifier cette vente ?')">Valider</button>
</form>


@endsection