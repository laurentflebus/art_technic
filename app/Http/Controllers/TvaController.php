<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Facture;
use App\Models\Poste;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Achat;
use Illuminate\Support\Facades\DB;

class TvaController extends Controller
{
    /**
     * Affiche la page de gestion des tvas à imprimer
     */
    public function index()
    {
        return view('tva');
    }
    /**
     * Télécharger la tva relative aux clients par poste
     * @param  \Illuminate\Http\Request  $request
     */
    public function telecharger(Request $request)
    {
        // Valide les champs du formulaire
        $request->validate([
            'depart' => ['required'],
            'arret' => ['required'],
        ]);

        $depart = request('depart');
        switch ($depart) {
            // janvier
            case '1':
                $depart = 1;
                break;
            // avril
            case '2':
                $depart = 4;
                break;
            // juillet
            case '3':
                $depart = 7;
                break;
            // octobre
            case '4':
                $depart = 10;
                break;
        }
      
        $arret = request('arret');
        switch ($arret) {
            // mars
            case '1':
                $arret = 3;
                break;
            // juin
            case '2':
                $arret = 6;
                break;
            // septembre
            case '3':
                $arret = 9;
                break;
            // decembre
            case '4':
                $arret = 12;
                break;
        }
        
        $factures = Facture::all();
        foreach ($factures as $facture) {
            // récupère le mois de la facture en nombre entier
            $mois = (int) substr($facture->date, 5, 7);
            // compare le mois de la facture avec la période de départ et d'arrêt
            if ($mois < $depart || $mois > $arret) {
                // retire du tableau de factures, la facture qui correspond à la condition
                $factures->forget($factures->search($facture));
            }
            // récupère l'année de la facture
            $annee = (int) substr($facture->date, 0, 4);
            // compare avec la date actuelle
            if ($annee != (int) date('Y')) {
                $factures->forget($factures->search($facture));
            }
            // si pas de client attaché à la facture
            if ($facture->vente->client_id == null) {
                $factures->forget($factures->search($facture));
            }
        }
        if (sizeof($factures) == 0) {
            flash("Pas de facture pour l'année en cours")->error();
            return back();
        }
        // récupère les id de poste des factures (évite de faire un double foreach)
        $facturespostes= DB::table('ventes')
                        ->leftJoin('clients', 'clients.id', '=', 'ventes.client_id')
                        ->leftJoin('factures', 'ventes.id', '=', 'factures.vente_id')
                        ->leftJoin('poste_vente', 'ventes.id', '=', 'poste_vente.vente_id')
                        ->rightJoin('postes', 'postes.id', '=', 'poste_vente.poste_id') 
                        ->select(DB::raw('postes.id as id'))
                        ->whereNotNull('factures.vente_id')
                        // condition pour la tva de l'année courante
                        ->whereBetween('ventes.date', [date('Y').'-01-01', date('Y') . '-12-31'])                      
                        ->get();
        // récupère les totaux par facture + id de facture
        $totaux = DB::table('ventes')
                    ->leftJoin('clients', 'clients.id', '=', 'ventes.client_id')
                    ->leftJoin('factures', 'ventes.id', '=', 'factures.vente_id')
                    ->leftJoin('poste_vente', 'ventes.id', '=', 'poste_vente.vente_id')
                    ->rightJoin('postes', 'postes.id', '=', 'poste_vente.poste_id') 
                    ->select(DB::raw('SUM(poste_vente.quantite*poste_vente.prix_unitaire) as total, factures.id as id'))
                    ->whereNotNull('factures.vente_id')
                    ->whereBetween('ventes.date', [date('Y').'-01-01', date('Y') . '-12-31']) 
                    ->groupBy('factures.id')                       
                    ->get();
        // récupère les totaux par poste + id du poste
        $totauxparposte = DB::table('ventes')
                ->leftJoin('clients', 'clients.id', '=', 'ventes.client_id')
                ->leftJoin('factures', 'ventes.id', '=', 'factures.vente_id')
                ->leftJoin('poste_vente', 'ventes.id', '=', 'poste_vente.vente_id')
                ->rightJoin('postes', 'postes.id', '=', 'poste_vente.poste_id') 
                ->select(DB::raw('SUM(poste_vente.quantite*poste_vente.prix_unitaire) as total, postes.id as id'))
                ->whereNotNull('factures.vente_id') 
                ->whereBetween('ventes.date', [date('Y').'-01-01', date('Y') . '-12-31'])
                ->groupBy('postes.id')                       
                ->get();
        // récupère les totaux par taux de tva + id du taux
        $totauxpartva = DB::table('ventes')
                ->leftJoin('clients', 'clients.id', '=', 'ventes.client_id')
                ->leftJoin('factures', 'ventes.id', '=', 'factures.vente_id')
                ->leftJoin('poste_vente', 'ventes.id', '=', 'poste_vente.vente_id')
                ->rightJoin('postes', 'postes.id', '=', 'poste_vente.poste_id')
                ->rightJoin('tvas', 'tvas.id', '=', 'postes.tva_id') 
                ->select(DB::raw('SUM(poste_vente.quantite*poste_vente.prix_unitaire) as total, tvas.taux as taux'))
                ->whereNotNull('factures.vente_id')
                ->whereBetween('ventes.date', [date('Y').'-01-01', date('Y') . '-12-31'])
                ->groupBy('tvas.id')                       
                ->get();
        $postes = Poste::all();
        $nomPdf = "tvaclients". date('Y');
        // charger la vue tvaposte.blade.php
        $pdf = PDF::loadView('pdf.tvaposte', [
            'factures' => $factures,
            'postes' => $postes,
            'facturespostes' => $facturespostes,
            'totaux' => $totaux,
            'totauxparposte' => $totauxparposte,
            'totauxpartva' => $totauxpartva,
            'depart' => request('depart'),
            'arret' => request('arret'),
        ]);;
        // télécharger le pdf
        return $pdf->download($nomPdf.'.pdf');
    }
    /**
     * Télécharger la tva relative aux clients par client
     * @param  \Illuminate\Http\Request  $request
     */
    public function download(Request $request)
    {
        // Valide les champs du formulaire
        $request->validate([
            'depart' => ['required'],
            'arret' => ['required'],
        ]);

        $depart = request('depart');
        switch ($depart) {
            // janvier
            case '1':
                $depart = 1;
                break;
            // avril
            case '2':
                $depart = 4;
                break;
            // juillet
            case '3':
                $depart = 7;
                break;
            // octobre
            case '4':
                $depart = 10;
                break;
        }
      
        $arret = request('arret');
        switch ($arret) {
            // mars
            case '1':
                $arret = 3;
                break;
            // juin
            case '2':
                $arret = 6;
                break;
            // septembre
            case '3':
                $arret = 9;
                break;
            // decembre
            case '4':
                $arret = 12;
                break;
        }
        
        $factures = Facture::all();
        foreach ($factures as $facture) {
            // récupère le mois de la facture en nombre entier
            $mois = (int) substr($facture->date, 5, 7);
            // compare le mois de la facture avec la période de départ et d'arrêt
            if ($mois < $depart || $mois > $arret) {
                // retire du tableau de factures, la facture qui correspond à la condition
                $factures->forget($factures->search($facture));
            }
            // récupère l'année de la facture
            $annee = (int) substr($facture->date, 0, 4);
            // compare avec la date actuelle
            if ($annee != (int) date('Y')) {
                $factures->forget($factures->search($facture));
            }
            // si pas de client attaché à la facture
            if ($facture->vente->client_id == null) {
                $factures->forget($factures->search($facture));
            }
        }
        if (sizeof($factures) == 0) {
            flash("Pas de facture pour l'année en cours")->error();
            return back();
        }
        // crée un tableau à 2 dimensions avec les totaux tva calculés par facture
        $facturesdetaillees = array();
        foreach ($factures as $facture) {
            // initialise les totaux pour chaque facture
            $totaltvac = 0;
            $totalhtva = 0;
            $totaltva = 0;
            foreach ($facture->vente->postes as $poste) {
                $totalhtva += floatval($poste->pivot->prix_unitaire * $poste->pivot->quantite) / floatval(1 + $poste->tva->taux/100);
                $totaltvac += floatval($poste->pivot->prix_unitaire * $poste->pivot->quantite);
                $totaltva += floatval($poste->pivot->prix_unitaire * $poste->pivot->quantite) / floatval(1+$poste->tva->taux/100) * floatval($poste->tva->taux/100);
            }
            array_push($facturesdetaillees, [
                'numero' => $facture->numero,
                'idclient' => $facture->vente->client_id,
                'totalhtva' => $totalhtva,
                'totaltvac' =>$totaltvac,
                'totaltva'=>$totaltva
            ]);
        }
        // crée un tableau à 2 dimensions avec les totaux tva calculés par client
        $totauxfacturesclients = array();
        $clients = Client::all();
        foreach ($clients as $client) {
            // initialise les totaux à chaque client
            $totaltvac = 0;
            $totalhtva = 0;
            $totaltva = 0;
            // si le client est associé à une vente
            if (sizeof($client->ventes) != null) {
                foreach ($facturesdetaillees as $facture) {
                    if ($client->id == $facture['idclient']) {
                        $totaltvac += $facture['totaltvac'];
                        $totalhtva += $facture['totalhtva'];
                        $totaltva += $facture['totaltva'];
                    }
                }
                // Si le client a une de facture
                if ($totaltvac != 0) {
                    array_push($totauxfacturesclients, [
                        'idclient' => $client->id,
                        'totaltvac'=> $totaltvac,
                        'totalhtva'=> $totalhtva,
                        'totaltva'=> $totaltva
                    ]);
                }     
            }         
        }
        // récupère les totaux par taux de tva + id du taux
        $totauxpartva = DB::table('ventes')
                ->leftJoin('clients', 'clients.id', '=', 'ventes.client_id')
                ->leftJoin('factures', 'ventes.id', '=', 'factures.vente_id')
                ->leftJoin('poste_vente', 'ventes.id', '=', 'poste_vente.vente_id')
                ->leftJoin('postes', 'postes.id', '=', 'poste_vente.poste_id')
                ->leftJoin('tvas', 'tvas.id', '=', 'postes.tva_id') 
                ->select(DB::raw('SUM(poste_vente.quantite*poste_vente.prix_unitaire) as total, tvas.taux as taux'))
                ->whereNotNull('factures.vente_id')
                ->whereBetween('ventes.date', [date('Y').'-01-01', date('Y') . '-12-31'])
                ->groupBy('tvas.id')                       
                ->get();
        $clients = Client::all();
        $nomPdf = "tvaclients". date('Y');
        // charge la vue tvaclient.blade.php
        $pdf = PDF::loadView('pdf.tvaclient', [
            'factures' => $factures,
            'clients' => $clients,
            'totauxpartva' => $totauxpartva,
            'facturesdetaillees' => $facturesdetaillees,
            'totauxfacturesclients' =>$totauxfacturesclients,
            'depart' => request('depart'),
            'arret' => request('arret'),
        ]);;
        // télécharger le pdf
        return $pdf->download($nomPdf.'.pdf');
    }
    /**
     * Télécharger la tva relative aux fournisseurs par poste
     * @param  \Illuminate\Http\Request  $request
     */
    public function telechargerlisting(Request $request)
    {
        // Valide les champs du formulaire
        $request->validate([
            'depart' => ['required'],
            'arret' => ['required'],
        ]);

        $depart = request('depart');
        switch ($depart) {
            // janvier
            case '1':
                $depart = 1;
                break;
            // avril
            case '2':
                $depart = 4;
                break;
            // juillet
            case '3':
                $depart = 7;
                break;
            // octobre
            case '4':
                $depart = 10;
                break;
        }
      
        $arret = request('arret');
        switch ($arret) {
            // mars
            case '1':
                $arret = 3;
                break;
            // juin
            case '2':
                $arret = 6;
                break;
            // septembre
            case '3':
                $arret = 9;
                break;
            // decembre
            case '4':
                $arret = 12;
                break;
        }
        
        $achats = Achat::all();
        foreach ($achats as $achat) {
            // récupère le mois de la date d'achat en nombre entier
            $mois = (int) substr($achat->date, 5, 7);
            // compare le mois de la date d'achat avec la période de départ et d'arrêt
            if ($mois < $depart || $mois > $arret) {
                // retire du tableau d'achat', la date qui correspond à la condition
                $achats->forget($achats->search($achat));
            }
            // récupère l'année de l'achat'
            $annee = (int) substr($achat->date, 0, 4);
            // compare avec la date actuelle
            if ($annee != (int) date('Y')) {
                $achats->forget($achats->search($achat));
            }
            
        }
        if (sizeof($achats) == 0) {
            flash("Pas de facture d'achat pour l'année en cours")->error();
            return back();
        }
        // récupère les totaux par facture d'achat + id de facture
        $totaux = DB::table('achats')
                    ->leftJoin('achat_poste', 'achats.id', '=', 'achat_poste.achat_id')
                    ->rightJoin('postes', 'postes.id', '=', 'achat_poste.poste_id') 
                    ->select(DB::raw('SUM(achat_poste.quantite*achat_poste.prix_unitaire) as total, achats.id as id'))
                    ->whereBetween('achats.date', [date('Y').'-01-01', date('Y') . '-12-31']) 
                    ->groupBy('achats.id')                       
                    ->get();
        // récupère les totaux par poste + id du poste
        $totauxparposte = DB::table('achats')
                ->leftJoin('achat_poste', 'achats.id', '=', 'achat_poste.achat_id')
                ->rightJoin('postes', 'postes.id', '=', 'achat_poste.poste_id') 
                ->select(DB::raw('SUM(achat_poste.quantite*achat_poste.prix_unitaire) as total, postes.id as id'))
                ->whereBetween('achats.date', [date('Y').'-01-01', date('Y') . '-12-31'])
                ->groupBy('postes.id')                       
                ->get();
        // récupère les totaux par taux de tva + id du taux
        $totauxpartva = DB::table('achats')
                ->leftJoin('achat_poste', 'achats.id', '=', 'achat_poste.achat_id')
                ->rightJoin('postes', 'postes.id', '=', 'achat_poste.poste_id')
                ->rightJoin('tvas', 'tvas.id', '=', 'postes.tva_id') 
                ->select(DB::raw('SUM(achat_poste.quantite*achat_poste.prix_unitaire) as total, tvas.taux as taux'))
                ->whereBetween('achats.date', [date('Y').'-01-01', date('Y') . '-12-31'])
                ->groupBy('tvas.id')                       
                ->get();
        $postes = Poste::all();
        $nomPdf = "tvafournisseurs". date('Y');
        // charger la vue tvapostefournisseur.blade.php
        $pdf = PDF::loadView('pdf.tvapostefournisseur', [
            'achats' => $achats,
            'postes' => $postes,
            'totaux' => $totaux,
            'totauxparposte' => $totauxparposte,
            'totauxpartva' => $totauxpartva,
            'depart' => request('depart'),
            'arret' => request('arret'),
        ]);
        // télécharger le pdf
        return $pdf->download($nomPdf.'.pdf');
    }
    /**
     * Télécharger la tva relative aux fournisseurs par nom
     *  @param \Illuminate\Http\Request $request
     */
    public function downloadlisting(Request $request)
    {
        // Valide les champs du formulaire
        $request->validate([
            'depart' => ['required'],
            'arret' => ['required'],
        ]);

        $depart = request('depart');
        switch ($depart) {
            // janvier
            case '1':
                $depart = 1;
                break;
            // avril
            case '2':
                $depart = 4;
                break;
            // juillet
            case '3':
                $depart = 7;
                break;
            // octobre
            case '4':
                $depart = 10;
                break;
        }
      
        $arret = request('arret');
        switch ($arret) {
            // mars
            case '1':
                $arret = 3;
                break;
            // juin
            case '2':
                $arret = 6;
                break;
            // septembre
            case '3':
                $arret = 9;
                break;
            // decembre
            case '4':
                $arret = 12;
                break;
        }
        
        $achats = Achat::all();
        foreach ($achats as $achat) {
            // récupère le mois de la date d'achat en nombre entier
            $mois = (int) substr($achat->date, 5, 7);
            // compare le mois de la date d'achat avec la période de départ et d'arrêt
            if ($mois < $depart || $mois > $arret) {
                // retire du tableau d'achat', la date qui correspond à la condition
                $achats->forget($achats->search($achat));
            }
            // récupère l'année de l'achat'
            $annee = (int) substr($achat->date, 0, 4);
            // compare avec la date actuelle
            if ($annee != (int) date('Y')) {
                $achats->forget($achats->search($achat));
            }
            
        }
        if (sizeof($achats) == 0) {
            flash("Pas de facture d'achat pour l'année en cours")->error();
            return back();
        }
        // crée un tableau à 2 dimensions avec les totaux tva calculés par facture d'achat
        $facturesdetaillees = array();
        foreach ($achats as $achat) {
            // initialise les totaux pour chaque facture d'achat
            $totaltvac = 0;
            $totalhtva = 0;
            $totaltva = 0;
            $date = date("d/m/Y", strtotime($achat->date));
            foreach ($achat->postes as $poste) {
                $totalhtva += floatval($poste->pivot->prix_unitaire * $poste->pivot->quantite) / floatval(1 + $poste->tva->taux/100);
                $totaltvac += floatval($poste->pivot->prix_unitaire * $poste->pivot->quantite);
                $totaltva += floatval($poste->pivot->prix_unitaire * $poste->pivot->quantite) / floatval(1+$poste->tva->taux/100) * floatval($poste->tva->taux/100);
            }
            array_push($facturesdetaillees, [
                'idfournisseur' => $achat->fournisseur_id,
                'date' => $date,
                'numero' => $achat->numero,
                'totalhtva' => $totalhtva,
                'totaltvac' =>$totaltvac,
                'totaltva'=>$totaltva
            ]);
        }
        // crée un tableau à 2 dimensions avec les totaux tva calculés par fournisseur
        $totauxfacturesfournisseurs = array();
        $fournisseurs = Fournisseur::all();
        foreach ($fournisseurs as $fournisseur) {
            // initialise les totaux à chaque fournisseur
            $totaltvac = 0;
            $totalhtva = 0;
            $totaltva = 0;
            // si le fournisseur est associé à un achat
            if (sizeof($fournisseur->achats) != null) {
                foreach ($facturesdetaillees as $facture) {
                    if ($fournisseur->id == $facture['idfournisseur']) {
                        $totaltvac += $facture['totaltvac'];
                        $totalhtva += $facture['totalhtva'];
                        $totaltva += $facture['totaltva'];
                    }
                }
                // Si le fournisseur a pas une facture d'achat
                if ($totaltvac != 0) {
                    array_push($totauxfacturesfournisseurs, [
                        'idfournisseur' => $fournisseur->id,
                        'totaltvac'=> $totaltvac,
                        'totalhtva'=> $totalhtva,
                        'totaltva'=> $totaltva
                    ]);
                }     
            }         
        }
        // récupère les totaux par taux de tva + id du taux
        $totauxpartva = DB::table('achats')
                ->leftJoin('achat_poste', 'achats.id', '=', 'achat_poste.achat_id')
                ->rightJoin('postes', 'postes.id', '=', 'achat_poste.poste_id')
                ->rightJoin('tvas', 'tvas.id', '=', 'postes.tva_id') 
                ->select(DB::raw('SUM(achat_poste.quantite*achat_poste.prix_unitaire) as total, tvas.taux as taux'))
                ->whereBetween('achats.date', [date('Y').'-01-01', date('Y') . '-12-31'])
                ->groupBy('tvas.id')                       
                ->get();
        $nomPdf = "tvafournisseurs". date('Y');
        // charge la vue tvaclient.blade.php
        $pdf = PDF::loadView('pdf.tvafournisseur', [
            'achats' => $achats,
            'fournisseurs' => $fournisseurs,
            'totauxpartva' => $totauxpartva,
            'facturesdetaillees' => $facturesdetaillees,
            'totauxfacturesfournisseurs' =>$totauxfacturesfournisseurs,
            'depart' => request('depart'),
            'arret' => request('arret'),
        ]);;
        // télécharger le pdf
        return $pdf->download($nomPdf.'.pdf');
    }
}
