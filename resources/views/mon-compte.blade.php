@extends('layout')

@section('contenu')
    <div class="container">
        <h1 class="display-1">Mon compte</h1>

    <p>Vous êtes bien connecté {{ auth()->user()->user }}</p>

    </div>

    {{-- Formulaire de modification de mot de passe --}}
    <br>
    <form class="section" action="/modification-mot-de-passe" method="post">
        
        {{ csrf_field() }}
        
        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
            @if ($errors->has('password'))
                <p class="alert alert-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        

        <div class="form-group">
            <label for="password_confirmation">Confirmation mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Modifier</button>
   
    </form>
    
@endsection