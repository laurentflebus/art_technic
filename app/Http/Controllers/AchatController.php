<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Fournisseur;
use App\Models\Poste;
use DateTime;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AchatController extends Controller
{
    /**
     * Afficher la liste des achats.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achats = Achat::all();
        return view('achats.index', [
            'achats' => $achats,
        ]);
    }

    /**
     * Afficher le formulaire de création d'un achat.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();

        $compare = "";
        $delais = DB::table('fournisseurs')->select('delai_paiement')->get();
        foreach ($delais as $item) {
            if ($compare == Crypt::decrypt($item->delai_paiement)) {
                $delais->forget($delais->search($item));
            }
            $compare = Crypt::decrypt($item->delai_paiement);
        }

        return view('achats.create', [
            'fournisseurs' => $fournisseurs,
            'delais' => $delais
        ]);
    }

    /**
     * Enregister un achat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // récupère le nombre de poste grâce à l'input caché 'nbPoste'
        $nbPoste = request('nbPoste');
        
        $request->validate([
            'date' => ['required'],
        ]);
        
        // boucle pour les tests de champs null, doublons
        for ($i=1; $i <= $nbPoste ; $i++) { 
            // récupére tous les champs numeroposte($i) intituleposte($i) quantite($i) prixtvac($i)
            $numeroposte = request('numeroposte'.$i);
            $intituleposte = request('intituleposte'.$i);
            $quantite = request('quantite'.$i);
            $montanttvac = request('montanttvac'.$i);

            // vérifie les champs sont null
            if (!($numeroposte && $intituleposte)) {
                flash('Vous devez insérer un numero et un intitulé de poste à la ligne '.$i)->error();
                return back();
            }

            if (!$quantite) {
                flash('Vous devez insérer une quantité à la ligne '.$i)->error();
                return back();
            }

            if (!$montanttvac) {
                flash('Vous devez insérer un montant TVAC à la ligne '.$i)->error();
                return back();
            }

            // vérifie si le montant tvac sont au format numéric
            
            if (!is_numeric($montanttvac)) {
                flash('Le montant TVAC doit être un nombre')->error();
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
        // date à payer 
        $delai = request('delai');
        switch ($delai) {
            case '30 jours fin de mois':
                $date_achat = new DateTime(request('date'));
                $date_achat->modify('+30 days');
                $date_achat->modify('last day of this month');
                $date_a_payer = $date_achat->format('Y-m-d');
                break;
            case '60 jours fin de mois':
                $date_achat = new DateTime(request('date'));
                $date_achat->modify('+60 days');
                $date_achat->modify('last day of this month');
                $date_a_payer = $date_achat->format('Y-m-d');
                break;
            case '90 jours fin de mois':
                $date_achat = new DateTime(request('date'));
                $date_achat->modify('+90 days');
                $date_achat->modify('last day of this month');
                $date_a_payer = $date_achat->format('Y-m-d');
                break;
            case '120 jours fin de mois':
                $date_achat = new DateTime(request('date'));
                $date_achat->modify('+120 days');
                $date_achat->modify('last day of this month');
                $date_a_payer = $date_achat->format('Y-m-d');
                break;
            case 'Comptant':
                $date_a_payer = request('date');
                break;
            case '15 jours': 
                $date_a_payer = date('Y-m-d', strtotime(request('date'). '+15 days'));
                break;
            case '30 jours':
                $date_a_payer = date('Y-m-d', strtotime(request('date')));
                break;
        }
        // année de l'achat
        $annee = date("y", strtotime(request('date')));
        $achat = DB::table('achats')->select('id')->latest()->first();
        // Si il n'y a pas d'achat en BD
        if ($achat) {
            $numachat = $achat->id;
            $numachat++;
            $achat = Achat::create([
                'numero' => 'A/' . $annee . '/'.$numachat,
                'date' => request('date'),
                'date_a_payer' => $date_a_payer,
                'est_paye' => false,
                'fournisseur_id' => request('fournisseur'),
            ]);
        } else {
            $numachat = 1;   
            $achat = Achat::create([
                'numero' => 'A/' . $annee . '/'.$numachat,
                'date' => request('date'),
                'date_a_payer' => $date_a_payer,
                'est_paye' => false,
                'fournisseur_id' => request('fournisseur'),
            ]);
        }
          
        // Boucle pour les ajouts de postes d'achat
        for ($i=1; $i <= $nbPoste; $i++) {           
            $poste = Poste::where('numero', request('numeroposte'.$i))->first();
            $montanttvac = request('montanttvac'.$i);
            $quantite = request('quantite'.$i);
            $prixtvac = floatval($montanttvac/$quantite);
            $achat->postes()->attach($poste, [
                'quantite' => request('quantite'.$i),
                'prix_unitaire' => $prixtvac,
                'detail' => 'Aucun détail',
            ]);
            // Si une quantité (en stock) existe pour ce poste 
            if ($poste->quantite) {
                // augmente la quantite du poste en stock
                $quantitemaj = $poste->quantite + $quantite;
                $poste->update([
                    'quantite' => $quantitemaj,
                ]);
            }
        }

        flash('L\'achat a bien été enregistré.')->success();
        return redirect('/achats');
    }

    /**
     * Afficher un achat.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $achat = Achat::find($id);
        return view('achats.show', [
            'achat' => $achat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Payer l'achat
     * 
     * @param int $id
     */

     public function payer($id)
     {
        $achat = Achat::find($id);

        $achat->update([
            'est_paye' => true,
        ]);

        flash('L\'achat ' . $achat->numero . ' a bien été payé.')->success();
        return redirect('/achats');
     }
}
