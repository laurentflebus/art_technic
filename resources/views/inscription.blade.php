@extends('layout')

@section('contenu')
    <form action="/inscription" method="post">
        <fieldset>
            <legend>Formulaire d'inscription utilisateur</legend>
        {{-- Ajoute un input de type hidden avec un nombre aléatoire généré qui permet à Laravel
             de vérifier que le formulaire est bien envoyé depuis le site --}}
        {{ csrf_field() }}
        
        <div class="form-group">
            <label for="user">Utilisateur</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Utilisateur" value="{{ old('user') }}">
            {{-- variable $errors  contient toutes les erreurs --}}
            @if ($errors->has('user'))
                <p class="alert alert-danger">{{ $errors->first('user') }}</p>
            @endif
        </div>
        

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            @if ($errors->has('password'))
                <p class="alert alert-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>
        

        <div class="form-group">
            <label for="password_confirmation">Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Mot de passe (confirmation)">
            @if ($errors->has('password_confirmation'))
                <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">M'inscrire</button>
        </fieldset>
    </form>

@endsection