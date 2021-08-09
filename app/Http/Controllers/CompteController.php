<?php

namespace App\Http\Controllers;

use App\Models\Authentification;
use App\Models\Societe;

class CompteController extends Controller
{
    public function accueil() 
    {
        $utilisateurs = Authentification::all();
        $societe = Societe::get()->first();
        return view('/accueil', [
            'utilisateurs' => $utilisateurs,
            'societe' => $societe,
        ]);
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
            'user' => ['required', 'max:8'],
            // le mot de passe doit contenir une minuscule, une majuscule et un chiffre
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[0-9])\S*$/'],
            'password_confirmation' => ['required'],
        ],[
            'user.max' => 'Le nom d\'utilisateur doit contenir au maximum :max caractères.',
            'password.min' => 'Pour des raisons de sécurité, votre mot de passe doit contenir au minimum :min caractères.',
            'password.regex' => 'Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.'
        ]);
        // fonction create de Eloquent qui permet de faire un new et un save
        $authentification = Authentification::create([
            'user' => request('user'),
            // bcrypt : fonction de hashing | mot de passe hashé
            'password' => bcrypt(request('password')),
            'admin' => request('admin')
        ]);
        flash('Le nouvel utilisateur a bien été enregistré.')->success();
        return redirect('/accueil');
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

        // Redirige vers la page d'accueil si connexion réussie
        if($resultat)
        {
            $utilisateurs = Authentification::all();
            $societe = Societe::get()->first();
            flash('Vous êtes connecté.')->success();
            return view('/accueil', [
                'utilisateurs' => $utilisateurs,
                'societe' => $societe,
            ]);
        }
        // Sinon retour vers la page précédente et renvoit également les données qui ont été envoyées par l'utilisateur
        return back()->withInput()->withErrors([
            'user' => 'Vos identifiants sont incorrects.',
        ]);
    }

    public function modificationMotDePasse()
    {
       $resultat = request()->validate([
                'password' => ['required', 'confirmed', 'min:8', 'regex:/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[0-9])\S*$/'],
                'password_confirmation' => ['required'],
            ],[
                'password.min' => 'Pour des raisons de sécurité, votre mot de passe doit faire au minimum :min caractères.',
                'password.regex' => 'Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.'    
            ]);
        // Si la requête est valide
        if ($resultat) {
            auth()->user()->update([
                // nom colonne bd | name input formulaire, requête client
                'password' => bcrypt(request('password')),
            ]);
    
            flash('Votre mot de passe a bien été mis à jour.')->success();
            return redirect('/accueil');
        }
        
        // Sinon 
        return back();
    }
    /**
     * Supprimer un compte utilisateur
     * @param int $id
     */
    public function supprimer($id)
    {
        $utilisateur = Authentification::find($id);
        $utilisateur->delete();
        flash('L\'utilisateur ' . $utilisateur->user . ' a été supprimé avec succès.')->success();
        return back();
    }
}
