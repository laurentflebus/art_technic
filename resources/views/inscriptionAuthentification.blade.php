@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Ajout d'un utilisateur</h3>
    </div>
    <div class="card-body">
        <form action="/inscriptionAuthentification" method="post">
            <br>
                
            {{-- Ajoute un input de type hidden avec un nombre aléatoire généré qui permet à Laravel
                 de vérifier que le formulaire est bien envoyé depuis le site --}}
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="user">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="user" name="user" value="{{ old('user') }}">
                {{-- variable $errors  contient toutes les erreurs --}}
                
                @if ($errors->has('user'))
                    <p class="alert alert-danger">{{ $errors->first('user') }}</p>
                @endif
            </div>
            
    
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @if ($errors->has('password'))
                    <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>
            
    
            <div class="form-group">
                <label for="password_confirmation">Confirmation</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
    
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-2 pt-0">Type de compte</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="admin" value="0" checked>
                            <label class="form-check-label" for="gridRadios1">Utilisateur régulier</label>
                        </div>
                        @if ($errors->has('utilisateur'))
                            <p class="alert alert-danger">{{ $errors->first('admin') }}</p>
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="admin" value="1">
                            <label class="form-check-label" for="gridRadios2">Administrateur</label>
                        </div>
                        @if ($errors->has('admin'))
                            <p class="alert alert-danger">{{ $errors->first('admin') }}</p>
                        @endif
                    </div>
                </div>
            </fieldset>
    
            
    <div class="card-footer text-center">
        <button type="reset" class="btn btn-danger">Annuler</button>
        <button type="submit" class="btn btn-primary">Valider</button>
            
        </form>
    </div>
    </div>
</div>
    

@endsection