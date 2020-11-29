@extends('layout')

@section('contenu')
<h1>Modifier {{ $client->nom }} {{ $client->prenom }}</h1>
<form action="/clients" method="PUT">
    {{ csrf_field() }}
    <div class="form-row">

        <div class="form-group col-md-4">
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-4 pt-0">Civilité</legend>
                    <div class="col-sm-8">
                        @foreach ($civilites as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="civilite" value="{{ $item->civilite }}"
                                @if ($client->civilite == $item->civilite)
                                    checked
                                @endif
                                >
                                <label class="form-check-label">{{ $item->civilite }}</label>
                            </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </fieldset>
        </div> 
        
      <div class="form-group col-md-4">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $client->nom }}">
        @if ($errors->has('nom'))
                <p class="alert alert-danger">{{ $errors->first('nom') }}</p>
        @endif
      </div>
      <div class="form-group col-md-4">
        <label>Prénom</label>
      <input type="text" name="prenom" class="form-control" value="{{ $client->prenom }}">
        @if ($errors->has('prenom'))
                <p class="alert alert-danger">{{ $errors->first('prenom') }}</p>
            @endif
      </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-4">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email }}">
            @if ($errors->has('email'))
                <p class="alert alert-danger">{{ $errors->first('email') }}</p>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone fixe</label>
            <input type="text" name="telephone" class="form-control" value="{{ $client->telephone }}">
            @if ($errors->has('telephone'))
                <p class="alert alert-danger">{{ $errors->first('telephone') }}</p>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{ $client->mobile }}">
            @if ($errors->has('mobile'))
                <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
            @endif
          </div>

    </div>


    <div class="form-row">
        <div class="form-group col-md-8">
            <label>Rue</label>
            <input type="text" name="rue" class="form-control" value="{{ $client->rue }}">
            @if ($errors->has('rue'))
                <p class="alert alert-danger">{{ $errors->first('rue') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>N. rue</label>
            <input type="text" name="nrue" class="form-control" value="{{ $client->nrue }}">
            @if ($errors->has('nrue'))
                <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
            @endif
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Code postal</label>
            <select id="codepostal" name="codepostal" class="form-control">
                @foreach ($localites as $localite)
                    <option value="{{ $localite->code_postal }}"
                        @if ($client->localite->code_postal == $localite->code_postal)
                            selected="selected"
                        @endif
                    >{{ $localite->code_postal }}</option>
                @endforeach
                
            </select>
            @if ($errors->has('codepostal'))
                <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Localité</label>
            <select id="localite" name="localite" class="form-control">
                @foreach ($localites as $localite)
                    <option value="{{ $localite->intitule }}"
                        @if ($client->localite->intitule == $localite->intitule)
                            selected="selected"
                        @endif
                    >{{ $localite->intitule }}</option>
                @endforeach
            </select>
            @if ($errors->has('localite'))
                <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Pays</label>
            <select id="codepostal" name="pays" class="form-control">
                @foreach ($pays as $item)
                    <option value="{{ $item->pays }}"
                        @if ($client->pays == $item->pays)
                            selected="selected"
                        @endif
                    >{{ $item->pays }}</option>
                @endforeach
            </select>
            @if ($errors->has('codepostal'))
                <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
            @endif
        </div>
        
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-4 pt-0">Assujetti</legend>
                    <div class="col-sm-6">
                        @foreach ($assujettis as $assujetti)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" value="{{ $assujetti->intitule }}" 
                                @if ($client->assujetti->intitule == $assujetti->intitule)
                                    checked
                                @endif
                            >
                        <label class="form-check-label">{{ $assujetti->intitule }}</label>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </fieldset>
        </div> 
        <div class="form-group col-md-6">
            <label>Numéro TVA</label>
        <input type="text" name="numtva" class="form-control" value="{{ $client->assujetti->num_tva }}">
        </div>
    </div>

    
    <button type="submit" class="btn btn-primary">Modifier</button>
  </form>
@endsection