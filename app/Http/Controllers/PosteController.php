<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Poste;
use App\Models\Tva;

class PosteController extends Controller
{
    /**
     * Affiche la liste des postes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postes = Poste::all();

        return view('postes.index', [
            'postes' => $postes,
        ]);
    }

    /**
     * Affiche le formulaire pour créer un nouveau poste de vente
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postes.create');
    }

    /**
     * Enregistre un nouveau poste.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des champs du formulaire (poste de vente)
        $request->validate([
            'numero' => ['required', 'numeric'],
            'poste' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
            'codebarre' => ['required', 'regex:/^[\w]+$/i'],
            'quantite' => ['required', 'regex:/^[0-9]+$/'],
            'prixunitaire' => ['required', 'regex:/^[0-9]+(.[0-9]{1,2})?$/'],
            'tva' => ['required', 'regex:/^[a-z]+$/i'],
            'taux' => ['required', 'regex:/^[0-9]+$/']
        ]);

        //verification doublon du poste de vente
        $poste = Poste::where('intitule', request('poste'))->first();
        if ($poste){
            flash('Poste de vente déjà présent')->error();
            return back();
        }

        
        $tva = Tva::where('intitule', request('tva'))->first();
        // si la tva n'existe pas
        if (!$tva) {
            // créé
            $tva = Tva::create([
                'intitule' => request('tva'),
                'taux' => request('taux'),
            ]);

            $poste = Poste::create([
                'numero' => request('numero'),
                'intitule' => request('poste'),
                'code_barre' => request('codebarre'),
                'quantite' => request('quantite'),
                'prix_unitaire' => request('prixunitaire'),
                'tva_id' => $tva->id,
            ]);
        } else {
            $poste = Poste::create([
                'numero' => request('numero'),
                'intitule' => request('poste'),
                'code_barre' => request('codebarre'),
                'quantite' => request('quantite'),
                'prix_unitaire' => request('prixunitaire'),
                'tva_id' => $tva->id,
            ]);
        }

        flash('Le nouveau poste de vente a bien été enregistré.')->success();
        return redirect('/postes');

        
    }

    /**
     * Afficher un poste de vente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poste = Poste::find($id);

        return view('postes.show',[
            'poste' => $poste,
        ]);
    }

    /**
     * Afficher le formulaire pour modifier un poste
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tvas = DB::table('tvas')->select('intitule', 'taux')->distinct()->get();
        $poste = Poste::find($id);

        return view('postes.edit', [
            'poste' => $poste,
            'tvas' => $tvas,
        ]);
    }
    

    /**
     * Modifier un poste de vente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des champs du formulaire (poste de vente)
        $request->validate([
            'numero' => ['required', 'numeric'],
            'poste' => ['required', 'regex:/^[a-z ,.\'-]+$/i'],
            'codebarre' => ['required', 'regex:/^[\w]+$/i'],
            'quantite' => ['required', 'regex:/^[0-9]+$/'],
            'prixunitaire' => ['required', 'regex:/^[0-9]+(.[0-9]{1,2})?$/'],
            'tva' => ['required', 'regex:/^[a-z]+$/i'],
            'taux' => ['required', 'regex:/^[0-9]+$/']
        ]);

        // récupère le poste grâce à son id
        $poste = Poste::find($id);
        
        // Vérifie si la tva existe déjà en bd
        $tva="";       
        $tvas = DB::table('tvas')->get();        
        foreach ($tvas as $item) {
            if ($item->intitule == request('tva') && $item->taux == request('taux')) {
                $tva = $item;
            } 
        }
        // si la localité n'existe pas
        if (!$tva) {
            $tva = Tva::create([
                'intitule' => request('tva'),
                'taux' => request('taux'),
            ]);
        }

    
        // $tva = Tva::where('intitule', request('tva'))->first();

        $poste->update([
                'numero' => request('numero'),
                'intitule' => request('poste'),
                'code_barre' => request('codebarre'),
                'quantite' => request('quantite'),
                'prix_unitaire' => request('prixunitaire'),
                'tva_id' => $tva->id,
            
        ]);
        flash('Le poste a bien été mis à jour.')->success();
        return redirect('/postes');
    }

    /**
     * Supprimer un poste de vente.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poste = Poste::find($id);
        $poste->delete();

        flash('Le poste de vente ' . $poste->intitule . ' a bien été supprimé.')->success();
        return redirect('/postes');
    }
}
