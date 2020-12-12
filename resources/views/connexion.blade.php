@extends('layout')

@section('contenu')
<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h3>Connexion</h3>
            </div>
            <div class="card-body">
                <form action="/" method="post">
                    <br>
                    {{-- Ajoute un input de type hidden avec un nombre aléatoire généré qui permet à Laravel
                         de vérifier que le formulaire est bien envoyé depuis le site --}}
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="user">Utilisateur</label>
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