@extends('layout')

@section('contenu')
<h3>Modification du contact : {{ Crypt::decrypt($client->nom) }} {{ Crypt::decrypt($client->prenom) }}</h3>
<form action="/clients/{{ $client->id }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-row">

        <div class="form-group col-md-4">
            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-sm-4 pt-0">Civilité</legend>
                    <div class="col-sm-8">
                        @foreach ($civilites as $item)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="civilite" value="{{ $item->civilite }}"
                                @if (Crypt::decrypt($client->civilite) == Crypt::decrypt($item->civilite))
                                    checked
                                @endif
                                >
                                <label class="form-check-label">{{ Crypt::decrypt($item->civilite) }}</label>
                            </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </fieldset>
        </div> 
        
      <div class="form-group col-md-4">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ Crypt::decrypt($client->nom) }}">
        @if ($errors->has('nom'))
                <p class="alert alert-danger">{{ $errors->first('nom') }}</p>
        @endif
      </div>
      <div class="form-group col-md-4">
        <label>Prénom</label>
      <input type="text" name="prenom" class="form-control" value="{{ Crypt::decrypt($client->prenom) }}">
        @if ($errors->has('prenom'))
                <p class="alert alert-danger">{{ $errors->first('prenom') }}</p>
            @endif
      </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-4">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ Crypt::decrypt($client->email) }}">
            @if ($errors->has('email'))
                <p class="alert alert-danger">{{ $errors->first('email') }}</p>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone fixe</label>
            <input type="text" name="telephone" class="form-control" value="{{ Crypt::decrypt($client->telephone) }}">
            @if ($errors->has('telephone'))
                <p class="alert alert-danger">{{ $errors->first('telephone') }}</p>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label>Téléphone mobile</label>
            <input type="text" name="mobile" class="form-control" value="{{ Crypt::decrypt($client->mobile) }}">
            @if ($errors->has('mobile'))
                <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
            @endif
          </div>

    </div>


    <div class="form-row">
        <div class="form-group col-md-8">
            <label>Rue</label>
            <input type="text" name="rue" class="form-control" value="{{ Crypt::decrypt($client->rue) }}">
            @if ($errors->has('rue'))
                <p class="alert alert-danger">{{ $errors->first('rue') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>N. rue</label>
            <input type="text" name="nrue" class="form-control" value="{{ Crypt::decrypt($client->nrue) }}">
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
                    <option value="{{ Crypt::decrypt($localite->code_postal) }}"
                        @if (Crypt::decrypt($client->localite->code_postal) == Crypt::decrypt($localite->code_postal))
                            selected="selected"
                        @endif
                    >{{ Crypt::decrypt($localite->code_postal) }}</option>
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
                    <option value="{{ Crypt::decrypt($localite->intitule) }}"
                        @if (Crypt::decrypt($client->localite->intitule) == Crypt::decrypt($localite->intitule))
                            selected="selected"
                        @endif
                    >{{ Crypt::decrypt($localite->intitule) }}</option>
                @endforeach
            </select>
            @if ($errors->has('localite'))
                <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label>Pays</label>
            <select id="pays" name="pays" class="form-control">
                @foreach ($pays as $item)
                    <option value="{{ Crypt::decrypt($item->pays) }}"
                        @if (Crypt::decrypt($client->pays) == Crypt::decrypt($item->pays))
                            selected="selected"
                        @endif
                    >{{ Crypt::decrypt($item->pays) }}</option>
                @endforeach
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
                        @foreach ($assujettis as $assujetti)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assujetti" value="{{ Crypt::decrypt($assujetti->intitule) }}" 
                                @if (Crypt::decrypt($client->assujetti->intitule) == Crypt::decrypt($assujetti->intitule))
                                    checked
                                @endif
                            >
                        <label class="form-check-label">{{ Crypt::decrypt($assujetti->intitule) }}</label>
                        </div>
                        @endforeach
                        
                        
                    </div>
                </div>
            </fieldset>
        </div> 
        <div class="form-group col-md-6">
            <label>Numéro TVA</label>
        <input type="text" name="numtva" class="form-control" value="{{ Crypt::decrypt($client->assujetti->num_tva) }}">
        </div>
    </div>

    
<<<<<<< HEAD
    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vouloir modifier ce client.')">Valider</button>
=======
    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vouloir modifier ce client ?')">Valider</button>
>>>>>>> poste
  </form>
@endsection