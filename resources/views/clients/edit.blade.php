@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Modification du contact : {{ Crypt::decrypt($client->nom) }} {{ Crypt::decrypt($client->prenom) }}</h3>
    </div>
    <div class="card-body">
        <form action="/clients/{{ $client->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-row">
        
                <div class="form-group col-md-4">
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-4 pt-0">Civilité</legend>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Monsieur"
                                        @if (Crypt::decrypt($client->civilite) == "Monsieur")
                                                checked
                                        @endif
                                    >
                                    <label class="form-check-label">Mr.</label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Madame"
                                        @if (Crypt::decrypt($client->civilite) == "Madame")
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label">Mme</label>
                                </div>
        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Mademoiselle"
                                        @if (Crypt::decrypt($client->civilite) == "Mademoiselle")
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label">Mlle</label>
                                </div>
                                
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
                    <input type="text" name="codepostal" class="form-control" value="{{ Crypt::decrypt($client->localite->code_postal) }}">
                    @if ($errors->has('codepostal'))
                        <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label>Localité</label>
                    <input type="text" name="localite" class="form-control" value="{{ Crypt::decrypt($client->localite->intitule) }}">
                    @if ($errors->has('localite'))
                        <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
                    @endif
                </div>
                
                <div class="form-group col-md-4">
                    <label>Pays</label>
                    <select id="pays" name="pays" class="form-control">
                        <option
                        @if (Crypt::decrypt($client->pays) == "Belgique")
                            selected
                        @endif
                        >Belgique</option>
                        <option
                        @if (Crypt::decrypt($client->pays) == "France")
                            selected
                        @endif
                        >France</option>
                        <option
                        @if (Crypt::decrypt($client->pays) == "Luxembourg")
                            selected
                        @endif
                        >Luxembourg</option>
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
        
            
            
    </div>
    <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vouloir modifier ce client ?')">Modifier</button>
          </form>
    </div>
</div>


@endsection