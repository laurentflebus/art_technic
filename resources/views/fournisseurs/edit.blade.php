@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Modification du fournisseur : {{ Crypt::decrypt($fournisseur->nom) }} {{ Crypt::decrypt($fournisseur->prenom) }}</h3>
    </div>
    <div class="card-body">
        <form action="/fournisseurs/{{ $fournisseur->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-row">
        
                <div class="form-group col-md-4">
                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-4 pt-0">Civilité</legend>
                            <div class="col-sm-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Aucune"
                                        @if (Crypt::decrypt($fournisseur->civilite) == "Aucune")
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label">Aucune</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Monsieur"
                                        @if (Crypt::decrypt($fournisseur->civilite) == "Monsieur")
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label">Mr.</label>
                                </div>
                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Madame"
                                        @if (Crypt::decrypt($fournisseur->civilite) == "Madame")
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label">Mme</label>
                                </div>
        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="civilite" value="Mademoiselle"
                                        @if (Crypt::decrypt($fournisseur->civilite) == "Mademoiselle")
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
                <input type="text" name="nom" class="form-control" value="{{ Crypt::decrypt($fournisseur->nom) }}">
                @if ($errors->has('nom'))
                        <p class="alert alert-danger">{{ $errors->first('nom') }}</p>
                @endif
              </div>
              <div class="form-group col-md-4">
                <label>Prénom</label>
              <input type="text" name="prenom" class="form-control" value="{{ Crypt::decrypt($fournisseur->prenom) }}">
                @if ($errors->has('prenom'))
                        <p class="alert alert-danger">{{ $errors->first('prenom') }}</p>
                    @endif
              </div>
        
            </div>
        
            <div class="form-row">
        
                <div class="form-group col-md-4">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" value="{{ Crypt::decrypt($fournisseur->email) }}">
                    @if ($errors->has('email'))
                        <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                    @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label>Téléphone fixe</label>
                    <input type="text" name="telephone" class="form-control" value="{{ Crypt::decrypt($fournisseur->telephone) }}">
                    @if ($errors->has('telephone'))
                        <p class="alert alert-danger">{{ $errors->first('telephone') }}</p>
                    @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label>Téléphone mobile</label>
                    <input type="text" name="mobile" class="form-control" value="{{ Crypt::decrypt($fournisseur->mobile) }}">
                    @if ($errors->has('mobile'))
                        <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
                    @endif
                  </div>
        
            </div>
        
        
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label>Rue</label>
                    <input type="text" name="rue" class="form-control" value="{{ Crypt::decrypt($fournisseur->rue) }}">
                    @if ($errors->has('rue'))
                        <p class="alert alert-danger">{{ $errors->first('rue') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label>N. rue</label>
                    <input type="text" name="nrue" class="form-control" value="{{ Crypt::decrypt($fournisseur->nrue) }}">
                    @if ($errors->has('nrue'))
                        <p class="alert alert-danger">{{ $errors->first('mobile') }}</p>
                    @endif
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Code postal</label>
                    <input type="text" name="codepostal" class="form-control" value="{{ Crypt::decrypt($fournisseur->localite->code_postal) }}">
                    @if ($errors->has('codepostal'))
                        <p class="alert alert-danger">{{ $errors->first('codepostal') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label>Localité</label>
                    <input type="text" name="localite" class="form-control" value="{{ Crypt::decrypt($fournisseur->localite->intitule) }}">
                    @if ($errors->has('localite'))
                        <p class="alert alert-danger">{{ $errors->first('localite') }}</p>
                    @endif
                </div>
                
                <div class="form-group col-md-4">
                    <label>Pays</label>
                    <select id="pays" name="pays" class="form-control">
                        <option
                        @if (Crypt::decrypt($fournisseur->pays) == "Belgique")
                            selected
                        @endif
                        >Belgique</option>
                        <option 
                        @if (Crypt::decrypt($fournisseur->pays) == "France")
                            selected
                        @endif
                        >France</option>
                        <option
                        
                        @if (Crypt::decrypt($fournisseur->pays) == "Luxembourg")
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
                                        @if (Crypt::decrypt($fournisseur->assujetti->intitule) == Crypt::decrypt($assujetti->intitule))
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
                    <input type="text" name="numtva" class="form-control" value="{{ Crypt::decrypt($fournisseur->assujetti->num_tva) }}">
                </div>
            </div>
        
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Numéro de compte</label>
                    <input type="text" name="numcompte" class="form-control" value="{{ Crypt::decrypt($fournisseur->num_compte) }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Référence personnel</label>
                    <input type="text" name="reference" class="form-control" value="{{ Crypt::decrypt($fournisseur->reference_personnel) }}">
                </div>
                <select id="delai" name="delai" class="form-control">
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "30 jours fin de mois")
                        selected
                    @endif
                    >30 jours fin de mois</option>
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "60 jours fin de mois")
                        selected
                    @endif
                    >60 jours fin de mois</option>
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "90 jours fin de mois")
                        selected
                    @endif
                    >90 jours fin de mois</option>
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "120 jours fin de mois")
                        selected
                    @endif
                    >120 jours fin de mois</option>
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "Comptant")
                        selected
                    @endif
                    >Comptant</option>
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "15 jours")
                        selected
                    @endif
                    >15 jours</option>
                    <option
                    @if (Crypt::decrypt($fournisseur->delai_paiement) == "30 jours")
                        selected
                    @endif
                    >30 jours</option>
                </select>
            </div>
                
            <div class="mb-3">
                <label class="form-label">Remarque</label>
                <textarea class="form-control" rows="3" name="remarque">{{ Crypt::decrypt($fournisseur->remarque) }}</textarea>
            </div>
            
        </div>
    <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vouloir modifier ce fournisseur ?')">Modifier</button>
          </form>
    </div>
</div>
@endsection