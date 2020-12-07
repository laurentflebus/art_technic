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

//routes concernant l'authentification
// 1er paramètre : chemin de l'URL, 2ème paramètre : la vue à afficher
Route::get('/', 'CompteController@afficherFormulaire');
Route::post('/', 'CompteController@traiterFormulaire');

// Groupe de routes
Route::group([
    'middleware' => 'App\Http\Middleware\Admin',
], function () {
    // Route qui répond aux requêtes de type POST
    Route::get('/inscriptionAuthentification', 'CompteController@visualiserFormulaire');
    // Route qui répond aux requêtes de type POST
    Route::post('/inscriptionAuthentification', 'CompteController@gererFormulaire');
});


Route::get('/utilisateurs', 'CompteController@liste');

// Groupe de routes 
Route::group([
    'middleware' => 'App\Http\Middleware\Auth',
], function () {
    //routes concernant l'utilisateur connecté
    Route::get('/mon-compte', 'CompteController@accueil');
    Route::get('/deconnexion', 'CompteController@deconnexion');
    Route::post('/modification-mot-de-passe', 'CompteController@modificationMotDePasse');

    Route::get('/parametres', 'SocieteController@afficher');
    Route::post('/parametres', 'SocieteController@gerer');

    Route::get('/ajax', 'AjaxController@ajaxRequest');

    Route::resource('/clients', 'ClientController');
    Route::resource('/postes', 'PosteController');
    Route::resource('/ventes', 'VenteController'); 
});






// route générique
//Route::get('/{nomclient}', 'ClientController@voir');