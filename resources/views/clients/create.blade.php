@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Ajout d'un contact</h3>
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
            <select id="codepostal" name="codepostal" class="form-control">
                <option>Choississez</option>
                <option>1000</option>
                <option>5000</option>
                <option>7130</option>
                <option>7000</option>
            </select>
            @if ($errors->has('codepostal'))
                <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Localité</label>
            <select id="localite" name="localite" class="form-control">
                <option value="">Choississez</option>
                <option>Bruxelles</option>
                <option>Binche</option>
                <option>Charleroi</option>
                <option>Mons</option>
            </select>
            @if ($errors->has('localite'))
                <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Pays</label>
            <select id="pays" name="pays" class="form-control">
                <option value="">Choississez</option>
                <option>Belgique</option>
                <option>France</option>
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