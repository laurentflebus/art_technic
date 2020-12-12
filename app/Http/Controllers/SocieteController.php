<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;
use App\Models\Localite;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class SocieteController extends Controller
{
    public function afficher()
    {
        //$societe = DB::table('societes')->get()->first();
        $societes = Societe::all();
        return view('parametres', [
            'societes' => $societes,
        ]);
    }

    public function gerer()
    {
        // Supprimer les infos de la première et unique societe 
        Societe::get()->first()->delete();
        // Validation des champs du formulaire info société
        request()->validate([
            'nom' => ['required', 'regex:/^[a-z éèàùç,.\'-]+$/i'],
            'numtva' => ['required', 'regex:/^[a-z0-9]+$/i'],
            'registre' => ['required', 'regex:/^[a-z0-9]+$/i'],
            'numcompte' => ['required', 'regex:/^[a-z0-9]+$/i'],
            'telephone' => ['required', 'numeric', 'min:8'],
            'rue' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'nrue' => ['required', 'alpha_num'],
            'codepostal' => ['required', 'regex:/^([0-9]{4,5})$/'],
            'localite' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'pays' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'remarque' => ['required', 'regex:/^[a-z0-9 éèàùç!,.\'-]+$/i'],          
        ]);
        // Vérifie si la localite existe déjà en bd
        $localite = "";       
        $localites = DB::table('localites')->get();
         
        foreach ($localites as $item) {
            if (Crypt::decrypt($item->intitule) == request('localite') &&
                Crypt::decrypt($item->code_postal) == request('codepostal')) {
                $localite = $item;
            } 
        }
        // si elle n'existe pas
        if (!$localite) {
            $localite = Localite::create([
                'intitule' => Crypt::encrypt(request('localite')),
                'code_postal' => Crypt::encrypt(request('codepostal')),
            ]);
        }
        $societe = Societe::create([
            'nom' => Crypt::encrypt(request('nom')),
            'num_tva' => Crypt::encrypt(request('numtva')),
            'registre' => Crypt::encrypt(request('registre')),
            'num_compte' => Crypt::encrypt(request('numcompte')),
            'telephone' => Crypt::encrypt(request('telephone')),
            'rue' => Crypt::encrypt(request('rue')),
            'nrue' => Crypt::encrypt(request('nrue')),
            'pays' => Crypt::encrypt(request('pays')),
            'remarque' => Crypt::encrypt(request('remarque')),
            'localite_id' => $localite->id,
        ]);

        flash('Les informations de la société ' . Crypt::decrypt($societe->nom) .  ' ont bien été enregistrées.')->success();
        return redirect('/parametres');

    }
}
