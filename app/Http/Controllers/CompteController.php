<?php

namespace App\Http\Controllers;

use App\Models\Authentification;

class CompteController extends Controller
{
    public function accueil() 
    {
        return view('/accueil');
    }

    public function deconnexion()
    {

        flash('Vous êtes deconnecté.')->success();

        // Déconnecter l'utilisateur
        auth()->logout();

        return redirect('/');
    }
    
    // afficher le formulaire d'inscription
    public function visualiserFormulaire()
    {
        return view('inscription');
    }
    
    public function gererFormulaire()
    {
            // on récupère toute la requête de l'utilisateur et on appelle la fonction validate pour valider les données
        request()->validate([
            // tableau de règles
            'user' => ['required'],
            'password' => ['required', 'confirmed', 'min:3'],
            'password_confirmation' => ['required'],
        ],[
            'password.min' => 'Pour des raisons de sécurité, votre mot de passe doit faire :min caractères.'
        ]);
        // fonction create de Eloquent qui permet de faire un new et un save
        $authentification = Authentification::create([
            'user' => request('user'),
            // bcrypt : fonction de hashing | mot de passe hashé
            'password' => bcrypt(request('password')),
            'admin' => request('admin')
        ]);
        
        return redirect('/');
    }

    public function liste()
    {
        // fonction Eloquent qui récupère tous les Authentifications (utilisateurs)
        $authentifications = Authentification::all();

        return view('utilisateurs', [
            'authentifications' => $authentifications,
        ]);
    }
    // afficher le formulaire de connexion
    public function afficherFormulaire()
    {
        //  si l'utilisateur est connecté
        if (auth()->check()) {        
            return back();
        }
        return view('connexion');
    }

    public function traiterFormulaire()
    {
        request()->validate([
            'user' => ['required'],
            'password' => ['required'],
        ]);

        // Système d'authentification de Laravel
        // Permet d'essayer une connexion
        // config/auth.php ligne 70
        $resultat = auth()->attempt([
            // nom colonnes bd | name input formulaire, requête client
            'user' => request('user'),
            'password' => request('password'),
        ]);

        // Rediriger vers la page mon-compte si connexion réussie
        if($resultat)
        {
            flash('Vous êtes connecté.')->success();
            return redirect('/accueil');
        }
        // Sinon retour vers la page précédente et renvoit également les données qui ont été envoyées par l'utilisateur
        return back()->withInput()->withErrors([
            'user' => 'Vos identifiants sont incorrects.',
        ]);
    }

    public function modificationMotDePasse()
    {
        request()->validate([
            'password' => ['required', 'confirmed', 'min:3'],
            'password_confirmation' => ['required'],
        ]);

        // 
        auth()->user()->update([
            // nom colonne bd | name input formulaire, requête client
            'password' => bcrypt(request('password')),
        ]);

        flash('Votre mot de passe a bien été mis à jour.')->success();

        return redirect('/mon-compte');
    }
    
}
