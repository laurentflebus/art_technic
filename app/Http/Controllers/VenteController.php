<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Poste;
use App\Models\Client;
use App\Models\Modereglement;
use App\Models\Facture;
use App\Models\Societe;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use FFI;
use Rawilk\Printing\Receipts\ReceiptPrinter;
use Rawilk\Printing\Facades\Printing;

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
        
        $request->validate([
            'date' => ['required'],
            // 'codebarre' => ['required', 'regex:/^[\w]+$/i'],
            // 'numeroposte1' => ['required', 'regex:/^[0-9]+$/'],
            // 'intituleposte1' => ['required', 'regex:/^[\w àéè,.\'-]+$/i'],            
            // 'prixtvac1' => ['required', 'regex:/^[0-9]+(.[0-9]{1,2})?$/'],          
            // 'client' => ['required', 'regex:/^[0-9]+$/'],
            // 'modereglement' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
        ]);
        
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
                'date' => request('date'),
                'modereglement_id' => $modereglement->id, 
            ]);
        } else {
            $vente = Vente::create([
                'a_facturer' => $afacturer,
                'est_paye' => $paye,
                'a_un_bon_commande' => $b,
                'date' => request('date'),
                'client_id' => request('client'),
                'modereglement_id' => $modereglement->id, 
            ]);
        }
        
        $timestamp = strtotime(request('date'));
        $annee = date("y", $timestamp);
        $fact = DB::table('factures')->select('id')->latest()->first();
        $numfacture = $fact->id;
        if (!$numfacture) {
            $numfacture = 0;
        }
        if ($facture) {
            $numfacture++;
            $facture = Facture::create([
                'numero' => 'V/' . $annee . '/'.$numfacture,
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
            // Si une quantité (en stock) existe pour ce poste 
            if ($poste->quantite) {
                // diminue la quantite du poste de vente en stock
                $quantitemaj = $poste->quantite - request('quantite'.$i);
                $poste->update([
                    'quantite' => $quantitemaj,
                ]);
            }
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

    /**
     * Imprimer un ticket de caisse
     * @param int $id
     */
    public function imprimerticket($id)
    {
        $receipt = (string) (new ReceiptPrinter)
            ->centerAlign()
            ->text('My heading')
            ->leftAlign()
            ->line()
            ->twoColumnText('Item 1', '2.00')
            ->twoColumnText('Item 2', '4.00')
            ->feed(2)
            ->centerAlign()
            ->barcode('1234')
            ->cut();

        $printerId = Printing::defaultPrinterId();

        Printing::newPrintTask()
            ->printer($printerId)
            ->content($receipt)
            ->send();
        return back();

    }

    /**
     * Télécharger la facture
     * @param $id
     */
    public function imprimerfacture($id) 
    {
        // récupère de l'id de la vente (GET)
        // crée d'un objet vente à partir de celui-ci
        $vente = Vente::where('id', $id)->firstOrFail();
        
        // récupère la dernière facture avec son id (dernier numéro de facture)
        $fact = DB::table('factures')->select('id')->latest()->first();
        $numfacture = $fact->id;
        // année de la vente
        $timestamp = strtotime($vente->date);
        $annee = date("y", $timestamp);

        // si pas de facture en bd
        if (!$numfacture) {
            $numfacture = 0;
        }
        // si il n'y a pas de facture pour cette vente
        if (!$vente->facture) {
            $numfacture++;
            Facture::create([
                'numero' => 'V/' . $annee . '/'.$numfacture,
                'vente_id' => $vente->id,
            ]);
        } 
        
        $nomPdf = 'facture_' . $vente->facture->numero . '_'. substr($vente->created_at, 0, 9);
        
        $societe = Societe::get()->first();
        // charge la vue facture.blade.php  
        $pdf = PDF::loadView('pdf.facture', [
            'vente' => $vente,
            'societe' => $societe,
        ]);

        // $printerId = Printing::defaultPrinterId();

        // Printing::newPrintTask()
        //     ->printer($printerId)
        //     ->content($pdf->output())
        //     ->send();
        
        // génère le pdf
        return $pdf->download($nomPdf.'.pdf');

    }

    /**
     * Générer et paramétrer PDF
     */
    private function genererPDF($vente) 
    {
        // récupère le texte du ticket de caisse
        // $donnees = self::ticketcalcul($vente);

        // // génère le PDF
        // $data = [
        //   'vente'=> $vente,
        //   'donnees' => $donnees,
        // ];
        $societe = Societe::get()->first();
        $pdf = PDF::loadView('pdf.facture-pdf', [
            'vente' => $vente,
            'societe' => $societe,
        ]);

        return $pdf;
    }
    
    //fonction qui va à partir d'un objet devis, parcourir tous ce qu'il contient (articles, etc) et générer des phrases de facture
    private function ticketcalcul($vente) {

        $societe = Societe::get()->first();
        //variable tableau qui va servir à recevoir les phrases de la facture
        $texteticket = array();
 
        //ajout des phrases de la facture et des calculs
        $premiereligne = Crypt::decrypt($societe->nom) . '        ' . Crypt::decrypt($societe->localite->code_postal) . ' ' . Crypt::decrypt($societe->localite->intitule);
        array_push($texteticket, $premiereligne);
        $deuxiemeligne = Crypt::decrypt($societe->rue) . ', ' . Crypt::decrypt($societe->nrue) . ' ' . Crypt::decrypt($societe->telephone);
        array_push($texteticket, $deuxiemeligne);
        $troisiemeligne = 'Le ' . $vente->date;
        array_push($texteticket, $troisiemeligne);
        $quatriemeligne = '               Article           Qté             Montant    ';
        array_push($texteticket, $quatriemeligne);
        array_push($texteticket, '--------------------------------------------------------');
        foreach ($vente->postes as $poste) {
            $total = floatval($poste->quantite * $poste->prix_unitaire);
            $ligneposte = $poste->intitule . '                    ' . $poste->pivot->quantite . '        ' . $poste->prix_unitaire;
            array_push($texteticket, $ligneposte);
            $barre = '                             ----------------------';
            array_push($texteticket, $barre);
            $somme = '                             = ' . $total;
            array_push($texteticket, $somme);
        }
        return $texteticket;
    }
}
