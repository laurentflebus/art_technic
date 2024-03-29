@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-building" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694L1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
            </svg>
            Créer les Informations de la Société
            
        </h3>
        
    </div>
    <div class="card-body">
        <form action="/parametres/create" method="post">

            {{ csrf_field() }}
            
            
            <div class="input-group mb-3">
                <span class="input-group-text">Nom</span>
                <input type="text" name="nom" class="form-control" value="{{ old('nom')}}">
                @if ($errors->has('nom'))
                    <p class="alert alert-danger">{{ $errors->first('nom') }}</p>
                @endif
            </div>
            
            <div class="input-group mb-3">
                <span class="input-group-text">N°TVA</span>
                <input type="text" name="numtva" class="form-control" value="{{ old('numtva')}}">
                @if ($errors->has('numtva'))
                    <p class="alert alert-danger">{{ $errors->first('numtva') }}</p>
                @endif
            </div>
        
            <div class="input-group mb-3">
                <span class="input-group-text">Registre</span>
                <input type="text" name="registre" class="form-control" value="{{ old('registre')}}">
                @if ($errors->has('registre'))
                    <p class="alert alert-danger">{{ $errors->first('registre') }}</p>
                @endif
            </div>
        
            <div class="input-group mb-3">
                <span class="input-group-text">N°Compte</span>
                <input type="text" name="numcompte" class="form-control" value="{{ old('numcompte')}}">
                @if ($errors->has('numcompte'))
                    <p class="alert alert-danger">{{ $errors->first('numcompte') }}</p>
                @endif
            </div>
        
            <div class="input-group mb-3">
                <span class="input-group-text">Téléphone</span>
                <input type="text" name="telephone" class="form-control" value="{{ old('telephone')}}">
                @if ($errors->has('telephone'))
                    <p class="alert alert-danger">{{ $errors->first('telephone') }}</p>
                @endif
            </div>
        
            <div class="input-group mb-3">
                <span class="input-group-text">Rue</span>
                <input type="text" name="rue" class="form-control" value="{{ old('rue') }}">
                @if ($errors->has('rue'))
                    <p class="alert alert-danger">{{ $errors->first('rue') }}</p>
                @endif
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">N. rue</span>
                <input type="text" name="nrue" class="form-control" value="{{ old('nrue') }}">
                @if ($errors->has('nrue'))
                    <p class="alert alert-danger">{{ $errors->first('nrue') }}</p>
                @endif
            </div>
        
        
        
            <div class="input-group mb-3">
                <span class="input-group-text">Code postal</span>
                <input type="text" name="codepostal" class="form-control" value="{{ old('codepostal') }}">
                @if ($errors->has('codepostal'))
                    <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
                @endif
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Localité</span>
                <input type="text" name="localite" class="form-control" value="{{ old('localite') }}">
                @if ($errors->has('localite'))
                    <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
                @endif
            </div>
        

            <div class="input-group mb-3">
                <span class="input-group-text">Pays</span>
                <select id="pays" name="pays" class="form-control">
                    <option>Belgique</option>
                    <option>France</option>
                </select>
                @if ($errors->has('pays'))
                    <p class="alert alert-danger">{{ $errors->first('pays') }}</p>
                @endif
            </div>

            
            <div class="form-group mb-3">
                <span class="input-group-text" id="remarque">Remarque</span>
                <textarea class="form-control" id="remarque" rows="3" name="remarque">{{ old('remarque') }}</textarea>
                @if ($errors->has('remarque'))
                        <p class="alert alert-danger">{{ $errors->first('remarque') }}</p>
                @endif
            </div>
                
           
            
            
    </div>
    <div class="card-footer text-center">
            <button type="reset" class="btn btn-danger">Annuler</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vos données ?')">Valider</button>
        </form>
        
    </div>
</div>


@endsection