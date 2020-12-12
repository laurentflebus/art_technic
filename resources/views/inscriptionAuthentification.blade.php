@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Ajout d'un utilisateur</h3>
    </div>
    <div class="card-body">
        <form action="/inscriptionAuthentification" method="post">
                
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
                    <label for="password">Password</label>
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
                    <label for="password_confirmation">Confirmation</label>
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
    
            
    <div class="card-footer text-center">
        <button type="reset" class="btn btn-danger">Annuler</button>
        <button type="submit" class="btn btn-primary">Valider</button>
            
        </form>
    </div>
    </div>
</div>
    

@endsection