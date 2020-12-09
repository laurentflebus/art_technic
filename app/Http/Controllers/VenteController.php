<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Poste;
use App\Models\Client;
use App\Models\Modereglement;
use App\Models\Facture;
use Hamcrest\Type\IsNumeric;

class VenteController extends Controller
{
    /**
     * Afficher la liste des ventes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventes = Vente::all();
        return view('ventes.index', [
            'ventes' => $ventes,
        ]);
    }

    /**
     * Afficher le formulaire de création d'une vente.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postes = Poste::all();
        $clients = Client::all();
        return view('ventes.create', ['postes' => $postes, 'clients' => $clients]);
    }

    /**
     * Enregistrer une nouvelle vente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // récupère le nombre de poste grâce à l'input caché 'nbPoste'
        $nbPoste = request('nbPoste');

        
        for ($i=1; $i <= $nbPoste; $i++) { 
            $request->validate([
                'quantite'.$i => ['required', 'regex:/^[0-9]+$/'],
            ]);
        }
        // $request->validate([
        //     'codebarre' => ['required', 'regex:/^[\w]+$/i'],
        //     'numeroposte1' => ['required', 'regex:/^[0-9]+$/'],
        //     'intituleposte1' => ['required', 'regex:/^[\w àéè,.\'-]+$/i'],            
        //     'prixtvac1' => ['required', 'regex:/^[0-9]+(.[0-9]{1,2})?$/'],          
        //     'client' => ['required', 'regex:/^[0-9]+$/'],
        //     'modereglement' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
        // ]);

        $modereglement = "";
        $modereglement = Modereglement::where('intitule', request('modereglement'))->first();

        if (!$modereglement) {
            $modereglement = Modereglement::create([
                'intitule' => request('modereglement'),
            ]);
        }
        $facture = Facture::create([
            'numero' => 'A/20/0000001',
        ]);
        $vente = Vente::create([
            'a_facturer' => false,
            'est_paye' => true,
            'a_un_bon_commande' => false,
            'client_id' => request('client'),
            'modereglement_id' => $modereglement->id,
            'facture_id' => $facture->id, 
        ]);
        
        
        
        // boucle pour les tests champs null, doublons
        for ($i=1; $i <= $nbPoste ; $i++) { 
            // récupération tous les champs numeroposte($i) intituleposte($i) quantite($i) prixtvac($i)
            $numeroposte = request('numeroposte'.$i);
            $intituleposte = request('intituleposte'.$i);
            $quantite = request('quantite'.$i);
            $prixtvac = request('prixtvac'.$i);

            // vérifie les champs sont nuls
            if (!$numeroposte) {
                flash('Vous devez insérer un numero de poste à la ligne '.$i)->error();
                return back();
            }
            if (!$intituleposte) {
                flash('Vous devez insérer un intitule de poste à la ligne '.$i)->error();
                return back();
            }
            if (!$quantite) {
                flash('Vous devez insérer une quantité à la ligne '.$i)->error();
                return back();
            }
            if (!(is_numeric($quantite))) {
                flash('La quantité doit être un nombre entier.')->error();
                return back();
            }
            if (!$prixtvac) {
                flash('Vous devez insérer un prix tvac à la ligne '.$i)->error();
                return back();
            }

            // Boucle qui compare les intitulés de poste au précédent de la liste, empeche ainsi les doublons de poste
            for ($cposte=1; $cposte < $i; $cposte++) { 
                $intitulecompare = request('intituleposte'.$cposte);
                if($intituleposte == $intitulecompare) {
                    flash('Vous avez entré plusieurs fois le même poste de vente.')->error();
                    return back();
                }
            }

        }
        // Boucle pour les ajouts de postes de vente
        for ($i=1; $i <= $nbPoste; $i++) {           
            $poste = Poste::where('intitule', request('intituleposte'.$i))->first();
            $vente->postes()->attach($poste, [
                'quantite' => request('quantite'.$i),
                'prix_unitaire' => request('prixtvac'.$i),
                'detail' => 'Aucun détail',
            ]);
        }

        flash('La vente a bien été enregistrée')->success();
        return redirect('/ventes');
        
    }

    /**
     * Afficher une vente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Afficher le formulaire pour modifier une vente
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postes = Poste::all();
        $clients = Client::all();
        $vente = Vente::find($id);

        return view('ventes.edit', ['postes' => $postes, 'clients' => $clients ,'vente' => $vente]);
    }

    /**
     * Modifier une vente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codebarre' => ['required'],
            'numeroposte' => ['required'],
            'intituleposte' => ['required'],
            'quantite' => ['required'],
            'prixtvac' => ['required'],
            'client' => ['required'],
            'modereglement' => ['required'],
        ]);

        
    }

    /**
     * Supprimer une vente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vente = Vente::find($id);
        $vente->delete();
        foreach ($vente->postes as $poste) {
            $vente->postes()->detach($poste);
        }
        
        flash('La vente ' . $vente->id . ' a bien été supprimée.')->success();
        return redirect('/ventes');
    }
}
