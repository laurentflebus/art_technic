@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg> 
            Ajout d'un Utilisateur
        </h3>
    </div>
    <div class="card-body">
        <form action="/inscription" method="post">
                
            {{-- Ajoute un input de type hidden avec un nombre aléatoire généré qui permet à Laravel
                 de vérifier que le formulaire est bien envoyé depuis le site --}}
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-md-3">

                </div>
                <div class="form-group col-md-6">
                    <label for="user">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="user" name="user" value="{{ old('user') }}">
                    {{-- variable $errors  contient toutes les erreurs --}}
                    
                    @if ($errors->has('user'))
                        <p class="alert alert-danger">{{ $errors->first('user') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-3">

                </div>
            </div>
            
            
            <div class="row">
                <div class="form-group col-md-3">

                </div>
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                        <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-3">

                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-3">

                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmation (mot de passe)</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-3">

                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-3">

                </div>
                <fieldset class="form-group col-md-6">
                    <div class="row">
                        <legend class="col-form-label col-md-4">Type de compte</legend>
                        <div class="col-md-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="admin" id="util" value="0" checked>
                                <label class="form-check-label" for="util">Utilisateur régulier</label>
                            </div>
                            @if ($errors->has('utilisateur'))
                                <p class="alert alert-danger">{{ $errors->first('admin') }}</p>
                            @endif
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="admin" id="admin" value="1">
                                <label class="form-check-label" for="admin">Administrateur</label>
                            </div>
                            @if ($errors->has('admin'))
                                <p class="alert alert-danger">{{ $errors->first('admin') }}</p>
                            @endif
                        </div>
                    </div>
                </fieldset>
                <div class="form-group col-md-3">

                </div>
            </div>
        </div>   
    <div class="card-footer text-center">
        <button type="reset" class="btn btn-danger">Annuler</button>
        <button type="submit" class="btn btn-primary">Valider</button>
            
        </form>
    </div>   
</div>
    

@endsection