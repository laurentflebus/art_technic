@extends('layout')

@section('contenu')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h3>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-in-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                    Connexion
                </h3>
            </div>
            <div class="card-body">
                <form action="/" method="post">
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
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->has('password'))
                            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Se connecter</button>
                    
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">

    </div>
</div>
@endsection