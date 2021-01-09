@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zM13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            Ajout d'un contact
        </h3>
    </div>
    <div class="card-body">
    <form action="/clients" method="post">
    {{ csrf_field() }}
    <div class="form-row">

        <div class="form-group col-md-4">
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-4 pt-0">Civilité</legend>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="civilite" value="Monsieur" checked>
                            <label class="form-check-label">Mr.</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="civilite" value="Madame">
                            <label class="form-check-label">Mme</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="civilite" value="Mademoiselle">
                            <label class="form-check-label">Mlle</label>
                        </div>
                        
                    </div>
                </div>
            </fieldset>
        </div> 
        
      <div class="form-group col-md-4">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        @if ($errors->has('nom'))
                <p class="alert alert-danger">{{ $errors->first('nom') }}</p>
        @endif
      </div>
      <div class="form-group col-md-4">
        <label>Prénom</label>
      <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}">
        @if ($errors->has('prenom'))
                <p class="alert alert-danger">{{ $errors->first('prenom') }}</p>
            @endif
      </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-4">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <p class="alert alert-danger">{{ $errors->first('email') }}</p>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone fixe</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
            @if ($errors->has('telephone'))
                <p class="alert alert-danger">{{ $errors->first('telephone') }}</p>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}">
            @if ($errors->has('mobile'))
                <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
            @endif
          </div>

    </div>


    <div class="form-row">
        <div class="form-group col-md-8">
            <label>Rue</label>
            <input type="text" name="rue" class="form-control" value="{{ old('rue') }}">
            @if ($errors->has('rue'))
                <p class="alert alert-danger">{{ $errors->first('rue') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>N. rue</label>
            <input type="text" name="nrue" class="form-control" value="{{ old('nrue') }}">
            @if ($errors->has('nrue'))
                <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
            @endif
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Code postal</label>
            <input type="text" name="codepostal" class="form-control" value="{{ old('codepostal') }}">
            @if ($errors->has('codepostal'))
                <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Localité</label>
            <input type="text" name="localite" class="form-control" value="{{ old('localite') }}">
            @if ($errors->has('localite'))
                <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Pays</label>
            <select id="pays" name="pays" class="form-control">
                <option>Belgique</option>
                <option>France</option>
                <option>Luxembourg</option>
            </select>
            @if ($errors->has('pays'))
                <p class="alert alert-danger">{{ $errors->first('pays') }}</p>
            @endif
        </div>
        
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-4 pt-0">Assujetti</legend>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" id="assujetti" value="Assujetti" checked>
                            <label class="form-check-label" for="assujetti">Assujetti</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" id="nassujetti" value="Non assujetti">
                            <label class="form-check-label" for="nassujetti">Non assujetti</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" id="attente" value="En attente">
                            <label class="form-check-label" for="attente">En attente</label>
                        </div>
                        
                    </div>
                </div>
            </fieldset>
            @if ($errors->has('assujetti'))
                <p class="alert alert-danger">{{ $errors->first('assujetti') }}</p>
            @endif
        </div> 
        <div class="form-group col-md-6">
            <label>Numéro TVA</label>
            <input type="text" name="numtva" class="form-control" value="{{ old('numtva') }}">
            @if ($errors->has('numtva'))
                <p class="alert alert-danger">{{ $errors->first('numtva') }}</p>
            @endif
        </div>
    </div>

    
    
</div>
    <div class="card-footer text-center">
            <button type="reset" class="btn btn-danger">Annuler</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vos données ?')">Valider</button>
        </form>
    </div>
</div>



    
@endsection