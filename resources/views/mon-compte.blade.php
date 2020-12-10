@extends('layout')

@section('contenu')
    <div class="card">
        <div class="card-header text-center">
            <h3>Bienvenue sur votre compte</h3>
            <p>Vous êtes connecté en tant que <strong>{{ auth()->user()->user }}</strong></p>
        </div>
        <div class="card-body">
            <form class="section" action="/modification-mot-de-passe" method="post">
                
                {{ csrf_field() }}
                
                <div class="form-group col-md-6">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @if ($errors->has('password'))
                        <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                
        
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmation mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
                
                
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Modifier</button>
           
            </form>
        </div>
    </div>
@endsection