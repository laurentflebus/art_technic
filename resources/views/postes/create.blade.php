@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h4>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
            </svg>&nbsp;
            Ajout d'un Poste de vente / d'achat
        </h4>
    </div>
    <div class="card-body">
        <form action="/postes" id="formposte" method="post">
            {{ csrf_field() }}
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="numero">Numéro</label>
                    <input type="text" id="numero" name="numero" class="form-control" value="{{ old('numero') }}">
                    @if ($errors->has('numero'))
                            <p class="alert alert-danger">{{ $errors->first('numero') }}</p>
                    @endif
              </div>
        
              <div class="form-group col-md-6">
                    <label for="poste">Intitulé du poste de vente</label>
                    <input type="text" name="poste" class="form-control" value="{{ old('poste') }}">
                    @if ($errors->has('poste'))
                        <p class="alert alert-danger">{{ $errors->first('poste') }}</p>
                    @endif
              </div>
            </div>
        
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Code barre / Code</label>
                    <input type="text" name="codebarre" class="form-control" value="{{ old('codebarre') }}">
                    @if ($errors->has('codebarre'))
                        <p class="alert alert-danger">{{ $errors->first('codebarre') }}</p>
                    @endif
                </div>
        
                <div class="form-group col-md-4">
                    <label>Quantité en stock</label>
                    <input type="text" name="quantite" class="form-control" value="{{ old('quantite') }}">
                    @if ($errors->has('quantite'))
                        <p class="alert alert-danger">{{ $errors->first('quantite') }}</p>
                    @endif
                </div>
                
                <div class="form-group col-md-4">
                <label>Prix unitaire</label>
                <input type="text" name="prixunitaire" class="form-control" value="{{ old('prixunitaire') }}">
                @if ($errors->has('prixunitaire'))
                    <p class="alert alert-danger">{{ $errors->first('prixunitaire') }}</p>
                @endif
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Intitulé TVA</label>
                    <select id="tva" name="tva" class="form-control">
                        <option value="normal">Normal</option>
                        <option value="cocontractant">Co-contractant</option>
                        <option value="exonere">Exonéré</option>
                    </select>
                    @if ($errors->has('tva'))
                        <p class="alert alert-danger">{{ $errors->first('tva') }}</p>
                    @endif
                </div>
        
                <div class="form-group col-md-6">
                    <label>Taux TVA</label>
                    <select id="taux" name="taux" class="form-control">
                        <option value="21">21</option>
                        <option value="6">6</option>
                        <option value="0">0</option>
                    </select>
                    @if ($errors->has('taux'))
                        <p class="alert alert-danger">{{ $errors->first('taux') }}</p>
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