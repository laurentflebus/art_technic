@extends('layout')
@section('contenu')
<div class="card">
    <div class="card-header text-center">
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-journal" viewBox="0 0 16 16">
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
            </svg>
            Gestion des TVA
        </h3>
    </div>
    
    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#menu1">Listing TVA clients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">Solde</a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane container active" id="menu1">
                <div class="text-center">
                    <h5>Impressions relatives aux clients</h5>
                </div>
                <form action="/tva" method="post">
                    {{ csrf_field() }}
                    <fieldset class="form-group">
                        <legend class="col-form-label">Période de départ</legend>
                        <div class="form-row">
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="depart" value="1" checked>
                                <label class="form-check-label">1</label>
                            </div>
                            
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="depart" value="2">
                                <label class="form-check-label">2</label>
                            </div>
    
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="depart" value="3">
                                <label class="form-check-label">3</label>
                            </div>

                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="depart" value="4">
                                <label class="form-check-label">4</label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <legend class="col-form-label">Période d'arrêt</legend>
                        <div class="form-row">
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="arret" value="1" checked>
                                <label class="form-check-label">1</label>
                            </div>
                            
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="arret" value="2">
                                <label class="form-check-label">2</label>
                            </div>
    
                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="arret" value="3">
                                <label class="form-check-label">3</label>
                            </div>

                            <div class="form-check col-md-1">
                                <input class="form-check-input" type="radio" name="arret" value="4">
                                <label class="form-check-label">4</label>
                            </div>
                        </div>
                    </fieldset>   
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Êtes-vous sur de vos données ?')">Listing TVA par Poste</button>
                </form>
            </div>
            <div class="tab-pane container fade" id="menu2">
                
            </div>
            
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection