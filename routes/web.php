<?php

use Illuminate\Support\Facades\Route;

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

// Routes concernant l'authentification
// 1er paramètre : chemin de l'URL, 2ème paramètre : nom du controller @ fonction à appeler
Route::get('/', 'CompteController@afficherFormulaire');
Route::post('/', 'CompteController@traiterFormulaire');

// Groupe de routes Middelware Admin (est administrateur)
Route::group([
    'middleware' => 'App\Http\Middleware\Admin',
], function () {
    // Route qui répond aux requêtes de type GET
    Route::get('/inscription', 'CompteController@visualiserFormulaire');
    // Route qui répond aux requêtes de type POST
    Route::post('/inscription', 'CompteController@gererFormulaire');

    Route::get('/parametres/create', 'SocieteController@create');
    Route::post('/parametres/create', 'SocieteController@store');
});

// Groupe de routes Middleware Auth (est identifié)
Route::group([
    'middleware' => 'App\Http\Middleware\Auth',
], function () {
    //routes concernant l'utilisateur connecté
    Route::get('/accueil', 'CompteController@accueil');
    Route::get('/deconnexion', 'CompteController@deconnexion');
    Route::post('/modification-mot-de-passe', 'CompteController@modificationMotDePasse');
    Route::post('/supprimer/{id}', 'CompteController@supprimer');

    Route::get('/parametres/edit', 'SocieteController@edit');
    Route::post('/parametres/edit', 'SocieteController@update');

    Route::get('/ajax', 'AjaxController@ajaxRequest');

    Route::resource('/clients', 'ClientController');
    Route::resource('/postes', 'PosteController');
    Route::resource('/ventes', 'VenteController');

    Route::get('/listing', 'VenteController@showlisting');
    Route::get('/inventaire', 'PosteController@showinventory');

    Route::get('/imprimerticket/{id}', 'VenteController@imprimerticket');
    Route::get('/imprimerfacture/{id}', 'VenteController@imprimerfacture');

    Route::get('/email/{id}', 'VenteController@envoyerEmail');

    Route::get('/tva', 'TvaController@index');
    Route::post('/tva', 'TvaController@telecharger');
});
// Route générique
//Route::get('/{nomclient}', 'ClientController@voir');