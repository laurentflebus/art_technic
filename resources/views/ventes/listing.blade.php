@extends('layout')
@section('contenu')
    <div class="card">
        <div class="card-header text-center">
            <h4>Listing</h4>
        </div>
        
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#menu1">Ventes globales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Ventes facturées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">Ventes non facturées</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4">Clients facturés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu5">Clients non facturés</a>
                </li>
            </ul>
            
            <div class="tab-content">
                <div class="tab-pane container active" id="menu1">
                    <div class="table-responsive">
                        <table class="listingtable table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NumPoste</th>
                                    <th>Intitule</th>
                                    <th>TVAC</th>
                                    <th>HTVA</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postes as $poste)
                                    <tr>
                                        <td>{{ $poste->numero }}</td>
                                        <td>{{ $poste->intitule }}</td>
                                        <td>{{ $poste->total }}€</td>
                                        @foreach ($tvas as $tva)
                                            @if ($poste->tva_id == $tva->id)
                                                <td>{{ number_format(floatval($poste->total * (1 - $tva->taux/100)), 2, '.', '') }}€</td>
                                            @endif    
                                        @endforeach
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu2">
                    <div class="table-responsive">
                        <table class="listingtable table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NumPoste</th>
                                    <th>Intitule</th>
                                    <th>TVAC</th>
                                    <th>HTVA</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postesfactures as $poste)
                                    <tr>
                                        <td>{{ $poste->numero }}</td>
                                        <td>{{ $poste->intitule }}</td>
                                        <td>{{ $poste->total }}€</td>
                                        @foreach ($tvas as $tva)
                                            @if ($poste->tva_id == $tva->id)
                                                <td>{{ number_format(floatval($poste->total * (1 - $tva->taux/100)), 2, '.', '') }}€</td>
                                            @endif
                                            
                                        @endforeach
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu3">
                    <div class="table-responsive">
                        <table class="listingtable table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NumPoste</th>
                                    <th>Intitule</th>
                                    <th>TVAC</th>
                                    <th>HTVA</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postesnonfactures as $poste)
                                    <tr>
                                        <td>{{ $poste->numero }}</td>
                                        <td>{{ $poste->intitule }}</td>
                                        <td>{{ $poste->total }}€</td>
                                        @foreach ($tvas as $tva)
                                            @if ($poste->tva_id == $tva->id)
                                                <td>{{ number_format(floatval($poste->total * (1 - $tva->taux/100)), 2, '.', '') }}€</td>
                                            @endif    
                                        @endforeach
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu4">
                    <div class="table-responsive">
                        <table  class="listingtable table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Numéro de vente</th>
                                    <th>Nom du client</th>
                                    <th>TVAC</th>
                                    <th>HTVA</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientsfactures as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ Crypt::decypt($client->nom) ?? "" }} {{ Crypt::decrypt($client->prenom) ?? "" }}</td>
                                        <td>{{ $client->total }}€</td>
                                        @foreach ($tvas as $tva)
                                            @if ($client->tva_id == $tva->id)
                                                <td>{{ number_format(floatval($client->total * (1 - $tva->taux/100)), 2, '.', '') }}€</td>
                                            @endif    
                                        @endforeach
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane container fade" id="menu5">
                    <div class="table-responsive">
                        <table class="listingtable table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Numéro de vente</th>
                                    <th>Nom du client</th>
                                    <th>TVAC</th>
                                    <th>HTVA</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientsnonfactures as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ Crypt::decrypt($client->nom) ?? "" }} {{ Crypt::decrypt($client->prenom) ?? "" }}</td>
                                        <td>{{ $client->total }}€</td>
                                        @foreach ($tvas as $tva)
                                            @if ($client->tva_id == $tva->id)
                                                <td>{{ number_format(floatval($client->total * (1 - $tva->taux/100)), 2, '.', '') }}€</td>
                                            @endif    
                                        @endforeach
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
    
        </div>
    </div>
        
    
@endsection