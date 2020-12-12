@extends('layout')

@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>Modification d'un poste de vente</h3>
    </div>
    <div class="card-body">
        <form action="/postes/{{ $poste->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-row">
        
                <div class="form-group col-md-6">
                    <label>Numéro</label>
                <input type="text" name="numero" class="form-control" value="{{ $poste->numero }}">
                    @if ($errors->has('numero'))
                            <p class="alert alert-danger">{{ $errors->first('numero') }}</p>
                    @endif
                </div> 
                
                <div class="form-group col-md-6">
                    <label>Intitulé du poste de vente</label>
                    <input type="text" name="poste" class="form-control" value="{{ $poste->intitule }}">
                    @if ($errors->has('poste'))
                            <p class="alert alert-danger">{{ $errors->first('poste') }}</p>
                    @endif
                </div>
        
            </div>
        
            <div class="form-row">
        
                <div class="form-group col-md-4">
                    <label>Code barre</label>
                    <input type="text" name="codebarre" class="form-control" value="{{ $poste->code_barre }}">
                    @if ($errors->has('codebarre'))
                        <p class="alert alert-danger">{{ $errors->first('codebarre') }}</p>
                    @endif
                </div>
        
                <div class="form-group col-md-4">
                    <label>Quantité en stock</label>
                    <input type="text" name="quantite" class="form-control" value="{{ $poste->quantite }}">
                    @if ($errors->has('quantite'))
                        <p class="alert alert-danger">{{ $errors->first('quantite') }}</p>
                    @endif
                </div>
                  <div class="form-group col-md-4">
                    <label>Prix unitaire</label>
                    <input type="text" name="prixunitaire" class="form-control" value="{{ $poste->prix_unitaire }}">
                    @if ($errors->has('prixunitaire'))
                        <p class="alert alert-danger">{{ $errors->first('prixunitaire') }}</p>
                    @endif
                  </div>
        
            </div>
        
            
            <div class="form-row">
        
                <div class="form-group col-md-6">
                    <label>Intitule TVA</label>
                    <select name="tva" class="form-control">
                        @foreach ($tvas as $tva)
                            <option value="{{ $tva->intitule }}"
                                @if ($poste->tva->intitule == $tva->intitule)
                                    selected="selected"
                                @endif
                            >{{ $tva->intitule }}</option>
                        @endforeach               
                    </select>
                    @if ($errors->has('tva'))
                        <p class="alert alert-danger">{{ $errors->first('tva') }}</p>
                    @endif
                </div>
        
                <div class="form-group col-md-6">
                    <label>Taux TVA</label>
                    <select name="taux" class="form-control">
                        @foreach ($tvas as $tva)
                            <option value="{{ $tva->taux }}"
                                @if ($poste->tva->taux == $tva->taux)
                                    selected="selected"
                                @endif
                            >{{ $tva->taux }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('taux'))
                        <p class="alert alert-danger">{{ $errors->first('taux') }}</p>
                    @endif
                </div>
                
            </div>
        
            
            
    </div>
    <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vouloir modifier ce poste de vente ?')">Modifier</button>
          </form>
    </div>
</div>


@endsection