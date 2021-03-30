@extends('layout')

@section('contenu')
    <div class="card">
        <div class="card-header text-center">
            <h3>Gestion de {{ Crypt::decrypt($societe->nom) }}</h3>
            <p>Vous êtes connecté en tant que <strong>{{ auth()->user()->user }}</strong></p>
        </div>
        <div class="card-body">
            <form action="/modification-mot-de-passe" method="post">
                
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-4">

                    </div>
                    <div class="form-group col-md-4">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->has('password'))
                            <p class="alert alert-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-4">

                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-4">

                    </div>
                    <div class="form-group col-md-4">
                        <label for="password_confirmation">Confirmation mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <p class="alert alert-danger">{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-4">

                    </div>
                </div>
                
                
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Modifier</button>
           
            </form>
        </div>
    </div>
    <br>
    {{-- Si administrateur, affiche le tableau des utilisateurs --}}
    @if (auth()->user()->admin)
        <div class="card">
            <div class="card-header text-center">
                <h4>
                    Gestion des Utilisateurs
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1h7.956a.274.274 0 0 0 .014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 0 0 .022.004zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                    </svg>
                </h4>
            </div>
        
            <div class="card-body">
                <div class="table-responsive">
                    <table id="utilisateurstable" class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nom d'utilisateur</th>
                                <th>Mot de passe</td>
                                <th>Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($utilisateurs as $utilisateur)
                            <tr>
                                <td>{{ $utilisateur->user }}</td>
                                <td>{{ $utilisateur->password }}</td>
                                <td>
                                <input type="checkbox"
                                {{-- Si admin --}}
                                @if ($utilisateur->admin)
                                    checked
                                @endif
                                >
                            </td>
                                <td>
                        
                                <form action= "{{ URL::to('supprimer/' . $utilisateur->id) }}" method="post">
        
                                        {{-- Modifie le client (utilise la méthode edit avec la route GET /clients/{id}/edit) --}}
                                        {{-- <a class="btn btn-small btn-info" href="{{ URL::to('clients/' . $client->id . '/edit') }}" title="Modifier le client">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                                <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                            </svg>
                                        </a> --}}
        
                                        {{-- Supprime l'utilisateur' --}}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sur de vouloir supprimer cet utilisateur ?')" title="Supprimer l'utilisateur'">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
        
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection