<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Poste;
use App\Models\Client;
use App\Models\Modereglement;
use App\Models\Facture;

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
        $clients = Client::all();
        return view('ventes.create', ['clients' => $clients]);
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
    
    
        // $request->validate([
        //     'codebarre' => ['required', 'regex:/^[\w]+$/i'],
        //     'numeroposte1' => ['required', 'regex:/^[0-9]+$/'],
        //     'intituleposte1' => ['required', 'regex:/^[\w àéè,.\'-]+$/i'],            
        //     'prixtvac1' => ['required', 'regex:/^[0-9]+(.[0-9]{1,2})?$/'],          
        //     'client' => ['required', 'regex:/^[0-9]+$/'],
        //     'modereglement' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
        // ]);
        
        // boucle pour les tests de champs null, doublons
        for ($i=1; $i <= $nbPoste ; $i++) { 
            // récupére tous les champs numeroposte($i) intituleposte($i) quantite($i) prixtvac($i)
            $numeroposte = request('numeroposte'.$i);
            $intituleposte = request('intituleposte'.$i);
            $quantite = request('quantite'.$i);

            // vérifie les champs sont null
            if (!($numeroposte && $intituleposte)) {
                flash('Vous devez insérer un numero et un intitulé de poste à la ligne '.$i)->error();
                return back();
            }

            if (!$quantite) {
                flash('Vous devez insérer une quantité à la ligne '.$i)->error();
                return back();
            }

            // vérifie si la quantité est au format numéric
            if (!is_numeric($quantite)) {
                flash('La quantité doit être un nombre entier.')->error();
                return back();
            }
            // évite les chiffres à virgule
            for ($j=1; $j <= $nbPoste; $j++) { 
                $request->validate([
                    'quantite'.$j => ['required', 'regex:/^[0-9]+$/'],
                ], [
                    'quantite'.$j.'.regex' => 'La quantité doit être un nombre entier.'
                ]);
            }

            // Boucle qui compare les numéros de poste au(x) précédent(s) de la liste, empêche ainsi les doublons de poste
            for ($cposte=1; $cposte < $i; $cposte++) {
                $numerocompare = request('numeroposte'.$cposte);
                if($numeroposte == $numerocompare) {
                    flash('Vous avez entré plusieurs fois le même poste de vente.')->error();
                    return back();
                }
            }

        }

        $modereglement = "";
        $modereglement = Modereglement::where('intitule', request('modereglement'))->first();

        if (!$modereglement) {
            $modereglement = Modereglement::create([
                'intitule' => request('modereglement'),
            ]);
        }


        $ticket = request('ticket');
        // Si la case Ticket de caisse est cochée, on assigne la valeur true à la variable $paye
        if ($ticket) {
            $paye = true;
        } else {
            $paye = false;
        }

        $bon = request('bon');
        // Si la case Bon de commande est cochée, on assigne la valeur true à la variable $b
        if ($bon) {
            $b = true;
        } else {
            $b = false;
        }
        
        // Si la case Facture est cochée, on crée une facture et assigne la valeur false à la variable $afacturer
        $facture = request('facture');
        if ($facture) {
            $afacturer = false;
        } else {
            $afacturer = true;
        }

        $client = request('client');
        if (!$client) {
            $vente = Vente::create([
                'a_facturer' => $afacturer,
                'est_paye' => $paye,
                'a_un_bon_commande' => $b,
                'modereglement_id' => $modereglement->id, 
            ]);
        } else {
            $vente = Vente::create([
                'a_facturer' => $afacturer,
                'est_paye' => $paye,
                'a_un_bon_commande' => $b,
                'client_id' => request('client'),
                'modereglement_id' => $modereglement->id, 
            ]);
        }
        
        
        $nfacture = 0;
        if ($facture) {
            $nfacture++;
            $facture = Facture::create([
                'numero' => 'A/20/'.$nfacture,
                'vente_id' => $vente->id,
            ]);
        } 
            
        // Boucle pour les ajouts de postes de vente
        for ($i=1; $i <= $nbPoste; $i++) {           
            $poste = Poste::where('numero', request('numeroposte'.$i))->first();
            $vente->postes()->attach($poste, [
                'quantite' => request('quantite'.$i),
                'prix_unitaire' => request('prixtvac'.$i),
                'detail' => 'Aucun détail',
            ]);
            // diminue la quantite du poste de vente en stock
            $quantitemaj = $poste->quantite - request('quantite'.$i);
            $poste->update([
                'quantite' => $quantitemaj,
            ]);

        }
        


        flash('La vente a bien été enregistrée.')->success();
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
       // récupérer la vente
       $vente = Vente::find($id);

       //afficher la vue et passer la variable $vente
       return view('ventes.show', [
           'vente' => $vente,
       ]);
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
