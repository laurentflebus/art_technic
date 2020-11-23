@extends('layout')

@section('contenu')
    <h1>Les utilisateurs</h1>
    <ul>
        @foreach ($authentifications as $authentification)
            <li>{{ $authentification->user }}</li>
        @endforeach
    </ul>
    
@endsection