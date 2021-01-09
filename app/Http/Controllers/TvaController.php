<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Facture;
use App\Models\Poste;
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
        }
        // $tvas= DB::table('ventes')
        //                 ->leftJoin('clients', 'clients.id', '=', 'ventes.client_id')
        //                 ->leftJoin('factures', 'ventes.id', '=', 'factures.vente_id')
        //                 ->leftJoin('poste_vente', 'ventes.id', '=', 'poste_vente.vente_id')
        //                 ->rightJoin('postes', 'postes.id', '=', 'poste_vente.poste_id') 
        //                 ->select(DB::raw('postes.intitule as poste, factures.numero as facture, tva_id, poste_vente.prix_unitaire*poste_vente.quantite as montant, clients.nom as nom, clients.prenom as prenom, ventes.id as id'))
        //                 ->whereNotNull('factures.vente_id')                        
        //                 ->get();
        $postes = Poste::all();
        $nomPdf = "tvaclientsposte";
        // charger la vue tva.blade.php
        $pdf = PDF::loadView('pdf.tva', [
            'factures' => $factures,
            'postes' => $postes,
        ]);;
        // télécharger le pdf
        return $pdf->download($nomPdf.'.pdf');
    }

}
