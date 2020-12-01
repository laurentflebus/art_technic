<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'numero' => ['required'],
            'poste' => ['required'],
            'codebarre' => ['required'],
            'quantite' => ['required', 'numeric'],
            'prixunitaire' => ['required'],
            'tva' => ['required'],
            'taux' => ['required', 'numeric']
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
}
