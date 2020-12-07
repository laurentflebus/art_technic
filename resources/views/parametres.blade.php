@extends('layout')

@section('contenu')
<h3>Information de la société</h3>
<form action="/parametres" method="post">

    {{ csrf_field() }}
           
    <div class="input-group mb-3">
        <span class="input-group-text">Nom</span>
        <input type="text" name="nom" class="form-control" value="">
        @if ($errors->has('nom'))
            <p class="alert alert-danger">{{ $errors->first('nom') }}</p>
        @endif
    </div>
    
    <div class="input-group mb-3">
        <span class="input-group-text">N°TVA</span>
        <input type="text" name="numtva" class="form-control" value="">
        @if ($errors->has('numtva'))
            <p class="alert alert-danger">{{ $errors->first('numtva') }}</p>
        @endif
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Registre</span>
        <input type="text" name="registre" class="form-control" value="">
        @if ($errors->has('registre'))
            <p class="alert alert-danger">{{ $errors->first('registre') }}</p>
        @endif
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">N°Compte</span>
        <input type="text" name="numcompte" class="form-control" value="">
        @if ($errors->has('numcompte'))
            <p class="alert alert-danger">{{ $errors->first('numcompte') }}</p>
        @endif
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Téléphone</span>
        <input type="text" name="telephone" class="form-control" value="">
        @if ($errors->has('telephone'))
            <p class="alert alert-danger">{{ $errors->first('telephone') }}</p>
        @endif
    </div>

    <div class="form-row">
        <div class="input-group col-md-6">
            <span class="input-group-text">Rue</span>
            <input type="text" name="rue" class="form-control" value="">
            @if ($errors->has('rue'))
                <p class="alert alert-danger">{{ $errors->first('rue') }}</p>
            @endif
        </div>
        <div class="input-group col-md-6">
            <span class="input-group-text">N. rue</span>
            <input type="text" name="nrue" class="form-control" value="{{ old('nrue') }}">
            @if ($errors->has('nrue'))
                <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
            @endif
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="form-label">Code postal</label>
            <select class="form-control" id="codepostal" name="codepostal">
                <option value=""></option>
                <option>1000</option>
                <option>5000</option>
                <option>7130</option>
                <option>7000</option>
            </select>
            @if ($errors->has('codepostal'))
                <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
            @endif
          </div>

          <div class="form-group col-md-4">
            <label class="form-label">Localité</label>
            <select id="localite" name="localite" class="form-control">
                <option value="">Choississez</option>
                <option>Bruxelles</option>
                <option>Binche</option>
                <option>Charleroi</option>
                <option>Mons</option>
            </select>
            @if ($errors->has('localite'))
                <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
            @endif
        </div>
        

        <div class="form-group col-md-4">
            <label class="form-label">Pays</label>
            <select id="pays" name="pays" class="form-control">
                <option value="">Choississez</option>
                <option>Belgique</option>
                <option>France</option>
            </select>
            @if ($errors->has('pays'))
                <p class="alert alert-danger">{{ $errors->first('pays') }}</p>
            @endif
        </div>
        
        
    </div>

    <div class="mb-3">
        <label for="remarque" class="form-label">Remarque</label>
        <textarea class="form-control" id="remarque" rows="3" name="remarque"></textarea>
    </div>
    

    
    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vos données ?')">Valider</button>
  </form>
@endsection