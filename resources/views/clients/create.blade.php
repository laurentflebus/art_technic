@extends('layout')

@section('contenu')

<h1>Créer un client</h1>

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
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone fixe</label>
            <input type="text" name="telephone" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone mobile</label>
            <input type="text" name="mobile" class="form-control">
          </div>

    </div>


    <div class="form-row">
        <div class="form-group col-md-8">
            <label>Rue</label>
            <input type="text" name="rue" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>N. rue</label>
            <input type="text" name="nrue" class="form-control">
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Code postal</label>
            <select id="codepostal" name="codepostal" class="form-control">
                <option selected>Choississez</option>
                <option>7130</option>
                <option>7000</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Localité</label>
            <select id="localite" name="localite" class="form-control">
                <option selected>Choississez</option>
                <option>Binche</option>
                <option>Mons</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Pays</label>
            <select id="codepostal" name="pays" class="form-control">
                <option selected>Choississez</option>
                <option>Belgique</option>
                <option>France</option>
            </select>
        </div>
        
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-4 pt-0">Assujetti</legend>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" value="Assujetti" checked>
                            <label class="form-check-label">Assujetti</label>
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" value="Non assujetti">
                            <label class="form-check-label">Non assujetti</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" value="En attente">
                            <label class="form-check-label">En attente</label>
                        </div>
                        
                    </div>
                </div>
            </fieldset>
        </div> 
        <div class="form-group col-md-6">
            <label>Numéro TVA</label>
            <input type="text" name="numtva" class="form-control">
        </div>
    </div>

    
    <button type="submit" class="btn btn-primary">Valider</button>
  </form>

    
@endsection