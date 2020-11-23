<?php

use Illuminate\Support\Facades\Route;

use App\Models\Authentification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/a-propos', function () {
    return view('a-propos');
});

Route::get('/bonjour/{nom}', function () {
    return view('bonjour', [
        'prenom' => request('nom')
    ]);
});
// Route qui répond aux requêtes de type POST
Route::get('/inscription', function () {
    return view('inscription');
});
// Route qui répond aux requêtes de type POST
Route::post('/inscription', function () {
    // on récupère toute la requête et on appelle la fonction validate pour valider les données
    request()->validate([
        // tableau de règles
        'user' => ['required'],
        'password' => ['required', 'confirmed', 'min:3'],
        'password_confirmation' => ['required'],
    ]);
    // fonction create de Eloquent qui permet de faire un new et un save
    $authentification = Authentification::create([
        'user' => request('user'),
        // bcrypt : fonction de hashing | mot de passe hashé
        'password' => bcrypt(request('password'))
    ]);

    return "Nous avons reçu votre e-mail qui est " . request('email') . " et votre mot de passe est " . request('password');
});

Route::get('/utilisateurs', function () {
    // fonction Eloquent qui récupère tous les Authentifications (utilisateurs)
    $authentifications = Authentification::all();

    return view('utilisateurs', [
        'authentifications' => $authentifications,
    ]);
});