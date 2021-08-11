@extends('layout')
@section('contenu')
    <div class="card">
        <div class="card-header text-center">
            <h4>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>&nbsp;
                Listing
            </h4>
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
                                                <td>{{ number_format(floatval($poste->total / (1 + $tva->taux/100)), 2, '.', '') }}€</td>
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
                                                <td>{{ number_format(floatval($poste->total / (1 + $tva->taux/100)), 2, '.', '') }}€</td>
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
                                                <td>{{ number_format(floatval($poste->total / (1 + $tva->taux/100)), 2, '.', '') }}€</td>
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
                                        <td>{{ Crypt::decrypt($client->nom) ?? "" }} {{ Crypt::decrypt($client->prenom) ?? "" }}</td>
                                        <td>{{ $client->total }}€</td>
                                        @foreach ($tvas as $tva)
                                            @if ($client->tva_id == $tva->id)
                                                <td>{{ number_format(floatval($client->total / (1 + $tva->taux/100)), 2, '.', '') }}€</td>
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
                                                <td>{{ number_format(floatval($client->total / (1 + $tva->taux/100)), 2, '.', '') }}€</td>
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