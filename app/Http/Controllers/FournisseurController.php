<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseur;
use App\Models\Localite;
use App\Models\Assujetti;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Affiche la liste des fournisseurs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', [
            'fournisseurs' => $fournisseurs,
        ]);
    }

    /**
     * Affiche le formulaire pour créer un nouveau fournisseur
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Enregistre un nouveau fournisseur
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des champs du formulaire d'inscription
        $request->validate([
            'nom' => ['required', 'regex:/^[a-z éèàùç\'-]+$/i'],
            'prenom' => ['nullable', 'regex:/^[a-zA-Z éèàùç\'-]+$/i'],
            'email' => ['required', 'regex:/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/' ,'email'],
            'telephone' => ['required', 'numeric', 'min:8'],
            'mobile' => ['required', 'numeric', 'min:8'],
            'rue' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'nrue' => ['required', 'alpha_num'],
            'codepostal' => ['required', 'regex:/^([0-9]{4,5})$/'],
            'localite' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'pays' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'assujetti' => ['required', 'regex:/^[a-z ]+$/i'],
            'numcompte' => ['required', 'regex:/^[a-z0-9]+$/i'],
            'delai' => ['required'],
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

        // Vérifie si le type d'assujetissement existe déjà
        $assujetti = "";
        $assujettis = DB::table('assujettis')->get();   
        foreach ($assujettis as $item) {
            if (Crypt::decrypt($item->intitule) == request('assujetti') &&
                Crypt::decrypt($item->num_tva) == request('numtva')) {
                $assujetti = $item;
            }  
        }

        // Vérifie si le fournisseur existe déjà
        $fournisseurs = Fournisseur::all();       
        foreach($fournisseurs as $fournisseur) {           
            if ( Crypt::decrypt($fournisseur->nom) == request('nom') &&
                 Crypt::decrypt($fournisseur->email) == request('email') ) {
                    flash('Le fournisseur existe déjà.')->error();
                    return back();
             }
        }
        
        // Si la localité et l'assujetissement n'existe pas
       if (!$localite && !$assujetti) {
            DB::transaction(function() {
                $assujetti = Assujetti::create([
                    'intitule' => Crypt::encrypt(request('assujetti')),
                    'num_tva' => Crypt::encrypt(request('numtva')),
                ]);
                $localite = Localite::create([
                    'intitule' => Crypt::encrypt(request('localite')),
                    'code_postal' => Crypt::encrypt(request('codepostal')),
                ]);           
                $fournisseur = Fournisseur::create([
                    'civilite' => Crypt::encrypt(request('civilite')),
                    'nom' => Crypt::encrypt(request('nom')),
                    'prenom' => Crypt::encrypt(request('prenom')),
                    'email' => Crypt::encrypt(request('email')),
                    'telephone' => Crypt::encrypt(request('telephone')),
                    'mobile' => Crypt::encrypt(request('mobile')),
                    'rue' => Crypt::encrypt(request('rue')),
                    'nrue' => Crypt::encrypt(request('nrue')),
                    'pays' => Crypt::encrypt(request('pays')),
                    'num_compte' => Crypt::encrypt(request('numcompte')),
                    'delai_paiement' => Crypt::encrypt(request('delai')),
                    'reference_personnel' => Crypt::encrypt(request('reference')),
                    'remarque' => Crypt::encrypt(request('remarque')),
                    'localite_id' => $localite->id,
                    'assujetti_id' => $assujetti->id,
                ]);
            });         
        // Si l'assujetissement n'existe pas
       } elseif (!$assujetti) {
           DB::transaction(function() use($localite) {
                // Insertion de l'assujetissement en bd
                $assujetti = Assujetti::create([
                    'intitule' => Crypt::encrypt(request('assujetti')),
                    'num_tva' => Crypt::encrypt(request('numtva')),
                ]);
                $fournisseur = Fournisseur::create([
                    'civilite' => Crypt::encrypt(request('civilite')),
                    'nom' => Crypt::encrypt(request('nom')),
                    'prenom' => Crypt::encrypt(request('prenom')),
                    'email' => Crypt::encrypt(request('email')),
                    'telephone' => Crypt::encrypt(request('telephone')),
                    'mobile' => Crypt::encrypt(request('mobile')),
                    'rue' => Crypt::encrypt(request('rue')),
                    'nrue' => Crypt::encrypt(request('nrue')),
                    'pays' => Crypt::encrypt(request('pays')),
                    'num_compte' => Crypt::encrypt(request('numcompte')),
                    'delai_paiement' => Crypt::encrypt(request('delai')),
                    'reference_personnel' => Crypt::encrypt(request('reference')),
                    'remarque' => Crypt::encrypt(request('remarque')),
                    'localite_id' => $localite->id,
                    'assujetti_id' => $assujetti->id,
                ]);
           });    
        // Si la localite n'existe pas
       } elseif (!$localite) {
            DB::transaction(function() use($assujetti) {
                // Insertion de la localité en bd
                $localite = Localite::create([
                    'intitule' => Crypt::encrypt(request('localite')),
                    'code_postal' => Crypt::encrypt(request('codepostal')),
                ]);
                $fournisseur = Fournisseur::create([
                    'civilite' => Crypt::encrypt(request('civilite')),
                    'nom' => Crypt::encrypt(request('nom')),
                    'prenom' => Crypt::encrypt(request('prenom')),
                    'email' => Crypt::encrypt(request('email')),
                    'telephone' => Crypt::encrypt(request('telephone')),
                    'mobile' => Crypt::encrypt(request('mobile')),
                    'rue' => Crypt::encrypt(request('rue')),
                    'nrue' => Crypt::encrypt(request('nrue')),
                    'pays' => Crypt::encrypt(request('pays')),
                    'num_compte' => Crypt::encrypt(request('numcompte')),
                    'delai_paiement' => Crypt::encrypt(request('delai')),
                    'reference_personnel' => Crypt::encrypt(request('reference')),
                    'remarque' => Crypt::encrypt(request('remarque')),
                    'localite_id' => $localite->id,
                    'assujetti_id' => $assujetti->id,
                ]);
            });
        } else {
            DB::transaction(function() use($localite, $assujetti) {
                //Insertion du fournisseur en base de données
                $fournisseur = Fournisseur::create([
                    'civilite' => Crypt::encrypt(request('civilite')),
                    'nom' => Crypt::encrypt(request('nom')),
                    'prenom' => Crypt::encrypt(request('prenom')),
                    'email' => Crypt::encrypt(request('email')),
                    'telephone' => Crypt::encrypt(request('telephone')),
                    'mobile' => Crypt::encrypt(request('mobile')),
                    'rue' => Crypt::encrypt(request('rue')),
                    'nrue' => Crypt::encrypt(request('nrue')),
                    'pays' => Crypt::encrypt(request('pays')),
                    'num_compte' => Crypt::encrypt(request('numcompte')),
                    'delai_paiement' => Crypt::encrypt(request('delai')),
                    'reference_personnel' => Crypt::encrypt(request('reference')),
                    'remarque' => Crypt::encrypt(request('remarque')),
                    'localite_id' => $localite->id,
                    'assujetti_id' => $assujetti->id,
                ]);
            });
        }
        
         flash('Le nouveau fournisseur a bien été enregistré.')->success();
         return redirect('/fournisseurs');
    }

    /**
     * Afficher un fournisseur
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // récupère le fournisseur
        $fournisseur = Fournisseur::find($id);
        // affiche la vue et passe la variable
        return view('fournisseurs.show',[
            'fournisseur' => $fournisseur
        ]);
    }

    /**
     * Afficher le formulaire pour modifier le fournisseur
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // selectionne toutes les valeurs de la colonne intitule de la table assujettis 
        $assujettis = DB::table('assujettis')->select('intitule')->get();
        // boucle car même si les valeurs sont égales décryptées elles ne le sont pas dans la table
        $compare = null;
        foreach ($assujettis as $assujetti) {      
            if ($compare == Crypt::decrypt($assujetti->intitule)) {
                $assujettis->forget($assujettis->search($assujetti));
            }
            $compare = Crypt::decrypt($assujetti->intitule);
        }

        $fournisseur = Fournisseur::find($id);

        return view('fournisseurs.edit', [
            'fournisseur' => $fournisseur,
            'assujettis' => $assujettis,
        ]);
    }

    /**
     * Modifier le fournisseur spécifié
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation des champs du formulaire d'inscription
        $request->validate([
            'nom' => ['required', 'regex:/^[a-z éèàùç\'-]+$/i'],
            'prenom' => ['nullable', 'regex:/^[a-zA-Z éèàùç\'-]+$/i'],
            'email' => ['required', 'regex:/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/' ,'email'],
            'telephone' => ['required', 'numeric', 'min:8'],
            'mobile' => ['required', 'numeric', 'min:8'],
            'rue' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'nrue' => ['required', 'alpha_num'],
            'codepostal' => ['required', 'regex:/^([0-9]{4,5})$/'],
            'localite' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'pays' => ['required', 'regex:/^[a-z éèàùç.,\'-]+$/i'],
            'assujetti' => ['required', 'regex:/^[a-z ]+$/i'],
            'numcompte' => ['required', 'regex:/^[a-z0-9]+$/i'],
            'delai' => ['required']
        ]);
        // Récupère le fournisseur grâce à son id
        $fournisseur = Fournisseur::find($id);
        
        // Vérifie si la localité existe déjà en bd
        $localite="";       
        $localites = DB::table('localites')->get();        
        foreach ($localites as $item) {
            if (Crypt::decrypt($item->intitule) == request('localite') &&
                Crypt::decrypt($item->code_postal) == request('codepostal')) {
                $localite = $item;
            } 
        }
        // Vérifie si le type d'assujetissement existe déjà
        $assujetti = "";
        $assujettis = DB::table('assujettis')->get();   
        foreach ($assujettis as $item) {
            if (Crypt::decrypt($item->intitule) == request('assujetti') &&
                Crypt::decrypt($item->num_tva) == request('numtva')) {
                $assujetti = $item;
            }  
        }
        DB::transaction(function() use($localite, $assujetti, $fournisseur) {
            // Si la localité n'existe pas
            if (!$localite) {
                $localite = Localite::create([
                    'intitule' => Crypt::encrypt(request('localite')),
                    'code_postal' => Crypt::encrypt(request('codepostal')),
                ]);
            }
            // Si le type d'assujetissement n'existe pas
            if(!$assujetti) {
                $assujetti = Assujetti::create([
                    'intitule' => Crypt::encrypt(request('assujetti')),
                    'num_tva' => Crypt::encrypt(request('numtva')),
                ]);
            }
            $fournisseur->update([
                'civilite' => Crypt::encrypt(request('civilite')),
                'nom' => Crypt::encrypt(request('nom')),
                'prenom' => Crypt::encrypt(request('prenom')),
                'email' => Crypt::encrypt(request('email')),
                'telephone' => Crypt::encrypt(request('telephone')),
                'mobile' => Crypt::encrypt(request('mobile')),
                'rue' => Crypt::encrypt(request('rue')),
                'nrue' => Crypt::encrypt(request('nrue')),
                'pays' => Crypt::encrypt(request('pays')),
                'num_compte' => Crypt::encrypt(request('numcompte')),
                'delai_paiement' => Crypt::encrypt(request('delai')),
                'reference_personnel' => Crypt::encrypt(request('reference')),
                'remarque' => Crypt::encrypt(request('remarque')),
                'localite_id' => $localite->id,
                'assujetti_id' => $assujetti->id,
                
            ]);
        });
        flash('Le fournisseur a bien été mis à jour.')->success();
        return redirect('/fournisseurs');
    }

    /**
     * Supprimer un fournisseur
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::find($id);
        // modifie les achats de ce fournisseur à aucun fournisseur
        foreach ($fournisseur->achats as $achat) {
            $achat->update([
                'fournisseur_id' => null,
            ]);
        }
        $fournisseur->delete();

        // modifier le fournisseur, appliquer sur tous les champs l'id du fournisseur et pas le supprimer
        // $fournisseur->update([
        //     'nom' => $fournisseur->id,
        // ]);

        flash('Le fournisseur ' . Crypt::decrypt($fournisseur->nom) . ' ' . Crypt::decrypt($fournisseur->prenom) . ' a bien été supprimé.')->success();
        return redirect('/fournisseurs');
    }
}
