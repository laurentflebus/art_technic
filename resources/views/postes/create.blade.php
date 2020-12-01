@extends('layout')

@section('contenu')
<h3>Créer un poste de vente</h3>
<form action="/postes" method="post">
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
            <label>Code barre</label>
            <input type="text" name="codebarre" class="form-control" value="{{ old('codebarre') }}">
            @if ($errors->has('codebarre'))
                <p class="alert alert-danger">{{ $errors->first('codebarre') }}</p>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label>Quantité en stock</label>
            <input type="text" name="quantite" class="form-control">
            @if ($errors->has('quantite'))
                <p class="alert alert-danger">{{ $errors->first('quantite') }}</p>
            @endif
        </div>
        
        <div class="form-group col-md-4">
        <label>Prix unitaire</label>
        <input type="text" name="prixunitaire" class="form-control">
        @if ($errors->has('mobile'))
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
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
@endsection