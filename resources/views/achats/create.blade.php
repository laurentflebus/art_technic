@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Création d'un Achat</h3>
    </div>
    <div class="card-body">
        <form action="/achats" id="formvente" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="nbPoste" name="nbPoste" value="1">
            
                <div class="form-row text-center">
                    <div class="form-group col-md-3">
                        <label>Code barre / Code</label>
                        <input type="text" id="codebarreAchat" name="codebarreAchat" class="form-control" value="{{ old('codebarreAchat') }}">
                        
                    </div>
                    <div class="form-group col-md-3">
                        <label>Quantité</label>
                        <input type="text" id="quantiteAchat" name="quantiteAchat" class="form-control" value="{{ old('quantiteAchat') }}">
                        @for ($i = 1; $i <= 10; $i++)
                            @if ($errors->has('quantite'.$i))
                            <p class="alert alert-danger">{{ $errors->first('quantite'.$i) }}</p>
                            @endif
                        @endfor
                        
                    </div>
                    <div class="form-group col-md-3">
                        <label>Montant TVAC</label>
                        <input type="text" id="montantAchat" name="montantAchat" class="form-control" value="{{ old('montantAchat') }}">
                        @for ($i = 1; $i <= 10; $i++)
                            @if ($errors->has('montantvac'.$i))
                            <p class="alert alert-danger">{{ $errors->first('montantvac'.$i) }}</p>
                            @endif
                        @endfor
                        
                    </div>
                    <div class="form-group col-md-2">
                        <div>
                            <label>Ajouter</label>
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm" id="ajouterposteAchat">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="form-group col-md-1">
                        <div>
                            <label>Supprimer</label>
                        </div>
                        
                        <button type="button" class="btn btn-outline-danger btn-sm" id="supprimerposteAchat">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </button>
                    </div>
                </div>
        
                <div id="clone">
                    <div class="form-row text-center">
                        <div class="form-group col-md-3">
                            <label>Référence</label>
                            <input type="text" id="numeroposte1" name="numeroposte1" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Intitulé</label>
                            <input type="text" id="intituleposte1" name="intituleposte1" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Qté</label>
                            <input type="text" id="quantite1" name="quantite1" class="form-control" readonly>
                        </div>
                               
                        {{-- <input type="hidden" id="prixtvac1" name="prixtvac1" class="form-control" readonly> --}}

                        <div class="form-group col-md-2">
                            <label>Montant HTVA</label>
                            <input type="text" id="montanthtva1" name="montanthtva1" class="form-control" readonly>                   
                        </div>
        
                        <div class="form-group col-md-2">
                            <label>Montant TVAC</label>
                            <input type="text" id="montanttvac1" name="montanttvac1" class="form-control" readonly>                              
                        </div>
    
                    </div>
                </div>
        
            <div id="bloc">
                
            </div>
            
            
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Fournisseur</label>
                    <select name="fournisseur" class="form-control">
                        @foreach ($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">
                                {{ Crypt::decrypt($fournisseur->nom) }} {{ Crypt::decrypt($fournisseur->prenom) }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('fournisseur'))
                        <p class="alert alert-danger">{{ $errors->first('fournisseur') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-4">

                </div>
                <div class="form-group col-md-4">
                    <label>Total HT</label>
                    <input type="text" id="totalht" name="totaltht" class="form-control" readonly>
                    @if ($errors->has('totalht'))
                        <p class="alert alert-danger">{{ $errors->first('totalht') }}</p>
                    @endif
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Date</label>
                    <input type="date" name="date" class="form-control" value="{{ $d = date('Y-m-d') }}" placeholder="Y-m-d">
                    @if ($errors->has('date'))
                        <p class="alert alert-danger">{{ $errors->first('date') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-4">

                </div>
                <div class="form-group col-md-4">
                    <label>Total TTC</label>
                    <input type="text" id="totalttc" name="totalttc" class="form-control" readonly>
                    @if ($errors->has('totalttc'))
                        <p class="alert alert-danger">{{ $errors->first('totalttc') }}</p>
                    @endif
                </div>               
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Délai de paiement</label>
                    <select name="delai" class="form-control">
                        @foreach ($delais as $item)
                            <option value="{{ Crypt::decrypt($item->delai_paiement) }}">
                                {{ Crypt::decrypt($item->delai_paiement) }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('delai'))
                        <p class="alert alert-danger">{{ $errors->first('delai') }}</p>
                    @endif
                </div> 
                <div class="form-group col-md-4">

                </div>
                <div class="form-group col-md-4">
                    <label>TVA déductible</label>
                    <input type="text" id="tva" name="tva" class="form-control" readonly>
                    @if ($errors->has('tva'))
                        <p class="alert alert-danger">{{ $errors->first('tva') }}</p>
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